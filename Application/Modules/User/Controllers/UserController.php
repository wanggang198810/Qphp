<?php

/**
 * Description of UserController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class UserController extends BaseController{
    
    private $needLogin = 1;
    
    public function __construct() {
        parent::__construct();
        $this->loadModel('User');
        $this->userModel = new UserModel('user');
    }
    
    
    public function index(){
        $this->checkLogin(1);
        $this->response->redirect('/u/');
    }    
    
    public function setting(){
        
    }
    
    
    // 登录
    function login(){
        //echo date('YW N w o c z' , strtotime('2013-12-31T00:00:00+00:00'));exit;
        if($this->uid > 0){
            Response::redirect('/u/'.$this->user['uid']);
        }
        if(Request::isPostSubmit()){
            
            $username = addslashes( trim( Request::getPost('username') ) );
            $password = addslashes( trim( Request::getPost('password') ) );

            if(empty($username) || empty($password)){
                $this->render('Login');
                return false;
            }
            
            load_uc();
            $uc_uid = uc_user_login($username, $password);
            /**-1:用户不存在，或者被删除
                -2:密码错
                -3:安全提问错
             */
            $notice = array(
                -1 => '用户不存在，或者被删除',
                -2 => '密码错误',
                -3 => '安全提问错误',
            );

            if(!$uc_uid || $uc_uid[0] <= 0){
                $this->show_error( $notice[$uc_uid[0]], '/user/login/');
                return ;
            }

            $result = $this->userModel->login($username, $password);
            if($result < 0){
                $email = $uc_uid[3];
                $ip = get_ip();
                $result = $this->userModel->register($username, $email, $password, '', $uc_uid[0], $ip);
                if($result > 0){
                    $this->signLogin($result);
                    //Response::redirect('/user/bind/');
                    Response::redirect(user_space($result));
                }
                return;
            }
            if($result <= 0){
                $this->show_error('密码错误', '/user/login/');
                return;
            }
            
            if($result > 0){
                $this->signLogin($result);
                $this->response->redirect('/user/');
            }
        }
        $this->render('Login');
    }
	
    
    // 注册
    public function register(){
        
        if($this->uid > 0){
            $this->response->redirect('/u/'.$this->user['blogname']);
        }
        
        if(Request::isPostSubmit()){
             load_uc();
            $username = trim($this->request->getPost('username'));
            $password = trim($this->request->getPost('password'));
            $blogname = trim($this->request->getPost('blogname'));
            $email = trim($this->request->getPost('email'));
            $ip = get_ip();
            
            if(empty($username) || empty($password) ||  empty($email)){ //empty($blogname) ||
                $this->show_error('请填写完整资料', '/user/register/');
                return false;
            }
            
            $uc_uid = uc_user_register($username, $password, $email, '', '' , $ip);
            if($uc_uid <= 0){
                /**
                 * -1:用户名不合法
                    -2:包含不允许注册的词语
                    -3:用户名已经存在
                    -4:Email 格式有误
                    -5:Email 不允许注册
                    -6:该 Email 已经被注册
                 */
                $failure_notice = array(
                    -1 => '用户名不合法',
                    -2 => '包含不允许注册的词语',
                    -3 => '用户名已经存在',
                    -4 => 'Email 格式有误',
                    -5 => 'Email 不允许注册',
                    -6 => '该 Email 已经被注册',
                ); 
                $this->show_error('注册失败：'. $failure_notice[$uc_uid], '/user/register/');
                return ;
            }
            
            $result = $this->userModel->register($username, $email, $password, $blogname, $uc_uid);

            if($result){
                $this->loadModel('Message.Message');
                $messageModel = new MessageModel();
                $r = $messageModel->sendMsg($result, 1, '', 0, 0, 100);
                $this->signLogin($result);
                $this->show_success('注册成功', user_space( $result ));
                return;
                //$this->response->redirect('/user');
            }
        }
        $this->render('Register');
    }

    
    /**
     * 绑定帐号
     */
    public function bind(){
        $this->checkLogin(1);
        if(Request::isPostSubmit()){
            $blogname = trim($this->request->getPost('blogname'));
            $email = trim($this->request->getPost('email'));
            $uc_uid = Request::getIntPost('ucuid');
            
             if(empty($uc_uid) || empty($blogname) || empty($email)){
                $this->show_error('请填写完整资料', '/user/bind/');
                return false;
            }
            $result = $this->userModel->bind($uc_uid, $blogname, $email);
           
            switch ($result){
                case 0:
                    $error_msg = '要绑定的用户不存在.';
                    break;
                case -1:
                    $error_msg = '该用户已绑定了资料.';
                    break;
                case -2:
                    $error_msg = '该邮箱已注册.';
                    break;
                case -3:
                    $error_msg = '该域名已注册.';
                    break;
            }
            
            if($result <= 0){
                $this->show_error($error_msg, '/user/login/');
                return;
            }
            
            $this->show_success('绑定成功', '/user/' . $blogname . '/');
            return;
        }
        //hprint($this->user, 1);
        $this->data['ucuid'] = $this->user['ucuid'];
        $this->render();
    }
    
    // 登录，记录cookie
    public function signLogin($uid){
        Q::import('Helpers.user', 'User/');
        User::setCookie($uid);
    }

    /**
     * 退出
     */
    public function logout(){
        Q::import('Helpers.user', 'User');
        User::clearCookie();
        $this->response->redirect('/');
    }

    public function settings(){
        $this->checkLogin(1);
        if( Request::isPostSubmit()){
            $data = array();
            $data['sex'] = Request::getIntPost('sex');
            $data['info'] = filter( Request::getPost('info') );
            $data['honorname'] = filter( Request::getPost('honorname') );
            $result = $this->userModel->editProfile($this->uid, $data);
            if($result){
                $this->show_success();
            }else{
                $this->show_error();
            }
        }
        $this->data['userinfo'] = $this->user;
        $this->render('Settings');
    }


    
    
}

