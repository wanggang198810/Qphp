<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>帐号绑定 - <?php echo APP_NAME;?></title>
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
        .form-heading{ color:#4BC071; padding-bottom: 15px;}
        .control-group{ position: relative;}
        .form-horizontal .controls{ margin-left: 50px;}
        .form-horizontal .control-label{ width: auto;}
        .checkbox{ font-size: 12px; color: #666;}
        .left{float:left;}
        .forget-pwd{ padding-top: 2px;}
        .litle-green{ color: #39814D}
    </style>
</head>
<body style="background:#226B1F">
    <div class="container">
        <div class="form-signin">
            
            
            <div class="form-info">
                <img src="/Public/image/liblogo.png" style="margin-top:50px; margin-left:50px;" />
            </div>
            
            <div class="form-con">
                <h2 class="form-heading">绑定帐号</h2>
                <form class="form-horizontal" method="post">
                <input type="hidden" id="ucuid" name="ucuid" value="<?php echo $ucuid;?>">
                <div class="control-group">
                  <label class="control-label" for="inputEmail">邮 箱：</label>
                  <div class="controls">
                        <input type="text" id="userEmail" name="email" placeholder="Email">
                  </div>
                </div>
                    
                <div class="control-group">
                  <label class="control-label" for="blogname">域 名：</label>
                  <div class="controls">
                    <input type="text" id="blogname" name="blogname" placeholder="Url">
                  </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success">绑 定</button> &nbsp;&nbsp;<a href="/user/logout/" class="litle-green" >退出</a></div>
                </div>
                    
                <div class="control-group">
                    <div class="controls">
                        <a href="javascript:;" class="litle-green" >帐号密码即为论坛帐号密码</a></div>
                </div>
                   
              </form>
            </div>
        </div>
    </div>
</body>
</html>
