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
    }
    
    public function index($id = '', $type = ''){
        if(empty($id)){
            $this->home();
            return;
        }
        
        $this->view($id,$type);
        $this->render();
    }
    
    
    public function home(){
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