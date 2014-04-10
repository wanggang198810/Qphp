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

    <div  class="" style="width: 100%;">
        <div style=" width: 250px;">
            <iframe src="/Admin/Common/Left" frameborder="0"></iframe>
        </div>
        
        <div style=" float: left; width: 100%; height: 600px; ">
            <iframe name="content-iframe" width="100%" src="/Admin/Common/Home" frameborder="0"></iframe>
        </div>
        
        
        
    </div>
    
    
</body>
</html>
