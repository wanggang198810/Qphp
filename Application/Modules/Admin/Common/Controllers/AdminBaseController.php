<?php
/**
 * Description of LoginController
 *
 * @author Administrator
 */
class AdminBaseController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        Q::import('Helpers.User', 'User');
        $this->adminId = User::getUserId();
        if( $this->adminId > 0 ){
            $this->data['admin_user'] = $this->user = User::getUser( $this->uid );
        }
    }
    
    public function checkLogin( $redirect = 1 ){
        if( $this->adminId <= 0){
            if($redirect == 1){
                $backurl = base64_encode( $this->request->currentUrl());
                $this->response->redirect("/admin/login?backurl={$backurl}");
            }else{
                return false;
            }
        }else{
            return $this->adminId;
        }
    }
    
    
}
