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
        <?php load_view('Settings.LeftSide');?>
        
        <div class="" style="width: 720px; float: right; margin-top: 0px;">
            <div class="main_title"><?php echo $user['username'];?>的邮箱</div>
            
            <form class="mt20" method="post" action="/settings/email/">
                <input type="hidden" id="action" name="action" value="edit-profile" />
                
                <div class="form-item">
                    <label for="email" class="item-label text-right">登录邮箱：</label>
                    <div class="item-input">
                        <?php echo $user['email'];?>
                    </div>
                </div>
                
                
                <div class="form-item">
                    <label for="email" class="item-label text-right">修改邮箱：</label>
                    <div class="item-input">
                        <input type="email" class="form-control" name="email" id="email" value="">
                    </div>
                </div>
                
                <div class="form-item">
                    <label for="honorname" class="item-label text-right">密 码：</label>
                    <div class="item-input">
                        <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                </div>
     
                <div class="form-item mt10">
                    <label for="" class="item-label text-right"></label>
                    <div class="item-input">
                        <input type="submit" class="btn btn-success">
                    </div>
                </div>
                
                
            </form>
            
            
      
            
        </div>
        
        
    </div>
    
    
</body>
</html>
