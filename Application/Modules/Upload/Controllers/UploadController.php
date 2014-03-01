<?php

/**
 * Description of UploadController
 *
 * @author Air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class UploadController extends BaseController{

    public function index(){
         hprint($_FILES);
        if(Request::isPostSubmit()){
            hprint($_FILES,1);
        }
        $this->render('Home');return;
        $data = array('success' => 0, 'message' => 'error');
        echo json_encode($data);
    }
    
    public function image(){
        $files = $_FILES;
        $imageInfo = getimagesize($files);
        $imageType = pathinfo($url, PATHINFO_EXTENSION);
        $imageSize = filesize($url);
        
        // 载入图像库
        import('Upload');
        $uploadObj = new Upload();
        
        $savePath = self::getCommonPath($uid, 'avatar', 'ori');
        $oriUrl = $savePath . $uid . '.jpg';   //. $imageType; // 这里统一图片格式来
        $result = $uploadObj->save($url, $oriUrl);
    }
    
    

}
