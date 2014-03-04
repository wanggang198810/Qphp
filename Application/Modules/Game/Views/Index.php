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
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 

    <div  class="main">
        <div style=" background: #EEE; border: 1px solid #ccc; margin-top: 32px; padding: 32px; line-height: 2; font-size: 15px;">
            吞食天地是以三国故事背景、讲诉三国时代各个英雄人物的实事故事和经典战役<Br />

游戏内容比较充实，遇敌率也不高，不过战斗过程比较漫长。战斗过程除了普通攻击外还有总攻击和策略选项，体现了一定的战术性<Br />

登场的人物总共有200多位，武将带兵的数量取代了传统RPG的HP值，军师谋略值替代了用来施放法术的“魔”<Br />

其它RPG游戏中的传统设定也都被战略游戏中的各种概念取代，将三国题材的SLG特点完美而合理的进行了RPG化。<Br />
        </div>
        
        <div style=" margin-top: 50px; line-height: 2; ">
            <ul class="game-list">
            <?php
                $i = 0;
                foreach($games as $k => $v){
                    $i ++ ;
                    $class=  $i%5 == 0 ? ' class="fright"' : '';
            ?>
                <li <?php echo $class;?>>
                    <img src="http://www.rgss.cn/<?php echo $v['cover'];?>" width="170" height="135" />
                    <div class="li-bottom">
                        <a style=" font-size: 14px;" href="<?php echo game_url($v['id'], $v['url']);?>"><?php echo $v['name'];?></a>
                        <div>中文 / 20M</div>
                    </div>
                </li>
            <?php 
                }
            ?>    
                
                
                
            </ul>
           
            
        </div>
        
        
        
        
    </div>
    
    
</body>
</html>
