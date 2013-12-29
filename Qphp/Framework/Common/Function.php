<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//获取config配置
if( !function_exists('get_config')){
    function get_config($key=''){
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
/**
 * 载入文件
 */
if( !function_exists('import')){
    function import($pathname){
        if(strpos($pathname, '.php') === false){
            $pathname .= '.php';    
        }
        if(file_exists( APP_PATH . $pathname)){
            require_once ( APP_PATH . $pathname);
        }elseif( file_exists( FRAMEWORK_PATH . $pathname) ){
            require_once ( FRAMEWORK_PATH . $pathname);
        }
    }
}

//打印
if(!function_exists('hprint')){
    function hprint($input, $exit=0){
        echo '<pre>';
        print_r($input);
        echo '</pre>';
        if( $exit)
            exit;
    }
}

if(!function_exists('view_test')){
    function view_test($a='', $b='', $c=''){
        echo $a.' : '.$b ." : ". $c;
    }
}

//跟踪程序错误信息
if(!function_exists('q_error_handler')){
    function q_error_handler($error, $error_string, $filename, $line, $symbols){
         $error_no_arr = array(1=>'ERROR', 2=>'WARNING', 4=>'PARSE', 8=>'NOTICE', 16=>'CORE_ERROR', 32=>'CORE_WARNING', 64=>'COMPILE_ERROR', 128=>'COMPILE_WARNING', 256=>'USER_ERROR', 512=>'USER_WARNING', 1024=>'USER_NOTICE', 2047=>'ALL', 2048=>'STRICT');
        
        if(in_array($error,array_keys($error_no_arr) )){
            $time = date("Y-m-d H:i:s");
            $msg = sprintf("[%s][%s] Url %s %s at file %s(%s)",$time, $error_no_arr[$error], Q_Request::getInstance()->currentUrl() ,$error_string, $filename, $line);
            Q_Registry::getInstance()->set('access',$msg);
        }
    }
}
?>
