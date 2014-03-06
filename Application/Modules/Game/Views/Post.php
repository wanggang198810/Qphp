<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>分享信息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="Rgss.inc">
    <?php
        load_css('bootstrap');
        load_css('style');
        load_js('jquery1');
        load_js('bootstrap');
    ?>
    <script charset="utf-8" src="/Public/js/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/Public/js/kindeditor/zh_CN.js"></script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                resizeType : 1,
                allowPreviewEmoticons : false,
                allowImageUpload : false,
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
            });
        });
    </script>
    <style>
       body{ background: #f1f5f8; margin: 0;}
       .top{
           background: #000;  height: 350px; margin: 0px; overflow: hidden; color: #FFF;
       }
       .bottom{
           width: 100%;
       }
       .main{
           width: 750px;
           margin-right: auto;
           margin-left: auto;
        }
        
        
        ul.recomm{
            padding: 0;
            margin: 0;
        }
        ul.recomm li{
            padding: 0px;
            list-style: none;
            line-height: 35px;
            height: 35px;
            font-size: 14px;
        }
    </style>
</head>
<body> 
<?php
    load_view('header');
?>
<div style=" width: 980px; margin: 70px auto 0;">
    <form action="/game/post/" method="post" enctype="multipart/form-data">
    
        <div style="float:left; width: 740px; background: #fff; padding: 20px;" class="radius-5">
            
                <div class="form-group">
                    <label for="title">游戏名</label>
                    <input type="text" style=" width: 720px; padding: 7px 9px;" class="form-control" id="name" name="name" placeholder="标题">
                </div>
            
                <div class="form-group" id="photo">
                    <label for="title">图片 <a href="javascript:;" id="add-photo-item">添加图片</a></label> 
                    <input type="file" class="photo" class="form-control" name="photo[]" />
                </div>

                <div class="form-group mt20">
                    <label for="content">内容</label>
                    <textarea name="content" id="content" style="width:737px; height:500px; visibility:hidden;"></textarea>
                </div>
                <div class="form-group" style="padding:20px 0;">
                <button type="submit" class="btn btn-default">保存</button>
                </div>
            
        </div>    
        <div style="float: right; width: 169px; padding: 15px; background: #DDD;border: 1px solid #ddd;border-left: none; margin-top: 20px;">
            <div>
                <label for="tagid">游戏集</label>
                <div class="btn-group">
                    <input type="hidden" name="groupid" id="groupid"  value="0"/>
                    <button style="width:170px; padding: 5px 9px;" class="btn dropdown-toggle" data-toggle="dropdown"><span id="group-name">默认分类</span> <span class="caret"></span></button>
                    <ul class="dropdown-menu" id="game_group" style="min-width: 167px;">
                      <?php
                        foreach($game_groups as $k => $v){
                      ?>
                        <li><a class="cate" href="javascript:;" id="<?php echo $v['id'];?>"><?php echo $v['name'];?></a></li>
                      <?php
                        }
                      ?>
                      <li class="divider"></li>
                    </ul>
                </div>
            </div>
            
            <div>
                <label for="tagid">游戏类型</label>
                <div class="btn-group">
                    <input type="hidden" name="type" id="type"  value="0"/>
                    <button style="width:170px; padding: 5px 9px;" class="btn dropdown-toggle" data-toggle="dropdown"><span id="type-name">默认分类</span> <span class="caret"></span></button>
                    <ul class="dropdown-menu" id="game_type" style="min-width: 167px;">
                      <?php
                        foreach($game_types as $k => $v){
                      ?>
                        <li><a class="cate" href="javascript:;" id="<?php echo $v['id'];?>"><?php echo $v['name'];?></a></li>
                      <?php
                        }
                      ?>
                      <li class="divider"></li>
                    </ul>
                </div>
            </div>
            
            
            <div style="margin-top:50px;">
                <label for="url">url</label>
                <input style="width:155px;" id="url" name="url" type="text" placeholder="hello-url">

                <label for="tag">标签</label>
                <input style="width:155px;" id="tag" name="tag" type="text" placeholder="tag">
            </div>
        </div>
        
    </form>
</div>

    
<script>
$(function(){
    $('#game_group .cate').click(function(){
        $("#groupid").val($(this).attr('id'));
        $("#group-name").html($(this).html());
        
    });
    
    $('#game_type .cate').click(function(){
        $("#type").val($(this).attr('id'));
        $("#type-name").html($(this).html());
        
    });
    
    $('#add-photo-item').click(function(){
        var html = '<input type="file" class="photo" class="form-control" name="photo[]" />';
        $('#photo').append(html);
    });
});   
</script>
</body>
</html>
