<?php
/**
 * Description of BaseTopicController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class BaseTopicController extends BaseController{
    
    public function __construct() {
        parent::__construct();
    }

    
    
    public function view($id = '', $type = ''){
        
        $int_id = intval($id);
        list($id0) = explode('-', $id);
        if($id0 != $int_id){ 
            $this->show_404();return;
        }
        
        if($type == 'answer' && !empty($id)){
            $this->answer($id); return;
        }
        
        $this->data['type'] = 2;
        
        $this->data['topic'] = $this->topicModel->getTopic($int_id);
        if( !empty($this->data['topic']['tag'])){
            $this->data['topic']['tag'] = explode(',', $this->data['topic']['tag']);
        }
        if($id != $this->data['topic']['id']. '-' . $this->data['topic']['url'] && $id != $this->data['topic']['id']){
            $this->show_404(); return;
        }
        
        $this->loadModel('User');
        $userModel = new UserModel('User');
        
        $page = Request::getIntGet('page',1);
        $this->loadModel('Topic.Reply');
        $replyModel = new ReplyModel();
        $replys = $replyModel->getReplysByTopic( intval($id), $page, 15, 0);
        
        foreach($replys['list'] as $k => $v){
            $replys['list'][$k]['reply_user'] = $userModel->getUser($v['uid']);
            if($v['replyid'] != 0){
                $replyid = -1;
                foreach($replys['list'] as $key => $val){
                    if($val['id'] == $v['replyid']){
                        $replyid = $key;
                        break;
                    }
                }
                //hprint($replyid,1);
                if($replyid != -1){
                    $replys['list'][$k]['reply'] = $replys['list'][$replyid];
                }else{
                    $replys['list'][$k]['reply'] = $replyModel->getReplyByRid($v['id']);
                }
            }
        }
        //hprint($replys['list'],1);
        $this->data['replys'] = $replys['list'];
        $this->data['pageinfo'] = $replys['pageinfo'];
        $this->data['page_html'] = to_page_html($page, $replys['pageinfo']['totalPage']);
        
        $this->data['relative_topics'] = $this->getRelativedTopics($this->data['topic']['tag']);
        
        
        $this->data['view_user'] = $userModel->getUser($this->data['topic']['uid']);
        
        if($this->data['topic']['type'] == 3){
            $this->loadModel('Group.Group');
            $groupModel = new GroupModel();
            $this->data['group'] = $groupModel->getGroup($this->data['topic']['gid']);
        }
        
        if(empty( $this->data['topic'])){
            $this->show_404(); return;
        }
        return true;
    }
    
    //
    public function getRelativedTopics($tags){
        
    }
    
    
    public function home(){
        $this->render('Home');
    }
    
    public function tag($name){
        $name = filter( urldecode($name) );
        echo $name;
    }
    
    
    public function answer2($id){
        $result = $this->_postAnswer($id);
        if($result){
            $data = $this->topicModel->getTopic( intval($id));
            Response::redirect(topic_url(intval($id), $data['url'], 2));
            $this->show_success();
        }else{
            $this->show_error();
        }
        
    }
    
    public function save(){
        $this->checkLogin(1);
        if(Request::isPostSubmit()){
            $this->loadModel('Topic');
            $postModel = new TopicModel();
            import('String');
            $data['title'] = filter(Request::getPost('title'));
            $data['content'] = htmlspecialchars( Request::getPost('content') );
            $data['shortcontent'] = String::substr(htmlspecialchars( Request::getPost('content') ), 0, 256);
            $data['cid'] = Request::getIntPost('category');
            $data['gid'] = Request::getIntPost('groupid');
            $data['tid'] = Request::getIntPost('tagid');
            $data['type'] = $this->topictype;//Request::getIntPost('type',1);
            $data['url'] = trim(Request::getPost('url'));
            $data['tag'] = trim(Request::getPost('tag'));
           
            if(!empty($data['url']) && strlen($data['url']) < 5){
                return false;
            }
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
                //$this->response->redirect(user_space($this->user['blogname']));
                return true;
            }else{
                return false;
            }
        }
        $this->response->redirect('/');
    }
    
    public function postAnswer($id){
        if( Request::isPostSubmit('topicid')){
            $data['topicid'] = Request::getIntPost('topicid');
            if( intval( $id ) != $data['topicid']){
                $this->show_404();
                return;
            }
            if( $data['topicid'] <= 0){
                $this->show_error('哥！问题跑到火星上去了。', '/question/'.$id);
            }
            $data['replyid'] = Request::getIntPost('replyid');
            $data['content'] = filter( Request::getPost('reply_content') ); 
            
            if( strlen($data['content']) <= 6){
                $this->show_error('哥！多写点东西吧。', '/question/'.$id);
            }
            
            $data['type'] = $this->topictype;
            $data['uid'] = $this->uid;
            $data['time'] = time();
            $this->loadModel('Topic.Reply');
            $replyModel = new ReplyModel();
            $result = $replyModel->addReply($data);
            if($result){
                return true;
            }
            return false;
        }
        
    }
    
    
    
    public function postReplyAgree(){
        $this->checkLogin(1);
        $rid = Request::getIntPost('replyid');
        $agree = Request::getIntPost('agree');
        $topicid = Request::getIntPost('topicid');
        $agree = intval($agree) > 0 ? 1 : 0;
        
        if($rid <= 0){ return false;}
        $this->loadModel('Topic.Reply');
        $replyModel = new ReplyModel();
        $result = $replyModel->dealReply($rid, $this->uid, $agree, $topicid);
        if($result){
            return true;
        }
        return false;
    }
    
}

?>
