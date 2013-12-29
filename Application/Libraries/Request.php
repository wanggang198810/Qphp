<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */

class Q_Request {
    
    public static $instance;
    public $_params;
    
    public static function getInstance(){
        if( null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    
    public function getPost($name='', $default=null){
        return  $name ? ( isset($_POST[$name]) ? $_POST[$name] : $default) : $_POST;
    }
    
    public function getIntPost($name='', $default=null){
        return  isset($_POST[$name]) ? intval($_POST[$name]) : intval($default);
    }
    
    public function setPost($name,$value){
        return $name && $_POST[$name]=$value;
    }
    
    public function getGet($name='', $default=null){
        return  $name ? ( isset($_GET[$name]) ? $_GET[$name] : $default) : $_GET;
    }
    
    public function getIntGet($name='', $default=null){
        return  isset($_GET[$name]) ? intval($_GET[$name]) : intval($default);
    }
    
    public function setGet($name,$value){
        return $name && $_GET[$name]=$value;
    }

    public function getPostInt(){
        
    }
    
    public function requestUri(){
		return $_SERVER["REQUEST_URI"];
    }
    
    
    public function getSubDomain(){
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
	public function refererUrl(){
		return isset( $_SERVER["HTTP_REFERER"] ) ? $_SERVER["HTTP_REFERER"] : '';
	}

	/**
	 * 返回当前页面的 URL 地址
	 */
	public function currentUrl(){
		$http = ( isset($_SERVER["HTTPS"] ) && $_SERVER["HTTPS"]!="off") ? 'https' : 'http';
		$http .= '://';
		$prot = $_SERVER["SERVER_PORT"]!='80' ? ':'.$_SERVER["SERVER_PORT"] : '';
		return $http.$_SERVER["SERVER_NAME"].$prot.$_SERVER["REQUEST_URI"];
	}
    
    
    public function getClientIp(){
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
