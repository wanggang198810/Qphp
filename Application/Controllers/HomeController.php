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
        
        //$data['title'] = 'Q php framework!';
        //$data['info'] = 'Q php framework!';
        //$data['a'] = 'aaaa';
        //$model = new HomeModel();
        //$this->assign($data);
        //$this->assign('c', 'ccc');
        $this->render();
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
        $data=array();
        $data['title'] = 'welcome!';
        $this->render('',$data);
    }
    
    public function header(){
        hprint(getallheaders());
        hprint(get_headers('http://www.baidu.com/'));
        $r = Q::getIncludeFiles();
        Q::printf($r);
    }
    
    public function db(){
        $db = new HomeModel('db_100w');
        $db->beginTransaction();
        $data = array('title'=>'测试数据','content'=>'测试内容','typeid' => 2);
        $data2 = array('uid'=>2,'title'=>'测试数据','content'=>'测试内容','typeid' => 2);
        $r1 = $db->add($data);
        $r2 = $db->add($data2);
        if ( $r && $r2){
            $db->commit();
            echo 'ok';
        }else{
            $db->rollback();
            echo 'rollback';
        }
    }
}

?>
