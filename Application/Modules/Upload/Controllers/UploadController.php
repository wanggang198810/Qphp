<?php

/**
 * Description of UploadController
 *
 * @author Air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class UploadController extends BaseController{

    public function index(){
        //hprint($_FILES);
    
        if(Request::isPostSubmit()){
            if( empty($_FILES['photo']['name'])){
                echo '==============为空';
            }
            hprint($_FILES,1);
        }
        $this->render('Home');return;
        $data = array('success' => 0, 'message' => 'error');
        echo json_encode($data);
    }
    
    public function image(){
        // 载入图像库
        import('Upload');
        $uploadObj = new Upload();
        $result = $uploadObj->save('photo');
        hprint($result,1);
    }
    
    

}
