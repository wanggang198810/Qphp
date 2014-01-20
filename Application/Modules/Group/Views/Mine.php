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
            <div class="main_title">我的小组</div>
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
            <div class="mt40"><a href="/group/apply/">申请创建小组>></a></div>
            <div class="main_title2" style=" padding-top: 20px;">我加入的小组</div>
            <div class="recom-group-box" style=" margin-top: 10px;">
                <?php
                    foreach($groups as $k => $v){
                ?>
                <div class="group-item" style=" width: 270px; height: 50px; margin-bottom: 20px;">
                    <div class="left" style="width: 48px; height: 48px; background: #eee;">
                        <a href="<?php echo group_url($v['url'])?>">
                            <img src="<?php echo group_logo($v['logo']);?>" title="<?php echo $v['name'];?>" />
                        </a>
                    </div>
                    <div class="right" style=" float: right; border: 1px solid #EEE; padding: 5px; width: 200px; height: 38px; color: #999; font-size: 13px;">
                        <a href="<?php echo group_url($v['url'])?>"><?php echo $v['name'];?></a> 
                        <span><?php echo $v['num']?>人加入</span>
                        <p><?php echo $v['info'];?></p>
                    </div>
                </div>
                <?php }?>
            </div>
            
        </div>
        
        
    </div>
    
<?php load_view('Footer');?>      
</body>
</html>
