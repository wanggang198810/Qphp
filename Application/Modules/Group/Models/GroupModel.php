<?php
/**
 * Description of GroupModel
 *
 * @author Administrator
 */
class GroupModel extends Model{
    
    public function getHotGroups($limit = 5){
        return $this->where( " `status` > 0" )->limit(" LIMIT {$limit}")->order( " order by num desc ")->fetchArray();
    }
    
    public function getNewGroups($limit = 3){
        return $this->where( " `status` > 0 " )->limit(" LIMIT {$limit}")->order( " order by id desc ")->fetchArray();
    }
    
    public function getGroup($id){
        if( intval($id) <= 0 ){ return false; }
        return $this->where( array('id' => intval($id) ) )->fetch();
    }
    
    public function getGroupList($page=1, $pageSize=20, $total=0){
        return $this->where( " `status` > 0" )->order(" order by num desc")->page($page, $pageSize, $total);
    }

    public function getGroupByUrl($url){
        $url = filter($url);
        if(empty($url)){
            return false;
        }
        return $this->where( array('url' => $url ) )->fetch();
    }
    
    public function getGroupByUid($uid){
        if( intval($uid) <= 0 ){ return false; }
        return $this->table('groupuser')->where( array('uid' => intval($uid) ) )->fetchArray();
    }

    /**
     * 添加
     */
    public function createGroup($name, $info, $creator, $status, $time, $url = '', $logo = ''){
        if(empty($name) || intval($creator) <= 0 ){
            return false;
        }
        if(!$this->createPermission($creator)){
            return false;
        }
        return $this->insert( array('name' => trim( $name ), 'info'=> trim( $info ), 'creator' => intval($creator), 'status' => $status , 'time' => $time , 'url'=> $url ,'logo' => $logo) , 1);
    }
    
    
    /**
     * 修改
     */
    public function editGroup($id, $uid, $data){
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
    public function deleteGroup($id, $uid) {
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
        $data = $this->where( array('id'=> intval($id), 'creator'=> intval($uid) ) )->fetch();
        if(!empty($data)){
            return true;
        }
        return false;
    }
    
    public function createPermission($uid){
        $num = $this->getGroupNumByCreator($uid);
        if($num < Q::getConfig('max_create_group')){
            return true;
        }
        return false;
    }
    
    
    public function getTagList($id){
        if(intval($id) <= 0){
            return false;
        }
        return $this->where( array('gid' => intval($id) ) )->fetchArray();
    }
    
    
    public function getRecentGroupMembers($gid){
        $gid = intval($gid);
        if($gid <= 0){ return false;}
        $sql = "select b.uid, b.username, b.blogname from groupuser a LEFT JOIN user b on a.uid = b.uid where gid = {$gid} order by id desc limit 12";
        return $this->fetchArrayBySql($sql);
    }
    
    public function getGroupMembers($gid, $page=1, $pageSize=20, $total=0){
        $gid = intval($gid);
        if($gid <= 0){ return false;}
        $sql = "select b.uid, b.username, b.blogname from groupuser a LEFT JOIN user b on a.uid = b.uid where gid = {$gid} order by id desc";
        return $this->page($page, $pageSize, $total, $sql);
    }
    
    public function getGroupsbyUid($uid, $iscreator=0){
        $uid = intval($uid);
        if($uid <= 0){ return false;}
        $sql = "select b.id, b.name, b.url from `groupuser` a LEFT JOIN `group` b on a.gid = b.id where a.uid = {$uid} and b.status > 0";
        if($iscreator){
            $sql .= ' and a.uid = b.creator ';
        }
        $result = $this->fetchArray($sql);
        return $result;
    }
    
    public function getGroupsByCreator($uid){
        $uid = intval($uid);
        if($uid <= 0){ return false;}
        $sql = "select `name`, `url`, `info`, `logo`, `top`, `num`, `time` from `group` where creator = {$uid} and status > 0";
        $result = $this->fetchArray($sql);
        return $result;
    }
    
    public function getGroupNumByCreator($uid){
        $uid = intval($uid);
        if($uid <= 0){ return false;}
        $sql = "select count(*) as `total` from `group` where `creator` = {$uid} and `status` > 0";
        $result = $this->fetch($sql);
        if($result){
            return $result['total'];
        }
        return 0;
    }
    
    
}
