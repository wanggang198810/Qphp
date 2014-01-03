<?php
/**
 * Description of Ucontroller
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class UController extends BaseController{
    
    private $view_user;
        
    public function index($id, $type=''){
        $this->checkLogin(1);
        $id = filter($id);
        $type = filter($type);
        
        if(empty($id)){
            if($this->uid > 0){
                $id = $this->user['blogname'];
                $this->response->redirect('/u/'.$id);
            }else{
                $this->checkLogin(1);
            }
        }
        
        $this->loadModel('User');
        $userModel = new UserModel();
        $this->view_user = $userModel->getUserByBlogname($id);

        switch($type){
            case 'archive':
                $this->archive($id);
                break;
            case 'group':
                $this->group();
                break;
            case 'photo':
                $this->photo();
                break;
            case 'articles':
                $this->articles();
                break;
            case 'questions':
                $this->questions();
                break;
            case 'category':
                $this->category();
                break;
            default :
                $this->home();
                break;
        }
    }
    
    private function home(){
        
        
        $this->loadModel('Topic');
        $topicModel = new TopicModel();
        $articles = $topicModel->getTopics($this->view_user['uid'], 1, 3);
        $questions = $topicModel->getTopics($this->view_user['uid'], 2, 3);

        $this->data['user'] = $this->view_user;
        $this->data['title'] = $this->view_user['username'];
        $this->data['topics'] = $articles;
        $this->data['questions'] = $questions;

        $this->loadModel('Topic');
        $topicModel = new TopicModel();
        $topics = $topicModel->getTopicList($this->uid);
        $this->data['user'] = $this->user;
        $this->data['title'] = $this->user['username'];
        $this->data['topics'] = $topics['list'];
        
        $this->render();
    }
    
    
    private function articles(){
        $this->_getListData(1);
        $this->data['type'] = 1;
        $this->data['title'] = $this->view_user['username'] . '的问答';
        $this->render('List');
    }
    
    public function questions(){
        $this->_getListData(2);
        $this->data['type'] = 2;
        $this->data['title'] = $this->view_user['username'] . '的问答';
        $this->render('List');
    }
    
    public function _getListData($type=1){
        $page = Request::getIntGet('page',1);
        $pageSize = 8;
        $this->loadModel('Topic');
        $topicModel = new TopicModel();
        $topics = $topicModel->getTopicList($this->view_user['uid'], $type, $page, $pageSize);
        $this->data['user'] = $this->view_user;
       
        $this->data['topics'] = $topics['list'];
        $this->data['page_html'] = to_page_html($page, $questions['pageinfo']['totalPage']);
    }
    
}


