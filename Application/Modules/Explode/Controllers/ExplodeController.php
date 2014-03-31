<?php
/**
 * Description of ExplodeController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class ExplodeController  extends  BaseController{
    
    //首页
    public function index(){
        
        $type = Request::getGet('type');
        $page = Request::getIntGet('page');
        
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $result = $topicModel->getTopicList(0, $type, $page, 20, 1000);
        
        $this->data['topics'] = $result['list'];
        $this->data['pageinfo'] = $result['pageinfo'];
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        $this->render();
    }
    
    
    
    
    
}

?>
