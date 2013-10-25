<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    
    'layout'=> true,
    
    //是否记录程序运行log
    'record_log' => true,
    
    //url模式，为1时采用链接形式. 如/controller/action。  否则:?m=controller&a=action
    //注: 采用模式为1的时候，action里的方法支持直接在链接中表示.
    //example:  /index/index/param1/param2 => controller / public function index($param1, $param2); 
    'url_mode'=>1,
    
    //数据库 db
    'dbconfig' => array(
        'dbtype'=>'mysql',
        'host'=>'localhost',
        'username'=>'root',
        'password'=>'',
        'pconnect'=> 0,
        'port'=>3306,
        'dbname'=>'r',
        'charset'=>'utf8', //注:没有减号-
        'tableprex'=>'',
    ),
    
    //调试模式
    'debug' => true,
    //错误模式，0为抛出错误，1为使用自定义错误提示
    'error_mode' => 1,
    
    //启用模板引擎(启用用则不能在view层写原生php代码)
    'compile_template' => false,
    
    
    //默认控制器以及控制器参数
    'default_controller' => 'index',
    'default_action' => 'index',
    'controller_url_var' => 'm',
    'action_url_var' => 'a',
    
    
    'charset' => 'utf-8',
    
    /*
    //二级域名配置
    'subdomain'=>array(
        // 控制器 => 二级域名 (暂不支持三级或三级以上的子域名.)
        // controller => subDomain ( don't support the third subdomain or more)
        'welcome'=>'welcome',
    ),*/

);




?>
