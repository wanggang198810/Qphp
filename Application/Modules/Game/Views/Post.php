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
        #btnCancel,#divStatus{ display: none;}
    </style>
    
    <script type="text/javascript" src="/Public/js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/Public/js/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="/Public/js/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="/Public/js/swfupload/handlers.js"></script>
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "/Public/js/swfupload/swfupload.swf",
				upload_url: "/upload/",
				post_params: {"PHPSESSID" : "<?php echo $user['uid']; ?>"},
				file_size_limit : "2 MB",
				file_types : "*.jpg;*.gif;*png;*.jpeg",
				file_types_description : "All Files",
				file_upload_limit : 5,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: true,
                

				// Button settings
				//button_image_url: "/Public/js/swfupload/TestImageNoText_65x29.png",
                button_image_url: "/Public/image/add-photo.png",
				button_width: "100",
				button_height: "39",
				button_placeholder_id: "spanButtonPlaceHolder",
				//button_text: '<span class="theFont">Hello</span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>  
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
                    <!--
                    <label for="title">图片 <a href="javascript:;" id="add-photo-item">添加图片</a></label> 
                    <input type="file" class="photo" class="form-control" name="photo[]" />-->
                    <a href="javascript:;" id="get-r">结果</a>
                    <div class="fieldset flash" id="fsUploadProgress">
                    <span class="legend"></span>
                    </div>
                    <div id="divStatus">0 Files Uploaded</div>
                    <div class="mt20">
                        <span id="spanButtonPlaceHolder"></span>
                        <input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
                    </div>
                </div>

                <div class="form-group mt20">
                    <label for="content">内容</label>
                    <textarea name="content" id="content" style="width:737px; height:500px; visibility:hidden;"></textarea>
                </div>
                
                <div class="form-group mt20" id="down-address">
                    <label for="down">下载地址 <a href="javascript:;" id="add-down-address">增加下载链接</a></label> 
                    <div class="down-address-item">
                        <input type="text" style=" width: 120px; padding: 7px 9px;" class="form-control" name="downname[]" placeholder="下载名称" />
                        <input type="text" style=" width: 520px; padding: 7px 9px;" class="form-control " name="down[]" placeholder="下载链接">
                            <a href="javascript:;" class="delete-down">删除</a></div>
                    </div>
                </div>
            
            
            
                <div class="form-group" style="padding:20px 0;">
                <button type="button" id="submit-btn" class="btn btn-default">保存</button>
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

                <label for="filesize">游戏大小</label>
                <input style="width:155px;" id="filesize" name="filesize" type="text" placeholder="单位为M">
            </div>
            
            <div style="margin-top:20px;">
                <label for="url">游戏语言</label>
                <select name="lang" id="lang" style="width:169px">
                    <option value="1">简体中文</option>
                    <option value="2">繁体中文</option>
                    <option value="3">英文</option>
                    <option value="4">日文</option>
                    <option value="5">其他</option>
                </select>
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
    
    $('#add-down-address').click(function(){
        var html = '<div class="down-address-item"><input type="text" style=" width: 120px; padding: 7px 9px;" class="form-control" name="downname[]" placeholder="下载名称" /> <input type="text" style=" width: 520px; padding: 7px 9px;" class="form-control " name="down[]" placeholder="下载链接"> <a href="javascript:;" class="delete-down">删除</a></div>';
        $('#down-address').append(html);
    });
    
    
    
    $('#down-address').on('click','.delete-down', function(){
        $(this).parent('.down-address-item').remove();
    });
    
    $('#submit-btn').click(function(){
        var name = $('#name').val();
        var content = $('#content').val();
        var type = $('#type').val();
        var gid = $('#groupid').val();
        var url = $('#url').val();
        var cover = '';
        $('.progressWrapper').each(function(){
            cover += $(this).attr('filepath') + '|||';
        });
        if(name=='' || content =='' || type == 0 || gid ==0 || cover ==''){
            //alert('请填写完整的内容');
            //return false;
        }
        var data = {'name':name, 'content':content, 'type':type, 'gid':gid, 'url':url, 'cover':cover};
        $.post('/game/post/', data, function(r){
            alert(r);
            r = eval( "(" + r +")");
            alert(r.success);
        });
    });
});   
</script>
</body>
</html>
