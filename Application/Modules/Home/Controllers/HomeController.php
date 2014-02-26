<?php
/**
 * Description of HomeConroller
 *
 * @author Air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class HomeController extends BaseController{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->render('Index');
    }
}
