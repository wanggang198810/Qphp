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
        //清空缓存区，禁止之前的内容输出;
        //ob_clean();
        //得到缓冲区内容，并删除.
        //$content = ob_get_clean();
        //$content = $controller->render();
        //$this->output( $content );
        
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
            $this->_trace('UageMemory', ($this->_debugInfo['endMemory'] - $this->_debugInfo['beginMemory']) / 1024 );
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
       
        if( !file_exists( APP_PATH . '/Controller/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php' )){
            $controllerfile =  APP_PATH . '/Controller/' . $this->_controller.'/'.$this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }else{
            $controllerfile =  APP_PATH . '/Controller/' . $this->_controller . self::CONTROLLER_SUFFIX . '.php';
        }
        if(file_exists($controllerfile)){
            require( $controllerfile );
        }
        if( ! class_exists($this->_controller. self::CONTROLLER_SUFFIX)){
            echo ' NOT FOUND THE '.$this->_controller.' CONTROLLER FILE';
        }
        $className = $this->_controller.self::CONTROLLER_SUFFIX;
        $controller = new $className($this->_controller) ;
        
        //打开缓存区
        ob_start();
        $controller->init();
        $controller->_controller = $this->_controller;
        $action = $controller->_action = $this->_action;
        if( !method_exists($controller, $action) ){
            if($this->_config['debug']){
                throw new Q_Exception('控制器:'.get_class($controller).' 中未定义动作:'.$action );
            }else{
//                $this->_response->redirect('/');
                $this->show_404();
                return;
            }
        }
        //执行操作
        //$controller->$action();
        
        call_user_func_array( array( $controller, $this->_action), $router['param'] );
    }
    
    
    private function _trace($name, $value){
        if($this->_config['debug']){
            $this->_debugInfo[$name] = $value;
        }
    }
    
    /**
     * @deprecated 废弃
     */
    public function output($html){
        if($this->_config['compile_template']){
            echo $this->template($html);
        }else{
            echo $html;
        }
    }
    
    /**
     * @deprecated 废弃
     */
    public function template($html){
        require ( FRAMEWORK_PATH . '/Core/Template.php');
        $template = new Template();
        return $template->compile($html);
    }
    
    
    public function show_404(){
        echo '<center><h1>404</h1></center>';
    }
}

?>
