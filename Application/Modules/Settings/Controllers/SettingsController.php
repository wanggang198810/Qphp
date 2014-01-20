<?php
/**
 * Description of SettingsController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class SettingsController extends BaseController{
    
    public function __construct() {
        parent::__construct();
        $this->checkLogin(1);
    }
    

    public function index(){
        
        $this->profile();
    }


    public function profile(){
        $this->data['user'] = $this->user;
        if(Request::isPostSubmit('action')){
            $data['honorname'] = Request::getPost('honorname');
            $data['info'] = Request::getPost('info');
            $this->loadModel('User.UserModel');
            $userModel = new UserModel();
            $result = $userModel->editProfile($this->uid, $data);
            if($result){
                $this->show_success('', '/settings/profile/');
            }else{
                $this->show_error('', '/settings/profile/');
            }
        }
        $this->render('Profile');
    }
    
    
    public function email(){
        $this->data['user'] = $this->user;
        if(Request::isPostSubmit('action')){
            $email = Request::getPost('email');
            $password = Request::getPost('password');
            $this->loadModel('User.UserModel');
            $userModel = new UserModel();
            $result = $userModel->editEmail($this->uid, $email, $password);
            if($result){
                $this->show_success('', '/settings/email/');
            }else{
                $this->show_error('', '/settings/email/');
            }
        }
        $this->render('Email');
    }
    
    
    public function password(){
        $this->data['user'] = $this->user;
        if(Request::isPostSubmit('action')){
            $old_password = Request::getPost('old_password');
            $password = Request::getPost('password');
            $this->loadModel('User.UserModel');
            $userModel = new UserModel();
            $result = $userModel->editPassword($this->uid, $password, $old_password);
            if($result){
                $this->show_success('', '/settings/password/');
            }else{
                $this->show_error('', '/settings/password/');
            }
        }
        $this->render('Password');
    }
    
    
    public function avatar(){
        $this->data['user'] = $this->user;
        if(Request::isPostSubmit('action')){
            $file = $_FILES['avatar'];
            //$this->loadModel('User.UserModel');
            //$userModel = new UserModel();
            //$result = $userModel->editEmail($this->uid, $email, $password, $old_password);
            $result = false;
            if($result){
                $this->show_success('', '/settings/avatar/');
            }else{
                $this->show_error('', '/settings/avatar/');
            }
        }
        $this->render('Profile');
    }
    
    
}

