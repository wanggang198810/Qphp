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
        <div style="position: fixed; "></div>
        <div class="uside" style="position: fixed;">
            
            <h2 style=" font-size: 35px; padding: 20px 0 5px; font-weight: normal;"><?php echo $user['username'];?></h2>
            <div style=" background: #FFF; width: 198px; border: 1px solid #EEE; margin-bottom: 10px; text-align: center; padding: 10px 0; border-radius: 5px;"><img src="/Public/image/default_avatar.jpg"></div>
            
            <!--  侧边栏 -->
            <div class="item">
                <ul class="person_nav">
                    <li><a href="/settings"><i class="icon-cog"></i> 帐号设置</a></li>
                    <li><a href="<?php echo user_space($user['blogname'], 'articles');?>"><i class="icon-list"></i> 我的文字</a></li>
                    <li><a href="<?php echo user_space($user['blogname'], 'questions');?>"><i class="icon-question-sign"></i> 我的问答</a></li>
                    <li><a href="<?php echo user_space($user['blogname'], 'music');?>"><i class="icon-music"></i> 我的音乐</a></li>
                    <li><a href="<?php echo user_space($user['blogname'], 'like');?>"><i class="icon-heart"></i> 我喜欢的</a></li>
                    <li><a href="/message"><i class="icon-envelope"></i> 我的消息</a></li>
                </ul>
            </div>
        </div>
        
        
        
        
    </div>
    
    
</body>
</html>
