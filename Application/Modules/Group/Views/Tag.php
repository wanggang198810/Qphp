<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $group['name'];?>小组</title>
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
                        if($is_creator){
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
                <a class="active" href="">全部标签</a>  <!--<a href="">精华</a>-->
                <?php if($is_manager){?>
                <a class="group-post-btn" href="<?php echo group_url($group['url'], 'addtag');?>">添加标签</a>
                <?php }?>
            </div>
            
            <div style=" ">
            <ul class="tag-list">
            <?php
                foreach ($tags as $k => $v){
            ?>
                <li class="tag-li" id="tag-li-<?php echo $v['id'];?>" style="position: relative;">
                <?php if($is_creator){?>
                        <a class="group-tag-delete" tagid ="<?php echo $v['id'];?>" href="#" style=" display: none; position: absolute; top: -12px; right: -4px;">x</a>
                <?php }?>
                        <a href="<?php echo group_tag($group['url'], $v['name']);?>"><?php echo $v['name'];?></a>
                </li>
            <?php }?>
            </ul>
            </div>
            
            <div class="page"></div>
            
            
        </div>
        
        
        <div class="main-right">
            <div class="main_title2 mt20">活跃的小组成员</div>
            
            <div class=" mt20">
                <p><a href="/group/<?php echo $group['url']?>/members/">查看所有小组成员</a></p>
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
            
            $('.group-tag-delete').click(function(){
                var tagid = $(this).attr('tagid');
                $.post('/group/<?php echo $group['url'];?>/deleteTag/', {'tagid': tagid, 'groupid' : <?php echo $group['id']?>}, function(r){
                    r = eval( "(" + r + ")");
                    alert(r.msg);
                    if(r.success == 1){
                        $('#tag-li-' + tagid).remove();
                    }
                    
                });
            });
            
            <?php if($is_creator){?>
            $('.tag-li').hover(
                function(){
                    $(".group-tag-delete").css({ 'display':'block'})
                },
                function(){
                    $(".group-tag-delete").css({ 'display':'none'})
                }
            );
            <?php }?>
        });
    </script>
</body>
</html>
