<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $topic['title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <!--<meta http-equiv="refresh" content="5; url=<?php echo $url;?>" />-->
    <?php
        load_css('bootstrap');
        load_css('style');
    ?>
</head>
<body id="dump" style=" position: relative; ">
<div >
<?php
    //load_view ('Common.header');
    //load_view ('SubMenu');
?> 

    <div  class="main" id="main" style="position: relative;">
        
        <div style="position: relative; padding: 50px; width: 500px; height: 200px; left: 50%; top: 50%; margin-left: -300px; margin-top: 100px; background: #ddd; border: 1px solid #ccc; border-radius: 5px; ">
            <div class="title" style="text-align: center; color: green;">
                <h1>404</h1>
            </div>
            
            <div style=" padding-top: 30px;  font-size: 17px; color: #333; text-align: center; position: relative">
                <a href="/">亲， 你跑到火星上去了哦！</a>
                <h3 id="jiggle0" style="position: relative"><span id="timer">10</span>...</h3>
            </div>
        </div>
        
        
        
        
    </div>
</div>    
<script>
    setInterval(timer, 80);
    function timer(){
        var num = parseInt(document.getElementById("timer").innerHTML);
        num = num > 1 ? (num - 1) : 0;
        document.getElementById("timer").innerHTML = num;
        if(num == 0){
            init();
            document.getElementById("timer").innerHTML = "喯!";
            //window.clearInterval(int);
            //location.href = "<?php //echo $url;?>";
        }
    }
    
    var ns6=document.getElementById && !document.all
    var ie=document.all
    var customcollect=new Array()
    var i=0
    function jiggleit(num){
        if ((!document.all && !document.getElementById)) return;
        customcollect[num].style.left=(parseInt(customcollect[num].style.left)==-10)? customcollect[num].style.left=10 : customcollect[num].style.left = -10;
        customcollect[num].style.top=(parseInt(customcollect[num].style.top) == -10)? customcollect[num].style.top = 10 : customcollect[num].style.top = -10
        customcollect[num].style.fontSize=(parseInt(customcollect[num].style.fontSize) == 17)? customcollect[num].style.fontSize = 500 : customcollect[num].style.fontSize = 17;
 
        document.getElementById("dump").style.left=(parseInt(document.getElementById("dump").style.left)==-10)? document.getElementById("dump").style.left=10 : document.getElementById("dump").style.left=-10
        //document.getElementById("timer").style.top=(parseInt(document.getElementById("timer").style.top)==-10)? document.getElementById("timer").style.top=10 : document.getElementById("timer").style.top=-10
    }

    function init(){
        if (ie){
            while (eval("document.all.jiggle"+i)!=null){
                customcollect[i]= eval("document.all.jiggle"+i);
                i++;
            } 
        }else if (ns6){
            while (document.getElementById("jiggle"+i) != null){
                customcollect[i]= document.getElementById("jiggle"+i);
                i++;
            }
        }

        if (customcollect.length == 1)
            jiggleit(0);
            //setInterval("jiggleit(0)", 80);
        else if (customcollect.length>1)
            for (y=0;y<customcollect.length;y++){
            var tempvariable='setInterval("jiggleit('+y+')",'+'500)';
            eval(tempvariable);
        }
    }

</script>    
</body>
</html>
