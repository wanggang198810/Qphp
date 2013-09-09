<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author Administrator
 */
class HomeController extends Controller{
    //put your code here
    public function index(){
        hprint($this->_request->getGet(),1);
        $data['title'] = 'Q php framework!';
        $data['info'] = 'Q php framework!';
        $this->render('',$data);
        //$mode = new HomeModel();
    }
}

?>
