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
    public $controller;
    public $ext = '.php';
    public $viewBasePath;
    
    public function __construct($controller='') {
        $this->controller = $controller;
    }

    public static function getInstance($controller){
        if( null === self::$instance){
            self::$instance = new self($controller);
        }
        return self::$instance;
    }
    
    public function render($file=''){
        if(empty($file)){ $file = 'Index';}
        if( false !== strpos($file, '.')){
            list($controller, $file) = explode('.', $file);
            $this->controller = $controller;
            $file = str_replace('.', '/', $file);
        }
        $this->viewBasePath = $this->getPath($this->controller);
        return $this->viewBasePath . '/' . ucfirst( $file ) . $this->ext;
    }
    
    public function getPath($controller){
        $config = Q::getConfig();
        if($config['hmvc']){
            $filename = APP_PATH . Q::checkPath( $config['hmvc_dir'] ) .$controller . '/Views' ;
        }else{
            $filename =  APP_PATH .'/Views/'.$controller;
        }
        return $filename;
    }
    
    /**
     * 设置视图层目录
     */
    public function setPath($controller){
        $this->viewBasePath = APP_PATH.'/Views/'.$controller;
    }
}


