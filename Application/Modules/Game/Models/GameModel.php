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
    
    
    /**
     * 获取游戏类型，
     * @param Integer $gid '0：游戏分类,1:游戏集，2:模拟器游戏,3:同能原创游戏',
     */
    public function getGameType($gid=-1, $limit=20){
        $gid = intval($gid);
        $limit = intval($limit);
        if($gid > -1){
            $where = array('groupid' => $gid);
        }else{
            $where = 1;
        }
        $this->setTable('game_type');
        return $this->where($where)->limit(" LIMIT {$limit}")->order(" ORDER BY sortid DESC")->fetchArray();
    }
}

?>
