<?php
/**
 * 
 * Q PHP FRAMEWORK, A  Newcomer's Framework.
 * 
 * @author Air
 */
class View {
    
    public static $instance;
    
    public $_params;
    
    public $ext = '.php';
    public $viewBasePath;
    
    public function __construct($controller) {
        $this->viewBasePath = $this->getViewPath($controller);
    }

    public static function getInstance($controller){
        if( null === self::$instance){
            self::$instance = new self($controller);
        }
        return self::$instance;
    }
    
    function render($file){
        
        return $this->viewBasePath . '/' . ucfirst( $file ) . $this->ext;
    }
    
    function getViewPath($controller){
        return APP_PATH.'/View/'.$controller;
    }
}

?>
