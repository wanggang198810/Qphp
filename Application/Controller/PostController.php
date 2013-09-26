<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class PostController extends Controller{
    
    protected $postModel;
    
    public function __construct() {
        parent::__construct();
        $this->loadModel('Topic');
        $this->postModel = new TopicModel();
    }

    public function index(){
        
    }
    
    
    public function save(){
        $data = $this->request->getPost();
        
    }
}

?>
