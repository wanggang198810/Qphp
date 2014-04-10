<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>问答标签 - <?php echo APP_NAME;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
?> 

    <div  class="" style="width: 100%; height: 100%;">
        <div style="float:left; width: 165px; height: 100%;">
            <iframe src="/Admin/Common/Left" frameborder="0" width="205" height="100%"></iframe>
        </div>
        
        <div style=" margin-left: 205px !important; margin-left: 202px; padding: 10px;">
            <iframe width="100%" height="100%" name="content-iframe" src="/Admin/Common/Home" frameborder="0"></iframe>
        </div>
        
        
        
    </div>
    
    
</body>
</html>
