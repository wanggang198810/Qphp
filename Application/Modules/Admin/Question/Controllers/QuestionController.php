<?php
/**
 * Description of LoginController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Admin/Common/Controllers/AdminBaseController.php" );
class QuestionController extends AdminBaseController{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function index(){
        
    }
    
    public function tag(){
        $this->view('Tag');
    }
    
    
}
