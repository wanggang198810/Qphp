<?php
/**
 * Description of MessageModel
 *
 * @author Air
 */
class MessageModel extends Model{

    public function getMessageList(){
        
    }
    
    public function getSystemMessageList(){
        
    }
    
    
    public function sendMsg($to_uid, $from_uid, $content, $temp_id=0){
        
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
        
        
    }
    
    public function parseMsg($msg){
        
    }
    
    
}
