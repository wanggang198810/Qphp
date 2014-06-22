<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>同能游戏_同能网</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
    ?>
    
    <style>
    	body{ background:#fcfcfc}
    	#game-main { margin:auto; max-width:1250px; z-index: 2; padding:15px; position: relative; background: #FFF; margin-top: 50px;}
    	#game-recom-side {float: left; width:230px;  position:fixed; }
    	.game-recom-side-item { padding:10px; width:210px; border:1px solid #C6F0B6; border-left:1px solid #C6F0B6; border-top:3px solid #4BC71A; height:200px; background:#FFF; margin-top:30px;}
    	.game-recom-title {  line-height:1.2; color: #078036; font-size:18px;  padding-bottom: 10px;}
    	.game-recom-bottom-line { border-bottom:1px solid #eee;}
    	.game-recom-list {}
    	.game-recom-item { padding:10px 0;}
    	
    	#game_con { float: right; width:978px;}
    	
    </style>
</head>
<body>
<?php
    //load_view ('Common.header');
    load_view ('SubGameMenu');
?> 
<div id="page">
	<div class="common-bg">
		<a class="common-bg-link" href="#"></a>
	</div>
	
    <div id="game-main">
    
    	<div id="game-recom-side">
	    	<div class="game-recom-side-item box-shadow1" style=" ">
	    		<div class="game-recom-title game-recom-bottom-line" >游戏分类</div>
	    		<div class="game-recom-list">
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">唐门世界</a></div>
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">绝世天府</a></div>
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">太古仙域</a></div>
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">大话水浒</a></div>
	    		</div>
	    	</div>
	    	
	    	<div class="game-recom-side-item box-shadow1" style=" ">
	    		<div class="game-recom-title game-recom-bottom-line" >精品手游推荐</div>
	    		<div class="game-recom-list">
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">唐门世界</a></div>
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">绝世天府</a></div>
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">太古仙域</a></div>
	    			<div class="game-recom-item game-recom-bottom-line"><a href="">大话水浒</a></div>
	    		</div>
	    	</div>
    	</div>
    	
    	<div id="game_con" >
	        <div style=" background: #EEE; border: 1px solid #ccc; margin-top: 32px; padding: 32px; line-height: 2; font-size: 15px;">
	            吞食天地是以三国故事背景、讲诉三国时代各个英雄人物的实事故事和经典战役<Br />
	
	游戏内容比较充实，遇敌率也不高，不过战斗过程比较漫长。战斗过程除了普通攻击外还有总攻击和策略选项，体现了一定的战术性<Br />
	
	登场的人物总共有200多位，武将带兵的数量取代了传统RPG的HP值，军师谋略值替代了用来施放法术的“魔”<Br />
	
	其它RPG游戏中的传统设定也都被战略游戏中的各种概念取代，将三国题材的SLG特点完美而合理的进行了RPG化。<Br />
	        </div>
	        <div>
	            <a href="/game/post/">提交游戏</a>
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
	                    <a style=" font-size: 14px;" href="<?php echo game_url($v['id'], $v['url']);?>">
	                        <img src="http://www.rgss.cn/<?php echo $v['cover'];?>" width="170" height="135" />
	                    </a>
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
        
        <div class="clear"></div>
    </div>
    
</div>  

<?php load_view('Footer');?>    
</body>
</html>
