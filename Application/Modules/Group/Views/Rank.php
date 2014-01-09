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
            <div class="main_title">精华推荐</div>
            <ul class="forum-list">
            <?php
                foreach ($groups as $k => $v){
            ?>
                <li class="forum-li">
                    <h3 class="title-h3"><a href="<?php echo group_url( $v['url']);?>"><?php echo $v['name'];?></a></h3>
                    <div class="forum-author">
                        <?php echo $v['num']?>人已加入
                    </div>
                    <div class="forum-reply-num">
                        <?php 
                            if( in_array($v['id'], $usergroup) ){
                                echo '已加入';
                            }else{
                                echo '未加入';
                            }
                        ?>
                    </div>
                </li>
            
            <?php }?>
            </ul>
            
            
           
        </div>
        
        
        <div class="main-right">
            <div class="main_title2">最新热门小组</div>
            <div class="recom-group-box" style=" margin-top: 10px;">
                <?php
                    foreach($hot_groups as $k => $v){
                ?>
                <div class="group-item" style=" width: 270px; height: 50px; margin-bottom: 20px;">
                    <div class="left" style="width: 48px; height: 48px; background: #eee;"><img /></div>
                    <div class="right" style=" float: right; border: 1px solid #EEE; padding: 5px; width: 200px; height: 38px; color: #999; font-size: 13px;">
                        <a href="<?php echo group_url($v['id'], $v['url'])?>"><?php echo $v['name'];?></a> 
                        <span><?php echo $v['num']?>人加入</span>
                        <p><?php echo $v['info'];?></p>
                    </div>
                </div>
                <?php }?>
            </div>
            
            
            <div class="main_title2">新创建的小组</div>
            <div class="recom-group-box" style=" margin-top: 10px;">
                <?php
                    foreach($new_groups as $k => $v){
                ?>
                <div class="group-item" style=" width: 270px; height: 50px; margin-bottom: 20px;">
                    <div class="left" style="width: 48px; height: 48px; background: #eee;"><img /></div>
                    <div class="right" style=" float: right; border: 1px solid #EEE; padding: 5px; width: 200px; height: 38px;">
                        <a href="<?php echo group_url($v['id'], $v['url'])?>"><?php echo $v['name'];?></a> 
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
