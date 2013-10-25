<?php
/**
 * 
 * Q PHP FRAMEWORK, A  Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Exception extends Exception{
    //put your code here
    
    public function __construct($message, $code=0, $previous=null) {
        //parent::__construct($message, $code);
    }
    
    
    public function showError(){
        
    }
}

?>
