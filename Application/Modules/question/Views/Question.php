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
        load_js('bootstrap');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 

    <div  class="main">
        <div style="float:left; width: 700px;">
            <div style="padding:10px 0;"><h1 style=" font-size: 30px; padding: 20px 0 5px; font-weight: normal;"><a style="color:#333; " href="<?php echo topic_url($topic['id'], $topic['url'], $type);?>"><?php echo $topic['title'];?></a></h1></div>


            <div class="" style="width: 700px; float: left; line-height: 2; font-size: 15px;  padding-bottom: 50px;">
                <div class="content1 radius-51" style=" /*min-height: 300px; background: #FFF; padding: 10px;*/"><?php echo filter_content($topic['content']) ;?></div>
            </div>
            
            <div class="reply-box" style="">
                <div style="font-size:12px; color:#999; padding-bottom: 5px;">13条评论</div>
                <form method="post">
                    <textarea name="reply" id="reply" style=" width: 686px; height: 70px;"></textarea>
                    <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                </form>
            </div>
        </div>
        
        
        <div class="" style="float: right; width: 230px; margin-top: 30px;">
            <div>
                <a href="<?php echo user_space($user['blogname'])?>"><img src="http://www.q.com/Public/image/default_avatar.jpg" style="border-radius:40px; width: 80px; height: 80px;" /></a>
                <div style=" padding:10px 20px 5px;"><a href="<?php echo user_space($user['blogname'])?>"><?php echo $user['username']?></a></div>
                <div style=" font-size: 12px; color: #666;"><?php echo $user['honorname']?></div>
                
                <div style=" font-size: 12px; color: #999; padding-top: 15px; border-top: 1px solid #ccc; margin-top: 25px; ">发表于<br><?php echo date( "Y-m-d H:i" , $topic['time']);?></div>
            </div>
        </div>
        
    </div>
    
    
</body>
</html>
