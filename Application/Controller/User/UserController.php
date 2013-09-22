<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class UserController extends Controller{
    
    public function __construct() {
        parent::__construct();
        $this->userDao = new UserModel('user');
    }

    //put your code here
    public function index(){
        
        $r = $this->userDao->where( array('uid'=>1) )->find();
        hprint($r);
    }
    
    public function update(){
        echo $this->userDao->where("username='air'")->update(array('password'=>'222222'));
    }
    
    public function insert(){
        $data = array('username'=>'三哥', 'password'=>123456, 'score'=>99);
        echo $this->userDao->insert($data);
    }
    
    public function delete(){
        echo $this->userDao->where('uid=14')->delete();
    }
    
    public function page($page=1){
        $r = $this->userDao->where("score > 0")->order("order by score desc")->page($page,2);
        hprint($r);
    }
}

?>
