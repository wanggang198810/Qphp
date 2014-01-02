<?php
/**
 * Description of TopicModel
 *
 * @author air
 */
class TopicModel extends Model{
    
    
    public function post($data){
        $result = $this->insert($data, 1);
        if($result){
            return $result;
        }
        return false;
    }
    
    
    
    public function getTopicList($uid, $page = 1, $pageSize = 20 , $total = 0){
        return $this->where( array('uid'=>$uid) )->page($page, $pageSize, $total);
    }
    
    
    public function getTopicByGid($gid , $page = 1, $pageSize = 20 , $total = 0){
        return $this->where( array('gid'=>$gid) )->page($page, $pageSize, $total);
    }
    
    
    public function getTopic($id){
        if( intval($id) <= 0 ){ return false; }
        return $this->where( array('id' => intval($id) ) )->fetch();
    }
    
    
    /**
     * 修改
     */
    public function editTopic($id, $uid, $data){
        $id = intval($id);
        if($id <= 0 || empty($data)){
            return false;
        }
        if(!$this->hasPermission($id, $uid)){
            return false;
        }
        return $this->where( array('id' => $id))->update($data);
    }
    
    
    /**
     * 删除
     */
    public function deleteTopic($id, $uid) {
        $id = intval($id);
        if($id <= 0){
            return false;
        }
        if(!$this->hasPermission($id, $uid)){
            return false;
        }
        $this->where( array('id' => $id) )->delete();
    }
    
    
    /**
     * 检测权限
     */
    public function hasPermission($id, $uid){
        $data = $this->where( array('id'=> intval($id), 'uid'=> intval($uid) ) )->fetch();
        if(!empty($data)){
            return true;
        }
        return false;
    }
    
    
}

