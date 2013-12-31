<?php
/**
 * Description of Ucontroller
 *
 * @author air
 */
require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class UController extends BaseController{
    
    

    
    public function index($id, $type=''){
        $this->checkLogin(1);
        $id = filter($id);
        $type = filter($type);
        if(empty($id)){
            if($this->uid > 0){
                $id = $this->user['blogname'];
                $this->response->redirect('/u/'.$id);
            }else{
                $this->checkLogin(1);
            }
        }
        
        
        switch($type){
            case 'archive':
                $this->archive($id);
                break;
            case 'group':
                $this->group();
                break;
            case 'photo':
                $this->photo();
                break;
            case 'category':
                $this->category();
                break;
            default :
                $this->home();
                break;
        }
    }
    
    private function home(){
        $this->assign('title', '空间');
        $this->render();
    }
    
    
    private function archive(){
        echo 'dd';
    }
    
}

