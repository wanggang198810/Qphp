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
                <div style="font-size:12px; color:#999; padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">13个回答</div>
                <div style="position: relative">
                    <div class="answer-item">
                        <div class="" style="  position: absolute; margin-left: -50px;">
                            <div class="up radius-5 active" style="">
                                <i class="icon-chevron-up"></i><br />
                                <span>12</span>
                            </div>
                            <div class="down radius-5" style="">
                                <i class="icon-chevron-down"></i><br />
                            </div>
                        </div>
                        <div class="answer-head"><a href="">二锅头</a>, 同能游戏爱好者</div>
                        <div class="answer-agree">ddddddddddd阿飞阿斯蒂芬ddddd</div>
                        <div class="answer-con">ddddddddddd阿飞阿斯蒂芬ddddd</div>
                        <div class="answer-bottom"><a href="">2014-05-12</a> <a href="">添加评论</a></div>
                    </div>
                    
                    
                    <div class="answer-item">
                        <div class="" style="  position: absolute; margin-left: -50px;">
                            <div class="up radius-5 active" style="">
                                <i class="icon-chevron-up"></i><br />
                                <span>12</span>
                            </div>
                            <div class="down radius-5" style="">
                                <i class="icon-chevron-down"></i><br />
                            </div>
                        </div>
                        <div class="answer-head"><a href="">二锅头</a>, 同能游戏爱好者</div>
                        <div class="answer-agree">ddddddddddd阿飞阿斯蒂芬ddddd</div>
                        <div class="answer-con">ddddddddddd阿飞阿撒旦风格撒旦告诉对方告诉对方告诉对方告诉对方告诉对方公司的风格撒旦风格撒旦风格撒旦法告诉对方个斯蒂芬ddddd</div>
                        <div class="answer-bottom"><a href="">2014-05-12</a> <a href="">添加评论</a></div>
                    </div>
                    
                    
                </div>
                <form method="post">
                    <div style="color: #005580; font-weight: 600; font-size: 14px; padding: 10px 0;">添加回答</div>
                    <textarea name="reply" id="reply" style=" width: 636px; height: 70px;"></textarea>
                    <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                </form>
            </div>
        </div>
        
        
        <div class="" style="float: right; width: 270px; margin-top: 30px;">
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
