<?php
/**
 * 
 * Q PHP FRAMEWORK, A  Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Response {
    //put your code here
    public static $instance;
    public $_params;
    
    public static function getInstance(){
        if( null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    
    public function redirect($url){
        header("Location:".$url);
    }
}

?>
