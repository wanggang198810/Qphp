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
    private $_autoloalmodel = true;
    const MODEL_SUFFIX = 'Model';
    const CONTRONLLER_SUFFIX = 'Controller';

    public function __construct() {
        $controller = get_class($this);
        $this->_controller = str_replace(self::CONTRONLLER_SUFFIX,'', $controller);
        $this->_request = Q_Request::getInstance();
        $this->_response = Q_Response::getInstance();
        $this->_config = Q::getConfig();
        $this->autoLoadModel( APP_PATH.'/Models/'.$this->_controller .self::MODEL_SUFFIX . '.php');
        
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
        if($this->_autoloalmodel){
            if(file_exists($model)){
                require ($model);
            }
        }
    }
    
    
    /**
     * 导入模型文件
     */
    public static function loadModel($name){
        if(strpos($name, '.php') === false){
            $name .= self::MODEL_SUFFIX.'.php';    
        }
        if(false === strpos($name,'/')){
            $filename = APP_PATH .'Application/Models/'.$name;
        }else{
            $path = '';
            $pathArr =  explode('/', $name);
            array_pop($pathArr);
            foreach ($pathArr as $k => $v){
                $path .= $v.'/';
            }
            $filename = APP_PATH .'Application/Models/'.$path .$name;
        }
        if(file_exists($filename)){
            include($filename);
        }
    }
    
    
    /**
     * 加载视图层
     */
    public function render($file=''){
        if( empty($file) ){
            $file = $this->_action;
        }
        if(!empty($this->data)){
            extract($this->data);
        }
        $file = View::getInstance($this->_controller)->render($file);
        ob_start();
        $layout = new Q_Layout();
        
        
        if(!$this->_config['compile_template']){
            include $file;
            echo ob_get_clean();
        }else{
            $content = file_get_contents($file);
            $cachefile = $this->templateCompile( $content );
            include($cachefile);
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
