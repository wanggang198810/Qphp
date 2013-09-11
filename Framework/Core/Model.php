<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Model {
    //put your code here
    protected $db;
    protected $table;
    protected $tablePrex='';
    protected $_config;
    protected $_sql;
    protected $_validate       = array();  // 自动验证定义
    protected $_auto           = array();  // 自动完成定义


    public function __construct($name='') {
        $this->_config = Q::getConfig('dbconfig');
        $db = $this->_config['dbtype'];
        //$name= get_class($this);
        if($name){
            $this->tablePrex = $this->_config['tablePrex'];
            $this->db->table = $this->table = $this->tablePrex . $name;
        }
        $filename = FRAMEWORK_PATH . '/Db/Driver/'.$db.'/'.$db.'.php';
        if(file_exists($filename)){
            include( $filename);
        }
        
        $this->db = new $db($this->_config);
        $this->db->table = $name;
        $this->db->tablePrex = $this->tablePrex ;
        $this->table = $this->tablePrex.$this->db->table($name);
    }
    
    public function fetch(){
        $this->_sql = "select * from ".$this->table ." ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder() . " LIMIT 1";
        return $this->db->fetch( $this->_sql );
    }
    public function find(){
        $this->db->fetch();
    }
    
    public function fetchArray(){
        $this->_sql = "select * from ".$this->table ." ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving." ".$this->db->getOrder();
        return $this->db->fetchArray($this->_sql);
    }
    public function getAll(){
        return $this->fetchArray();
    }
    
    public function page($page=1, $pageSize=10, $total=0){
        $this->_sql = "select * from ".$this->table ." ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder();
        return $this->db->page($this_sql, $page, $pageSize, $total);
    }
    
    public function add($data){
        if(empty($data)){
            return false;
        }
        return $this->db->insert($this->table,$data);
    }
    
    public function insert($data){
        return $this->add($data);
    }
    
    public function update($data){
        return $this->db->update($this->table,$data);
    }
    
    
    public function count($countStr = 'count(*)'){
        $this->_sql = "select {$countStr} from ".$this->table ." ".$this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving." ".$this->db->getOrder();
        return $this->db->query($this->_sql);
    }


    public function delete(){
        $this->db->delete($this->db->where);
    }
    
    public function where($data){
        if(!empty($data)){
            $this->db->setWhere($data);
        }
        return $this->db;
    }
    
    public function group($str){
        if(!empty($str)){
            $this->db->setGroup($str);
        }
        return $this->db;
    }
    
    public function having($str){
        if(!empty($str)){
            $this->db->setHaving($str);
        }
        return $this->db;
    }
    
    public function order($str){
        if(!empty($str)){
            $this->db->setOrder($str);
        }
        return $this->db;
    }
    
    
}

?>
