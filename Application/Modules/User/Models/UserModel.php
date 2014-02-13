<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 
 * 
 */

class UserModel extends Model{
    
    // 登录
    public function login($username, $password, $colum='*'){
        if(empty($username) || empty($password)){
            return false;
        }
        $data = $this->setColumField( $colum )->where( array( 'username' => $username ))->fetch();
        if(empty($data)){
            return -1;
        }
        if(strcasecmp($data['password'] , self::encryptPassword($password) ) === 0){
            $this->where( array( 'uid'=>$data['uid']))->update( array('lastlogin' => date("Y-m-d H:i:s")));
            return $data['uid'];
        }
        return 0;
    }
    
    
    // 注册
    public function register($username, $password, $blogname){
        if(empty($username) || empty($password)){
            return false;
        }
        if( $this->exist($username) ){
            return array(__LINE__, '用户名已被注册');
        }
        $time = time();
        $result = $this->insert( array('username'=>$username, 'password' => self::encryptPassword($password), 'blogname' => $blogname, 'time'=>$time, 'lastlogin' => $time ));
        if($result){ 
            return $this->lastInsertId();
        }
        return false;
    }
    
    
    public function getUser($uid, $colum = '*'){
        return $this->setColumField( $colum )->where( array('uid' => $uid))->fetch();
    }
    
    public function getUsername($uid){
        $uid = intval($uid);
        $sql = " SELECT `username` FROM " .$this->table('user'). " WHERE `uid` = {$uid}" ;
        $data = $this->fetch($sql);
        return $data['username'];
    }
    
    /**
     * $colum = array('uid', 'username')
     */
    public function getUserById($uid, $colum = '*'){
        $uid = intval($uid);
        if($uid <= 0){ return false;}
        return $this->setColumField( $colum )->where( array('uid'=> $uid) )->fetch();
    }
    
    
    public function getUserByBlogname($url, $colum = '*'){
        $url = filter($url);
        if(empty($url)){ return false;}
        return $this->setColumField( $colum )->where( array('blogname'=> $url) )->fetch();
    }
    
    //是否已存在
    public function exist($username){
        $data = $this->where(array( 'username' => $username ))->fetch();
        if(!empty($data)){
            return true;
        }
        return false;
    }
    
    
    public function editProfile($uid, $data){
        $uid = intval($uid);
        if($uid <= 0 || empty($data)){return false;}
        return $this->where( array('uid'=>$uid) )->update($data);
    }
    
    public function editEmail($uid, $email, $password){
        $uid = intval($uid);
        if($uid <= 0 || empty($email) || empty($password)){return false;}
        $data = $this->getUserById($uid,array('password'));
        $password = self::encryptPassword($password);
        if(strcasecmp($data['password'], $password) != 0){
            return false;
        }
        return $this->editProfile($uid, array( 'email'=> $email ));
    }
    
    public function editPassword($uid, $password, $old_password){
        $uid = intval($uid);
        if($uid <= 0 || empty($password) || empty($old_password)){return false;}
        $data = $this->getUserById($uid,array('password'));
        if(strcasecmp($data['password'], self::encryptPassword($old_password)) != 0){
            return false;
        }
        return $this->editProfile($uid, array( 'password'=> self::encryptPassword($password) ));
    }
    
    
    public static function encryptPassword($password){
        return md5($password);
    }
}

