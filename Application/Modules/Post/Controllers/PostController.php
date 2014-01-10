<?php
/**
 * Description of PostController
 *
 * @author air
 */
require( APP_PATH ."Modules/Topic/Controllers/BaseTopicController.php" );
class PostController extends BaseTopicController{
    
    
    public $topictype = 3;
    
    public function __construct() {
        parent::__construct();
        
        $this->loadModel('Topic');
        $this->topicModel = new TopicModel('Topic');
    }
    

    
    public function index($id='', $type=''){
        if( !empty($id)){
            Q::import('Helpers.Topic', 'Topic/');
            $this->view($id, $type);
            $this->render('Post');
            return ;
        }else{
            Response::redirect('/group');
        }
        
        $this->checkLogin(1);
        $this->loadModel('Category');
        $cateDao = new CategoryModel();
        $this->data['categories'] = $cateDao->getCategoryByUid($this->uid);
        
        $this->render('Post');
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
    
    
    public function save(){
        $result = parent::save();
        retur;
        $this->checkLogin(1);
        
        if(Request::isPostSubmit()){
            $this->loadModel('Topic');
            $postModel = new TopicModel();
            
            
            $data['title'] = trim(Request::getPost('title'));
            $data['content'] = htmlspecialchars( Request::getPost('content') );
            $data['shortcontent'] = substr(htmlspecialchars( Request::getPost('content') ), 0, 70);
            $data['cid'] = Request::getIntPost('category');
            $data['gid'] = Request::getIntPost('groupid');
            $data['type'] = Request::getIntPost('type',1);
            $data['url'] = trim(Request::getPost('url'));
            $data['tag'] = trim(Request::getPost('tag'));
            
            
            if( strlen($data['title']) <= 0 && strlen( trim($data['content']) ) <= 20){
                return false;
            }
            
            $data['time'] = time();
            $data['uid'] = $this->uid;
            
            $result = $postModel->post($data);
            if($result > 0){
                if(!empty($data['tag'])){
                    $this->loadModel('Tag');
                    $tagModel = new TagModel('Tag'); 
                    $result = $tagModel->addTag($result, $data['tag']);
                }
                $this->response->redirect(user_space($this->user['blogname']));
                return;
            }
        }
        $this->response->redirect('/post');
    }
}

