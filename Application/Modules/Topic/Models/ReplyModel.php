<?php
/**
 * Description of ReplyModel
 *
 * @author air
 */
class ReplyModel extends Model{
    
    protected $_hasReplyed = false;


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
        $page = intval($page) < 1 ? 1 : intval($page);
        $data = $this->where( " topicid = {$topicid} " )->page($page, $pageSize, $total); // and replyid = 0
        /*
        foreach($data['list'] as $k => $v){
            $data['list'][$k]['replys'] = $this->getReplysByReply($v['id']);
        }*/
        return $data;
    }
    
    public function getReplyByRid($replyid){
        $replyid = intval($replyid);
        if( $replyid <= 0){ return false;}
        return $this->where( array('id' => $replyid) )->fetch();
    }
    
    public function getReplysByReply($replyid, $page=1, $pageSize=20, $total=0){
        $replyid = intval($replyid);
        if( $replyid <= 0){ return false;}
        
    }
    
    public function getReplysByType($type, $page=1, $pageSize=20, $total=0){
        return $this->page($page, $pageSize, $total);
    }
    
    public function agreeReply($replyid, $uid, $topicid){
        $replyid = intval($replyid);
        if( $replyid <= 0){ return false;}
        $result = $this->hasReplyed($replyid, $uid);
        if($result){
            return false;
        }
        $this->setTable('reply');
        $result = $this->increment('agree', array('id'=> $replyid));
        if($result){
            return $this->addAgreeRecord($replyid, $uid, 1, $topicid);
        }
        return false;
    }
    
    public function disagreeReply($replyid, $uid, $topicid){
        $replyid = intval($replyid);
        if( $replyid <= 0){ return false;}
        $result = $this->hasReplyed($replyid, $uid);
        if($result){
            return false;
        }
        $this->setTable('reply');
        $result = $this->increment('disagree', array('id'=> $replyid));
        if($result){
            return $this->addAgreeRecord($replyid, $uid, 0, $topicid);
        }
        return false;
    }
    
    public function dealReply($replyid, $uid, $agree, $topicid=0){
        if($agree > 0){
            return $this->agreeReply($replyid, $uid, $topicid);
        }else{
            return $this->disagreeReply($replyid, $uid, $topicid);
        }
    }
    
    
    public function addAgreeRecord($replyid, $uid, $agree, $topicid=0){
        $this->setTable('replyagree');
        return $this->insert( array('replyid'=> $replyid, 'uid' => $uid, 'agree'=> $agree, 'topicid'=>$topicid) );
    }
    
    public function hasReplyed($replyid, $uid){
        if($this->_hasReplyed === -1){
            return false;
        }elseif($this->_hasReplyed === 1){
            return true;
        }
        $this->setTable('replyagree');
        $result = $this->where( array('replyid'=> $replyid, 'uid' => $uid))->fetch();
        if(empty($result)){
            $this->_hasReplyed = -1;
            return false;
        }
        $this->_hasReplyed = 1;
        return true;
    }
}


