<?php

/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Layout {

    //默认布局名
	const DEFAULT_NAME = 'Main.html';

	//布局名称
	private static $_name = '';

	//布局模板变量,控制器动作对应的视图内容变量是: "LayoutContent"
	private static $data = array();	
	

	/**
	 * 开始使用布局
	 *
	 * 注意：
	 * 布局文件必需定义在 Application/Views/Layouts 目录下
	 *
	 * @param string $layoutName 布局文件名
	 */
	public static function start($layoutName = self::DEFAULT_NAME){
		self::$_name = $layoutName;
		self::$_enabled = true;
	}
	
	/**
	 * 设置布局模块变量的值
	 *
	 * @param string|array $key 键名或数据
	 * @param mixed $value 数据
	 * @return void
	 */
	public static function set($key, $value = null){
		if(is_array($key)){
			self::$data = array_merge(self::$data, $key);
		}else{
			self::$data[$key] = $value;
		}
	}
	
	/**
	 * 得到布局模块变量的值
	 *
	 * @param string $key
	 * @return mixed
	 */
	public static function get($key=''){
		return $key=='' ? self::$data : (isset(self::$data[$key]) ? self::$data[$key] : '');
	}	

	/**
	 * 禁用布局
	 */
	public static function stop(){
		self::$_enabled = false;
	}

	/**
	 * 布局是否有效
	 *
	 * @return boolean
	 */
	public static function isEnabled(){
		return self::$_enabled;
	}

	/**
	 * 得到当前布局名
	 *
	 * @param $name 如果设置值则 Layout 登录这个值，否则返回当前的 Layout 名称
	 * @return string
	 */
	public static function name($name=''){
		if($name){
			self::$_name = $name;
		}
		return self::$_name;
	}
}

