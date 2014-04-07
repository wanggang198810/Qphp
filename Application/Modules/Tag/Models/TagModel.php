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
    public function addTag($topicid , $tagStr){
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
    
    
    public function search($tagname='', $type=0, $page =1, $pageSize = 20, $total = 0){
        if(intval($type) > 0){
            $type_where  = ' AND type = ' . $type ;
        }else{
            $type_where = " AND type IN (1, 2 , 3, 4 ,5) ";
        }
        $sql = "SELECT topicid FROM `topictag` WHERE tagname LIKE '{$tagname}%' ". $type_where ;
        $result = $this->page($page, $pageSize, $total, $sql);
        if(!empty($result['list'])){
            foreach ($result['list'] as $v){
                $topicids .= $v['topicid']. ',';
            }
            $topicid_where = ' id IN ('. trim( $topicids , ',').')';
            $sql = "SELECT * FROM `topic` WHERE ". $topicid_where; 
            $list = $this->fetchArray($sql);
            $result['list'] = $list;
        }
        return $result;
    }
    
    
    
}

?>
