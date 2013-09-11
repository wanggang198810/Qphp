<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//定义框架目录
define('FRAMEWORK_PATH', './Framework');
define('APP_PATH', './Application');
require_once (FRAMEWORK_PATH.'/Q.php');

Q::createApplication()->go();

?>
