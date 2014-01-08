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
    
    
    public function getGroupMembers($gid, $page=1, $pageSize=20, $total=0){
        $gid = intval($gid);
        if($gid <= 0){ return false;}
        return $this->where( array( 'gid'=>$gid) )->order(" order by id desc")->page($page, $pageSize, $total);
    }
}

?>
