<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $group['name'];?>小组管理</title>
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
                        <a href="<?php echo group_url($group['url'], 'edit');?>" id="manage-group" groupurl = "<?php echo $group['url'];?>" groupid="<?php echo $group['id'];?>" class="">修改</a>
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
            
            
            
            <div class="main_title"><?php echo $group['name'];?>小组成员</div>
            <ul class="manage-member-list" id="manage-member-list" groupurl = "<?php echo $group['url'];?>" groupid="<?php echo $group['id'];?>">
            <?php
                foreach ($members as $k => $v){
                    $i = 1;
            ?>
                <li id="member-li-<?php echo $v['uid']?>">
                    <a href="<?php echo user_space($v['uid']);?>"><?php echo $v['username'];?></a>
                    <?php if($v['manager'] > 1){?>
                        <a class="right" href="javascript:;" uid="<?php echo $v['uid']?>">创始人</a>
                    <?php }elseif($v['manager'] >= 1){?>
                        <a class="kickMember right" href="javascript:;" uid="<?php echo $v['uid']?>" id="member-<?php echo $v['uid']?>">删除</a>
                        <a class="del-manage right" style=" margin-right: 5px;" href="javascript:;" uid="<?php echo $v['uid']?>" id="del-manage-<?php echo $v['uid']?>">取消管理员</a>
                    <?php }else{?>
                        <a class="kickMember right" href="javascript:;" uid="<?php echo $v['uid']?>" id="member-<?php echo $v['uid']?>">删除</a>
                        <a class="add-manage right" style=" margin-right: 5px;" href="javascript:;" uid="<?php echo $v['uid']?>" id="add-manage-<?php echo $v['uid']?>">设置管理员</a>
                    <?php }?>
                </li>
            
            <?php   $i ++ ; }?>
            </ul>
            
            <div class="page"><?php echo $page_html;?></div>
            
            
        </div>
        
        
        <div class="main-right">
            <div class="main_title2 mt20">活跃的小组成员</div>
            <div class="active-member-box" style=" margin-top: 10px;">
               
            </div>
            
            <div class="mt20">
                <p><a href="/group/<?php echo $group['url']?>/members/">查看所有小组成员</a></p>
                <p><a href="/group/<?php echo $group['url']?>/members/">邀请好友加入</a></p>
                <p><a href="/group/<?php echo $group['url']?>/taglist/">小组标签</a></p>
            </div>
            
        </div>
        
        <div class="clear"></div>
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
        
        
        $('.kickMember').live('click', function(){
            var uid = $(this).attr('uid');
            var gid = $('#manage-member-list').attr('groupid');
            var groupurl = $('#manage-member-list').attr('groupurl');
            var url = '/group/' + groupurl + '/kickMember/';
            $.post(url, {'uid':uid, 'gid':gid}, function(r){
                result = eval("(" + r + ")");
                if(result.success == 1){
                    $('#member-li-' + uid).remove();
                }else{
                    alert('未知错误.');
                }
            });
        });

        //设置管理员
        $('.add-manage').live('click', function(){
            var uid = $(this).attr('uid');
            var gid = $('#manage-member-list').attr('groupid');
            var groupurl = $('#manage-member-list').attr('groupurl');
            var url = '/group/' + groupurl + '/addManage/';
            $.post(url, {'uid':uid, 'gid':gid}, function(r){
                alert(r);
                result = eval("(" + r + ")");
                if(result.success == 1){
                    $('#member-li-' + uid).remove();
                }else{
                    alert('未知错误.');
                }
            });
        });
    });
</script>
</body>
</html>
