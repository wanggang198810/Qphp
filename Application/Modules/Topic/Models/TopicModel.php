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
    
    
    public function getHotTopics($uid=0, $type=1, $limit = 5, $start=''){
        $where = array('status' => 1);
        $type = intval($type);
        $uid = intval($uid);
        if( $type > 0 ){
            $where['type'] = $type;
        }
        if($uid > 0){
            $where['uid'] = $uid;
        }
        
        if( !empty($start)){
            $limitSql = " LIMIT {$start}, $limit";
        }else{
            $limitSql = " LIMIT {$limit}";
        }
        return $this->where( $where )->limit( $limitSql )->order(' order by replynum desc')->fetchArray();
    }
    
    
    public function getRecomTopics($uid=0, $type=1, $limit = 5, $start=''){
        $where = '`status` > 0  and `top` > 0';
        $type = intval($type);
        $uid = intval($uid);
        if( $type > 0 ){
           $where .= ' and `type` = '.$type;
        }
        if($uid > 0){
            $where .= ' and `uid` = '.$uid;
        }
        
        if( !empty($start)){
            $limitSql = " LIMIT {$start}, $limit";
        }else{
            $limitSql = " LIMIT {$limit}";
        }
        return $this->where( $where )->limit( $limitSql )->order(' order by top desc')->fetchArray();
    }
    
    
    public function getTopics($uid=0, $type=1, $limit = 5, $start=''){
        $where = array('status' => 1);
        $type = intval($type);
        $uid = intval($uid);
        if( $type > 0 ){
           $where['type'] = $type;
        }
        if($uid > 0){
            $where['uid'] = $uid;
        }
        
        if( !empty($start)){
            $limitSql = " LIMIT {$start}, $limit";
        }else{
            $limitSql = " LIMIT {$limit}";
        }
        return $this->where( $where )->limit( $limitSql )->order(' order by id desc')->fetchArray();
    }
    
    
    public function getTopicList($uid=0, $type=1, $page = 1, $pageSize = 20 , $total = 0){
        $where = array('status' => 1);
        $type = intval($type);
        $uid = intval($uid);
        if( $type > 0 ){
           $where['type'] = $type;
        }
        if($uid > 0){
            $where['uid'] = $uid;
        }
        return $this->where( $where )->order( " order by id DESC")->page($page, $pageSize, $total);

    }
    
    
    public function getTopicByGid($gid , $page = 1, $pageSize = 20 , $total = 0){
        return $this->where( array('status' => 1, 'gid'=>$gid) )->order(" ORDER BY id DESC")->page($page, $pageSize, $total);
    }
    
    public function getTopicByGids($gid , $page = 1, $pageSize = 20 , $total = 0){
        $gidstr = implode(',', $gid);
        return $this->where( " gid in ({$gidstr})" )->order(" order by id desc")->page($page, $pageSize, $total);
    }
    
    
    
    public function getTopicsByTagid($tagid, $page = 1, $pageSize = 20 , $total = 0){
        $sql = "select a.*, b.username from topic a left join user b on a.uid = b.uid  where  a.tid = {$tagid} order by id desc";
        return $this->page($page, $pageSize, $total, $sql);
    }
    
    
    public function getTopic($id){
        if( intval($id) <= 0 ){ return false; }
        return $this->where( array('status' => 1,'id' => intval($id) ) )->fetch();
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
    public function deleteTopic($id, $uid, $real=0) {
        $id = intval($id);
        if($id <= 0){
            return false;
        }
        if(!$this->hasPermission($id, $uid)){
            //return false;
        }
        
        if($real){
            return $this->where( array('id' => $id) )->delete();
        }else{
            return $this->where( array('id' => $id) )->update(array('status'=>0));
        }
        
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

