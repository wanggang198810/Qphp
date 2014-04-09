<?php

/**
 * Description of CommonController
 *
 * @author air
 */
require( APP_PATH ."Modules/Admin/Common/Controllers/AdminBaseController.php" );
class IndexController extends AdminBaseController{
    
    
    public function index(){
        $this->view();
    }
}

?>
