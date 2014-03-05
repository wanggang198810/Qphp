<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $game['name'];?> - 同能游戏</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
        load_js('rgss.js');
    ?>
        <style>
           
        
        </style>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 


    <div  class="main">
        <div style="float:left; width: 650px;">
            <div class="game-title">
                <h1 class="title-h1">
                    <a href="<?php echo game_url($game['id'], $game['url']);?>"><?php echo $game['name'];?></a>
                </h1>
            </div>
            
            <div style=" margin-bottom: 20px;">
                <div>图集</div>
                <div>
                    <div style="padding: 20px;  width: 600px; height: 350px; overflow: hidden;"><img style=" width: 600px; height: 350px;" src="http://www.rgss.cn/<?php echo $game['cover']?>" /></div>
                    <div>
                        <img src="http://www.rgss.cn/<?php echo $game['cover']?>" width="100" />
                        <img src="http://www.rgss.cn/<?php echo $game['cover']?>" width="100" />
                        <img src="http://www.rgss.cn/<?php echo $game['cover']?>" width="100" />
                    </div>
                </div>
            </div>

            <div class="content-box">
                <div class="content">
                    <?php echo filter_content($game['content']) ;?>
                </div>
            </div>
            
            <div class="reply-box">
                
                <div style="font-size:12px; color:#999; padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
                    <?php echo $pageinfo['total'];?>个评论
                </div>
                
                <div style="position: relative">
                    <!-- 回复列表 -->
                    <?php
                        foreach($replys as $k => $reply){
                    ?>
                        <div class="answer-item" replyid="<?php echo $reply['id'];?>" gameid="<?php echo $reply['gameid'];?>">
                            <div class="post-avatar"><img src="<?php echo avatar($game['uid'])?>" /></div>
                            <div class="post-content">
                                <div class="post-user">
                                    <a href="<?php echo user_space($reply['reply_user']['blogname']);?>"><?php echo $reply['reply_user']['username'];?></a>
                                    <?php echo '，' , $reply['reply_user']['honorname']?>
                                </div>

                                <div class="answer-head">

                                </div>
                                <div class="answer-agree"></div>
                                <div class="answer-con"><?php echo filter_content( $reply['content'] );?></div>
                                <div class="answer-bottom">
                                    <a href="javascript:;"><?php echo dgmdate($reply['time']);?></a> 
                                    <a href="javascript:;" replyid="<?php echo $reply['id']?>" openreply="0" class="add-reply">添加评论</a>
                                    <div id="sub-reply-box-<?php echo $reply['id'];?>"  class="sub-reply-box radius-5">
                                        <form method="post" action="<?php echo game_url($game['id'], $game['url'], 2) . '/answer';?>">
                                            <input type="hidden" name="gameid" id="gameid" value="<?php echo $reply['gameid'];?>" />
                                            <input type="hidden" name="replyid" id="replyid" value="<?php echo $reply['id'];?>" />
                                            <textarea name="reply_content" id="reply_content" class="sub-reply-textarea"></textarea>
                                            <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <!-- 回复列表 -->
                </div>
                
                
                <form method="post" action="<?php echo game_url($game['id'], $game['url'], 1) . '/answer';?>">
                    <div style="color: #005580; font-weight: 600; font-size: 14px; padding: 10px 0;">添加评论</div>
                    <input type="hidden" name="gameid" id="gameid" value="<?php echo $game['id'];?>" />
                    <input type="hidden" name="replyid" id="replyid" value="0" />
                    <textarea name="reply_content" id="reply_content" class="reply-textarea"></textarea>
                    <button type="submit" class="btn btn-success" style="float: right;">回复</button>
                </form>
            </div>
        </div>
        
        
        <div class="right side270 mt30">
            <div class="game-user">
                <a class="user-avatar" href="<?php echo user_space($view_user['blogname'])?>">
                    <img src="http://www.q.com/Public/image/default_avatar.jpg" />
                </a>
                <div class="blogname" style=""><a href="<?php echo user_space($view_user['blogname'])?>"><?php echo $view_user['username']?></a></div>
                <div class="honorname"><?php echo $view_user['honorname']?></div>
                <div class="reply-time">发表于<br><?php echo date( "Y-m-d H:i" , $game['time']);?></div>
            </div>
        </div>
        
    </div>
    
<?php load_view('Footer');?>     
</body>
</html>
