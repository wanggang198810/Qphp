<?php

/**
 * Description of GameModels
 *
 * @author air
 */
class GameModel extends Model{
    //put your code here
    
    public function getGameList($type=0, $gid=0){
        $result = $this->where("1")->order("order by id desc")->limit("Limit 20")->fetchArray();
        return $result;
    }
    
    
    public function getGame($id){
        $id = intval($id);
        return $this->where( array('id' => $id , 'status' => 1))->fetch();
    }
}

?>
