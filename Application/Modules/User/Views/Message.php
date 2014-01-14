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
        <div style="position: fixed; "></div>
        <div class="uside" style="position: fixed;">
            
            <div style=" background: #eee; width: 198px; border: 1px solid #EEE; margin-bottom: 10px; padding: 10px 0; min-height: 500px;">
                <h1 style=" margin-top: 20px; font-size: 24px; font-family: 微软雅黑; font-weight: normal; padding-left: 30px;">消息中心</h1>
                <ul style=" padding-left: 40px; font-size: 14px;">
                    <li style="line-height:30px;"><a href="/user/message"><i class="icon-envelope"></i> 站内信</a></li>
                    <li style="line-height:30px;"><a href="/user/notice"><i class="icon-bell"></i> 通知</a></li>
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
