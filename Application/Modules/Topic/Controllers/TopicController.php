<?php

/**
 * Description of TopicControllers
 *
 * @author air
 */
require( APP_PATH ."Modules/Topic/Controllers/BaseTopicController.php" );
class TopicController extends BaseTopicController {
    
    public $topictype = 1;
    
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
        //$this->view($id,$type);
        $is_ok = $this->view($id, $type);
        if($is_ok){
            Q::import('Helpers.Topic', 'Topic/');
            $this->render();
            return;
        }else{
            Response::redirect('/group');
        }
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
    
    public function post(){
        $this->checkLogin(1);
        
        if(Request::isPostSubmit()){
            $result = parent::save();
            if($result){
                $this->show_success('分享文字成功', user_space($this->user['uid'], 'topic'));
            }else{
                $this->show_error('系统繁忙', '/');
            }
            return;
        }
        $this->render('/Post');
    }
    
}


