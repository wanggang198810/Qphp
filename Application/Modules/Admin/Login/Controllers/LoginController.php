<?php
/**
 * Description of LoginController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Admin/Common/Controllers/AdminBaseController.php" );
class LoginController extends AdminBaseController{
    
    public function index(){
        if($this->admind > 0){
            $this->response->redirect('/admin/');
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
        $this->render('Admin.Login');
    }
    
    
    // 登录，记录cookie
    public function signLogin($uid){
        Q::import('Helpers.user', 'User/');
        User::setCookie($uid, 31536000, 1);
    }

    /**
     * 退出
     */
    public function logout(){
        Q::import('Helpers.user', 'User');
        User::clearCookie(1);
        $this->response->redirect('/');
    }
}
