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
    
    
    /**
     * 
     */
    public function getTagByName($gid, $tagname){
        return $this->where( array('name' => $tagname, 'gid' => $gid, 'status' => 1) )->fetch();
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
    
    
    /**
     * 删除标签
     */
    public function deleteTag($tagid, $gid, $force=0){
        if($force){
            return $this->where( array('id' => $tagid, 'gid' => $gid) )->delete();
        }else{
            $data = array(
                'status' => 0,
            );
            return $this->where( array('id' => $tagid, 'gid' => $gid, 'status' => 1) )->update($data);
        }
    }
    
    
    
}
