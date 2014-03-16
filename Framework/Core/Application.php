<?php

/**
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Application {
    
    private $_controller;
    private $_action;
    private $_debugInfo;
    private $_request;
    private $_config;
    const CONTROLLER_SUFFIX = 'Controller'; //控制器类名统一后缀

    

    public function __construct() {
        //初始化http请求与响应
        $this->_request = Q_Request::getInstance();
        $this->_response = Q_Response::getInstance();
        //初始化系统配置项
        $this->_config = Q::getConfig();
        date_default_timezone_set( $this->_config['timezone']);
        //设置系统错误级别
        if($this->_config['debug']){
            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        }else{
            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
            set_error_handler('q_error_handler');//自定义错误
        }
    }
    
    
    public function run(){
        $this->_trace('beginTime', microtime(true));
        $this->_trace('beginMemory', Q_Memory::getInstance()->get());
        
        $this->_setSystemHeader();
        $this->_getController2();
   
        //记录日志
        //record log
        if($this->_config['record_log']){
            Q_Log::log();
        }

        //构建debug信息
        if($this->_config['debug']){
            $this->_trace('endTime',  microtime(true));
            $this->_setDebugInfo();
        }
    }
    
    
    
    private function _getController2(){
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
        if( file_exists( APP_PATH . Q::checkPath( $this->_config['hmvc_dir'] ) . $this->_controller .'/' . $this->_action . '/Controllers/' . $this->_action . self::CONTROLLER_SUFFIX . '.php' )){
            $controllerfile =  APP_PATH . Q::checkPath( $this->_config['hmvc_dir'] ) . $this->_controller  .'/'. $this->_action . '/Controllers/' . $this->_action . self::CONTROLLER_SUFFIX . '.php';
            $this->_controller = $this->_action;
            $this->_action = array_shift($router['param']);
        }elseif( file_exists( APP_PATH . Q::checkPath( $this->_config['hmvc_dir'] ) . $this->_controller .'/Controllers/' . $this->_controller .'/'.$this->_controller . self::CONTROLLER_SUFFIX . '.php' )){
            $controllerfile =  APP_PATH . Q::checkPath( $this->_config['hmvc_dir'] ) . $this->_controller . '/Controllers/' . $this->_controller.'/'.$this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }else{
            $controllerfile =  APP_PATH . Q::checkPath( $this->_config['hmvc_dir'] ) . $this->_controller . '/Controllers/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }
        if(file_exists($controllerfile)){
            require( $controllerfile );
        }
        //debuginfo
        if( ! class_exists($this->_controller. self::CONTROLLER_SUFFIX)){
            if($this->_config['record_log']){
                Q_Log::set( Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller );
                Q_Log::log();
            }
            if($this->_config['debug']){
                if($this->_config['error_mode']==1){
                    Q_Error::show(Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller);
                }else{
                    throw new Q_Exception( Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller );
                }
                return;
            }else{
                $this->show_404();
                return;
            }
        }
        $className = $this->_controller.self::CONTROLLER_SUFFIX;
        $controller = new $className() ;
        
        //初始化controller
        $controller->init();
        //$controller->_controller = $this->_controller;
        //$controller->_action = $action = $this->_action;
        $action = $this->_action;
        if( !method_exists($controller, $this->_action) ){
            $this->_action = $this->_config['default_action'];
            $router['param'] = array_merge( array($action), $router['param']);
        }

        if( !method_exists($controller, $this->_action) ){
            if($this->_config['record_log']){
                Q_Log::set( Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$this->_action );
                Q_Log::log();
            }
            if($this->_config['debug']){
                if($this->_config['error_mode']==1){
                    Q_Error::show(Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$this->_action);
                }else{
                    throw new Q_Exception( Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$this->_action );
                }
                return;
            }else{
                $this->show_404();
                return;
            }
        }
        //执行操作
        //$controller->$action();
        call_user_func_array( array( $controller, $this->_action), $router['param'] );
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
        if( !file_exists( APP_PATH . '/Controllers/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php' )){
            $controllerfile =  APP_PATH . '/Controllers/' . $this->_controller.'/'.$this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }else{
            $controllerfile =  APP_PATH . '/Controllers/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }
        if(file_exists($controllerfile)){
            require( $controllerfile );
        }
        
        //debuginfo
        if( ! class_exists($this->_controller. self::CONTROLLER_SUFFIX)){
            if($this->_config['record_log']){
                Q_Log::set( Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller );
                Q_Log::log();
            }
            if($this->_config['debug']){
                if($this->_config['error_mode']==1){
                    Q_Error::show(Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller);
                }else{
                    throw new Q_Exception( Q_Error::getError( Q_Error::$errorType['nocontroller'] ).': '.$this->_controller );
                }
                return;
            }else{
                $this->show_404();
                return;
            }
        }
        $className = $this->_controller.self::CONTROLLER_SUFFIX;
        $controller = new $className() ;
        
        //初始化controller
        $controller->init();
        $controller->_controller = $this->_controller;
        $controller->_action = $this->_action;
        
        if( !method_exists($controller, $this->_action) ){
            if($this->_config['record_log']){
                Q_Log::set( Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$this->_action );
                Q_Log::log();
            }
            if($this->_config['debug']){
                if($this->_config['error_mode']==1){
                    Q_Error::show(Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$this->_action);
                }else{
                    throw new Q_Exception( Q_Error::getError( Q_Error::$errorType['noaction'] ).': '.$this->_action );
                }
                return;
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
     * 构建debug信息
     */
    private function _setDebugInfo(){
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

    /**
     * 设置系统默认HTTP头
     */
    private function _setSystemHeader(){
        header("Content-type:text/html; charset=".$this->_config['charset']);
        //header("Transfer-Encoding: chunked");
        //header("Content-Encoding:gzip");
        //header('Server: Apache');
        header('X-Powered-By: Qphp ' .Q::VERSION);
    }

    private function _trace($name, $value){
        if($this->_config['debug']){
            $this->_debugInfo[$name] = $value;
        }
    }
        
    
    public function show_404(){
        echo '<center><h1>404</h1></center>';
    }
}


