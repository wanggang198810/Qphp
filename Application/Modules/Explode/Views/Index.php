<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $topic['title'];?></title>
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
        <style>
           .explode-item{
               margin-bottom: 30px; border: 1px solid #ccc; background: #FFF; border-radius: 5px; padding: 15px;
                -moz-box-shadow:0px 1px 4px #ccc;              
    -webkit-box-shadow:0px 1px 4px #ccc;           
    box-shadow:0px 1px 4px #ccc;   
            }
            
            
            .explode-title{ margin-bottom: 10px;}
            .explode-title a{ font-size: 20px; color: #333; }
            .explode-title a:hover{ color: #000;}
            
            .explode-con{ color: #666; word-break: break-all;}
            
            .explode-cate a{ width: 253px; display: block;  padding: 7px 0 7px 15px; background: #ddd; border-bottom: 1px solid #ccc ;}
            .explode-cate a:hover{ background: #fcfcfc;}
        </style>
</head>
<body style=" background: #eee;">
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 

    <div  class="main">
        
        <div style="float:left; width: 650px; margin-top: 30px;">
           
            <?php
                if(!empty($topics)){
                    foreach($topics as $k => $v){
            ?>
                <div class="explode-item">
                    <div class="explode-title"><a href="<?php echo topic_url($v['id'], $v['url'], $v['type'])?>"><?php echo filter_content($v['title'])?></a></div>
                    <div class="explode-con">
                        <?php echo filter_content($v['content'])?>
                    </div>
                </div>
            <?php } }?>
            
            <?php echo $page_html;?>
        </div>
        
        
        <div class="main-right" style=" width: 270px; margin-top: 30px;">
            
            <div style="border: 1px solid #ccc; border-radius: 5px; ">
                <div class="explode-cate"><a href="/explode/?type=game">游戏</a></div>
                <div class="explode-cate"><a href="/explode/?type=topic">日志</a></div>
                <div class="explode-cate"><a href="/explode/?type=question">问答</a></div>
            </div>
            
        </div>
        
        
        
    </div>
    
<?php load_view('Footer');?>        
<script src="http://www.rgss.cn/api/js/rgsscnadv.js"></script>
</body>
</html>
