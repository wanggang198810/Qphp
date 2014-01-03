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
    
    
    public function getTopics($uid, $type=1, $limit = 5, $start=''){
        $type = intval($type);
        $uid = intval($uid);
        if($uid <= 0 ){ return false; }
        if( !empty($start)){
            $limitSql = " LIMIT {$start}, $limit";
        }else{
            $limitSql = " LIMIT {$limit}";
        }
        return $this->where( array('type'=>$type) )->limit( $limitSql )->order(' order by id desc')->fetchArray();
    }
    
    
    public function getTopicList($uid, $type=1, $page = 1, $pageSize = 20 , $total = 0){
        if( $type != 0 ){
           $where['type'] = $type;
        }
        $where['uid'] = $uid;
        return $this->where( $where )->order( " order by id DESC")->page($page, $pageSize, $total);
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

