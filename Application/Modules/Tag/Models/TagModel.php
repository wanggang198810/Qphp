<?php
/**
 * Description of TagModel
 *
 * @author air
 */
class TagModel extends Model{
    //put your code here
    
    /**
     * 添加标签
     */
    public function add($topicid , $tagStr){
        $tag = explode(',', $tagStr);
        foreach($tag as $k => $v){
            if(empty($v)){
                continue;
            }
            $tags[$k]['tagname']= $v;
            $tags[$k]['topicid'] = $topicid;
        }
        return $this->multiInsert($tags);
    }
}

?>
