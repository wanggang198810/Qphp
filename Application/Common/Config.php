<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    
    'url_mode'=>1,
    'compile_template'=>false,
    
    'dbconfig' => array(
        'dbtype'=>'mysql',
        'host'=>'localhost',
        'username'=>'root',
        'password'=>'',
        'pconnect'=> 0,
        'port'=>3306,
        'dbname'=>'r',
        'charset'=>'utf8', //注:没有减号-
        'tablepre'=>'',
    ),
    
    'debug' => true,
    
    
    'subdomain'=>array(
        // 控制器 => 二级域名 (暂不支持三级或三级以上的子域名.)
        // controller => subDomain ( don't support the third subdomain or more)
        'welcome'=>'welcome',
    ),
    
    
);
?>
