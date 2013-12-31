<?php
/**
 * Description of GroupModel
 *
 * @author Administrator
 */
class GroupModel extends Model{
    
    public function get($id){
        if( intval($id) <= 0 ){ return false; }
        return $this->where( array('id' => intval($id) ) )->fetch();
    }

    public function getGroupByUrl($url){
        $url = filter($url);
        if(empty($url)){
            return false;
        }
        return $this->where( array('url' => $url ) )->fetch();
    }

    /**
     * 添加
     */
    public function add($name, $uid, $url = ''){
        if(empty($name) || intval($uid) <= 0 ){
            return false;
        }
        return $this->insert( array('name' => $name, 'uid' => intval($uid), 'url'=> $url) );
    }
    
    
    /**
     * 修改
     */
    public function edit($id, $uid, $data){
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
    public function delete($id, $uid) {
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
    
    
    public function getTagList($id){
        if(intval($id) <= 0){
            return false;
        }
        return $this->where( array('gid' => intval($id) ) )->fetchArray();
    }
}
