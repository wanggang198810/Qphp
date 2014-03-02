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
        load_js('bootstrap');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 

    <div  class="main">
        <div style="float:left; width: 650px;">
           
            <form method="post" enctype="multipart/form-data" action="/upload/image">
                <input type="file" name="photo" /><br />
                <input type="file" name="photo1[]" /><br />
                <input type="file" name="photo1[]" /><br />
                <input type="hidden" name="uid" value="1" />
                <input type="submit" value="提交" />
           </form>
            
        </div>
        
        
        
        
    </div>
    
    
</body>
</html>
