<?php
/**
 * Description of QuestionController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class QuestionController  extends BaseController{
    
    
    public function index($id){
        $int_id = intval($id);
        list($id0) = explode('-', $id);
        if($id0 != $int_id){
            $this->show_404();
            return;
        }
        
        $this->data['type'] = 2;
        
        $this->loadModel('Topic');
        $topicModel = new TopicModel('Topic');
        $this->data['topic'] = $topicModel->getTopic($int_id);
        if($id != $this->data['topic']['id']. '-' . $this->data['topic']['url'] && $id != $this->data['topic']['id']){
            $this->show_404();
            return;
        }
        
        $this->loadModel('User');
        $userModel = new UserModel('User');
        $this->data['user'] = $userModel->getUser($this->data['topic']['uid']);
        
        if(empty( $this->data['topic'])){
            $this->show_404();
        }
        $this->render();
    }
    
}
