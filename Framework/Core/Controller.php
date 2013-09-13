<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Air
 */
class Controller {
    //put your code here
    
    public $_action;
    public $_controller;
    public $request;
    public $response;
    public $_config;
    private $_autoloalmodel = true;
    const MODEL_SUFFIX = 'Model';
    const CONTRONLLER_SUFFIX = 'Controller';

    public function __construct() {
        $controller = get_class($this);
        $this->_controller = str_replace(self::CONTRONLLER_SUFFIX,'', $controller);
        $this->_request = Q_Request::getInstance();
        $this->_response = Q_Response::getInstance();
        $this->_config = get_config();
        $this->autoLoadModel( APP_PATH.'/Model/'.$this->_controller .self::MODEL_SUFFIX . '.php');
        
    }
    
    public function setAutoLoadModel($flag ){
        $this->_autoloalmodel = $flag;
    }


    public function init(){
        
    }
    
    public function autoLoadModel($model){
        if($this->_autoloalmodel){
            if(file_exists($model)){
                require ($model);
            }
        }
    }
    
    /**
     * 
     */
    public function render($file='', $data=array()){
        if( empty($file) ){
            $file = $this->_action;
        }
        if(!empty($data)){
            extract($data);
        }
        $file = View::getInstance($this->_controller)->render($file);
        ob_start();
        
        if(!$this->_config['compile_template']){
            include $file;
            echo ob_get_clean();
        }else{
            $content = file_get_contents($file);
            $cachefile = $this->templateCompile( $content );
            include($cachefile);
        }
    }
    
    
    public function showMessage(){
        
    }
    
    public function show_404(){
        echo '<center><h1>404</h1></center>';
    }
    
    public function output($html){
        if($this->_config['compile_template']){
            echo $this->templateCompile($html);
        }else{
            echo $html;
        }
    }
    
    public function templateCompile($html){
        require ( FRAMEWORK_PATH . '/Core/Template.php');
        $template = new Template();
        $template->templateID = $this->_controller.  $this->_action;
        $tmpfile = $template->compile($html);
        return $tmpfile;
    }
}

?>
