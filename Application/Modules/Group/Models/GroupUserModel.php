<?php
/**
 * Description of GroupUserModel
 *
 * @author air
 */
class GroupUserModel extends Model{
    
    public function getGroupsByUid( $uid , $field = '' ){
        if( intval($uid) <= 0 ){ return false; }
        if(empty($field)){
            return $this->where( array('uid' => intval($uid) ) )->fetchArray();
        }else{
            return $this->where( array('uid' => intval($uid) ) )->fetchLocateCol($field);
        }
    }
    
    
    public function getGroupInfoByUid( $uid  ){
        if( intval($uid) <= 0 ){ return false; }
        $sql = "select b.* from groupuser a LEFT JOIN `group` b on a.gid = b.id where a.uid = {$uid}";
        return $this->fetchArrayBySql($sql);
    }
    
    
    public function getGroupMembers2($gid, $page=1, $pageSize=20, $total=0){
        $gid = intval($gid);
        if($gid <= 0){ return false;}
        return $this->where( array( 'gid'=>$gid) )->order(" order by id desc")->page($page, $pageSize, $total);
    }
    
    public function getGroupMembers($gid, $page=1, $pageSize=20, $total=0){
        $gid = intval($gid);
        if($gid <= 0){ return false;}
        $sql = "select b.uid, b.username, b.blogname, a.manager from groupuser a LEFT JOIN user b on a.uid = b.uid where gid = {$gid} order by id desc";
        return $this->page($page, $pageSize, $total, $sql);
    }
    
    
    /**
     * 获取群组管理员
     */
    public function getGroupManager($gid){
        $gid = intval($gid);
        if($gid <= 0){ return false;}
        $sql = "select b.uid, b.username, b.blogname from groupuser a LEFT JOIN user b on a.uid = b.uid where gid = {$gid} AND manager > 0  order by id desc";
        return $this->fetchArray($sql);
    }
    
    public function isInGroup($gid, $uid){
        $gid = intval($gid);
        $uid = intval($uid);
        if($gid <= 0 || $uid <= 0){ return false;}
        
        $result = $this->where( array('uid'=>$uid, 'gid'=> $gid))->fetch();
        if(!empty($result)){ 
            if($result['manager'] > 0){
                return 2;
            }else{
                return 1;
            }
        }
        return 0;
    }
    
    public function isManager($gid, $uid){
        $gid = intval($gid);
        $uid = intval($uid);
        if($gid <= 0 || $uid <= 0){ return false;}
        
        $result = $this->where( array('uid'=>$uid, 'gid'=> $gid, 'manager' => 1))->fetchLocateCol('id');
        if(!empty($result)){ 
            return true;
        }
        return false;
    }
    
    public function join($gid , $uid){
        $gid = intval($gid);
        $uid = intval($uid);
        if($gid <= 0 || $uid <= 0){ return false;}
        return $this->insert(array( 'gid'=>$gid, 'uid'=> $uid));
    }
    
    public function leave($gid , $uid){
        $gid = intval($gid);
        $uid = intval($uid);
        if($gid <= 0 || $uid <= 0){ return false;}
        return $this->where( array('gid'=> $gid, 'uid'=>$uid) )->delete();
    }
}


