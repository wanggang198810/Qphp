<?php
/**
 * 
 * Q PHP FRAMEWORK, A  Newcomer's Framework.
 * 
 * @author Air
 */
class Response {
    //put your code here
    public static $instance;
    public $_params;
    
    public static function getInstance(){
        if( null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    
    public static function redirect($url){
        header("Location:".$url);
    }
}

?>
