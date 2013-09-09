<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    
    'record_log' => true,
    'url_mode'=>1,
    
    'dbtype'=>'class',
    'dbconfig' => array(
        'host'=>'loalhost',
        'username'=>'root',
        'password'=>'',
        'dbname'=>'test',
    ),
    
    'debug' => false,
    'compile_template' => false,
    
    
    //默认控制器
    'default_controller' => 'index',
    'default_action' => 'index',
    
    
    'controller_url_var' => 'm',
    'action_url_var' => 'a',
    'charset' => 'utf-8',

);




?>
