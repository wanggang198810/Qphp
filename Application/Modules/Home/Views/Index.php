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
    ?>
</head>
<body>


    <div  class="main">
        <div style="float:left; width: 650px;">
           
           
            
        </div>
        
        <div id="rgss-alert" style=" display: none;">
            <div style=" position: absolute; width: 400px; height: 200px; background: #000; margin-top: -100px; margin-left: -200px; top: 50%; left: 50%; z-index: 998; border-radius: 5px;"></div>
            <div style=" position: absolute; width: 380px; height: 180px; background: #ccc; margin-top: -90px; margin-left: -190px; top: 50%; left: 50%; z-index: 999; border-radius: 5px;"></div>
        </div>
    </div>
    
<script>
window.onload = setTimeout('alert_msg()', 3000);
function show_message(){
    
}

function alert_msg(){
    $('#rgss-alert').fadeIn();
}
</script>    
</body>
</html>
