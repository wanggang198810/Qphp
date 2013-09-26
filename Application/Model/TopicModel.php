<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class TopicModel extends Model{
    
    
    public function publish($data){
        $tag = $data['tag'];
        $topicid = $this->db->insert( $this->table('topic',$data['userid']), $data, true);
        $this->addTag($topicid, $tag);
    }
    
    
    public function addTag($topicid, $data){
        $data = explode(',', $data);
        foreach ($data as $k => $v) {
            if(empty($v))                
                continue;
           $tag[] = array('topicid'=>$topicid, 'tag'=>$v);
        }
        return $this->db->multiInsert($data);
    }
    
}

?>
