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
    
    public function getError($type){
        switch ($type){
            case 1000:
                return Q_Lang::$systemError['1000'];
                break;
            case 1001:
                return Q_Lang::$systemError['1001'];
                break;
            default:
                return Q_Lang::$systemError['1111'];;
                break;
        }
    }
    
    
    
    
}

?>
