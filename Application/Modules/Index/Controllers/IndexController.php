<?php
/**
 * Description of IndexControllers
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class IndexController extends BaseController{
    
    
    public function index(){
        $this->render('Index');
    }
}

?>
