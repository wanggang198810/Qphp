<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class MongoController extends Controller{
    public $_link;
    public $_config;
    
    public function __construct() {
        parent::__construct();
    }

    //put your code here
    public function index(){

        $this->_config = array(
            'username'=>'mongo',
            'password'=>'123456',
            'host'=>'127.0.0.1',
            'port'=>27017,
        );
        $mongo = $this->connect($this->_config);
        if(!$mongo){
            echo "wrong";exit;
        }
        
        // 选择一个数据库和要操作的集(如果没有数据库默认创建)
        $collection = $mongo->selectDB('admin')->selectCollection('content');
        //Q::printf($collection);
        
        //$db = $mongo->selectDB('admin');
        //$collection = new MongoCollection($db, 'test');
        //Q::printf($collection);

        
        // $collection2 = $mongo->selectCollection('admin', 'test');
        //$rows = $collection->find();
        //Q::printf($rows);
        //Q::printf($collection);
        //Q::printf($collection2);
        
        $content = array(
            'title'=>'title',
            'author'=>'admin',
            'url'=>'http://www.cnblogs.com/wubaiqing/archive/2011/09/17/2179870.html',
        );
        
        $r = $collection->insert($content);
        if($r){
            echo '插入成功!';
        }else{
            echo '失败';
        }
        
        
        //$r = get_class_methods($mongo);
        //Q::printf($r);

    }
    

    
    public function connect($config){
        return $this->_link = new Mongo("mongodb://{$config['username']}:{$config['password']}@{$config['host']}:{$config['port']}");
    }
    
    
    public function insert(){
        
    }
    
}

?>
