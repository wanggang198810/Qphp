<?php
/**
 * Description of GameController
 *
 * @author Air
 */

require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class GameController extends BaseController{
    
    public function index(){
       $this->render(); 
    }
    
    public function post(){
        $this->render('Post');
    }
}
