<?php
/**
 * Description of SettingsController
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class SettingsController extends BaseController{
    
    public function index(){
        $this->profile();
    }


    public function profile(){
        $this->render('Profile');
    }
}

?>
