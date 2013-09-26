<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
include(FRAMEWORK_PATH .'/Db/Driver/Mysql/Base.php');
include(FRAMEWORK_PATH .'/Db/Driver/Mysql/Interface.php');

abstract class Db_Abstract extends Db_Base implements Db_Interface {
    //put your code here
    //数据库配置信息
    protected $_config;
    
    protected $_table;
    
    protected $_tablePrefix;

    //是否开启debug模式,记录错误
    protected $_debug=0;
    //错误信息
    protected $_debugInfo;

    //数据库连接池
    protected $_links;
    
    //当前连接
    protected $_link;
    
    //当前查询句柄
    protected $_query;
    
    protected $_sql;
    //操作条件
    protected $_where;
    
    //group分组
    protected $_group;
    
    //having 分组
    protected $_having;

    //order 分组
    protected $_order;
    
    
    /**
     * 初始化数据库信息
     */
    public function __construct($config=array(), $debug=0) {
        if( !empty($config) ){
            $this->_config = $config;
        }
        $this->debug = $debug;
    }
    
    /**
     * 执行sql
     */
    public function execute($sql){
        return $this->_query = mysql_query($sql, $this->_link);
    }
    
    public function insert($table,$data,$lastInsertid=false,$replaceInto=false){
		$ret = $this->_parseInsertSet($data);
		$func = $replaceInto ? 'REPLACE' : 'INSERT';
		$sql = sprintf("%s INTO %s(%s) VALUES(%s)",$func,$this->table( $table),$ret['field'],$ret['value']);
		$result = $this->execute($sql);
        if($lastInsertid){
            $this->lastInsertId();
        }
        return $result;
	}
    
    public function multiInsert($table,$data){
        $values = $gas = '';
        foreach ($data as $k => $v){
            $ret = $this->_parseInsertSet($v);
            $values .= $gas.'('.$ret['value'].')';
            $gas = ',';
        }
        $sql = sprintf("INSERT INTO %s (%s) VALUES %s",$table, $ret['field'], $values);
        return $this->execute($sql);
    }
    
    
    public function delete($table, $where, $limit=1){
        $this->_where = $this->_parseWhere($where);
        $limit = ($limit > 0)? " LIMIT {$limit}" : "";
        $sql = "DELETE FROM ".$this->table($table)." WHERE ".$this->_where.$limit;
        return $this->execute($sql);
    }
    
    public function update($table, $data, $where='', $order='', $limit='', $group=''){
        $data = $this->_parseData($data);
		$sql = sprintf("UPDATE %s SET %s",$this->table( $table ),$data);
        if ($where != '') $sql .= ' WHERE '.$this->_parseWhere($where);
		if ($order != '') $sql .= ' ORDER BY '.$order;
		if ($group != '') $sql .= ' GROUP BY '.$group;
		if ($limit != '') $sql .= ' LIMIT '.$limit;
        return $this->execute($sql);
    }


    public function fetch($sql,$bind=array()){
        
    }
    
    /**
	 * 返回结果集中第一列的所有值(一维数组)
	 * @param string $sql
	 * @return array
	 */
	public function fetchCol($sql)
	{
		$data = array();
		$result = $this->fetchAll($sql);
		foreach ($result as $row){
			$data[] = current($row);
		}
		return $data;
	}

	/**
	 * 执行SQL并返回结果集中第一行第一列的值
	 * @param string $sql
	 * @return array
	 */
	public function fetchFirstCol($sql)
	{
		$result = $this->fetchAll($sql);
		if($result){
			return current(current($result));
		}else{
			return false;
		}
	}
    
    public function affectedRows() {
        return mysql_affected_rows($this->_link);
    }
    
    
    public function beginTransaction(){
        $bool = $this->query('SET AUTOCOMMIT=0');
		if(! $bool){
			return false;
		}
		return $this->query('BEGIN');
    }

    public function commit() {
        $bool = $this->query('COMMIT');
		if(! $bool){
			return false;
		}
		return $this->query('SET AUTOCOMMIT=1');	
    }

    public function rollBack() {
        $bool = $this->query('ROLLBACK');
		if(! $bool){
			return false;
		}
		return $this->query('SET AUTOCOMMIT=1');;
    }


    public function lastInsertId() {
        /**
		 *  [PHP手册]
		 * 
		 * 如果 AUTO_INCREMENT 的列的类型是 BIGINT，则 mysql_insert_id() 返回的值将不正确。
		 * 可以在 SQL 查询中用 MySQL 内部的 SQL 函数 LAST_INSERT_ID() 来替代。
		 * 
		 */
		$id = $this->fetchOne('select last_insert_id()');
		return $id ? $id : 0;
    }
    
    public function rowCount(){
        return @mysql_num_rows($this->_query);
    }
    
    public function errorMsg(){
        return @mysql_error($this->_link);
    }
    
    public function errorNo() {
        return @mysql_errno($this->_link);
    }

    public function escape($str) {
        $str = @mysql_real_escape_string($str,$this->_link);
		return "'$str'";
    }
 
    public function close(){
        @mysql_free_result($this->_query);
        @mysql_close($this->_link);
        return true;
    }
    
    
    public function _trace($key, $value){
        $this->_debugInfo[$key] = $value;
    }

    
    public function table($table){
        return "`".$this->_tablePrefix . $table."`";
    }
    
    public function setWhere($data){
        $this->_where = $this->_parseWhere($data);
    }
    
    public function setGroup($groupStr){
        $this->_group = $groupStr;
    }
    
    public function setHaving($havingStr){
         $this->_having = $havingStr;
    }
    
    public function setOrder($orderStr){
        $this->_order = $orderStr;
    }
    
    public function getWhere(){
        return $this->_where;
    }
    
    public function getGroup(){
        return $this->_group;
    }
    
    public function getHaving(){
        return $this->_having;
    }
    
    public function getOrder(){
        return $this->_order;
    }
    
}
?>
