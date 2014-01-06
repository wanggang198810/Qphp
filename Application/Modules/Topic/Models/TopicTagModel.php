<?php
/**
 * Description of TopicTag
 *
 * @author air
 */
class TopicTagModel extends Model{
    
    
    public function getTagsByTopic($topicid, $page=1, $pageSize=20, $total=0){
        if($topicid <= 0){ return false;}
        $page = intval($page) < 1 ? intval($page) : 1;
        return $this->where( array('topicid'=> $topicid) )->page($page, $pageSize, $total);
    }
}

?>
