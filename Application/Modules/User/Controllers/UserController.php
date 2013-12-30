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
        
        if(Request::isPostSubmit()){
            $username = trim($this->request->getPost('username', 'air'));
            $password = trim($this->request->getPost('password', '123456'));
            if(empty($username) || empty($password)){
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
        
        if(Request::isPostSubmit()){
            $username = trim($this->request->getPost('username', 'air'));
            $password = trim($this->request->getPost('password', '123456'));
            
            if(empty($username) || empty($password)){
                return false;
            }
            $result = $this->userModel->register($username, $password);

            if($result){
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


    public function doLogin(){

        $username=Request::getPost('username');
        $password=Request::getPost('password');
        $result=$this->MUser->login($username,$password);
        if($result){
                echo '登录成功';
                redirect("/");
        }else{
                echo 'no';
                //redirect("/user/login");
        }
    }

    public function logout(){
            CUser::logout();
            redirect("/user/login");
    }




    public function doRegister(){
            $username=Request::getPost('username');
            $password=Request::getPost('password');
            $result=$this->MUser->register($username,$password);
            if($result){
                    echo '注册成功<a href="/">返回</a>';
            }

    }
    
    
}

