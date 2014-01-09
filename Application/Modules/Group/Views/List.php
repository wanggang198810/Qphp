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
        load_js('bootstrap');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubGroupMenu');
?> 

    <div  class="main">
        
        <div class="main-left">
            <div class="main_title"><?php echo $group['name'];?></div>
            
            <div class=""><a href="<?php echo group_url($group['url'], 'post');?>">发帖</a></div>
            <ul class="forum-list">
            <?php
                foreach ($topics as $k => $v){
            ?>
                <li class="forum-li">
                    <h3 class="title-h3"><a href="<?php echo topic_url($v['id'], $v['url'], 3);?>"><?php echo $v['title'];?></a></h3>
                    <div class="forum-author">
                        <a href="<?php echo group_url($v['group']['url']);?>"><?php echo $v['group']['name'];?></a>
                    </div>
                    <div class="forum-reply-num"><?php echo dgmdate( $v['time'] );?></div>
                </li>
            
            <?php }?>
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
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
                </li>
                
                <li>
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
                </li>
                
                <li>
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
                </li>
                
                <li class="mr0">
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
                </li>
                
                <li>
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
                </li>
                
                <li>
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
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
