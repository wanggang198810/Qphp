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
       body{ background: #f1f5f8; margin: 0;}
       .top{
           background: #000;  height: 350px; margin: 0px; overflow: hidden; color: #FFF;
       }
       .bottom{
           width: 100%;
       }
       .main{
           width: 750px;
           margin-right: auto;
           margin-left: auto;
        }
        
        
        ul.recomm{
            padding: 0;
            margin: 0;
        }
        ul.recomm li{
            padding: 0px;
            list-style: none;
            line-height: 35px;
            height: 35px;
            font-size: 14px;
        }
    </style>
</head>
<body> 
    <div class="top">
        <div class="main">
            <div class="left" style="font-size: 80px; margin-top: 50px;">
                <img src="/Public/image/logo-info.png"><br>
                        <!--<img src="/Public/image/logo-troop.png">-->
            </div>
            <div class="right" style=" margin-top: 50px; width: 225px; color: #FFF;">
              <form method="post" action="/user/login">
                <div  style="font-size:14px; margin-bottom: 20px;">登录同能 <a class="right white-color" href="/user/register">注册</a></div>
                <input style="padding:5px 9px; margin-bottom: 20px;" type="text" placeholder="Username" autoComplete="off" id="username" name="username">
                <input style="padding:5px 9px; margin-bottom: 20px;" type="password" placeholder="Password" autoComplete="off" id="password" name="password">
                
                <button style="width:225px; padding: 6px;" class="btn btn-middle btn-primary" type="submit">登 &nbsp;&nbsp; 录</button>
                <div class="white-color point pt20">注.可使用同能论坛帐号直接登录.</div>
              </form>
            </div>
        </div>
    </div>
    
    <div class="bottom" style="background: #f1f5f8;">
        <div class="main">
            <div class="left" style="margin-top: 30px;">
                
            </div>
            <!--
            <div class="right radius-5" style=" width: 400px; background: #FFF; height: 310px; margin-top: 30px; padding: 20px;">
                <ul class="recomm">
                    <li><a href="">在 App 里，遇到告警或者提示用户，「确定」按钮应该放在？</a></li>
                    <li><a href="">在 App 里，遇到告警或者提示用户，「确定」按钮应还是右边？</a></li>
                    <li><a href="">到告警或者提示用户，「确定」按钮应该放在左边右边？</a></li>
                    <li><a href="">在 App 里，遇到告警或者按钮应该放在左边还是右边？</a></li>
                    <li><a href="">在 App 里，遇到告警或者提示用户，「确定」按钮应该放在？</a></li>
                    <li><a href="">在 App 里，遇到告警或者提示用户，「确定」按钮应还是右边？</a></li>
                    <li><a href="">户，「确定」按钮应该放在左边右边？</a></li>
                    <li><a href="">在 App 里，遇到告警或者按钮应该放在左边还是右边？</a></li>
                </ul>
            </div>-->
        </div>
    </div>
    
</body>
</html>
