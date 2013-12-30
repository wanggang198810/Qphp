<?php


function filter($str){
    return htmlspecialchars( trim($str));
}


function load_js($filename){
    if(false === strpos($filename, '.js')){
        $filename .= '.js';
    }
    
    echo '<script src="'.$filename.'"></script>';
}

function load_css($filename){
    if(false === strpos($filename, '.css')){
        $filename .= '.css';
    }
    echo '<link href="/Public/css/'.$filename.'" rel="stylesheet" type="text/css">';
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