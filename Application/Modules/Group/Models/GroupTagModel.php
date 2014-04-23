<?php
/**
 * Description of GroupTagModel
 *
 * @author Administrator
 */
class GroupTagModel extends Model{
    
    public function getTagsByGid($gid){
        $gid = intval($gid);
        if($gid <= 0){ return false;} 
        return $this->where( " `gid` = {$gid} or `gid` = 0 ")->fetchArray();
    }


    public function addTag($uid, $gid, $tagname){
        $gid = intval($gid);
        $tagname = filter($tagname);
        if($gid <= 0 || strlen( tagname ) <= 0 || strlen($tagname) > 18 ){
            return false;
        }
        $data = array(
            'gid' => $gid,
            'name' => $tagname,
            'uid' => $uid,
        );
        return $this->insert($data);
    }
}
