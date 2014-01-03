<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
require( FRAMEWORK_PATH .'/Db/Driver/Mysql/Abstract.php' );
class Mysql extends Db_Abstract{
    
    public function __construct($config, $debug=0) {
        $beginTime = microtime(true);
        parent::__construct($config, $debug);
        $this->connect();
        if($this->_debug){
            $endTime = microtime(true);
            $this->_tace('链接数据库时间:'.($endTime-$beginTime));
        }
    }
    
    //连接数据库
    public function connect(){
        $func = $this->_config['pconnect'] ? 'mysql_pconnect' : 'mysql_connect';
        $this->links[] = $this->_link = $func($this->_config['host'].":".$this->_config['port'], $this->_config['username'], $this->_config['password']);
        if (! $this->_link ){
            die( '数据库连接失败，请检查你的数据库配置是否正确:'.@mysql_error());
        }
        mysql_select_db($this->_config['dbname']);
        $this->_setCharset();
    }
    
    private function _setCharset(){
        $this->query("SET NAMES ".$this->_config['charset']);
    }

    /**
     * 
     * @param String $type NORMAL UNBUFFERED
     */
    public function query($sql, $type = 'NORMAL'){
        //mysql_unbuffered_query的优点更主要在及时反应，不需要等待，当数据量少或者你需要查询的东西少的时候而mysql_query则在需要查询匹配大量的数据集时候 比较有优势。
		//1.mysql_unbuffered_query
		//mysql_unbuffered_query() 向 MySQL 发送一条 SQL 查询 query ，但不像 mysql_query() 那样自动获取并缓存结果集。一方面，这在处理很大的结果集时会节省可观的内存。另一方面，可以在获取第一行后立即对结果集进行操作，而不用等到整个 SQL 语句都执行完毕。
		//2.mysql_query
		// 函数执行一条 MySQL 查询。返回查询结果
		//如果没有打开的连接，本函数会尝试无参数调用 mysql_connect() 函数来建立一个连接并使用之。
		$func = $type == 'UNBUFFERED' && function_exists ( 'mysql_unbuffered_query' ) ? 'mysql_unbuffered_query' : 'mysql_query';
        $this->_query = $func($sql, $this->_link)or die(mysql_error());
    }
    
    
    
    /**
     * 获取单条记录
     */
    public function fetch($sql, $type = MYSQL_ASSOC){
        $this->query($sql);
        return mysql_fetch_array($this->_query, $type);
    }

    /**
     * 获取数据集
     * @param String $sql
     * @param Array $bind 
     * @param Const $type  MYSQL_BOTH MYSQL_NUM  MYSQL_ASSOC
     */
    public function fetchAll($sql, $type = MYSQL_ASSOC) {
        $result = array();
		$this->query($sql);
		while ($row = @mysql_fetch_array($this->_query, $type)){
			$result[current($row)] = $row;
		}
		return $result;
    }
    
    /**
     * 获取多条数据
     */
    public function fetchArray($sql, $type = MYSQL_ASSOC){
        $result = array();
		$this->query($sql);
		while ($row = @mysql_fetch_array($this->_query, $type)){
			$result[current($row)] = $row;
		}
		return $result;
    }


    /**
	 * @param string $sql
	 * @param array $bind
	 * @return array
	 */
	public function fetchCol($sql, $type = MYSQL_ASSOC)
	{
		$result = array();
		$this->execute($sql);
		while ($row = @mysql_fetch_array($this->_query, $type)){
			$result[] = current($row);
		}
		return $result;	
	}

	/**
	 * 获取第一条数据的第一列
	 * @param string $sql
	 * @return mixed 
	 */
	public function fetchFirstCol($sql, $type = MYSQL_ASSOC) {
       
		$this->execute($sql,$bind);
		$row = @mysql_fetch_array($this->_query, $type);
		if($row){
			return current($row);
		}else{
			return false;
		}
	}
    
    
    /**
	 * 遍历一个mysql_query或者mysql_unbuffered_query的返回值资源，将每一行放入数组
	 * @param resource $resource 一个资源变量，来自mysql_query或者mysql_unbuffered_query函数的返回值
	 * @return array 如果资源为false，或者资源不存在任何行则返回一个空数组，否则放回一个行集合数组 
	 */
	function queryToArray($resource) {
		$result = array ();
		if ($resource) {
			while ( $row = mysql_fetch_assoc ( $resource ) ) {
				$result [] = $row;
			}
		}
		return $result;
	}
    
    

    /**
     * 分页获取数据
     */
    public function page($sql, $page=1, $pageSize=10, $total=0){
        $page = intval($page);
        $pageSize = intval($pageSize);
        $total = intval($total);
        if( $page <= 1){
            $page = 1;
        }
        if($pageSize <= 0){
            $pageSize = 10;
        }
        if($total <= 0){
            $tocalSql = preg_replace ( '{select\s+\*\s+from}i', 'select count(1) from ', $sql );
			$tocalSql = preg_replace ( '{order\s+by\s+\w+(?:\s+(?:asc|desc))?}i', '', $tocalSql );
			$total = $this->fetchFirstCol ( $tocalSql );
        }
        if($total < 1){
			$pageInfo = array ('success' => 1, 'page' => $page, 'totalPage' => 0, 'pageSize'=>$pageSize, 'total' => 0, 'message' => '无数据' );
			return array ('list' => array (), 'pageinfo' => $pageInfo );
        }
        //根据页大小和当前总行数获取最大页数
		$totalPage = ceil ( $total / $pageSize );
        if ( $page > $totalPage ){
            $page = $totalPage;
        }
        $sql = $sql . ' limit ' . (($page - 1) * $pageSize) . ',' . $pageSize;
		$data = $this->queryToArray ( mysql_unbuffered_query ( $sql, $this->_link ) );
        if(!empty( $data )){
            $pageInfo = array ( 'success' => 1,'page' => $page, 'totalPage' => $totalPage, 'total' => $total, 'message' => '' );
            return array ('list' => $data, 'pageinfo' => $pageInfo );
        }else{
            $pageInfo = array ( 'success' => 0,'page' => $page, 'totalPage' => 0, 'total' => 0, 'message' => '分页失败' );
            return array ('list' => array (), 'pageinfo' => $pageInfo );
        }
    }
    
    
       
    
    
}

?>
