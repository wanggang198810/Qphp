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
        load_js('bootstrap');
    ?>
</head>
<body>
<?php
    load_view ('Common.header');
    load_view ('SubMenu');
?> 

    <div  class="main">
        <div class="main-left">
           
            <h2 class="apply-group-title mt30">创建小组</h2>
            
            
            <form class="" method="post">
                <div class="apply-form-box">
                    <div class="apply-form-left">小组类型:</div>
                    <div class="apply-form-right">
                        <input checked="checked" type="radio" name="group-type" style="margin-top: -2px;" id="public-group" value="1" />
                        <label for="public-group">公开小组</label>

                        <input type="radio" name="group-type" style=" margin-left: 30px; margin-top: -2px;" id="private-group" value="0" />
                        <label for="private-group">私密小组</label>
                    </div>
                </div>
                
                
                <div class="apply-form-box">
                    <div class="apply-form-left">小组名称:</div>
                    <div class="apply-form-right">
                        <input type="text" name="group-name" id="group-name" class="group-name" value="" />
                    </div>
                </div>
                
                <div class="apply-form-box">
                    <div class="apply-form-left">小组简介:</div>
                    <div class="apply-form-right">
                        <textarea name="group-info" id="group-info" class="group-info"></textarea>
                    </div>
                </div>
                
                <div class="apply-form-box">
                    <div class="apply-form-left"></div>
                    <div class="apply-form-right">
                        <input type="checkbox" name="group-rule" id="group-rule" style="margin-top: -2px;" value="1" />
                        <label style="color:#999;" for="group-rule">我已阅读并愿意遵守《社区指导原则》</label>
                    </div>
                </div>
                
                <div class="apply-form-box">
                    <div class="apply-form-left"></div>
                    <div class="apply-form-right">
                        <input type="submit" id="group-submit" class="btn btn-success" value="提交" />
                        <a style=" margin-left: 20px;" href="/group">取消</a>
                    </div>
                </div>
            </form>
            
        </div>
        
        
        
        
    </div>
    
    
</body>
</html>
