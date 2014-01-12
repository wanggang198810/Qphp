<?php


/**
 * Description of Topic
 *
 * @author air
 */
class Topic {
    //put your code here
    
    
    
    public function outputReply($topic, $replys, $topictype, $pageinfo){
        
        $html = '<div style="position: relative">';
        if(empty($replys)){
            return $html .= '</div>';
        }
        
        $_i = ($pageinfo['page'] - 1 )* $pageinfo['pageSize']  + 1;
        foreach($replys as $k => $reply){
            $html .= '<div class="answer-item" replyid="'.$reply['id'].'" topicid="<?php echo '.$reply['topicid'].'">
                            <div class="post-avatar">
                             <a href="'.user_space($reply['reply_user']['blogname']).'"><img src="'.avatar($topic['uid']).'" /></a><br>'.$_i.'楼
                            </div>';
            
            $html .= '<div class="post-content">';
            
            $html .= '<div class="post-user">
                        <a href="'.user_space($reply['reply_user']['blogname']).'">'. $reply['reply_user']['username'].'</a>，'. $reply['reply_user']['honorname'].'</div><div class="answer-head"></div><div class="answer-agree"></div>';
            
            if(isset( $reply['reply'] )){
                $html .= '<blockquote>引用<a href="'.  user_space($reply['reply_user']['blogname']) .'">@' . $reply['reply_user']['username'].'</a>的话：' . $reply['reply']['content'].'</blockquote>';
            }
            
            $html .= '<div class="answer-con">'.filter_content( $reply['content'] ).'</div>';
            
            $html .= '<div class="answer-bottom">
                        <a href="javascript:;">'.dgmdate($reply['time']).'</a> 
                        <a href="javascript:;" replyid="'.$reply['id'].'" openreply="0" class="add-reply">添加评论</a>
                        <div id="sub-reply-box-'.$reply['id'].'"  class="sub-reply-box radius-5">
                            <form method="post" action="'.topic_url($topic['id'], $topic['url'], $topictype) . '/answer">
                                <input type="hidden" name="topicid" id="topicid" value="' . $reply['topicid'] . '" />
                                <input type="hidden" name="replyid" id="replyid" value="'. $reply['id'] .' " />
                                <textarea name="reply_content" class="sub-reply-content"></textarea>
                                <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                            </form>
                        </div>
                    </div>';
            
            $html .= '</div></div>';
          $_i ++ ;  
        }
        
        $html .= '</div>';
        return $html;
    }
}




?>



<div style="position: relative">
                    <!-- 回复列表 -->
                    <?php
                        if(!empty($replys)){;
                        $_i = ($pageinfo['page'] - 1 )* $pageinfo['pageSize']  + 1;
                        foreach($replys as $k => $reply){
                    ?>
                        <div class="answer-item" replyid="<?php echo $reply['id'];?>" topicid="<?php echo $reply['topicid'];?>">
                            <div class="post-avatar">
                                <a href="<?php echo user_space($reply['reply_user']['blogname']);?>"><img src="<?php echo avatar($topic['uid'])?>" /></a><br>
                                <?php echo $_i;?>楼
                            </div>
                            <div class="post-content">
                                <div class="post-user">
                                    <a href="<?php echo user_space($reply['reply_user']['blogname']);?>"><?php echo $reply['reply_user']['username'];?></a>
                                    <?php echo '，' , $reply['reply_user']['honorname']?>
                                </div>
                                
                                <div class="answer-head">
                                    
                                </div>
                                <div class="answer-agree"></div>
                                <div class="answer-con"><?php echo filter_content( $reply['content'] );?></div>
                                <div class="answer-bottom">
                                    <a href="javascript:;"><?php echo dgmdate($reply['time']);?></a> 
                                    <a href="javascript:;" replyid="<?php echo $reply['id']?>" openreply="0" class="add-reply">添加评论</a>
                                    <div id="sub-reply-box-<?php echo $reply['id'];?>"  class="sub-reply-box radius-5">
                                        <form method="post" action="<?php echo topic_url($topic['id'], $topic['url'], 3) . '/answer';?>">
                                            <input type="hidden" name="topicid" id="topicid" value="<?php echo $reply['topicid'];?>" />
                                            <input type="hidden" name="replyid" id="replyid" value="<?php echo $reply['id'];?>" />
                                            <textarea name="reply_content" id="reply_content" style=" width: 545px;"></textarea>
                                            <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                            $_i ++;
                        }
                        }
                    ?>
                    <!-- 回复列表 -->
                </div>