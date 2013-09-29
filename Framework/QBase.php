<?php
/**
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */

if( !defined('FRAMEWORK_PATH')){
    define('FRAMEWORK_PATH', './Framework');
}

if( !defined('APP_PATH')){
    define('APP_PATH', './');
}

//载入系统类库
require ( FRAMEWORK_PATH . '/Common/Function.php');
require ( FRAMEWORK_PATH . '/Common/Config.php');
require ( FRAMEWORK_PATH . '/Core/Request.php');
require ( FRAMEWORK_PATH . '/Core/Response.php');
require ( FRAMEWORK_PATH . '/Core/Exception.php');
require ( FRAMEWORK_PATH . '/Core/View.php');
require ( FRAMEWORK_PATH . '/Core/Model.php');
require ( FRAMEWORK_PATH . '/Core/Log.php');
require ( FRAMEWORK_PATH . '/Core/Memory.php');
require ( FRAMEWORK_PATH . '/Core/Registry.php');
require ( FRAMEWORK_PATH . '/Core/Error.php');
require ( FRAMEWORK_PATH . '/Core/Lang.php');
//加载需要自动装载的类库

/*
$_autoload = Q::getConfig('autoload');
if( !empty($_autoload)){
    foreach ($_autoload as $k => $v){
        if(file_exists( APP_PATH . 'Library/'.$v)){
            require_once( APP_PATH . 'Library/'.$v .'.php');
        }elseif( file_exists( FRAMEWORK_PATH . 'Library/'.$v) ){
            require_once( FRAMEWORK_PATH . 'Library/'.$v .'.php');
        }
    }
}
*/




class QBase {
    
    const VERSION='1.0';
    
    /**
     * 创建应用
     */
    public static function createApplication(){
        return new Application();
    }
    
    /**
     * 导入类库文件
     */
    public static function import($pathname){
        if(strpos($pathname, '.php') === false){
            $pathname .= '.php';    
        }
        if(file_exists( APP_PATH . $pathname)){
            require_once ( APP_PATH . $pathname);
        }elseif( file_exists( FRAMEWORK_PATH . $pathname) ){
            require_once ( FRAMEWORK_PATH . $pathname);
        }
    }
    
    
    /**
     * 获取配置信息
     */
    public static function getConfig($key=''){
        $_config = include( FRAMEWORK_PATH . '/Common/Config.php');
        if(file_exists( APP_PATH . '/Common/Config.php' )){
           $config = include( APP_PATH . '/Common/Config.php'); 
        }else{
            $config = array();
        }
        $config = array_merge( $_config, $config);
        unset($_config);
        return $key ? (isset($config[$key]) ? $config[$key] : 'index' ) : $config;
    }
    
    /**
     * 获取include的文件
     */
    public static function getIncludeFiles(){
        return get_included_files();
    }
    
    
    /**
     * 获取include目录
     */
    public static function getIncludePath(){
        return get_include_path();
    }


    /**
     * 格式输出
     */
    public static function printf($input, $exit=0){
        echo '<pre>';
        print_r($input);
        echo '</pre>';
        if( $exit)
            exit;
    }
    
    /**
     * 获取浏览器信息
     */
    public static function getBrowser($user_agent=null, $return_array=true){
		return get_browser($user_agent,$return_array);
	}
	
	/**
	 * 获取服务器响应一个 HTTP 请求所发送的所有标头
	 * */
	public static function getHeaders($url, $fromat=''){
		return get_headers($url);
	}
	
    /**
     * 获取服务器响应所有请求所发送的标头
     */
    public static function getAllHeaders(){
		return getallheaders();
	}
    
    /**
     * 获取HTTP 响应头， 同get_headers();
     */
    public static function getResonse(){
        return $http_response_header;
    }
   
    /**
     * 获取上一个错误信息
     */
    public static function error(){
        return $php_errormsg;
    }
     
    /**
     * 是否是搜索引擎访问
     */
    public static function isSearchEngine(){
        $isSearchEngine=preg_match("/(Googlebot|Msnbot|YodaoBot|Sosospider|baiduspider|google|baidu|yahoo|sogou|bing|coodir|soso|youdao|zhongsou|slurp|ia_archiver|scooter|spider|webcrawler|OutfoxBot|360)/i", $_SERVER['HTTP_USER_AGENT']);
        return $isSearchEngine;
    }
}

?>
