<?php
/**
 * Description of BaseController
 *
 * @author air
 */
class BaseController extends Controller{
    
    private $needLogin = true;
    public $uid;
    
    public function __construct() {
        parent::__construct();
        Q::import('Helpers.User', 'User/');
        $this->uid = User::getUserId();
        if( $this->uid > 0 ){
            $GLOBALS['userinfo'] = $this->data['user'] = $this->user = User::getUser( $this->uid );
            $this->loadModel('Message.Message');
            $messageModel = new MessageModel('message');
            $GLOBALS['message_count'] = $messageModel->getMessageCount($this->uid);
        }
    }
    
    
    public function checkLogin( $redirect = 1 ){
        if( $this->uid <= 0){
            if($redirect == 1){
                $backurl = base64_encode( $this->request->currentUrl());
                $this->response->redirect("/user/login?backurl={$backurl}");
            }else{
                return false;
            }
        }else{
            return $this->uid;
        }
    }
    
    
    public function getUser(){
        
    }
}


