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
        //load_js('bootstrap');
    ?>
<!--<link href="/Public/js/swfupload/default.css" rel="stylesheet" type="text/css" />-->
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
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "2 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "/Public/js/swfupload/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Hello</span>',
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
    load_view ('Common.header');
?> 

    <div  class="main">
        <div style="float:left; width: 650px;">
           
            <form method="post" enctype="multipart/form-data" action="/game/post">
			<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload Queue</span>
			</div>
            <div id="divStatus">0 Files Uploaded</div>
			<div>
				<span id="spanButtonPlaceHolder"></span>
				<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
			</div>
                
            </form>
            
        </div>
        
        
        
        
    </div>
    
    
</body>
</html>
