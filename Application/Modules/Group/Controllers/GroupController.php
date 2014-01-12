<?php
/**
 * Description of GroupController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class GroupController extends BaseController{
    
    public function __construct() {
        parent::__construct();
        $this->groupModel = new GroupModel();
    }
    
    public function index($url = '', $type=''){
        //$this->groupModel = new GroupModel();
        
        $url = filter($url);
        if(empty($url) ){
           $this->_home();
           return;
        }
  
        
        $this->data['group'] = $this->groupModel->getGroupByUrl($url);
        if(empty($this->data['group'])){
            $this->response->redirect('/group');
        }
        
        $type = filter($type);
        if(!empty($type)){
            switch ($type){
                case 'members':
                    $this->_members( $this->data['group']['id']);
                    break;
                case 'post':
                    $this->_post($this->data['group']['id']);
                    break;
                case 'join':
                    $this->_join($this->data['group']['id']);
                    break;
                case 'leave':
                    $this->_leave($this->data['group']['id']);
                    break;
            }
            return;
        }
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $this->data['is_in_group'] = $groupuserModel->isInGroup($this->data['group']['id'], $this->uid);
        //$this->data['tags'] = $this->groupModel->getTagList($this->data['group']['id']);
        $page = Request::getIntGet('page',1);
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $result = $topicModel->getTopicByGid( $this->data['group']['id'], $page, 10);
        $this->data['topics'] = $result['list'];
        $this->loadModel('User.User');
        $userModel = new UserModel();
        foreach($this->data['topics'] as $k => $v){
            $this->data['topics'][$k]['author'] = $userModel->getUser($v['uid']);
        }
        
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        
        $this->data['members'] = $this->groupModel->getRecentGroupMembers($this->data['group']['id']);
        
        $this->render('List');
    }
    
    private function _home(){
        $this->data['hot_groups'] = $this->groupModel->getHotGroups();
        $this->data['new_groups'] = $this->groupModel->getNewGroups();
        
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $this->loadModel('User.User');
        $userModel = new UserModel();
        $this->data['recom_topics'] = $topicModel->getRecomTopics(0, 3, 8);
        foreach($this->data['recom_topics'] as $k => $v){
            $this->data['recom_topics'][$k]['topic_user'] = $userModel->getUser($v['uid']);
        }
        
        $this->data['hot_topics'] = $topicModel->getHotTopics(0, 3, 15);
        foreach($this->data['hot_topics'] as $k => $v){
            $this->data['hot_topics'][$k]['topic_user'] = $userModel->getUser($v['uid']);
        }
        
        $this->render('Home');
    }
    
    
    
    private function _members($gid){
        $page = Request::getIntGet('page',1);
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $result = $groupuserModel->getGroupMembers($gid, $page, 20);
       
        $this->data['members'] = $result['list'];
        
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        $this->render('Member');
    }

    private function _post($gid){
        
        if(Request::isPostSubmit('title') && Request::isPostSubmit('content')){
            hprint($_POST,1);
        }
        
        $this->loadModel('Group.GroupTag');
        $grouptagModel = new GroupTagModel();
        $this->data['tags'] = $grouptagModel->getTagsByGid($gid);
        $this->render('Post');
    }
    
    
    private function _join($gid){
        $this->checkLogin(1);
        $gid2 = Request::getIntPost('gid');
        
        $data = array('time'=> time(), 'success'=> 0);
        if($gid != $gid2){
            $data = array('time'=> time(), 'success'=> -1);
            echo json_encode($data);
            return;
        }
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $result = $groupuserModel->join($gid, $this->uid);
        if($result){
            $data = array('time'=> time(), 'success'=> 1);
        }
        echo json_encode($data);
        return;
    }
    
    
    private function _leave($gid){
        $this->checkLogin(1);
        $gid2 = Request::getIntPost('gid');
        
        $data = array('time'=> time(), 'success'=> 0);
        if($gid != $gid2){
            $data = array('time'=> time(), 'success'=> -1);
            echo json_encode($data);
            return;
        }
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $result = $groupuserModel->leave($gid, $this->uid);
        if($result){
            $data = array('time'=> time(), 'success'=> 1);
        }
        echo json_encode($data);
        return;
    }
    

    public function apply(){
        
        if(Request::isPostSubmit('group_name') && Request::isPostSubmit('group_info') && Request::isPostSubmit('group_url')){
            $status = Request::getIntPost('group_type');
            $name = filter( Request::getPost('group_name') );
            $info = filter( Request::getPost('group_info') );
            $url = filter( Request::getPost('group_url') );
            $time = time();
            $result = $this->groupModel->addGroup($name, $info, $this->uid, $status, $time, $url);
            if($result){
                Response::redirect('/group/'.$result);
            }else{
                Response::redirect('/group');
            }
        }
        $this->render('Apply');
    }
    
    
    public function mine(){
        $page = Request::getIntGet('page',1);
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $this->data['groups'] = $groupuserModel->getGroupInfoByUid($this->uid );
        foreach($this->data['groups'] as $k => $v){
            $groups[] = $v['id'];
        }
        
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $result = $topicModel->getTopicByGids( $groups, $page, 10);
        $this->data['topics'] = $result['list'];
        foreach($this->data['topics'] as $k => $v){
            $this->data['topics'][$k]['group'] = $this->groupModel->getGroup($v['gid']);
        }
        
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        $this->render('Mine');
    }
    
    
    public function rank(){
        $page = Request::getIntGet('page',1);
        $result = $this->groupModel->getGroupList();
        $this->data['groups'] = $result['list'];
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        
        
        if($this->uid){
            $this->loadModel('Group.GroupUser');
            $groupuserModel = new GroupUserModel();
            $groups = $groupuserModel->getGroupsByUid( $this->uid );
            foreach($groups as $k => $v){
                $groupArr[] = $v['gid'];
            }
        }else{
            $groupArr =array();
        }
        $this->data['usergroup'] = $groupArr;
        $this->render('Rank');
    }
    
    
    
    
}
