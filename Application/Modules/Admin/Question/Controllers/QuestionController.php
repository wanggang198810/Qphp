<?php
/**
 * Description of LoginController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Admin/Common/Controllers/AdminBaseController.php" );
class QuestionController extends AdminBaseController{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function index(){
        $page = Request::getIntGet('page');
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $result = $topicModel->getTopicList(0, 3, $page);
        $this->data['topics'] = $result['list'];
        $this->view();
    }
    
    public function tag(){
        $this->view('Tag');
    }
    
    
}
