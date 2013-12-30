<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */

class Request {
    
    public $_params;
    
    public static function getInstance(){
        if( null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public static function isEmpty($key){
        if(isset($_POST[$key]) && !empty($_POST[$key])){
            return true;
        }
        return false;
    }
    
    public static function isPostSubmit($key=''){
        if(!empty($key)){
            if(isset($_POST[$key]) && !empty($_POST[$key])){
                return true;
            }
        }else{
            if(!empty($_POST)){
                return true;
            }
        }
        return false;
    }
    
    public static function getPost($name='', $default=null){
        return  $name ? ( isset($_POST[$name]) ? $_POST[$name] : $default) : $_POST;
    }
    
    public static function getIntPost($name='', $default=null){
        return  isset($_POST[$name]) ? intval($_POST[$name]) : intval($default);
    }
    
    public static function setPost($name,$value){
        return $name && $_POST[$name]=$value;
    }
    
    public static function getGet($name='', $default=null){
        return  $name ? ( isset($_GET[$name]) ? $_GET[$name] : $default) : $_GET;
    }
    
    public static function getIntGet($name='', $default=null){
        return  isset($_GET[$name]) ? intval($_GET[$name]) : intval($default);
    }
    
    public static function setGet($name,$value){
        return $name && $_GET[$name]=$value;
    }

    public static function getPostInt(){
        
    }
    
    public static function requestUri(){
		return $_SERVER["REQUEST_URI"];
    }
    
    
    public static function getSubDomain(){
        $server = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : ( $_SERVER['SERVER_NAME'] ? $_SERVER['SERVER_NAME'] : '');
        $regUri = '/(.*?)\.[a-zA-Z0-9\-]\.[a-zA-Z0-9\-]+$/i';
        $url = array();
        if( preg_match( $regUri, $server, $matches) ){
            $url = explode('.', $matches['1']);
            $url = array_diff($url, array('www'));
        }
        return $url;
    }
    
    /**
	 * 返回上一个页面的 URL 地址(来源)
	 */
	public static function refererUrl(){
		return isset( $_SERVER["HTTP_REFERER"] ) ? $_SERVER["HTTP_REFERER"] : '';
	}

	/**
	 * 返回当前页面的 URL 地址
	 */
	public static function currentUrl(){
		$http = ( isset($_SERVER["HTTPS"] ) && $_SERVER["HTTPS"]!="off") ? 'https' : 'http';
		$http .= '://';
		$prot = $_SERVER["SERVER_PORT"]!='80' ? ':'.$_SERVER["SERVER_PORT"] : '';
		return $http.$_SERVER["SERVER_NAME"].$prot.$_SERVER["REQUEST_URI"];
	}
    
    
    public static function getClientIp(){
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return($ip);
	}
}

?>
