<?php
/**
 * Description of GameController
 *
 * @author Air
 */

require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class GameController extends BaseController{
    
    public function __construct() {
        parent::__construct();
        $this->gameModel = new GameModel();
    }
    
    
    public function index($id=0, $url=''){
        $id = intval($id);
        if($id == 0){
            $this->data['games'] = $this->gameModel->getGameList(0,0);
            //hprint($this->data['games'],1);
        }else{
            
            $this->data['game'] = $this->gameModel->getGame($id);
            $this->_show();
            return;
        }
       
        $this->render(); 
    }
    
    private function _show(){
        $this->render('Show');
    }
    
    
    public function group(){
        
    }
    
    public function post(){
        if(Request::isPostSubmit()){
            hprint($_FILES);
            hprint($_POST, 1);
        }
        $this->data['game_groups'] = $this->gameModel->getGameType(1);
        $this->data['game_types'] = $this->gameModel->getGameType(0);
        $this->render('Post');
    }
}
