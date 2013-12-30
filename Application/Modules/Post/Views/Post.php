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
        load_js('bootstrap');
    ?>
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
    
    <div class="container" style="margin-top: 50px;">
    
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
        <div style="float:left;">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">标题</label>
                    <input type="text" style=" width: 682px; padding: 7px 9px;" class="form-control" id="title" name="title" placeholder="标题">
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea name="content" id="content" style="width:700px; height:500px; visibility:hidden;"></textarea>
                </div>
                <div class="form-group" style="padding:20px 0;">
                <button type="button" class="btn btn-default">保存</button>
                </div>
            </form>
        </div>    
        <div style="float: right">
            
            
        </div>
            
    </div>
    
    
</body>
</html>
