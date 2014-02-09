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
        <?php load_view('Message.LeftSide');?>
        
        <div class="" style="width: 720px; float: right; margin-top: 0px;">
            <div class="msg-title2" style=" padding-top: 30px; font-size: 17px; color: #666; font-family: 微软雅黑; border-bottom: 1px solid #ddd; line-height: 2;">我和<?php echo $message['fromuser']['username'];?>的对话</div>
            <div class="mt20">
               <div class="left">
                    <a href="<?php echo user_space( $message['fromuser']['blogname'] );?>">
                        <img src="<?php echo avatar($message['fromuid']);?>"></a>
                </div>
                <div class="right" style="width: 635px; background: #eee; padding: 10px; border: 1px solid #ccc;">
                    <a href="<?php echo user_space( $message['fromuser']['blogname'] );?>">
                        <?php echo $message['fromuser']['username']?></a>：
                    <?php echo mb_substr($message['content'], 0, 50)?>

                    <div class="msg-bottom" style=" padding-top: 10px; clear: both;">
                        <div class="msg-time" style=" float: left; width: 100px; color: #999; font-size: 12px;"><?php echo dgmdate($message['time']);?></div>
                        <div style="float: right;"><a href="">删除</a></div>
                    </div>
                </div>
            </div>
            <?php
                if($message['system'] == 0){
            ?>
            <div class="msg-reply" style="float: right; margin-top: 20px;">
                <form method="post">
                    <input id="msgid" name="msgid" value="<?php echo $message['id'];?>" type="hidden">
                    <input id="uid" name="uid" value="<?php echo $message['fromuid'];?>" type="hidden">
                    <textarea id="content" style=" width: 643px; height: 100px; margin-bottom: 10px;"></textarea><Br />
                    <input type="button" id="msg-reply-btn" class="btn btn-success right" value="回复">
                </form>
            </div>
            <?php }?>
        </div>
        
    </div>
    
<script>
$(function(){
    $('#msg-reply-btn').click(function(){
        var uid = $("#uid").val();
        var msgid = $("#msgid").val();
        var content = $("#content").val();
        $.post('/message/send/', {'uid':uid , 'msgid':msgid, "content": content} , function(r){
            r = eval("("+ r +")");
            if(r.success == 1){
                alert(r.msg);
            }
        });
    });
    
});
</script>    
</body>
</html>
