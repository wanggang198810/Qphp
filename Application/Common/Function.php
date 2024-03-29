<?php


function filter($str){
    return htmlspecialchars( trim($str) );
}


function load_js($filename){
    if(false === strpos($filename, '.js')){
        $filename .= '.js';
    }
    
    echo '<script src="/Public/js/'.$filename.'"></script>';
}

function load_css($filename){
    if(false === strpos($filename, '.css')){
        $filename .= '.css';
    }
    echo '<link href="/Public/css/'.$filename.'" rel="stylesheet" type="text/css">';
}


function load_uc(){
    include ROOT_PATH . '/UC_API/config.inc.php';
    include ROOT_PATH . '/UC_API/uc_client/client.php';
}

function load_view($filename){
    $type = 'Common/';
    
    $config = Q::getConfig();
    if( false !== strpos($filename, '.')){
        list($type, $filename) = explode('.', $filename);
        $type = Q::checkPath( ucfirst($type));
    }
    $filename = ucfirst($filename);
    if(strpos($filename, '.php') === false){
        $filename .= '.php';
    }
    if($config['hmvc']){
        $filepath = APP_PATH . Q::checkPath( $config['hmvc_dir'] ) . Q::checkPath( $type )  . 'Views/' . $filename ;
    }else{
        $filepath = APP_PATH . 'Views/' . Q::checkPath( $type ) . $filename;
    }
    
    if( file_exists( $filepath ) ){
        require_once ( $filepath );
    }elseif( file_exists( FRAMEWORK_PATH . $type . $filename) ){
        require_once ( FRAMEWORK_PATH . $type . $filename);
    }

}


function load_form( $url = '' , $data= array() ){
    $html =<<< EOD
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
		<form action="{action}">
			<textarea name="content" style="width:700px;height:200px;visibility:hidden;">KindEditor</textarea>
		</form>
EOD;
    
  $html = str_replace('{action}', $url , $html);
  echo $html;
}


//分页，页码
function to_page_html2( $page, $totalPage=1, $col=20, $param ='page'){
	if($totalPage <= 1){
		return '';
	}
	$html = '<div style="padding: 10px 0">';
	if($page >= $totalPage){
		$page = $totalPage;
	}
	if($page <= 0){
		$page = 1;
	}
	
	$start = floor( $page / $col ) * $col + 1;
	$end = $start + $col - 1;
	if($totalPage < $end){
		$end = $totalPage;
	}
	
	$url = $_SERVER['REQUEST_URI'];
	$url  = parse_url($url);
	parse_str($url['query'], $par);
	if(isset($par[$param])){
		unset($par[$param]);
	}
	if(isset($par['header_tips'])){
		unset($par['header_tips']);
	}
	$url_str = http_build_query($par);
	$url_str = empty($url_str) ? '' : '&'.$url_str;
    
	$pre_page = ($page - 1) <= 0 ? 1: $page-1; 
	$pre_url = $url['path'] . '?' .$url_str . $param. '=' . $pre_page;
	$html .= '<a href="'.$pre_url.'">上一页</a>';
	
	for ($i = $start; $i <= $end; $i++){
		$a_url = $url['path'] . '?' .$url_str . $param. '=' . $i;
		if($i==$page){
			$html .= '<span style="font-weight:bold; padding:0 5px;">'.$i.'</span>';
		}else{
			$html .= '<a href="' . $a_url . '" >'.$i.'</a>';
		}
	}
	
	$next_page = ($page+1) > $totalPage ? $totalPage: $page+1;
	$next_url = $url['path'] . '?' . $url_str . $param. '=' . $next_page;
	$html .= '<a href="'.$next_url.'">下一页</a>';
	
	$html .= '</div>';
	return $html;
}



