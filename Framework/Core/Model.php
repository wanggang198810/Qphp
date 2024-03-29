<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Model {

    protected $db;
    protected $_table;
    protected $_tablePrex='';
    protected $_config;
    protected $_sql;
    protected $_validate       = array();  // 自动验证定义
    protected $_auto         = array();  // 自动完成定义
    protected $_columField = '*';

    public function __construct($name='') {
        $this->_config = Q::getConfig('dbconfig');
        $db = ucfirst( $this->_config['dbtype'] );
        //$name= get_class($this);
        
        $filename = FRAMEWORK_PATH . '/Db/Driver/'.$db.'/'.$db.'.php';
        if(file_exists($filename)){
            require_once ( $filename);
            $this->db = new $db($this->_config);
        }else{
            exit( $db . "数据库驱动不存在!");
        }
        
        if(empty($name)){
            $model = get_class($this);
            $name = strtolower( str_replace( 'Model','', $model) );
        }
        $name = strtolower($name);
        $this->_tablePrex = $this->_config['tableprex'];
        $this->db->table = $this->_table = $this->_tablePrex . $name;
        $this->db->table = $name;
        $this->db->tablePrex = $this->_tablePrex ;
        //$this->table = $this->tablePrex.$this->db->table($name);
        $this->_table = $name;
    }
    
    
    public function table($name){
        return $this->db->table($name);
    }
    
    public function setTable($name){
        return $this->_table = $name;
    }
    
    /**
     * 使用正则验证数据
     * @access public
     * @param string $value  要验证的数据
     * @param string $rule 验证规则
     * @return boolean
     */
    public function regex($value,$rule) {
        $validate = array(
            'require'   =>  '/.+/',
            'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
            'currency'  =>  '/^\d+(\.\d+)?$/',
            'number'    =>  '/^\d+$/',
            'zip'       =>  '/^\d{6}$/',
            'integer'   =>  '/^[-\+]?\d+$/',
            'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
            'english'   =>  '/^[A-Za-z]+$/',
        );
        // 检查是否有内置的正则表达式
        if(isset($validate[strtolower($rule)]))
            $rule       =   $validate[strtolower($rule)];
        return preg_match($rule,$value)===1;
    }
    
    /**
     * $this->_auto = array('key','value','where','type');
     *                
     */
    public function auto($data){
        if(empty($this->_auto)){
            return;
        }
        foreach($this->_auto as $k => $v){
            switch ($v[3]) {
                case 'function':
                    call_user_func_array($data[$v[4]], $v[5]);
                    break;

                case 'string':
                default:
                    $data[$v[0]]=$v[1];
                    break;
            }
        }
    }
    
    public function validate(){
        
    }
    
    public function fetch($sql=''){
        if(!empty($sql)){
            $this->_sql = $sql;
        }else{
            $this->_sql = "select * from ".$this->db->table( $this->_table )." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder();
        }
        return $this->db->fetch( $this->_sql );
    }
    public function find($sql=''){
        return $this->fetch($sql);
    }
    
    public function fetchArray($sql = ''){
        if(!empty($sql)){
            $this->_sql = $sql;
        }else{
            $this->_sql = "select * from ".$this->db->table( $this->_table ) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder(). " ". $this->db->getLimit();
        }
        return $this->db->fetchArray($this->_sql);
    }
    
    public function fetchCol(){
        $this->_sql = "select * from ".$this->db->table( $this->_table ) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder(). " ". $this->db->getLimit();
        return $this->db->fetchCol($this->_sql);
    }
    
    public function fetchLocateCol($field){
        $this->_sql = "select * from ".$this->db->table( $this->_table ) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder(). " ". $this->db->getLimit();
        return $this->db->fetchLocateCol($this->_sql, $field);
    }
    
    public function getAll(){
        return $this->fetchArray();
    }
    
    public function fetchArrayBySql($sql){
        if( empty($sql)){ return false;}
        return $this->db->fetchArray($sql);
    }
    
    public function increment($field, $where){
        return $this->db->increment($field, $where, $this->_table);
    }
    
    public function getSql(){
        return $this->_sql;
    }
    
    public function setSql($sql=''){
        if( empty($sql)){
            $this->_sql = "select * from ".$this->db->table( $this->_table ) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder(). "". $this->db->getLimit();
        }else{
            $this->_sql;
        }
    }
    
    public function setColumField($data = '*'){
        $colum_str = '';
        if( is_array($data)){
            foreach($data as $k => $v){
                $colum_str .= '`' . $v . '`,';
            }
            $this->_columField = trim( $colum_str , ',');
        }else{
            $this->_columField = $data;
        }
        
        return $this;
    }
    
    public function getColumField(){
        return $this->_columField;
    }
    
    public function page($page=1, $pageSize=10, $total=0, $sql =''){
        if(!empty($sql)){
            $this->_sql = $sql;
        }else{
            $this->_sql = "select * from ".$this->db->table($this->_table) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder();
        }
        return $this->db->page($this->_sql, $page, $pageSize, $total);
    }
    
    public function add($data, $lastInsert=false){
        if(empty($data)){
            return false;
        }
        return $this->db->insert($this->_table,$data, $lastInsert);
    }
    
    public function insert($data, $lastInsert=false){
        return $this->add($data, $lastInsert);
    }
    
    public function multiInsert($data){
        if(empty($data)){
            return false;
        }
        return $this->db->multiInsert($this->_table,$data);
    }
    
    public function lastInsertId(){
        return $this->db->lastInsertId();
    }
    
    public function update($data){
        return $this->db->update($this->_table,$data, $this->db->getWhere());
    }
    
    
    public function count($countStr = 'count(*)'){
        $this->_sql = "select {$countStr} from ".$this->db->table($this->_table) ." where ".$this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving." ".$this->db->getOrder();
        return $this->db->query($this->_sql);
    }


    public function delete(){
        return $this->db->delete($this->_table,$this->db->getWhere(), 1);
    }
    
    public function limit($str){
        if( !empty($str)){
            $this->db->setLimit( $str );
        }
        return $this;
    }
    
    public function where($data){
        if(!empty($data)){
            $this->db->setWhere($data);
        }
        return $this;
    }
    
    public function group($str){
        if(!empty($str)){
            $this->db->setGroup($str);
        }
        return $this;
    }
    
    public function having($str){
        if(!empty($str)){
            $this->db->setHaving($str);
        }
        return $this;
    }
    
    public function order($str){
        if(!empty($str)){
            $this->db->setOrder($str);
        }
        return $this;
    }
    
    public function beginTransaction(){
        $this->db->beginTransaction();
    }
    
    public function commit(){
        $this->db->commit();
    }
    
    public function rollback(){
        $this->db->rollBack();
    }
    
}


