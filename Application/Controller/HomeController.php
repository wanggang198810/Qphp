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
        /*
        for ($i = 0; $i < 200000; $i++) {
            $array []= md5($i);
        }*/
        $data['title'] = 'Q php framework!';
        $data['info'] = 'Q php framework!';
        $model = new HomeModel();
        
        $this->render('',$data);
    }
    
    public function welcome($name='', $age=0, $where='china'){
        if(!$name || !$age || !$where){
            echo '<h3>please input correct name , age and address!</h3>';exit;
        }
        echo '<h3 style="line-height:1; margin:0;">Here is the method with param demo!: public function welcome($name, $age, $where)</h3><Br>';
        echo 'Hi, '.$name.'! welcome you to use Q framework.<br>';
        echo 'Now, we want to kown how old you are and where come from.<br>';
        echo '...<Br />';
        echo '...<Br />';
        echo '...<Br />';
        echo $name.': I\'m '.$age.', from '.$where.'.' ;
    }
}

?>
