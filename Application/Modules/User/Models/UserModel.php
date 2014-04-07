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
    public function register($username, $email, $password, $blogname, $uc_uid, $ip){
        if(empty($username) || empty($password)){
            return false;
        }
        if( $this->exist($username) ){
            return array(__LINE__, '用户名已被注册');
        }
        $time = time();
        $data = array( 
            'username'=>$username, 
            'password' => self::encryptPassword($password), 
            'blogname' => $blogname, 
            'ip' => $ip,
            'email' => $email,
            'ucuid' => $uc_uid,
            'time'=>$time, 
            'lastlogin' => $time
        );
        $result = $this->insert( $data );
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
        if( $this->checkEmailExist($email) ){
            return -1;
        }
        $data = $this->getUserById($uid,array('password'));
        $password = self::encryptPassword($password);
        if(strcasecmp($data['password'], $password) != 0){
            return false;
        }
        return $this->editProfile($uid, array( 'email'=> $email ));
    }
    
    
    public function checkEmailExist($email){
        $result = $this->where( array( 'email' => $email ) )->fetch();
        return !empty($result) ? 1 : 0;
    }
    
    public function checkBlognameExist($blogname){
        $result = $this->where( array( 'blogname' => $blogname ) )->fetch();
        return !empty($result) ? 1 : 0;
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
    
    
    /**
     * 绑定帐号
     */
    public function bind($uc_uid, $blogname, $email){
        $colum = array('email', 'blogname');
        $user = $this->setColumField( $colum )->where( array('ucuid' => $uc_uid))->fetch();
        //帐号不存在
        if(empty($user)){
            return 0;
        }
        //已绑定
        if(!empty($user['email']) || !empty($user['blogname'])){
            return -1;
        }
        //检测邮箱
        if ( $this->checkEmailExist($email) ){
            return -2;
        }
        //检测域名
        if($this->checkBlognameExist($blogname)){
            return -3;
        }
        
        $data = array(
            'email' => $email,
            'blogname' => $blogname,
        );
        return $this->where( array('ucuid' => $uc_uid) )->update($data);
    }
    
    
    
    
}

