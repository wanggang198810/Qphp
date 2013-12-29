<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#============================================================
# 载入核心框架
#============================================================
require_once( dirname(__FILE__) . '/Core/Application.php');
require_once( dirname(__FILE__) . '/Core/Controller.php');
require_once( dirname(__FILE__) . './QBase.php');
class Q extends QBase{
    private static $instance;
    
    public static function createApplication(){
        return parent::createApplication();
    }
    
    
    
}

?>
