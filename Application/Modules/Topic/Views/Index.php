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
        <style>
           
        
        </style>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 


    <div  class="main">
        <div style="float:left; width: 650px;">
            <div class="topic-title">
                <h1 class="title-h1">
                    <a href="<?php echo topic_url($topic['id'], $topic['url']);?>"><?php echo $topic['title'];?></a>
                </h1>
            </div>

            <div class="content-box">
                <div class="content">
                    <?php echo filter_content($topic['content']) ;?>
                </div>
            </div>
            
            <div class="reply-box">
                
                <div style="font-size:12px; color:#999; padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
                    <?php echo $pageinfo['total'];?>个评论
                </div>
                
                <div style="position: relative">
                    <?php
                    echo Topic::outputReply($topic, $replys, 1, $pageinfo);
                    ?>
                    <div class="page"><?php echo $page_html;?></div>
                    <!-- 回复列表 -->
                </div>
                
                
                <form method="post" action="<?php echo topic_url($topic['id'], $topic['url'], 1) . '/answer';?>">
                    <div style="color: #005580; font-weight: 600; font-size: 14px; padding: 10px 0;">添加评论</div>
                    <input type="hidden" name="topicid" id="topicid" value="<?php echo $topic['id'];?>" />
                    <input type="hidden" name="replyid" id="replyid" value="0" />
                    <textarea name="reply_content" id="reply_content" class="reply-textarea"></textarea>
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
</body>
</html>
