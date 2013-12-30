<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Memory {
    //put your code here
    public static $instance;
    
    public static function getInstance(){
        if( null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * 
     */
    public function get($realUsage=true){
        return memory_get_usage($realUsage);
    }
    
    public function getPeack($realUsage=true){
        return memory_get_peak_usage($realUsage);
    }
    
    public function memory_get_usage(){
        $output = array();
        exec('tasklist /FI "PID eq '.getmypid().'" /FO LIST', $output );
        return preg_replace( '/[^0-9]/', '', $output[5] ) * 1024;
    }
}


