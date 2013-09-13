<?php

/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Registry {
    //put your code here
    public static $instance;
    public static $_data;


    public function __construct() {
      
    }
    
    public static function getInstance(){
        if( null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
	 * 设置数据
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key,$value=''){
		if (is_array($key)){
			foreach ($value as $k=>$v){
				self::$_data[$key][$k] = $v;
			}
		}else{
			self::$_data[$key] = $value;
		}
	}

	/**
	 * 获得数据
	 *
	 * @param string $key :键名
	 * @return mixed
	 */
	public function get($key, $default=null){
		return $this->keyExists($key) ? self::$_data[$key] : $default;
	}

	/**
	 * 判断键是否存在的
	 *
	 * @param string $key
	 */
	public function keyExists($key){
		return isset(self::$_data[$key]);
	}

	/**
	 * 删除键对应的值
	 *
	 * @param string $key
	 */
	public function remove($key){
		if($this->keyExists($key)){
			unset(self::$_data[$key]);
			return true;
		}else{
			return false;
		}
	}
}

?>
