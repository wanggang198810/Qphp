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
}
