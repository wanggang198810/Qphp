<?php
/**
 * Description of CategoryModel
 *
 * @author air
 */
class CategoryModel extends Model{
    //put your code here
    
    
    public function getCategoryByUid( $uid ){
        if(intval($uid) <= 0 ){ return false; }
        $data = $this->where( array('uid'=>$uid))->fetchArray();
        return $data;
    }
}

?>
