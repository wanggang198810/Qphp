<?php
/**
 *COOKIE类
 */

class Cookie{
	
    static $pre_cookie = 'RGSS';
	
	//set cookie
	public static function set($name,$value,$time='3600',$path='/',$domain=''){
		setcookie(self::$pre_cookie.$name,$value,time()+$time,$path,$domain);
	}
	
	
	//get cookie
	public static function get($name){
		if(@$_COOKIE[self::$pre_cookie.$name])
			return $_COOKIE[self::$pre_cookie.$name];
		return false;
	}
	
        //get cookie
	public static function getDecode($name){
		if(@$_COOKIE[self::$pre_cookie.$name])
			return base64_decode($_COOKIE[self::$pre_cookie.$name]);
		return false;
	}
	
	
	//delete  cookie
	public static function del($name){
		setcookie(self::$pre_cookie.$name,'',time()-3600);
		unset($_COOKIE[self::$pre_cookie.$name]);
	}
	
	
	// destroy all cookie
	public static function destroy(){
		unset($_COOKIE);	
	}
	
	
}


?>