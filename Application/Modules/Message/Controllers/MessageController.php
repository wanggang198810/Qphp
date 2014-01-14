<?php
/**
 * Description of MessageController
 *
 * @author Administrator
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class MessageController extends BaseController{
    
    //
    public function index(){
      $this->render('Home');  
    }
    
    
}
