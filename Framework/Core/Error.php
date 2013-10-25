<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Error {
    
    //系统级别错误
    public static $errorType = array(
        'nocontroller' => 1000, //不存在控制器
        'noaction' => 1001, //不存在操作方法
        'unknown' => 1111, //未知错误
    );
    
    public static $error;
    
    public static $instance;
    
    public static function getInstance($controller){
        if( null === self::$instance){
            self::$instance = new self($controller);
        }
        return self::$instance;
    }
    
    public static function getError($type){
        switch ($type){
            case 1000:
                return Q_Lang::$systemError['1000'];
                break;
            case 1001:
                return Q_Lang::$systemError['1001'];
                break;
            default:
                return Q_Lang::$systemError['1111'];
                break;
        }
    }
    
    public static function show($msg){
        echo '<div style="text-align:center; font-size:30px; color:#666; padding-top:40px; font-family:微软雅黑;">'.$msg.'</div>';
        //exit;
    }
    
    
}

?>
