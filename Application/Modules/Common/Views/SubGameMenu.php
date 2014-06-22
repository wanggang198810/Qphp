<!--

-->
<div class="sub-game-nav-box" style="position: fixed; z-index:999">
    
    <div class="common-nav">
        <div class="">
            <div class="sub-game-logo">
                <a href="" href="/"><img src="/Public/image/logo-2.png" /></a></div>
                
			<div class="right" style="width:900px; ">
			
				<div class="sub-game-search-box">
		            <div class="input-append sub-game-search">
		                <form method="get" class="mb0">
		                  <input class="span2" name="tag" id="tag" type="text" placeholder="搜索你感兴趣的内容和人..." style="width:230px; font-size: 13px;"  autocomplete ="off">
		                  <div id="xxx" style="position: absolute; border: 1px solid #ccc; height: auto; width: 232px; min-height: 30px; background: #FFF; z-index: 99999; color: #000; font-size: 13px; padding: 5px; display: none;">
		                  </div>
		                  <button class="btn" type="button" id="tag-submit">Go!</button>
		                </form>
		           </div>
	           </div>
	           
	           <div style=" margin:0;">
		           <ul class="sub-game-nav">
		                <li><a href="/group" class="active">首页</a></li>
		                <li><a href="/group/mine/">新游预约</a></li>
		                <li><a href="/group/rank/">单机游戏</a></li>
		                <li><a href="/group/rank/">社交网游</a></li>
		                <li><a href="/group/rank/">动漫相关</a></li>
		                <li><a href="/group/rank/">宅腐福利</a></li>
		                <li><a href="/group/rank/">萌物周边</a></li>
		                <li><a href="/group/rank/">游戏攻略</a></li>
		           </ul>
	           </div>
           </div>
        </div>
    </div>
    <div class="clear"></div>
</div>


<div class="ad-a" style=" text-align: center; margin: 20px 0">
<img src="http://jp.appgame.com/wp-content/uploads/sites/6/2014/05/cc-show.jpg">
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