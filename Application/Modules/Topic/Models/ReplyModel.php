<?php
/**
 * Description of ReplyModel
 *
 * @author air
 */
class ReplyModel extends Model{
    
    /**
     * 添加回复
     */
    public function addReply($data){
        if(empty($data)){
            return false;
        }
        return $this->insert($data, 1);
    }
    
    public function getReplysByTopic($topicid, $page=1, $pageSize=20, $total=0){
        $topicid = intval($topicid);
        if($topicid <= 0){ return false;}
        $page = intval($page) < 1 ? intval($page) : 1;
        $data = $this->where( " topicid = {$topicid} " )->page($page, $pageSize, $total); // and replyid = 0
        /*
        foreach($data['list'] as $k => $v){
            $data['list'][$k]['replys'] = $this->getReplysByReply($v['id']);
        }*/
        return $data;
    }
    
    public function getReplysByReply($replyid, $page=1, $pageSize=20, $total=0){
        $replyid = intval($replyid);
        if( $replyid <= 0){ return false;}
        
    }
}

?>
