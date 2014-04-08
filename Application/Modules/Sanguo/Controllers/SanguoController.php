<?php
/**
 * Description of SanguoController
 *
 * @author air
 */
class SanguoController extends Controller{

    public function index(){
        
    }
    
    
    public function general($id=''){
        if( empty($id)){
            $this->generalList();
            return;
        }
        
        $this->render();
    }
    
    
    public function generalList(){
        
        $this->render();
    }
    
}

?>
