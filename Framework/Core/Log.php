<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Log {
    
    const LOG_PATH = 'Data/Log/';

    //put your code here
    public static function log(){
        global $_Sys;
        if(! self::checkLog()){
            return false;
        }
        $logFile = self::_getLogFileName();
        $log = Q_Registry::getInstance()->get('access');
        $endTime = microtime(true);
        if( empty($log)){
            $log = sprintf("[%s][SUCCESS][Time:%f] Url %s",date("Y-m-d H:i:s"), $endTime-$_Sys['beginTime'],  Q_Request::getInstance()->currentUrl() );
        }
        $fp = @fopen($logFile, "ab+");
        @fwrite($fp, $log."\r\n");
        @fclose($fp);
    }
    
    public static function set($msg){
        Q_Registry::getInstance()->set('access', '['.date("Y-m-d H:i:s").'][ERROR] Url '.Q_Request::getInstance()->currentUrl() . ' '.$msg);
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
     * 获取log文件名字，（原则上一天生产一个log文件)
     * get log file name (one day one file)
     */
    private static function _getLogFileName(){
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $logPath = self::_getPath();
        if( !is_dir( $logPath.$year) ){
            @mkdir( $logPath.$year );
        }
        if( !is_dir( $logPath.$year.'/'.$month ) ){
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
        return FRAMEWORK_PATH .'/'.self::LOG_PATH;
    }
    
    
    
}



   






