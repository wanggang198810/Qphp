<?php
/**
 * Description of HomeConroller
 *
 * @author Air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class HomeConroller extends BaseController{
    
    public function index(){
        $this->render('Index');
    }
}
