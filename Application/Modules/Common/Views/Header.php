<?php
global $message_count;
global $userinfo;
?>
<div class="navbar">
    <div class="navbar-inverse navbar-fixed-top">
        <div class="navbar-inner ">
            <div class="top-container">
                <a class="brand" href="/">Rgss</a>
                <ul class="nav">
                  <li class="active"><a href="/">首页</a></li>
                  <li><a href="/group/">小组</a></li>
                  <li><a href="/question/">问题</a></li>
                  <li><a href="/game/">游戏</a></li>
                  <li><a href="/explode/">发现</a></li>
                  <li><a href="/sanguo/general/">三国</a></li>
                  <li><a href="http://bbs.rgss.cn" target="_blank">论坛</a></li>
                  <li><a href="http://baike.rgss.cn" target="_blank">百科</a></li>
                  <li><a href="http://rgss.cn" target="_blank">资讯</a></li>
                </ul>
                <div class="pull-right">
                    <ul class="nav">
                    <?php
                        if( !empty($userinfo) ){
                    ?>    
                        <li><a href="/message/">消息
                            <?php if($message_count > 0){?>
                                (<span><?php echo $message_count;?></span>)
                            <?php }?></a></li>
                        <li><a href="/u/<?php echo $userinfo['uid'];?>"><?php echo $userinfo['username'];?></a></li>
                        <li><a href="/user/logout/">退出</a></li>
                      <?php }else{?>
                        <li><a href="/user/login/">登录</a></li>
                        <li><a href="/user/regsiter/">注册</a></li>
                      <?php }?>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>
