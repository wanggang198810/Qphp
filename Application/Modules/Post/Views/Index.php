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
        load_js('rgss');
    ?>
        <style>
           
        
        </style>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubGroupMenu');
?> 


    <div  class="main">
        <div style="float:left; width: 650px;">
            <div class="" style=" border-bottom: 1px solid #eee; padding: 25px 0 15px;">
                <a href="/group/">小组</a> > 
                <a href="<?php echo group_url($group['url'])?>"><?php echo $group['name']?></a> > 
                <a href="<?php echo topic_url($topic['id'], $topic['url'], 3);?>"><?php echo $topic['title'];?></a></div>
            
            <div class="topic-title">
                <h1 class="post-title-h1">
                    <a href="<?php echo topic_url($topic['id'], $topic['url'], 3);?>"><?php echo $topic['title'];?></a>
                </h1>
            </div>
            
            <div class="content-box" id="content-box">
                <div class="post-avatar"><img src="<?php echo avatar($topic['uid'])?>" /></div>
                <div class="post-content">
                    <div class="post-user">
                        <a href="<?php echo user_space($view_user['uid']);?>"><?php echo $view_user['username']?>
                        </a> <span style="float:right; color:#999; font-size: 12px;"><?php echo dgmdate($topic['time']);?></span></div>
                    <?php echo filter_content($topic['content']) ;?>
                </div>
                
                <div  style="">
                    <div id="topic-manage" style="visibility:hidden">
                    <?php 
                        if($is_manager ||  (isset($user['uid']) && $user['uid'] == $topic['uid'] ) ){
                            echo '<a href="/post/delete/'.$topic['id'].'">删除</a> <a href="/post/edit/'.$topic['id'].'">编辑</a>';
                        }
                    ?>
                    </div>
                </div>
            </div>
            
            <div class="reply-box">
                
                <div style="font-size:12px; color:#999; padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
                    <?php echo $pageinfo['total'];?>个评论
                </div>
                
                
                <?php
                    echo Topic::outputReply($topic, $replys, 3, $pageinfo);
                ?>
                <div class="page"><?php echo $page_html;?></div>
               
                
                
                <form method="post" action="<?php echo topic_url($topic['id'], $topic['url'], 3) . '/answer';?>">
                    <div style="color: #005580; font-weight: 600; font-size: 14px; padding: 10px 0;">添加评论</div>
                    <input type="hidden" name="topicid" id="topicid" value="<?php echo $topic['id'];?>" />
                    <input type="hidden" name="replyid" id="replyid" value="0" />
                    <textarea name="reply_content" id="reply_content" style=" width: 650px; height: 70px; resize: none; margin-bottom: 20px;"></textarea>
                    <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                </form>
            </div>
        </div>
        
        
        <div class="right side270 mt30">
            <div class="topic-user">
                <a class="user-avatar" href="<?php echo user_space($view_user['uid'])?>">
                    <img src="http://www.q.com/Public/image/default_avatar.jpg" />
                </a>
                <div class="blogname" style=""><a href="<?php echo user_space($view_user['uid'])?>"><?php echo $view_user['username']?></a></div>
                <div class="honorname"><?php echo $view_user['honorname']?></div>
                <div class="reply-time">发表于<br><?php echo date( "Y-m-d H:i" , $topic['time']);?></div>
            </div>
        </div>
        
    </div>
   
<?php load_view('Footer');?>
<script>
$(function(){
    $('#content-box').hover(
        function(){
            $("#topic-manage").css({ 'visibility':'visible'})
        },
        function(){
            $("#topic-manage").css({ 'visibility':'hidden'})
        }
    );
    
    
});
    
</script>
</body>
</html>
