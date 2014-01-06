<div style="position: relative">
    <!-- 回复列表 -->
    <?php
        foreach($replys as $k => $reply){
    ?>
        <div class="answer-item" replyid="<?php echo $reply['id'];?>" topicid="<?php echo $reply['topicid'];?>">
            <div class="post-avatar"><img src="<?php echo avatar($topic['uid'])?>" /></div>
            <div class="post-content">
                <div class="post-user">
                    <a href="<?php echo user_space($reply['reply_user']['url']);?>"><?php echo $reply['reply_user']['username'];?></a>
                    <?php echo '，' , $reply['reply_user']['info']?>
                </div>

                <div class="answer-head">

                </div>
                <div class="answer-agree"></div>
                <div class="answer-con"><?php echo filter_content( $reply['content'] );?></div>
                <div class="answer-bottom">
                    <a href="javascript:;"><?php echo dgmdate($reply['time']);?></a> 
                    <a href="javascript:;" replyid="<?php echo $reply['id']?>" openreply="0" class="add-reply">添加评论</a>
                    <div id="sub-reply-box-<?php echo $reply['id'];?>"  class="sub-reply-box radius-5">
                        <form method="post" action="<?php echo topic_url($topic['id'], $topic['url'], 2) . '/answer';?>">
                            <input type="hidden" name="topicid" id="topicid" value="<?php echo $reply['topicid'];?>" />
                            <input type="hidden" name="replyid" id="replyid" value="<?php echo $reply['id'];?>" />
                            <textarea name="reply_content" id="reply_content" style=" width: 605px;"></textarea>
                            <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    <!-- 回复列表 -->
</div>