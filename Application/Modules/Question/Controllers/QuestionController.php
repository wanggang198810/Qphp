<?php
/**
 * Description of QuestionController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Topic/Controllers/BaseTopicController.php" );
class QuestionController  extends BaseTopicController{
    
    public $topictype = 2;
    
    public function __construct() {
        parent::__construct();

        $this->loadModel('Topic');
        $this->topicModel = new TopicModel('Topic');
        $this->questionModel = new QuestionModel('topic');
    }
    
    public function index($id = '', $type = ''){
        
        if(empty($id)){
            $this->_home();
            return;
        }
        
        $is_ok = $this->view($id,$type);
        if($is_ok){
            $this->render();
        }
    }
    
    
    private function _home(){
        
        $this->data['new_topics'] = $this->questionModel->getNewQuestions(8);
        $result = $this->questionModel->getHotQuestions(1, 8, 10);
        $this->data['hot_topics'] = $result['list']; 
        $result = $this->questionModel->getRecomQuestions(1, 8, 10);
        $this->data['recom_topics'] = $result['list']; 
        //hprint($this->data['hot_topics'],1);
        $this->render('Home');
    }
    
    public function tag($name){
        $name = filter( urldecode($name) );
        echo $name;
    }
    
    
    public function answer($id){
        $this->checkLogin(1);
        $result = $this->postAnswer($id);
        if($result){
            $data = $this->topicModel->getTopic( intval($id));
            Response::redirect(topic_url(intval($id), $data['url'], $this->topictype));
            $this->show_success();
        }else{
            //$this->show_error();
        }
        
    }
    
    
    public function post(){
        $this->checkLogin(1);
        if(Request::isPostSubmit('title') && Request::isPostSubmit('content')){
            $result = $this->save();
            if($result){
                $this->show_success('', '/question');
            }else{
                $this->show_error('','/');
            }
            return ;
        }
        $gid =1;
        $this->loadModel('Group.GroupTag');
        $grouptagModel = new GroupTagModel();
        $this->data['tags'] = $grouptagModel->getTagsByGid($gid);
        $this->render('Post');
    }
    
    
    public function answerAgree(){
        $this->checkLogin(1);
        $data = array('success'=>0, 'msg' => 'failure');
        if(Request::isPostSubmit('replyid')){
            $result = $this->postReplyAgree();
            if($result){
                $data = array('success'=>1, 'msg' => '支持成功');
            }
            echo json_encode($data) ;
            return;
        }
        echo json_encode($data) ;
        return;
    }
    
    
    public function answerDisagree(){
        $this->checkLogin(1);
        $data = array('success'=>0, 'msg' => 'failure');
        if(Request::isPostSubmit('aid')){
            $result = $this->postReplyAgree();
            if($result){
                $data = array('success'=>1, 'msg' => '支持成功');
            }
            echo json_encode($data) ;
            return;
        }
        echo json_encode($data) ;
    }
    
}
