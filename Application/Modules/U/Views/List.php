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
        load_js('jquery');
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
        <div style="position: fixed; "></div>
        <div class="uside" style="position: fixed;">
            
            <h2 style=" font-size: 35px; padding: 20px 0 5px; font-weight: normal;"><?php echo $user['username'];?></h2>
            <div style=" background: #FFF; width: 198px; border: 1px solid #EEE; margin-bottom: 10px; text-align: center; padding: 10px 0; border-radius: 5px;"><img src="/Public/image/default_avatar.jpg"></div>
            
            <?php
                if(!$is_self){
            ?>
            <div style=" margin-bottom: 20px; text-align: center;">
                <a style=" padding: 20px 5px;" href="javascript:;" onclick="openSendMsgBox()">发私信</a>
                <a style=" padding: 20px 5px;" href="javascript:;" onclick="">加关注</a>
            </div>
            <?php }?>
            
            
            <!--  侧边栏 -->
            <div class="item">
                <ul class="person_nav">
                    <?php if($is_self){ ?><li><a href="/settings"><i class="icon-cog"></i> 帐号设置</a></li><?php }?>
                    <li><a href="<?php echo user_space($user['uid'], 'articles');?>"><i class="icon-list"></i> 我的文字</a></li>
                    <li><a href="<?php echo user_space($user['uid'], 'questions');?>"><i class="icon-question-sign"></i> 我的问答</a></li>
                    <li><a href="<?php echo user_space($user['uid'], 'music');?>"><i class="icon-music"></i> 我的音乐</a></li>
                    <li><a href="<?php echo user_space($user['uid'], 'like');?>"><i class="icon-heart"></i> 我喜欢的</a></li>
                    <?php if($is_self){ ?><li><a href="/message/"><i class="icon-envelope"></i> 我的消息</a></li><?php }?>
                </ul>
            </div>
        </div>
        
        <div class="" style="width: 720px; float: right; margin-top: 70px;">
            <div class="user-info">简介：<?php echo !empty($user['info']) ? $user['info'] : '这家伙很懒，还没有写简介.';?></div>
            <div class="recomm-tag">
                <span class="badge"><a href="">二货</a></span>  
                <span class="badge"><a href="">酱油控</a></span>  
                <span class="badge"><a href="">酱油控</a></span>
            </div>
            
            <div style=" padding-top: 30px;">                
                
                <div style=" color: #85C155; font-size: 15px; padding: 5px; margin-top: 10px; border-bottom: 1px solid #ddd; background: #DDD;">
                    <span style="display:inline-block; cursor: pointer;">我的问答</span> 
                    <span class="label right" style=""><a style="color: #FFF" href="/post">分享文字</a></span>
                </div>
                <ul>
                <?php
                    foreach($topics as $k => $v){
                ?>
                    <li style="border-bottom: 1px dotted #ccc; padding: 10px 0;">
                        <a href="<?php echo topic_url($v['id'],$v['url'], $type);?>"><?php echo $v['title']?></a><Br>
                            <div style=" color: #999; font-size: 12px; padding-top: 10px;">
                                <?php echo $v['shortcontent']?>
                            </div>
                            <div style=" color: #999; font-size: 12px; padding-top: 5px;">
                                提问于：<?php echo dgmdate( intval($v['time']) );?>. 
                                <a href="<?php echo topic_url($v['id'],$v['url'], $type);?>">查看全文</a> 
                            </div>
                    </li>
                <?php
                    }
                ?>
                </ul>
            </div>
            
            <div><?php echo $page_html;?></div>
            
        </div>
        
        
    </div>
    
    
</body>
</html>
