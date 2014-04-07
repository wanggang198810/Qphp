<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>用户登录 - <?php echo APP_NAME;?></title>
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
                <h2 class="form-heading">登录</h2>
                <form class="form-horizontal" method="post">
                <div class="control-group">
                  <label class="control-label" for="inputEmail">帐 号：</label>
                  <div class="controls">
                    <input type="text" id="username" name="username" placeholder="Username">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="inputPassword">密 码：</label>
                  <div class="controls">
                    <input type="password" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                      <div class="left">
                        <label class="checkbox">
                          <input type="checkbox"> 记住密码
                        </label>
                      </div>
                      <div class="left forget-pwd"> &nbsp;&nbsp; |&nbsp;&nbsp; <a class="litle-green" href="/user/password">忘记密码</a></div>
                  </div>
                </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-success">登 陆</button> &nbsp;&nbsp;<a href="/user/register" class="litle-green" >没有帐号，马上注册?</a></div>
                    </div>
              </form>
            </div>
        </div>
    </div>
</body>
</html>
