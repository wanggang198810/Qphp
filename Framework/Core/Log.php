<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Log {
    //put your code here
    public static function log(){
        $logFile = self::_getLogFileName();
        $log = Q_Registry::getInstance()->get('access');
        if( empty($log)){
            $log = sprintf("[%s][SUCCESS] Url %s",date("Y-m-d H:i:s"),  Q_Request::getInstance()->currentUrl() );
        }
        $fp = @fopen($logFile, "ab+");
        @fwrite($fp, $log."\r\n");
    }
    
    
    /**
     * 检查是否开启了记录日志,(调用前还必须判断段是否在debug模式下)
     * check if record log
     */
    public static function checkLog(){
        if( Q::getConfig('recorde_log') ){
            return true;
        }
        return false;
    }
    
    /**
     * 获取log文件名字，（原则上一天生产一个log文件
     * get log file name
     */
    private static function _getLogFileName(){
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $logPath = self::_getPath();
        if( !file_exists( $logPath.$year) ){
            @mkdir( $logPath.$year );
        }
        if( !file_exists( $logPath.$year.'/'.$month ) ){
            @mkdir( $logPath.$year.'/'.$month );
        }
        if ( !file_exists ( $logPath.$year.'/'.$month.'/'.$day.'.log' ) ){
            fopen( $logPath.$year.'/'.$month.'/'.$day.'.log', 'w+');
        }
        return $logPath.$year.'/'.$month.'/'.$day.'.log';
    }
    
    /**
     * 获取log路径
     * get log file path
     */
    private static function _getPath(){
        return FRAMEWORK_PATH .'/Data/Log/';
    }
    
    
    
}



   





?>
