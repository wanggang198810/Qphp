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
            
            $is_ok = $this->view($id, $type);
            if($is_ok){
                Q::import('Helpers.Topic', 'Topic/');
                $this->render();
            }
            return ;
        }else{
            Response::redirect('/group');
        }
        
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
        $this->checkLogin(1);
        $gid = Request::getIntPost('groupid');
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $is_in_group = $groupuserModel->isInGroup($gid, $this->uid);
        if(!$is_in_group){
            $this->show_error('不能在未加入的群组发帖', '/group/');
            return;
        }
        $result = parent::save();
        if($result){
            $url = Request::refererUrl();
            $url = parse_url( $url );
            $url = explode('/', trim($url['path'], '/'));
            $group_url = $url[1];
            $this->show_success('发表成功', group_url($group_url));
        }else{
            $this->show_error('', '/');
        }
        return;
        
        
        if(Request::isPostSubmit()){
            $this->loadModel('Topic');
            $postModel = new TopicModel();
            
            
            $data['title'] = filter(Request::getPost('title'));
            $data['content'] = filter( Request::getPost('content') );
            $data['shortcontent'] = String::substr(htmlspecialchars( Request::getPost('content') ), 0, 70);
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
                Response::redirect(user_space($this->user['uid']));
                return;
            }
        }
        Response::redirect('/post/');
    }
    
    
    public function delete($id){
        $this->checkLogin(1);
        $id = intval($id);
        if($id <= 0){
            $this->show_404();
            return;
        }
        
        $this->data['topic'] = $this->topicModel->getTopic($id);
        if(empty($this->data['topic'])){
            $this->show_404();
            return;
        }
        $this->loadModel('Group.Group');
        $this->loadModel('Group.GroupUser');
        $groupModel = new GroupModel();
        $groupuserModel = new GroupUserModel();
        $this->data['group'] = $groupModel->getGroup($this->data['topic']['gid']);
        $this->data['is_manager'] = $groupuserModel->isManager($this->data['topic']['gid'], $this->uid);
        $this->data['is_creator'] = $this->data['group']['creator'] == $this->data['user']['uid'] > 1 ? 1 : 0;
        //$this->data['is_manager'] = ($this->data['is_in_group'] > 1 || $this->data['is_creator']) ? 1 : $this->data['is_manager'];
        if(!$this->data['is_manager'] && $this->user['uid'] != $this->data['topic']['uid']){
            $this->show_error('没有权限', group_url($this->data['group']['url']));
            return;
        }
        
        $result =  $this->topicModel->deleteTopic($id,$this->uid);
        if($result){
            $this->show_success('删除成功', group_url($this->data['group']['url']) );
        }else{
            $this->show_error('删除失败', group_url($this->data['group']['url']));
        }
        
    }
    
    
    
    
    
    
}

