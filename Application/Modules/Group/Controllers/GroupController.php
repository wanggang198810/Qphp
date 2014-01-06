<?php
/**
 * Description of GroupController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class GroupController extends BaseController{
    
    public function __construct() {
        parent::__construct();
        $this->groupModel = new GroupModel();
    }
    
    public function index($url = ''){
        //$this->groupModel = new GroupModel();
        
        $url = filter($url);
        if(empty($url) ){
           $this->_home();
           return;
        }
        
        $this->data['groupinfo'] = $this->groupModel->getGroupByUrl($url);
        if(empty($this->data['groupinfo'])){
            $this->response->redirect('/group');
        }
        $this->data['tags'] = $this->groupModel->getTagList($this->data['groupinfo']['id']);
        
        $this->render();
    }
    
    private function _home(){
        $this->data['hot_groups'] = $this->groupModel->getHotGroups();
        $this->data['new_groups'] = $this->groupModel->getNewGroups();
        
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $this->loadModel('User.User');
        $userModel = new UserModel();
        $this->data['recom_topics'] = $topicModel->getRecomTopics(0, 3, 8);
        foreach($this->data['recom_topics'] as $k => $v){
            $this->data['recom_topics'][$k]['topic_user'] = $userModel->getUser($v['uid']);
        }
        
        $this->data['hot_topics'] = $topicModel->getHotTopics(0, 3, 15);
        foreach($this->data['hot_topics'] as $k => $v){
            $this->data['hot_topics'][$k]['topic_user'] = $userModel->getUser($v['uid']);
        }
        
        $this->render('Home');
    }
    
    
    
    public function apply(){
        hprint($_POST,1);
        $this->render('Apply');
    }
}
