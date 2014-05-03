<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>小组</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
        load_js('rgss');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubGroupMenu');
?> 

    <div  class="main">
        
        <div class="main-left">
            <div class="main_title"><?php echo $group['name'];?>小组成员</div>
            <ul class="member-list">
            <?php
                foreach ($members as $k => $v){
                    $i = 1;
            ?>
                <li>
                    <div class="member-avatar"><a href="<?php echo user_space($v['uid']);?>"><img width="30" height="30" src="<?php echo avatar($v['uid']);?>" /></a> </div>
                    <div class="member-author">
                        <a href="<?php echo user_space($v['uid']);?>"><?php echo $v['username'];?></a> 
                    </div>
                </li>
            
            <?php   $i ++ ; }?>
            </ul>
            
            <div class="page"><?php echo $page_html;?></div>
            
            
        </div>
        
        
        <div class="main-right">
            <div class="main_title2 mt20">活跃的小组成员</div>
            <div class="active-member-box" style=" margin-top: 10px;">
            <ul>
                <?php
                    foreach($members as $k => $v){
                        $i = 1;
                        $class = ($i%4 == 0) ? 'class="mr0"' : '';
                ?>
                <li <?php echo $class;?>>
                    <a href="<?php echo user_space($v['uid']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['uid']);?>"><?php echo $v['username'];?></a> 
                </li>
                
                
                <?php 
                    $i ++ ;
                }?>
                <div class="clear"></div>
            </ul>        
            </div>
            
            <div class="mt20">
                <p><a href="/group/<?php echo $group['url']?>/members/">查看所有小组成员</a></p>
                <p><a href="/group/<?php echo $group['url']?>/members/">邀请好友加入</a></p>
            </div>
            
        </div>
        
        
    </div>
    
<?php load_view('Footer');?>      
</body>
</html>
