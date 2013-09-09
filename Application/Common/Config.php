<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    
    'url_mode'=>1,
    'dbtype'=>'mysql',
    'dbconfig' => array(
        'host'=>'loalhost',
        'username'=>'root',
        'password'=>'',
        'dbname'=>'test',
    ),
    
    'debug' => true,
    
    
    'subdomain'=>array(
        // 控制器 => 二级域名 (暂不支持三级或三级以上的子域名.)
        // controller => subDomain ( don't support the third subdomain or more)
        'welcome'=>'welcome',
    ),
    
    
);
?>
