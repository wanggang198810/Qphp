<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */

class String extends Q_String{
    
}

class Q_String {
    
    public static function substr($string,$start=0,$length=0,$encoding ='utf-8'){
        return mb_substr($string, $start, $length, $encoding);
    }
    
    
    public static function cutstr($string,$start=0,$length=10,$encoding ='utf-8',$rep='...'){
        if(strlen($string) < $length){
            return $string;
        }else{
            return mb_substr($string, $start, $length, $encoding).$rep;
        }
    }
    
    
}

?>
