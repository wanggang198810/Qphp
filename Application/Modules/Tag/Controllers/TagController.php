<?php
/**
 * Description of TagControllers
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class TagController extends  BaseController{
    
    public function __construct() {
        parent::__construct();
        $this->tagModel = new TagModel();
    }
    
    public function index($tagname=''){
        $tagname = urldecode( filter($tagname) );
        if(empty($tagname)){
            $this->_home();
            return ;
        }
        
        $page = Request::getIntGet('page');
        $type = Request::getGet('type');
        // tag搜索
        $result = $this->tagModel->search( $tagname, $type, $page);
        
        $this->data['tagname'] = $tagname;
        $this->data['topics'] = $result['list'];
        $this->data['pageinfo'] = $result['pageinfo'];
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        $this->render();
    }
    
    
    // 首页
    private function _home(){
        
    }
    
    
}

?>
