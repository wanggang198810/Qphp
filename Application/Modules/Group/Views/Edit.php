<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $group['name'];?>小组资料修改</title>
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
        
        <div class="" style=" margin-top: 0px;">
            <div class="main_title">群组：<?php echo $group['name'];?>资料修改</div>
            
            <form class="mt20" method="post" action="<?php echo group_url($group['url'], 'edit');?>">
                <input type="hidden" id="action" name="action" value="edit-profile" />
                <div class="form-item">
                    <label for="username" class="item-label text-right">帐号：</label>
                    <div class="item-input">
                        <?php echo $group['name'];?>
                    </div>
                </div>
                
                <div class="form-item">
                    <label for="" class="item-label text-right">域名：</label>
                    <div class="item-input">
                        <?php echo $group['url'];?>
                    </div>
                </div>

                
                <div class="form-item" style="width: auto;">
                    <label for="info" class="item-label text-right">简介：</label>
                    <div class="item-input">
                        <textarea id="info" name="info" style="width: 500px; height: 200px;"><?php echo $group['info'];?></textarea>
                    </div>
                </div>
                
                
                <div class="form-item">
                    <label for="info" class="item-label text-right">标签：</label>
                    <div class="item-input">
                        <div class="recomm-tag">
                            <span class="badge"><a href="">二货</a></span>  
                            <span class="badge"><a href="">酱油控</a></span>  
                            <span class="badge"><a href="">酱油控</a></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-item">
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
