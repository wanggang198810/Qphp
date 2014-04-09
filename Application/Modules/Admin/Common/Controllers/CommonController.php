<?php

/**
 * Description of CommonController
 *
 * @author air
 */
require( APP_PATH ."Modules/Admin/Common/Controllers/AdminBaseController.php" );
class CommonController extends AdminBaseController{
    
    
    public function left(){
        $this->view();
    }
    
    public function home(){
        echo '欢迎来到同能管理中心';
    }
}

?>
