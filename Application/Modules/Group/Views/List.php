<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>小组</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery');
        load_js('rgss');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubGroupMenu');
?> 

    <div  class="main">
        
        <div class="main-left">
            <div class="group-info-box">
                <div class="group-title">
                    <div class="group-logo"><img src="<?php echo group_logo(0,$group['id']);?>" /></div>
                    <div class="group-title2"><?php echo $group['name'];?><span class="group-num"><?php echo $group['num'];?>人加入此小组</span></div>
                    <div class="group-join-status" id="group-join-status">
                    <?php 
                        if($user['uid'] == $group['creator']){
                    ?>
                        <a href="<?php echo group_url($group['url'], 'manage');?>" id="manage-group" groupurl = "<?php echo $group['url'];?>" groupid="<?php echo $group['id'];?>" class="">管理</a>
                    <?php 
                        }elseif($is_in_group){
                            echo '<a href="javascript:;" id="leave-group" groupurl = "'. $group['url']. '" groupid="' . $group['id'] .'" class="">已加入/退出</a>';
                        }else{
                    ?>
                        <a href="javascript:;" id="join-group" groupurl="<?php echo $group['url'] ;?>/join" groupid="<?php echo $group['id']?>" class="join-group">加入</a>
                        <?php }?>
                    </div>
                </div>
                <div class="group-info">
                    <?php echo $group['info']?>
                </div>
            </div>
            
            <div class="group-menu mt30">
                <a class="active" href="">全部帖子</a>  <!--<a href="">精华</a>-->
                <?php if($is_in_group){?>
                <a class="group-post-btn" href="<?php echo group_url($group['url'], 'post');?>">发帖</a>
                <?php }?>
            </div>
            
            <ul class="forum-list">
            <?php
                foreach ($topics as $k => $v){
            ?>
                <li class="forum-li">
                    <h3 class="title-h3"><a href="<?php echo topic_url($v['id'], $v['url'], 3);?>"><?php echo $v['title'];?></a></h3>
                    <div class="forum-author">
                        <a href="<?php echo user_space($v['author']['blogname']);?>"><?php echo $v['author']['username'];?></a>
                    </div>
                    <div class="forum-reply-num"><?php echo dgmdate( $v['time'] );?></div>
                </li>
            
            <?php }?>
            </ul>
            
            <div class="page"><?php echo $page_html;?></div>
            
            
        </div>
        
        
        <div class="main-right">
            <div class="main_title2 mt20">活跃的小组成员</div>
            <div class="active-member-box" style=" margin-top: 10px;">
            <ul>
                <?php
                    foreach($members as $k => $v){
                        $i = 1;
                        $class = ($i%4 == 0) ? 'class="mr0"' : '';
                ?>
                <li <?php echo $class;?>>
                    <a href="<?php echo user_space($v['blogname']);?>"><img src="<?php echo avatar($v['uid']);?>" /></a> 
                    <a href="<?php echo user_space($v['blogname']);?>"><?php echo $v['username'];?></a> 
                </li>
                <?php 
                    $i ++ ;
                }?>
                <div class="clear"></div>
            </ul>        
            </div>
            
            <div class="mt20">
                <p><a href="/group/<?php echo $group['url']?>/members/">查看所有小组成员</a></p>
                <p><a href="/group/<?php echo $group['url']?>/members/">邀请好友加入</a></p>
            </div>
            
        </div>
        
        
    </div>
    
<?php load_view('Footer');?>
    <script>
        $(function(){
            $('#join-group').live('click', function(){
                var groupurl = $(this).attr('groupurl')
                var url = '/group/' + groupurl + '/join';
                var gid = $(this).attr('groupid');
                $.post(url, {'gid':gid}, function(r){
                    result = eval("(" + r + ")");
                    if(result.success == 1){
                        var html = '<a href="javascript:;" id="leave-group" groupurl = "' + groupurl + '" groupid=" ' + gid + ' " class="">已加入/退出</a>';
                        $('#group-join-status').html(html);
                    }
                });
            });
            
            $('#leave-group').live('click', function(){
                var groupurl = $(this).attr('groupurl')
                var url = '/group/' + groupurl + '/leave';
                var gid = $(this).attr('groupid');
                $.post(url, {'gid':gid}, function(r){
                    result = eval("(" + r + ")");
                    if(result.success == 1){
                        var html = '<a href="javascript:;" id="join-group" groupurl="' + groupurl + '" groupid="' + gid + '" class="join-group">加入</a>';
                        $('#group-join-status').html(html);
                    }
                });
            });
        });
    </script>
</body>
</html>
