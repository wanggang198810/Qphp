<html>
    <head>
        <title><?php echo $title;?></title>
    </head>
<body>
    {$title}<Br>
    {$title|view_test="dd",$title,###}<Br>
    {$title|view_test="dd","cc",###}<Br>
    
    {$title|view_test=###}<Br>
    <php>echo 'dd';</php>

.

<Br><Br>
    <?php
        //Q::import('ko');
    ?>
    Hello,this is a App based on Q php framework !
    
    <a href="index.php?m=home&a=index">aa</a>
</body>
</html>
