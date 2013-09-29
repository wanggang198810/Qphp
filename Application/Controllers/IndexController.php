<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class IndexController extends Controller{
    //put your code here
    public function index(){
        $this->_response->redirect('/home');
    }
}

?>
