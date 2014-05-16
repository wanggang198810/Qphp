<div style=" width: 100%; height: 35px; background: #eee; border-bottom: 1px solid #ddd;  padding: 25px 0 25px 0;">
    <div class="main">
        <div class="">
            <div style="padding:0; margin:0; width: 142px; height: 35px; line-height: 35px; float: left; margin-right: 20px;">
                <a href="" href="/"><img src="/Public/image/logo-2.png" /></a></div>

            <ul class="sub-nav">
                <li><a href="/group" class="active">首页</a></li>
                <li><a href="/group/mine/">我的小组</a></li>
                <li><a href="/group/rank/">加入小组</a></li>
            </ul>

            <div class="input-append right" style="margin-top:3px;  height: 30px; position: relative">
                <form method="get">
                  <input class="span2" name="tag" id="tag" type="text" placeholder="搜索你感兴趣的内容和人..." style="width:230px; font-size: 13px;"  autocomplete ="off">
                  <div id="xxx" style="position: absolute; border: 1px solid #ccc; height: auto; width: 232px; min-height: 30px; background: #FFF; z-index: 99999; color: #000; font-size: 13px; padding: 5px;">
                  </div>
                  <button class="btn" type="button" id="tag-submit">Go!</button>
                </form>
           </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('#tag-submit').click(function(){
        var url = '/tag/' + $('#tag').val();
        location.href= url;
    });
    
    $('#tag').keyup(function(r){
        var tag = $(this).val();
        if(tag != ''){
            $.post('/tag/search', {'tag':tag},function(r){
                r = eval( "(" + r + ")");
                var html = '';
                if(r.length > 0){
                    for(x in r){
                        html += '<div><a href="http://www.q.com">' + r[x] + "</a></div>";
                    }
                    $('#xxx').html( html );
                    $('#xxx').show();
                }
                
            });
        }
    });
    
    $('#tag').blur(function(r){
        $('#xxx').hide();
        $('#xxx').html("");
    });
    
    
    
});
</script>