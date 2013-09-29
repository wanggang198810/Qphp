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
    
    public function __construct($controller='') {
        $this->viewBasePath = $this->getViewPath($controller);
    }

    public static function getInstance($controller){
        if( null === self::$instance){
            self::$instance = new self($controller);
        }
        return self::$instance;
    }
    
    public function render($file){
        
        return $this->viewBasePath . '/' . ucfirst( $file ) . $this->ext;
    }
    
    public function getViewPath($controller){
        return APP_PATH.'/Views/'.$controller;
    }
    
    /**
     * 设置视图层目录
     */
    public function setPath($controller){
        $this->viewBasePath = APP_PATH.'/Views/'.$controller;
    }
}

?>
