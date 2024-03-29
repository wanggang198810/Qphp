<?php
/**
 * Description of GroupController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class GroupController extends BaseController{
    
    private $groupUrl;


    public function __construct() {
        parent::__construct();
        $this->groupModel = new GroupModel();
    }
    
    public function index($url = '', $type='', $param3= '' , $param4=''){
        //$this->groupModel = new GroupModel();
        
        $this->groupUrl = $url = filter($url);
        if(empty($url) ){
           $this->_home();
           return;
        }
        
        $this->data['group'] = $this->groupModel->getGroupByUrl($url);
        if(empty($this->data['group'])){
            Response::redirect('/group/');
        }
        
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $managers = $groupuserModel->getGroupManager( $this->data['group']['id'] );
        $this->data['group_managers'] = $managers;
        if($this->uid > 0){
            $this->data['is_in_group'] = $groupuserModel->isInGroup($this->data['group']['id'], $this->uid);
            $this->data['is_creator'] = $this->data['group']['creator'] == $this->data['user']['uid']  ? 1 : 0;
            $this->data['is_manager'] = ($this->data['is_in_group'] > 1 || $this->data['is_creator']) ? 1 : 0;
        }else{
            $this->data['is_in_group'] = $this->data['is_creator'] = $this->data['is_manager'] = 0;
        }
        
        $type = strtolower(filter($type));
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
                case 'kickmember':
                    $this->_kickMember($this->data['group']['id']);
                    break;
                case 'manage':
                    $this->_manage($this->data['group']);
                    break;
                case 'edit':
                    $this->_edit();
                    break;
                case 'taglist';
                    $this->_taglist();
                    break;
                case 'addtag':
                    $this->_addTag();
                    break;
                case 'deletetag':
                    $this->_deleteTag();
                    break;
                case 'tag':
                    $this->_tag($param3, $param4);
                    break;
            }
            return;
        }
        
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
    
    
    /**
     * 群组首页逻辑
     */
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
            $this->data['recom_topics'][$k]['group'] = $this->groupModel->getGroup($v['gid']);
        }
        
        $this->data['hot_topics'] = $topicModel->getTopics(0, 3, 15);
        foreach($this->data['hot_topics'] as $k => $v){
            $this->data['hot_topics'][$k]['topic_user'] = $userModel->getUser($v['uid']);
            $this->data['hot_topics'][$k]['group'] = $this->groupModel->getGroup($v['gid']);
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
        $this->checkLogin(1);
        if(Request::isPostSubmit('title') && Request::isPostSubmit('content')){
            return ;
        }
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        if(!$groupuserModel->isInGroup($gid, $this->uid)){
            $this->show_error('你没有权限', '/group/');
            return ;
        }
        $this->loadModel('Group.GroupTag');
        $grouptagModel = new GroupTagModel();
        $this->data['tags'] = $grouptagModel->getTagsByGid($gid);
        $this->render('Post');
    }
    
    
    private function _join($gid){
        $this->checkLogin(1);
        $gid2 = Request::getIntPost('gid');
        
        $data = array('time'=> time(), 'success'=> 0, 'message' => '');
        if($gid != $gid2){
            $data = array('time'=> time(), 'success'=> -1, 'message' => '');
            echo json_encode($data);
            return;
        }
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $in = $groupuserModel->isInGroup($gid, $this->uid);
        if($in){
            $data = array('time'=> time(), 'success'=> -2, 'message' => '已加入该群组');
        }
        //隐私租
        if($this->data['group']['status'] == 2){
            $result = $this->groupModel->applyJoin($gid, $this->uid);
        }else{
            $result = $groupuserModel->join($gid, $this->uid);
        }
        if($result){
            $data = array('time'=> time(), 'success'=> 1, 'message' => '');
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
        $this->checkLogin(1);
        $permission = $this->groupModel->createPermission($this->uid);
        if(!$permission){
            $this->show_error('没有权限', '/group/');
            return ;
        }
        
        if(Request::isPostSubmit('group_name') && Request::isPostSubmit('group_info') && Request::isPostSubmit('group_url')){
            $status = Request::getIntPost('group_type');
            $name = filter( Request::getPost('group_name') );
            $info = filter( Request::getPost('group_info') );
            $url = filter( Request::getPost('group_url') );
            $time = time();
            $result = $this->groupModel->createGroup($name, $info, $this->uid, $status, $time, $url);
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
        if(!empty($this->data['groups'])){
            foreach($this->data['groups'] as $k => $v){
                $groups[] = $v['id'];
            }
        
            //$r = $this->groupModel->getGroupsByCreator($this->uid);
            //hprint($r,1);
            $this->loadModel('Topic.Topic');
            $topicModel = new TopicModel();
            $result = $topicModel->getTopicByGids( $groups, $page, 10);
            $this->data['topics'] = $result['list'];
            if(!empty($this->data['topics'])){
                foreach($this->data['topics'] as $k => $v){
                    $this->data['topics'][$k]['group'] = $this->groupModel->getGroup($v['gid']);
                }
            }
            $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        }
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
    
    
    
    /**
     * 群组管理
     */
    private function _manage($group){
        if($this->uid != $this->data['group']['creator']){
            $this->show_error('没有权限', '/group/');
            return;
        }
        //hprint($this->data['group'],1);
        $page = Request::getIntGet('page',1);
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $result = $groupuserModel->getGroupMembers($group['id'], $page, 20);
       
        $this->data['members'] = $result['list'];
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        $this->render('Manage');
    }
    
    
    private function _kickMember($gid){
        $this->checkLogin(1);
        $gid2 = Request::getIntPost('gid');
        $uid = Request::getIntPost('uid');
        
        $data = array('time'=> time(), 'success'=> 0);
        if($gid != $gid2 || $this->uid != $this->data['group']['creator'] || $uid == $this->uid || $uid == $this->data['group']['creator']){
            $data = array('time'=> time(), 'success'=> -1);
            echo json_encode($data);
            return;
        }
        
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $result = $groupuserModel->leave($gid, $uid);
        if($result){
            $data = array('time'=> time(), 'success'=> 1);
        }
        echo json_encode($data);
        return;
    }
    
    private function _edit(){
        if($this->uid != $this->data['group']['creator']){
            $this->show_error('没有权限', '/group/');
            return;
        }
        
        if(Request::isPostSubmit()){
            //$data['name'] = Request::getPost('name');
            //$data['url'] = Request::getPost('url');
            $data['info'] = Request::getPost('info');
            $result = $this->groupModel->editGroup($this->data['group']['id'], $this->uid, $data);
            if($result){
                Response::redirect(group_url($this->data['group']['url'], 'edit'));
            }else{
                Response::redirect(group_url($this->data['group']['url'], 'manage'));
            }
        }
        
        $this->render('Edit');
    }


    public function addManage($gid){
        $this->checkLogin(1);
        $data = array('time'=> time(), 'success'=> 0);
        if($this->uid != $this->data['group']['creator']){
            echo json_encode($data);
            return;
        }

        $gid2 = Request::getIntPost('gid');
        $uid = Request::getIntPost('uid');

        
        if($gid != $gid2 || $this->uid != $this->data['group']['creator'] || $uid == $this->uid || $uid == $this->data['group']['creator']){
            $data = array('time'=> time(), 'success'=> -1);
            echo json_encode($data);
            return;
        }

        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $result = $groupuserModel->leave($gid, $uid);
        if($result){
            $data = array('time'=> time(), 'success'=> 1);
        }
        echo json_encode($data);
        return;
    }
    
    //标签
    private function _taglist(){
        
        $this->loadModel('Group.GroupTag');
        $groupTagModel = new GroupTagModel();
        $result = $groupTagModel->getTagsByGid( $this->data['group']['id'] );

        $this->data['tags'] = $result;
        $this->render('Tag');
    }
    
    private function _addTag(){
        $this->checkLogin(1);
        if(Request::isPostSubmit('tagname')){
            if(!$this->data['is_manager']){
                $this->show_error('没有权限', '/group/'. $this->groupUrl . '/');
                return;
            }
            $tagname = Request::getPost('tagname');
            $gid = $this->data['group']['id'];
            $this->loadModel('Group.GroupTag');
            $groupTagModel = new GroupTagModel();
            $result = $groupTagModel->addTag($this->uid , $gid, $tagname);
            if($result == -1){
                $this->show_error('标签已存在', group_url($this->groupUrl, 'tag'));
                return;
            }
            if($result){
                $this->show_success('添加成功', group_url($this->groupUrl,'tag'));
            }else{
                $this->show_error('添加失败', group_url($this->groupUrl, 'tag'));
            }
            return ;
        }
        $this->render('AddTag');
    }
    
    
    private function getGroupInfoByUrl($url){
        $url = filter($url);
        
        $this->data['group'] = $this->groupModel->getGroupByUrl($url);
        
        $this->loadModel('Group.GroupUser');
        $groupuserModel = new GroupUserModel();
        $this->data['is_in_group'] = $groupuserModel->isInGroup($this->data['group']['id'], $this->uid);
        $this->data['is_creator'] = $this->data['group']['creator'] == $this->data['user']['uid'] > 1 ? 1 : 0;
        $this->data['is_manager'] = ($this->data['is_in_group'] > 1 || $this->data['is_creator']) ? 1 : 0;
    }
    
    
    private function _tag($tagname='', $param=''){
        
        $page = Request::getIntGet('page');

        $tagname = urldecode($tagname);
        if(empty($tagname) ){
            $this->show_error('哥，空标签啊', group_url($this->data['group']['url']));
            return;
        }
        $this->loadModel('Group.GroupTag');
        $groupTagModel = new GroupTagModel();
        $tag = $groupTagModel->getTagByName($this->data['group']['id'], $tagname);
        if(empty($tag) ){
            $this->show_error('没有此标签', group_url($this->data['group']['url']));
            return;
        }

        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $result = $topicModel->getTopicsByTagid($tag['id'], $page, 10);
        $this->data['topics'] = $result['list'];
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        
        $this->render('List2');
    }
    
    private function _deleteTag(){
        $this->checkLogin(1);
        $data = array('success' => 0, 'msg' => '删除失败');
        $tagid = Request::getIntPost('tagid');
        $groupid = Request::getIntPost('groupid');
        if($tagid <= 0 || $groupid <= 0){
            echo json_encode($data);   
            return;
        }
        if( !$this->data['is_creator']){
            $data = array('success' => 0, 'msg' => '没有权限');
            echo json_encode($data);
            exit();
        }
        $this->loadModel('Group.GroupTag');
        $groupTagModel = new GroupTagModel();
        $result = $groupTagModel->deleteTag($tagid, $groupid);
        if($result){
            $data = array('success' => 1, 'msg' => '删除成功');
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
        
    }
    
    
}
