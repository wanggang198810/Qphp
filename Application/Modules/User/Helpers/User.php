<?php

/**
 * Description of User
 *
 * @author air
 */
class User {
    
    
    
    public static function setCookie($value,$time=31536000){
        Q::import('Cookie');
        $value = strtoupper( md5($value) ) . '.' . base64_encode($value) . '.UID_'.  mt_rand(10000, 99999);
        Cookie::set('UID', $value, $time);
    }
    
    public static function clearCookie(){
        Q::import('Cookie');
        Cookie::set('UID', '', -3600);
    }
    
    
    // 获取登录用户id
    public static function getUserId(){
        Q::import('Cookie');
        $result = Cookie::get('UID');
        $arr = explode('.', $result);
        if(isset($arr[1])){
            return base64_decode($arr[1]);
        }
        return 0;
    }
    
    public static function checkLogin(){
        return self::getUserId();
    }
    
    
    public static function getUser($uid){
        Q::loadModel('User');
        $userDao = new UserModel();
        return $userDao->getUserById($uid);
    }
}

?>
