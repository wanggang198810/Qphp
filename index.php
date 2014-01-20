<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//定义框架目录
define('FRAMEWORK_PATH', './Framework/');
define('APP_PATH', './Application/');

//载入框架核心类库
require(FRAMEWORK_PATH.'/Q.php');

//运行系统
Q::createApplication()->run();

