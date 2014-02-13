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
        $this->response->redirect('/u');
    }    
    
    public function setting(){
        
    }
    
    
    // 登录
    function login(){
        //echo date('YW N w o c z' , strtotime('2013-12-31T00:00:00+00:00'));exit;
        if($this->uid > 0){
            $this->response->redirect('/u/'.$this->user['blogname']);
        }
        if(Request::isPostSubmit()){
            $username = trim($this->request->getPost('username'));
            $password = trim($this->request->getPost('password'));

            if(empty($username) || empty($password)){
                $this->render('Login');
                return false;
            }
            $result = $this->userModel->login($username, $password);
            if($result > 0){
                $this->signLogin($result);
                $this->response->redirect('/user');
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
            $username = trim($this->request->getPost('username'));
            $password = trim($this->request->getPost('password'));
            $blogname = trim($this->request->getPost('blogname'));

            if(empty($username) || empty($password)){
                return false;
            }
            $result = $this->userModel->register($username, $password, $blogname);

            if($result){
                $this->loadModel('Message.Message');
                $messageModel = new MessageModel();
                $r = $messageModel->sendMsg($result, 1, '', 0, 0, 100);
                $this->signLogin($result);
                $this->response->redirect('/user');
            }
        }
        $this->render('Register');
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

