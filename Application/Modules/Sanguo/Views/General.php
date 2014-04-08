<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>三国武将 - <?php echo APP_NAME?></title>
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
    load_view ('SubMenu');
?> 

    <div  class="main">
        <div style="float:left; width: 650px; margin-top: 30px;">
            <table cellpadding="10" cellspacing="0" border="1" style=" border : #666; text-align: center;">
                <tr style=" font-weight: bold;">
                    <td width="50">姓名</td>
                    <td width="50">武力</td>
                    <td width="50">智力</td>
                    <td width="50">统帅</td>
                    <td width="50">敏捷</td>
                    <td width="50">特性</td>
                    <td width="50">关系</td>
                </tr>
                
                <tr><td>刘备</td><td>82</td><td>85</td><td>95</td><td>85</td><td>特性</td><td>关系</td></tr>
                <tr><td>张飞</td><td>98</td><td>70</td><td>95</td><td>95</td><td>特性</td><td>关系</td></tr>
                <tr><td>关羽</td><td>97</td><td>80</td><td>97</td><td>95</td><td>特性</td><td>关系</td></tr>
                <tr><td>诸葛亮</td><td>65</td><td>100</td><td>98</td><td>80</td><td>特性</td><td>关系</td></tr>
                
            </table>
           
            
        </div>
        
        
        
        
    </div>
    
    
</body>
</html>
