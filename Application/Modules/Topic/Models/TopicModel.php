<?php
/**
 * Description of TopicModel
 *
 * @author air
 */
class TopicModel extends Model{
    
    
    public function post($data){
        $result = $this->insert($data);
        if($result){
            return $this->lastInsertId();
        }
        return false;
    }
    
    
    
    public function getList($page = 1, $pageSize = 20 , $total = 0){
        return $this->page($page, $pageSize, $total);
    }
    
    
    
    
}

