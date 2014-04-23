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
        return $this->where( " `gid` = {$gid} AND status = 1")->fetchArray();
    }


    public function addTag($uid, $gid, $tagname){
        $gid = intval($gid);
        $tagname = filter($tagname);
        if($gid <= 0 || strlen( $tagname ) <= 0 || strlen($tagname) > 18 ){
            return false;
        }
        $is_exists = $this->isExistsTag($gid, $tagname);
        if(!empty($is_exists)){
            return -1;
        }
        $data = array(
            'gid' => $gid,
            'name' => $tagname,
            'uid' => $uid,
        );
        return $this->insert($data);
    }
    
    
    /**
     * 判断标签是否存在
     */
    public function isExistsTag($gid, $tagname){
        $data = array(
            'gid' => $gid,
            'name' => $tagname,
        );
        return $this->where( $data )->fetch();
    }
    
    
    
}
