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
    protected $_config;
    public $data;
    public $autoLayout = true;
    public $_autoloalmodel = true;
    const MODEL_SUFFIX = 'Model';
    const CONTRONLLER_SUFFIX = 'Controller';

    public function __construct() {
        $controller = get_class($this);
        $controller = str_replace( self::CONTRONLLER_SUFFIX , '', $controller);
        $controller = str_replace( 'controller' , '', $controller);
        $this->_controller = $controller;
        $this->request = Q_Request::getInstance();
        $this->response = Q_Response::getInstance();
        $this->_config = Q::getConfig();
        if($this->_autoloalmodel){
            self::loadModel($this->_controller);
        }
        
    }
    
    /**
     * 是否自动加载模型
     */
    public function setAutoLoadModel($flag){
        $this->_autoloalmodel = $flag;
    }


    public function init(){
        
    }
    
    public function autoLoadModel($model){
        if(file_exists($model)){
            self::loadModel($model);
        }
    }
    
    
    /**
     * 导入模型文件
     */
    public function loadModel($name){
        Q::loadModel($name);
    }
    
    
    /**
     * 加载视图层
     */
    public function render($file='', $data = array()){
        if( empty($file) ){
            $file = $this->_action;
        }
        if(!empty($data)){
            extract($data);
        }elseif(!empty($this->data)){
            extract($this->data);
        }
        $file = View::getInstance($this->_controller)->render($file);
        ob_start();
        //$layout = new Q_Layout();
        if( !is_file($file)){
            echo 'no '. $file;exit;
        }
        if(!$this->_config['compile_template']){
            require( $file );
            echo ob_get_clean();
        }else{
            $content = file_get_contents($file);
            $cachefile = $this->templateCompile( $content );
            require ($cachefile);
        }
    }
    
    /**
     * 分配视图变量
     */
    public function assign($key, $value=''){
        if(is_array($key)){
            if (!empty($this->data)){
                $this->data = array_merge($this->data, $key);
            }else{
                $this->data = $key;
            }
        }else{
            $this->data[$key] = $value;
        }
    }
    
    
    public function showMessage(){
        
    }
    
    public function show_404(){
        $this->render('Common.404');
    }
    
    public function show_success( $msg='操作成功', $url=''){
        $this->data['url'] = $url;
        $this->data['msg'] = $msg;
        $this->render('Common.Success');
        return;
        sleep(3);
        if(!empty($url)){
            Response::redirect($url);
        }
    }
    
    public function show_error($msg='Error, 页面跳转中', $url='/'){
        $this->data['url'] = $url;
        $this->data['msg'] = $msg;
        $this->render('Common.Error');
        return;
        sleep(3);
        if(!empty($url)){
            Response::redirect($url);
        }
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


