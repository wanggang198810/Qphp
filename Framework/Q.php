<?php

/**
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
#============================================================
# 载入核心框架
#============================================================
require(dirname(__FILE__).'/Core/Application.php');
require(dirname(__FILE__).'/Core/Controller.php');
require(dirname(__FILE__).'./QBase.php');

class Q extends QBase{
    
    private static $instance;
    
    public static function createApplication(){
        return parent::createApplication();
    }
    
    
    
}

?>
