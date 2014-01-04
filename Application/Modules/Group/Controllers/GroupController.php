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
        
    }
    
    public function index($url = ''){
        //$this->groupModel = new GroupModel();
        
        $url = filter($url);
        if(empty($url) ){
           $this->_home();
           return;
        }
        
        $this->data['groupinfo'] = $this->groupModel->getGroupByUrl($url);
        if(empty($this->data['groupinfo'])){
            $this->response->redirect('/group');
        }
        $this->data['tags'] = $this->groupModel->getTagList($this->data['groupinfo']['id']);
        
        $this->render();
    }
    
    private function _home(){
        $this->render('Home');
    }
    
}
