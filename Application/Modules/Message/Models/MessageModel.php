<?php
/**
 * Description of MessageModel
 *
 * @author Air
 */
class MessageModel extends Model{

    
    public function getMessage($id, $uid){
        $id = intval($id);
        $uid = intval($uid);
        if($id <= 0 || $uid <= 0){ return false;}
        //$sql = "SELECT * FROM ".$this->table('message') . " WHERE `id` = {$id} and ( touid = {$uid} or fromuid = {$uid})";
        //return $this->fetch($sql);
        return $this->where( array( 'id'=>$id, 'touid'=>$uid) )->fetch();
    }
    
    public function getMessageRecord($id){
        $id = intval($id);
        if($id <= 0){ return false;}
        return $this->where( array( 'msgid'=>$id ) )->fetch();
    }
    
    public function getMessageList($uid, $system=0, $status=1, $page=1, $pageSize=20, $total=0){
        $uid = intval($uid);
        if($uid <= 0){ return false;}
        $where = array('touid'=>$uid, 'system'=>$system);
        if($status != -1){
            $where['status'] = $status;
        }
        return $this->where($where)->order(" ORDER BY id DESC")->page($page, $pageSize, $total);
    }
    
    public function getMessageCount($uid){
        $uid = intval($uid);
        if($uid <= 0){ return false;}
        $sql = "SELECT count(*) as total from `message` where touid = {$uid} and status = 1";
        $result = $this->fetch($sql);
        if($result){
            return $result['total'];
        }
        return false;
    }

    public function updateMessageStatus($id, $uid) {
        $id = intval($id);
        $uid = intval($uid);
        if($id <= 0 || $uid <= 0){ return false;}
        return $this->where( array( 'id'=>$id, 'touid'=>$uid) )->update( array('status' => 0));
    }

    
    public function sendMsg($to_uid, $from_uid, $content, $msgid=0, $system=0, $temp_id=0){
        if($system == 0 && strlen($content) < 5){return false;}
        $data = array(
            'touid' => $to_uid,
            'fromuid' => $from_uid,
            'content' => $content,
            'msgid' => $msgid,
            'system' => $system,
            'tempid' => $temp_id,
            'time' => time(),
        );
        return $this->insert($data);
    }
    
    public function addMsg(){
        
    }
    
    
    public function getTemplate($temp_id){
        $temp_id = intval($temp_id);
        switch ($temp_id){
            case 100:
                $msg = "欢迎加入同能社区，请遵严格遵守我国法律和同能网相关规定，祝你在同能有个愉快的网络生活";
                break;
            default :
                break;
        }
        return $msg;
    }
    
    public function parseMsg($msg){
        
    }
    
    
}
