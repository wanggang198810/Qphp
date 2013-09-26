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

    public function index(){
        
        if( !empty($_COOKIE['uid'])){
            echo 'uid:'.base64_decode($_COOKIE['uid']);
            hprint($_COOKIE);
            hprint($_POST);
            exit;
        }else{
            echo '未登录.';
        }
        
        exit;
        $r = $this->userDao->where( array('uid'=>1) )->find();
        //hprint($r);
    }
    
    public function login(){
        if(isset($_POST)){
            if(!empty($_POST['name']) && ! empty($_POST['pwd']) ){
                hprint($_POST);
                setcookie('uid',base64_encode($_POST['uid']),time()+3600*24*30,'/');
            }
        }
        exit;
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
