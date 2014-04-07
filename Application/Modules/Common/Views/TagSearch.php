<div class="input-append right" style="margin-top:3px;  height: 30px;">
    <!--<form method="get" action="/tag/">-->
      <input class="span2" name="tag" id="tag" type="text" placeholder="搜索你感兴趣的内容和人..." style="width:230px; font-size: 13px;" onkeypress="testEnter()">
      <button class="btn" type="button" id="tag-submit">Go!</button>
    <!--</form>-->
</div>

<script>
$(function(){
    $('#tag-submit').click(function(){
        var url  = "http://www.baidu.com/#wd=" + $('#tag').val() + " site:www.rgss.cn";
        window.open( url );
    });
    $("#tag").keypress(function(){
        if(event.keyCode==13) {  
            var url  = "http://www.baidu.com/#wd=" + $('#tag').val() + " site:www.rgss.cn";
            window.open( url );
        }  
    });
});
</script>
