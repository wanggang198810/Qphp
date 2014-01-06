<?php
/**
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */

global $_Sys;
$_Sys['beginTime'] = microtime(true);

if( !defined('FRAMEWORK_PATH')){
    define('FRAMEWORK_PATH', './Framework');
}

if( !defined('APP_PATH')){
    define('APP_PATH', './');
}

if(is_file(APP_PATH . '/Common/Function.php')){
    require ( APP_PATH . '/Common/Function.php');
}

//载入系统类库
require ( FRAMEWORK_PATH . '/Common/Function.php');
require ( FRAMEWORK_PATH . '/Common/Config.php');
require ( FRAMEWORK_PATH . '/Core/Request.php');
require ( FRAMEWORK_PATH . '/Core/Response.php');
require ( FRAMEWORK_PATH . '/Core/Exception.php');
require ( FRAMEWORK_PATH . '/Core/View.php');
require ( FRAMEWORK_PATH . '/Core/Model.php');
require ( FRAMEWORK_PATH . '/Core/Layout.php');
require ( FRAMEWORK_PATH . '/Core/Log.php');
require ( FRAMEWORK_PATH . '/Core/Memory.php');
require ( FRAMEWORK_PATH . '/Core/Registry.php');
require ( FRAMEWORK_PATH . '/Core/Error.php');
require ( FRAMEWORK_PATH . '/Core/Lang.php');


//加载需要自动装载的类库
$autoload = QBase::getConfig('autoload');
if( !empty($autoload)){
    foreach ($autoload as $k => $v){
        $v = ucfirst($v);
        if(file_exists( APP_PATH . 'Libraries/'.$v .'.php')){
            require_once( APP_PATH . 'Libraries/'.$v .'.php');
        }elseif( file_exists( FRAMEWORK_PATH . 'Libraries/'.$v) ){
            require_once( FRAMEWORK_PATH . 'Libraries/'.$v .'.php');
        }
    }
}





class QBase {
    
    const VERSION='1.0';
    static $config_data;
    
    /**
     * 创建应用
     */
    public static function createApplication(){
        return new Application();
    }
    
    /**
     * 导入类库文件
     */
    public static function import($filename, $modules=''){
        $type = 'Libraries/';
        
        $config = self::getConfig();
        if( false !== strpos($filename, '.')){
            list($type, $filename) = explode('.', $filename);
            $type = self::checkPath( ucfirst($type));
        }
        
        $filename = ucfirst($filename);
        if(strpos($filename, '.php') === false){
            $filename .= '.php';
        }
        
        if($config['hmvc'] && false === strpos($type, 'Libraries')){
            $filepath = APP_PATH . self::checkPath( $config['hmvc_dir'] ) .self::checkPath( $modules ) . $type . $filename ;
        }else{
            $filepath = APP_PATH . $type . $filename;
        }
        
        if( file_exists( $filepath ) ){
            require_once ( $filepath );
        }elseif( file_exists( FRAMEWORK_PATH . $type . $filename) ){
            require_once ( FRAMEWORK_PATH . $type . $filename);
        }
    }
    
    
    /**
     * 获取配置信息
     */
    public static function getConfig($key=''){
        if(isset(self::$config_data)){
            if(isset(self::$config_data[$key])){
                return self::$config_data[$key];
            }
            return self::$config_data;
        }
        $_config = require( FRAMEWORK_PATH . '/Common/Config.php');
        if(file_exists( APP_PATH . '/Common/Config.php' )){
           $config = require( APP_PATH . '/Common/Config.php'); 
        }else{
            $config = array();
        }
        if(!isset($config)){
            $config = array();
        }
        $config = array_merge( $_config, $config);
        unset($_config);
        self::$config_data = $config;
        return $key ? (isset($config[$key]) ? $config[$key] : 'index' ) : $config;
    }
    
    
    /**
     * 导入模型文件
     */
    public static function loadModel($name){
        $module = $name . '/';
        if( false !== strpos($name, '.')){
            list($module, $name) = explode('.', $name);
            $module = self::checkPath( ucfirst($module));
        }
        $module = ucfirst($module);
        $name = ucfirst($name);
        if(strpos($name, 'Model.php') === false){
            $name .= 'Model.php';    
        }
        $config = self::getConfig();
        if($config['hmvc']){
            $filename = APP_PATH . Q::checkPath( $config['hmvc_dir'] ) .$module . 'Models/'. $name ;
        }else{
            $filename =  APP_PATH .'/Models/'.$module .$name;
        }
        if(file_exists($filename)){
            require_once ($filename);
        }
        return true;
    }
    
    
    /**
     * 检测路径，结尾一律以 / 结尾
     */
    public static function checkPath($path){
        if(empty($path)) return '';
        return '/' !== substr($path, -1) ? $path.'/' : $path;
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


