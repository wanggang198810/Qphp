<?php
/**
 * Description of PostController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class PostController extends BaseController{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        $this->render('Post');
    }
    
    
    public function save(){
        
        if(Request::isPostSubmit()){
            $this->loadModel('Topic');
            $postModel = new TopicModel();
            
            
            $data['title'] = trim(Request::getPost('title'));
            $data['content'] = htmlspecialchars( Request::getPost('content') );
            $data['cid'] = Request::getPost('cid');
            $data['groupid'] = Request::getPost('groupid');
            $data['url'] = trim(Request::getPost('url'));
            $data['tag'] = trim(Request::getPost('tag'));
            
            
            $data['title'] = '测试文章' . rand(10000,99999);
            $data['content'] = '测试内容' . rand(10000,99999);
            $data['cid'] = 1;
            $data['groupid'] = 1;
            $data['url'] = 'go-hero';
            $data['tag'] = '测试,go';
            
            
            $data['time'] = time();
            $data['uid'] = $this->uid;
            $result = $postModel->post($data);
            if($result){
                $this->loadModel('Tag');
                $tagModel = new TagModel('Tag'); 
                $result = $tagModel->add($result, $data['tag']);
                hprint($result);
            }
        }
        $this->response->redirect('/post');
    }
}

