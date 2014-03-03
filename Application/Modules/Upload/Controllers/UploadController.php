<?php

/**
 * Description of UploadController
 *
 * @author Air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class UploadController extends BaseController{

    public function index(){
        header("Content-type:text/html; charset=utf-8");
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        } else if (isset($_GET["PHPSESSID"])) {
            session_id($_GET["PHPSESSID"]);
        }
        // 载入图像库
        import('Upload');
        $uploadObj = new Upload();
        $result = $uploadObj->save('photo');
        if($result['success'] == 1){
            $result['result'] = str_replace(ROOT_PATH, '', $result['result']);
        }
        echo json_encode($result);
    
        
        /*
        if(Request::isPostSubmit()){
            if( empty($_FILES['photo']['name'])){
                echo '==============为空';
            }
            hprint($_FILES,1);
        }
        $this->render('Home');return;
        $data = array('success' => 0, 'message' => 'error');
        echo json_encode($data);*/
    }
    
    public function image(){
        $this->render('Home');return;
        // 载入图像库
        import('Upload');
        $uploadObj = new Upload();
        $result = $uploadObj->save('photo');
        echo json_encode($result);
    }
    
    

}
