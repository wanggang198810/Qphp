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
        return $this->where( array( 'gid'=>$gid))->fetchArray();
    }
}
