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
?>
