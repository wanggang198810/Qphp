



$(function(){
    $('.add-reply').bind('click', function(){
        var id = 'sub-reply-box-'  +  $(this).attr('replyid');
        if( $(this).attr('openreply') == 1){
            $(this).attr('openreply', 0);
            $('#' + id).fadeOut();
        }else{
            $(this).attr('openreply', 1);
            $('#' + id).fadeIn();
        }
    });
    
    
    
    
    
    // 回到顶部插件.
    $.fn.manhuatoTop = function(options) {
		var defaults = {			
			showHeight : 150,
			speed : 1000
		};
		var options = $.extend(defaults,options);
		$("body").prepend("<div id='totop'><a>返回</a></div>");
		var $toTop = $(this);
		var $top = $("#totop");
		var $ta = $("#totop a");
		$toTop.scroll(function(){
			var scrolltop=$(this).scrollTop();		
			if(scrolltop>=options.showHeight){				
				$top.show();
			}
			else{
				$top.hide();
			}
		});	
		$ta.hover(function(){ 		
			$(this).addClass("cur");	
		},function(){			
			$(this).removeClass("cur");		
		});	
		$top.click(function(){
			$("html,body").animate({scrollTop: 0}, options.speed);	
		});
	}
    
    
    
    
})



