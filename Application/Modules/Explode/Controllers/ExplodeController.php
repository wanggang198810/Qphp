<?php
/**
 * Description of ExplodeController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class ExplodeController  extends  BaseController{

    public static $type = array(
        'topic' => 1,
        'question' => 2,
        'post' => 3,
    );
    
    //首页
    public function index(){
        
        $type = Request::getGet('type');
        $page = Request::getIntGet('page');
        
        $this->loadModel('Topic.Topic');
        $topicModel = new TopicModel();
        $type = in_array($type, array_keys( self::$type )) ? self::$type[$type] : 0;

        $result = $topicModel->getTopicList(0, $type, $page, 20, 0);

        $this->data['topics'] = $result['list'];
        $this->data['pageinfo'] = $result['pageinfo'];
        $this->data['page_html'] = to_page_html($page, $result['pageinfo']['totalPage']);
        $this->render();
    }
    
    
    
    
    
}

?>
