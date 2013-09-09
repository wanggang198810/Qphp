<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Model {
    //put your code here
    private $table;
    private $tablePrex='';
    private $config;
    
    public $db;


    public function __construct($name='') {
        $this->config = get_config('db');
        $this->db = new self();
        $this->table = $this->tablePrex.$this->db->table($name);
        //$this->db = new Mysql();
    }
    
    
    public function add($data){
        if(empty($data)){
            return false;
        }
        return $this->db->insert($this->table,$data);
    }
    
    public function update($data){
        return $this->db->update($this->table,$data);
    }
    
    
    public function delete(){
        $this->db->delete($this->data->where);
    }
    
    public function where($data){
        if(is_array($data)){
            $data = $this->db->buildData($data);
            $this->db->setWhere($data);
        }
        return $this->db;
    }
    
    public function find(){
        $this->db->fetchOne();
    }
}

?>
