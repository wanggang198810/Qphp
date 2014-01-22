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
        $result = $this->postAnswer($id);
        if($result){
            $data = $this->topicModel->getTopic( intval($id));
            Response::redirect(topic_url(intval($id), $data['url'], $this->topictype));
            $this->show_success();
        }else{
            $this->show_error();
        }
        
    }
    
    
    
}
