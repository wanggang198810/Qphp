<?php
/**
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */

if( !defined('FRAMEWORK_PATH')){
    define('FRAMEWORK_PATH', './Framework/');
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
    //put your code here
    
    

    public static function createApplication(){
        return new Application();
    }
    
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
    
    public static function getConfig($key=''){
        $_config = include( FRAMEWORK_PATH . '/Common/Config.php');
        if(file_exists( APP_PATH . '/Common/Config.php' )){
           $config = include( APP_PATH . '/Common/Config.php'); 
        }else{
            $config = array();
        }
        $config = array_merge( $_config, $config);
        return $key ? (isset($config[$key]) ? $config[$key] : 'index' ) : $config;
    }
    
}

?>
