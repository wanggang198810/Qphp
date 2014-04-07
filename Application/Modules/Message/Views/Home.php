<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>我的消息</title>
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
        <?php load_view('Message.LeftSide');?>
        
        <div class="" style="width: 720px; float: right; margin-top: 0px;">
            <div class="main_title">我的站内信</div> 
            <div style="padding-top:10px;">
                <span class="label label-inverse"><a href="/message/?type=all">全部</a></span> 
                <span class="label label-warning"><a href="/message/?type=1">未读</a></span> 
                <span class="label label-inverse"><a href="/message/?type=0">已读</a></div></span> 
            
            <div class="mt20">
                <?php
                    if(!empty($messages)){
                    foreach ($messages as $k => $message){
                ?>
                    <div style="color: #666; padding: 10px 0 15px; border-bottom: 1px dashed #eee; clear: both; min-height: 60px;">
                        <div class="left">
                            <a href="<?php echo user_space( $message['fromuser']['blogname'] );?>">
                                <img src="<?php echo avatar($message['fromuid']);?>"></a>
                        </div>
                        <div class="right" style="width: 655px;">
                            <a href="<?php echo user_space( $message['fromuser']['blogname'] );?>">
                                <?php echo $message['fromuser']['username']?></a>：
                            <?php echo String::cutstr($message['content'], 0, 50)?>
                            
                            <div class="msg-bottom" style=" padding-top: 10px;">
                                <div class="msg-time" style=" float: left; width: 100px; color: #999; font-size: 12px;"><?php echo dgmdate($message['time']);?></div>
                                <div style="float: right;"><a href="<?php echo message_url($message['id'], $message['msgid'])?>">查看全部</a>  <a href="">删除</a></div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                    }
                ?>
            </div>
        </div>
        
    </div>
    
    
</body>
</html>
