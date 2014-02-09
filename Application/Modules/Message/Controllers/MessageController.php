<?php
/**
 * Description of MessageController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class MessageController extends BaseController{
    
    public function __construct() {
        parent::__construct();
        $this->checkLogin(1);
        $this->MessageModel = new MessageModel();
    }
    //
    public function index($id = 0){
        $id = intval($id);
        if($id > 0){
            $this->_getMessage($id);
            return;
        }
        $this->_getMessageData(0,1);
        //hprint($this->data,1);
        $this->render('Home');
    }
    
    
    public function system(){
        $this->_getMessageData(1,1);
        $this->render('System');
    }
    
    private function _getMessageData($system, $status){
        $page = Request::getIntGet('page');
        $pageSize = Request::getIntGet('pageSize', 10);
        $total = Request::getIntGet('total');
        $result = $this->MessageModel->getMessageList($this->uid, $system, $status, $page, $pageSize, $total);
        $this->loadModel('User.User');
        $userModel = new UserModel('user');
        if(!empty($result['list'])){
            foreach($result['list'] as $k => $v){
                $result['list'][$k]['fromuser'] = $userModel->getUser($v['fromuid']);
            }
        }
        $this->data['messages'] = $result['list'];
        //hprint($this->data,1);
        $this->data['pageinfo'] = $result['pageinfo'];
    }
    
    private function _getMessage($id){
        $id = intval($id);
        if($id <= 0){
            $this->show_404();
            return;
        }
        $result = $this->MessageModel->getMessage($id, $this->uid);
        $this->loadModel('User.User');
        $userModel = new UserModel('user');
        if(!empty($result)){
            $result['fromuser'] = $userModel->getUser($result['fromuid']);
        }
        $record = $this->MessageModel->getMessageRecord($id);
        $this->data['message'] = $result;
        $this->data['record'] = $record;
        $this->render('ViewMessage');
    }


    public function send(){
        $data = array('success'=>0, 'msg'=>'failure');
        $to_uid = Request::getIntPost('uid');
        $msgid = Request::getIntPost('msgid');
        
        if(Request::isPostSubmit() && $to_uid != $this->uid && $this->uid > 0){
            $content = filter(Request::getPost('content'));
            $result = $this->MessageModel->sendMsg($to_uid, $this->uid, $content, $msgid);
            if($result){
                $data = array('success'=>1, 'msg'=>'ok');
            }
        }
        echo json_encode($data);
    }
    
}
