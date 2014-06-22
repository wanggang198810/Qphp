<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>问答</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
        load_js('rgss');
        //load_js('bootstrap');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubGroupMenu');
?> 

    <div  class="main">
        
        <div class="main-left" id="questions-box">
            <div class="main_title">等待回答</div>
            <div class="new-question">
            <ul class="forum-list">
            <?php
            if(!empty($new_topics)){
                foreach ($new_topics as $k => $v){
            ?>
                <li class="forum-li">
                    <h3 class="title-h3"><a href="<?php echo topic_url($v['id'], $v['url'], 2);?>"><?php echo $v['title'];?></a></h3>
                    <div class="forum-author">
                        
                    </div>
                    <div class="forum-reply-num"><?php echo dgmdate( $v['time'] );?></div>
                </li>
            
            <?php }}?>
            </ul>
            </div>
            
            
            <div class="mt20">
                
                <div style=" width: 300px; float: left; overflow-x: hidden;">
                    <div class="question-title">热门问答</div>
                    <ul class="">
                    <?php
                        foreach ($hot_topics as $k => $v){
                    ?>
                        <li class="hot-q-li">
                            <h3 class="title-h3"><a href="<?php echo topic_url($v['id'], $v['url'], 2);?>"><?php echo $v['title'];?></a></h3>
                        </li>

                    <?php }?>
                    </ul>
                </div>

                <div style=" width: 300px; float: right; overflow-x: hidden;overflow-x: hidden;">
                    <div class="question-title">精彩问答</div>

                    <ul class="">
                    <?php
                       if(!empty($recom_topics)){
                        foreach ($recom_topics as $k => $v){
                    ?>
                        <li class="hot-q-li">
                            <h3 class="title-h3"><a href="<?php echo topic_url($v['id'], $v['url'], 2);?>"><?php echo $v['title'];?></a></h3>
                        </li>

                        <?php }}?>
                    </ul>
                </div>
            </div>
        </div>
        
        
        <div class="main-right">
            <div class="main_title2" style="margin-top: 50px;">
                <a href="/question/post" class="ask-btn">我要提问</a>
            </div>
            <div class="main_title2">新增答案</div>
            <div class="recom-group-box" style=" margin-top: 10px;">
                <?php
                if(!empty($hot_groups)){
                    foreach($hot_groups as $k => $v){
                ?>
                <div class="group-item" style=" width: 270px; height: 50px; margin-bottom: 20px;">
                    <div class="left" style="width: 48px; height: 48px; background: #eee;"><img /></div>
                    <div class="right" style=" float: right; border: 1px solid #EEE; padding: 5px; width: 200px; height: 38px; color: #999; font-size: 13px;">
                        <a href="<?php echo group_url($v['url'])?>"><?php echo $v['name'];?></a> 
                        <span><?php echo $v['num']?>人加入</span>
                        <p><?php echo $v['info'];?></p>
                    </div>
                </div>
                <?php }}?>
            </div>
            
            
            
            
        </div>
        
        <div class="clear"></div>
    </div>
    
<?php load_view('Footer');?>      
</body>
</html>
