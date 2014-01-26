<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $topic['title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <meta http-equiv="refresh" content="5; url=<?php echo $url;?>" />
    <?php
        load_css('bootstrap');
        load_css('style');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    //load_view ('SubMenu');
?> 

    <div  class="main">
        
        <div style="position: relative; padding: 50px; width: 500px; height: 200px; left: 50%; top: 50%; margin-left: -300px; margin-top: 100px; background: #ddd; border: 1px solid #ccc; border-radius: 5px; ">
            <div class="title" style="text-align: center; color: red;">
                <h1>Error, 页面跳转中<span id="timer">5</span>...</h1>
            </div>
            
            <div style=" padding-top: 30px;  font-size: 17px; color: #333; text-align: center;">
                <a href="<?php echo $url;?>">如果页面没有自动跳转，请点击此处手动跳转</a>
            </div>
        </div>
        
        
        
        
    </div>
    
<script>
    setInterval(timer, 1000);
    function timer(){
        var num = parseInt(document.getElementById("timer").innerHTML);
        num = num > 1 ? (num - 1) : 0;
        document.getElementById("timer").innerHTML = num;
        if(num == 0){
            //window.clearInterval(int);
            //location.href = "<?php //echo $url;?>";
        }
    }
</script>    
</body>
</html>
