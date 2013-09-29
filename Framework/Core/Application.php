<?php

/**
 * Description of Core
 *
 * @author Administrator
 */
class Application {
    //put your code here
    
    private $_controller;
    private $_action;
    private $_debugInfo;
    private $_request;
    private $_config;
    const CONTROLLER_SUFFIX = 'Controller'; //控制器类名统一后缀

    

    public function __construct() {
        $this->_request = Q_Request::getInstance();
        $this->_response = Q_Response::getInstance();
        $this->_config = Q::getConfig();
        if($this->_config['debug']){
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            set_error_handler('q_error_handler');//自定义错误
        }else{
            error_reporting(0);
        }
    }
    
    
    public function go(){
        $this->_trace('beginTime',  microtime(true));
        $this->_trace('beginMemory', Q_Memory::getInstance()->get());
        header("Content-type:text/html;charset=".$this->_config['charset']);
        $controller = $this->_getController();
   
        //记录日志
        //record log
        if($this->_config['record_log']){
            Q_Log::log();
        }

        $this->_trace('endTime',  microtime(true));
        if($this->_config['debug']){
            $this->_trace('currentUrl', $this->_request->currentUrl());
            $this->_trace('refererUrl', $this->_request->refererUrl());
            $this->_trace('controller', ucfirst( $this->_controller ) );
            $this->_trace('action',ucfirst( $this->_action ) );
            $this->_trace('get', $this->_request->getGet() );
            $this->_trace('post', $this->_request->getPost() );
            $this->_trace('runTime', ($this->_debugInfo['endTime'] - $this->_debugInfo['beginTime']) );
            $this->_trace('endMemory', Q_Memory::getInstance()->get());
            $this->_trace('uageMemory', ($this->_debugInfo['endMemory'] - $this->_debugInfo['beginMemory']) / 1024 );
            $this->_trace('includeFile', Q::getIncludeFiles() );
            $this->_trace('header', Q::getAllHeaders() );
            $this->_trace('response', Q::getResonse() );
            require ( FRAMEWORK_PATH . '/Core/Debug.php');
            Q_Debug::output($this->_debugInfo);
        }
    }
    
    
    private function _getController(){
        //get controller
        if($this->_config['url_mode'] == 1){
            include(FRAMEWORK_PATH.'/Core/Router.php');
            $router = Router::parseUri();
            $this->_controller = $router['controller'];
            $this->_action = $router['action'];
        }elseif($this->_config['url_mode'] == 0){
            $subdomain = $this->_request->getSubDomain();
            if( !empty($subdomain) && in_array( $subdomain['0'] , array_keys(Q::getConfig('subdomain') )) ){
                $this->_controller = $subdomain['0'];
            }else{
                $this->_controller = $this->_request->getGet( $this->_config['controller_url_var'], $this->_config['default_controller']);
            }
            $this->_action = $this->_request->getGet( $this->_config['action_url_var'], $this->_config['default_action'] );
            $this->_controller = ucfirst( $this->_controller );
            $router['param']=array();
            //注意此模式下，目录形式链接将失效 (www.xxx.com/home/index => ?m=home&a=index)
            //in this mode, the url like path doesn't work (www.xxx.com/home/index => ?m=home&a=index)
        }
        
        //载入当前控制器文件
        //load current controller file
        if( !file_exists( APP_PATH . '/Controller/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php' )){
            $controllerfile =  APP_PATH . '/Controller/' . $this->_controller.'/'.$this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }else{
            $controllerfile =  APP_PATH . '/Controller/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }
        if(file_exists($controllerfile)){
            require( $controllerfile );
        }
        
        //debuginfo
        if( ! class_exists($this->_controller. self::CONTROLLER_SUFFIX)){
            Q_Log::set( Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller );
            if($this->_config['record_log']){
                Q_Log::log();
            }
            if($this->_config['debug']){
                throw new Q_Exception( Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller );
            }else{
                $this->show_404();
                return;
            }
        }
        $className = $this->_controller.self::CONTROLLER_SUFFIX;
        $controller = new $className($this->_controller) ;
        
        //初始化controller
        $controller->init();
        $controller->_controller = $this->_controller;
        $action = $controller->_action = $this->_action;
        if( !method_exists($controller, $action) ){
            Q_Log::set( Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$action );
            if($this->_config['record_log']){
                Q_Log::log();
            }
            if($this->_config['debug']){
                throw new Q_Exception( Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$action );
            }else{
                $this->show_404();
                return;
            }
        }
        //执行操作
        //$controller->$action();
        call_user_func_array( array( $controller, $this->_action), $router['param'] );
    }
    
    
    /**
     * 获取debug信息
     */
    public function getDebugInfo(){
        if($this->_config['debug']){
            $this->_trace('currentUrl', $this->_request->currentUrl());
            $this->_trace('refererUrl', $this->_request->refererUrl());
            $this->_trace('controller', ucfirst( $this->_controller ) );
            $this->_trace('action',ucfirst( $this->_action ) );
            $this->_trace('get', $this->_request->getGet() );
            $this->_trace('post', $this->_request->getPost() );
            $this->_trace('runTime', ($this->_debugInfo['endTime'] - $this->_debugInfo['beginTime']) );
            $this->_trace('endMemory', Q_Memory::getInstance()->get());
            $this->_trace('UageMemory', ($this->_debugInfo['endMemory'] - $this->_debugInfo['beginMemory']) / 1024 );
            require ( FRAMEWORK_PATH . '/Core/Debug.php');
            Q_Debug::output($this->_debugInfo);
        }
    }


    protected function _trace($name, $value){
        if($this->_config['debug']){
            $this->_debugInfo[$name] = $value;
        }
    }
        
    
    public function show_404(){
        echo '<center><h1>404</h1></center>';
    }
}

?>
