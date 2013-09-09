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

    public function __construct($controller) {
        $this->_controller = $controller;
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
        extract($data);
        $file = View::getInstance($this->_controller)->render($file);
        ob_start();
        include $file;
        $this->output( ob_get_clean() );
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
        return $template->compile($html);
    }
}

?>
