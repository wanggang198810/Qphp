<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $topic['title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
        load_js('rgss.js');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 

    <div  class="main">
        <div style="float:left; width: 650px;">
            <div style="padding:10px 0;"><h1 style=" font-size: 20px; padding: 20px 0 0px; margin: 0px; line-height: 1.7; font-weight: normal;"><a style="color:#333; " href="<?php echo topic_url($topic['id'], $topic['url'], $type);?>"><?php echo $topic['title'];?></a></h1></div>
            
            <div class="tag-box" style=" color: #666; font-family: 宋体; font-size: 12px;">标签：
                <?php
                    if(!empty($topic['tag'])){
                        foreach($topic['tag'] as $k => $tag){
                ?>
                    <span class="tag"><a href="<?php echo qtag_url($tag)?>"><?php echo $tag;?></a></span>
                <?php
                    }
                    }else{
                        echo '<span class="tag">没有标签</span>';
                    }
                ?>
            </div>

            <div class="" style="width: 650px; float: left; line-height: 2; font-size: 15px; margin-top: 20px;  padding-bottom: 50px; font-size: 13px;">
                <div class="content1 radius-51"><?php echo filter_content($topic['content']) ;?></div>
            </div>
            
            <div class="answer-box" style="">
                <div style="font-size:12px; color:#999; padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
                    <?php echo $pageinfo['total'];?>个回答
                </div>
                <div style="position: relative" id="question-reply" class="question-reply">
                    <!-- 回复列表 -->
                    <?php
                        foreach($replys as $k => $reply){
                    ?>
                        <div class="answer-item" replyid="<?php echo $reply['id'];?>" topicid="<?php echo $reply['topicid'];?>">
                            <div class="" style="  position: absolute; margin-left: -50px;">
                                <div class="up radius-5 active" style="">
                                    <i class="icon-chevron-up"></i><br />
                                    <span><?php echo $reply['agree'];?></span>
                                </div>
                                <div class="down radius-5" style="">
                                    <i class="icon-chevron-down"></i><br />
                                    <?php if($reply['disagree'] > 0){?>
                                    <span><?php echo $reply['agree'];?></span>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="answer-head">
                                <a href="<?php echo user_space($reply['reply_user']['blogname']);?>">
                                    <?php echo $reply['reply_user']['username'];?>
                                </a>
                                <?php echo ', ',$reply['reply_user']['honorname'];?>
                            </div>
                            
                            <div class="answer-agree">ddddddddddd阿飞阿斯蒂芬ddddd</div>
                            <div class="answer-con"><?php echo filter_content( $reply['content'] );?></div>
                            <div class="answer-bottom">
                                <a href="javascript:;"><?php echo dgmdate($reply['time'])?></a> 
                                <a href="javascript:;" replyid="<?php echo $reply['id']?>" openreply="0" class="add-reply">添加评论</a>
                                <div id="sub-reply-box-<?php echo $reply['id'];?>"  class="sub-reply-box radius-5">
                                    <form method="post" action="<?php echo topic_url($topic['id'], $topic['url'], 2) . '/answer';?>">
                                        <input type="hidden" name="topicid" id="topicid" value="<?php echo $reply['topicid'];?>" />
                                        <input type="hidden" name="replyid" id="replyid" value="<?php echo $reply['id'];?>" />
                                        <textarea name="reply_content" id="sub-reply-content" class="sub-reply-content"></textarea>
                                        <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <!-- 回复列表 -->
                </div>
                
                
                <form method="post" action="<?php echo topic_url($topic['id'], $topic['url'], 2) . '/answer';?>">
                    <div style="color: #005580; font-weight: 600; font-size: 14px; padding: 10px 0;">添加回答</div>
                    <input type="hidden" name="topicid" id="topicid" value="<?php echo $topic['id'];?>" />
                    <input type="hidden" name="replyid" id="replyid" value="0" />
                    <textarea name="reply_content" id="reply-content" class="reply-content" style=""></textarea>
                    <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                </form>
            </div>
        </div>
        
        
        <div class="right side270 mt30">
            <div class="topic-user">
                <a class="user-avatar" href="<?php echo user_space($view_user['blogname'])?>">
                    <img src="http://www.q.com/Public/image/default_avatar.jpg" />
                </a>
                <div class="blogname" style=""><a href="<?php echo user_space($view_user['blogname'])?>"><?php echo $view_user['username']?></a></div>
                <div class="honorname"><?php echo $view_user['honorname']?></div>
                <div class="reply-time">发表于<br><?php echo date( "Y-m-d H:i" , $topic['time']);?></div>
            </div>
        </div>
        
    </div>
    
<?php load_view('Footer');?>  
</body>
</html>
