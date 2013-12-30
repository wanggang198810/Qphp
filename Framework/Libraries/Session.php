<?php

class Session{
	
	public function __construct(){
		session_start();
	}
	
	
	public static function setSession($name,$value){
		$_SESSION[$name]=$value;
	}
	
	
	public static function getSession($name){
		return $_SESSION[$name];
	}
	
	
	public static function delSession($name){
		//$_SESSION[$name]='';
		unset($_SESSION[$name]);
	}
	
	
	public static function destroySession(){
		session_destroy();	
	}
	
}

?>