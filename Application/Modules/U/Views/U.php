<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('bootstrap');
    ?>
        <style>
           
        
        </style>
</head>
<body>
<?php
    load_view ('Common.header');
?> 

    <div style=" width: 100%; height: 35px; background: #eee; border-bottom: 1px solid #ddd;  padding: 25px 0 25px 0;">
        <div class="main">
            <div class="">
                <div style="padding:0; margin:0; width: 142px; height: 35px; line-height: 35px; float: left; margin-right: 20px;">
                    <a href="" href="/"><img src="/Public/image/logo-2.png" /></a></div>
            
                <ul class="sub-nav">
                    <li><a href="" class="active">首页</a></li>
                    <li><a href="">我的同能</a></li>
                    <li><a href="">我的游戏</a></li>
                </ul>
                
                <div class="input-append right" style="margin-top:3px;">
                    <form method="get">
                      <input class="span2" name="tag" id="tag" type="text" placeholder="搜索你感兴趣的内容和人..." style="width:230px; font-size: 13px;">
                      <button class="btn" type="submit">Go!</button>
                    </form>
               </div>
            </div>
        </div>
    </div>
    
    
    
    
    <div  class="main">
        <div><h2 style=" font-size: 35px; padding: 20px 0 5px; font-weight: normal;"><?php echo $user['username'];?></h2></div>
        <div class="uside">
            <div style=" background: #FFF; width: 198px; border: 1px solid #EEE; margin-bottom: 10px; text-align: center; padding: 10px 0; border-radius: 5px;"><img src="/Public/image/default_avatar.jpg"></div>
            <?php load_view('userSide');?>
        </div>
        
        <div class="" style="width: 720px; float: right;">
            <div class="user-info">简介：<?php echo !empty($user['info']) ? $user['info'] : '这家伙很懒，还没有写简介.';?></div>
            <div class="recomm-tag">
                <span class="badge"><a href="">二货</a></span>  
                <span class="badge"><a href="">酱油控</a></span>  
                <span class="badge"><a href="">酱油控</a></span>
            </div>
            
            <div style=" padding-top: 30px;">
                <div style=" color: #85C155; font-size: 15px; padding: 5px; background: #DDD;" class="jianb">
                    <span style="display:inline-block; cursor: pointer;">我的文字</span> 
                    <span class="label label-warning right" style=""><a href="/post">分享文字</a></span>
                </div>
                
                <?php
                    foreach($topics as $k => $v){
                ?>
                    <li><a href="<?php echo topic_url($v['id'], $v['url']);?>"><?php echo $v['title']?></a></li>
                <?php
                    }
                ?>
            </div>
        </div>
        
        
    </div>
    
    
</body>
</html>
