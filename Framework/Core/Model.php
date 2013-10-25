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
    protected $_table;
    protected $_tablePrex='';
    protected $_config;
    protected $_sql;
    protected $_validate       = array();  // 自动验证定义
    protected $_auto         = array();  // 自动完成定义


    
    public function __construct($name='') {
        $this->_config = Q::getConfig('dbconfig');
        $db = $this->_config['dbtype'];
        //$name= get_class($this);
        
        $filename = FRAMEWORK_PATH . '/Db/Driver/'.$db.'/'.$db.'.php';
        if(file_exists($filename)){
            include( $filename);
            $this->db = new $db($this->_config);
        }else{
            exit( $db . "数据库驱动不存在!");
        }
  
        if($name){
            $this->_tablePrex = $this->_config['tableprex'];
            $this->db->table = $this->_table = $this->_tablePrex . $name;
            $this->db->table = $name;
            $this->db->tablePrex = $this->_tablePrex ;
            //$this->table = $this->tablePrex.$this->db->table($name);
            $this->_table = $name;
        }
        
    }
    
    
    public function table($name){
        return $this->db->table($name);
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
    
    public function fetch(){
        $this->_sql = "select * from ".$this->db->table( $this->_table )." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder() . " LIMIT 1";
        return $this->db->fetch( $this->_sql );
    }
    public function find(){
        return $this->fetch();
    }
    
    public function fetchArray(){
        $this->_sql = "select * from ".$this->db->table( $this->_table ) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving." ".$this->db->getOrder();
        return $this->db->fetchArray($this->_sql);
    }
    public function getAll(){
        return $this->fetchArray();
    }
    
    public function page($page=1, $pageSize=10, $total=0){
        $this->_sql = "select * from ".$this->db->table($this->_table) ." where ". $this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving()." ".$this->db->getOrder();
        return $this->db->page($this->_sql, $page, $pageSize, $total);
    }
    
    public function add($data){
        if(empty($data)){
            return false;
        }
        return $this->db->insert($this->_table,$data);
    }
    
    public function insert($data){
        return $this->add($data);
    }
    
    public function update($data){
        return $this->db->update($this->_table,$data, $this->db->getWhere());
    }
    
    
    public function count($countStr = 'count(*)'){
        $this->_sql = "select {$countStr} from ".$this->db->table($this->_table) ." where ".$this->db->getWhere()." ".$this->db->getGroup()." ".$this->db->getHaving." ".$this->db->getOrder();
        return $this->db->query($this->_sql);
    }


    public function delete(){
        return $this->db->delete($this->_table,$this->db->getWhere());
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

?>