//分页，页码
function to_page_html( $page, $totalPage=1, $col=20, $param ='page'){
    if($totalPage <= 1){
        return '';
    }
    $html = '<div style="padding: 10px 0">';
    if($page >= $totalPage){
        $page = $totalPage;
    }
    if($page <= 0){
        $page = 1;
    }

    $start = floor( $page / $col ) * $col + 1;
    $end = $start + $col - 1;
    if($totalPage < $end){
        $end = $totalPage;
    }

    $url = $_SERVER['REQUEST_URI'];
    $url  = parse_url($url);
    $par = array();
    if(isset($url['query'])){
        parse_str($url['query'], $par);
    }
    if(isset($par[$param])){
        unset($par[$param]);
    }
    if(isset($par['header_tips'])){
        unset($par['header_tips']);
    }
    $url_str = http_build_query($par);
    $url_str = empty($url_str) ? '' : $url_str. '&';
    
    $pre_page = ($page - 1) <= 0 ? 1: $page-1;
    $pre_url = $url['path'] . '?' .$url_str .$param. '=' . $pre_page;
    $first_url = $url['path'] . '?' .$url_str . $param. '=1' ;
    $last_url = $url['path'] . '?' .$url_str .$param. '='.$totalPage ;
    $html .= '<a href="'.$first_url.'">首页</a>';
    $html .= '<a href="'.$pre_url.'" >上一页</a>';

    for ($i = $start; $i <= $end; $i++){
        $a_url = $url['path'] . '?' .$url_str . $param. '=' . $i;
        if($i==$page){
            $html .= '<span style="font-weight:bold; padding:0 5px;">'.$i.'</span>';
        }else{
            $html .= '<a href="' . $a_url . '" >'.$i.'</a>';
        }
    }

    $next_page = ($page+1) > $totalPage ? $totalPage: $page+1;
    $next_url = $url['path'] . '?' .$url_str .$param. '=' . $next_page;
    $html .= '<a href="'.$next_url.'" >下一页</a>';
    $html .= '<a href="'.$last_url.'" >尾页</a>';
    $html .= '</div>';
    return $html;
}

function user_space( $url , $type = '' ){
    if(!empty($type)){
        $type = '/'.$type;
    }
    return '/u/'.$url.$type;
}

function avatar($uid){
    return '/Public/image/default_avatar.png';
}


function group_url($url, $type =''){
    
    if(!empty($type)){
        return '/group/'.$url.'/'.$type.'/';
    }
    return '/group/'.$url.'/';
}

function group_logo($url=''){
    if(empty($url)){
        return '/Public/image/default_group.png';
    }
    return $url;
}

function group_tag($url, $tagname){
    return '/group/' . $url . '/tag/' . $tagname .'/';
}

function topic_url($id, $url='', $type = 1){
    switch ($type){
        case 2:
            $typeurl = 'question';
            break;
        case 3:
            $typeurl = 'post';
            break;
        default :
            $typeurl = 'topic';
            break; 
    }
    if(!empty($url)){
        return '/'.$typeurl.'/'.$id.'-'.$url;
    }
    return '/'.$typeurl.'/'.$id;
}

function qtag_url($tagname){
    return '/question/tag/'.$tagname;
}

function message_url($id, $msgid){
    return '/message/'.intval($id);
    $msgid = intval($msgid);
    if($msgid == 0){
        return '/message/'.intval($id);
    }else{
        return '/message/'.$msgid . '#message-'.intval($id);
    }
}

function game_url($id, $url = ''){
    $url = !empty($url) ? '/'.$url : '';
    return '/game/' . $id . $url; 
}

function filter_content($str){
    return htmlspecialchars_decode( htmlspecialchars( $str) );
}


/**
 * 人性化时间转换    只转换一周内的时间
 * @param object $time  int or string  时间戳或者 Y-m-d H:i:s格式
 * @param string $format 时间格式 默认 Y-m-d H:i:s
 */
function dgmdate($time, $format = 'Y-m-d H:i') {
	if (!is_numeric ( $time )) {
		$time = strtotime($time);
	}
	$timespan = time () - $time;
	$days = intval ( $timespan / 86400 );
	if ($days == 0) {
		if ($timespan > 3600) {
			return intval ( $timespan / 3600 ) . "小时前";
		} elseif ($timespan > 1800) {
			return "半小时前";
		} elseif ($timespan > 60) {
			return intval ( $timespan / 60 ) . "分钟前";
		} elseif ($timespan > 0) {
			return $timespan . "秒前";
		} elseif ($time <= 0) {
			return "刚刚";
		}
	} elseif ($days >= 0 && $days < 7) {
		return $days . "天前";
	}
	return date ( $format, $time );
}


