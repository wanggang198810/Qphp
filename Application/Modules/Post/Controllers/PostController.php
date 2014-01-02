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
        $this->checkLogin(1);
        $this->loadModel('Category');
        $cateDao = new CategoryModel();
        $this->data['categories'] = $cateDao->getCategoryByUid($this->uid);
        
        $this->render('Post');
    }
    
    
    public function save(){
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

