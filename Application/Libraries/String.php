<?php

/**
 * Description of String
 *
 * @author air
 */
class String {
    //put your code here
    
    
    public static function substr($str, $start, $length, $encoding="UTF-8"){
        return mb_substr($str, $start, $length, $encoding);
    }
    
    
    public static function cutstr($str, $start, $length, $replace = '...', $encoding="UTF-8"){
        $str = mb_substr($str, $start, $length, $encoding);
        if(mb_strlen($str, $encoding) > $length){
            $str .= $replace;
        }
        return $str;
    }
    
}


