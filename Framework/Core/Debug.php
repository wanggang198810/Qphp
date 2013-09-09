<?php

/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Debug {
    //put your code here
    public static function output($debugInfo){
        
    }
}
?>

<style>
#trace{  border: 3px dashed #ccc; padding: 10px;  position: relative; font-family: 微软雅黑,serif;  margin-top: 50px; background: #f1f1f1;}
#trace-title{ position: absolute; margin-top: -24px; margin-left: 12px; padding:0 5px;  background: #FFF; z-index: 10; font-size: 17px; font-weight: bold; color: #666;}
.trace-item{ height: 34px; line-height: 34px; color: #333; }
.trace-item .trace-t01{ float: left; color: #666; font-size: 13px; line-height: 34px; }
.trace-item .trace-c01{ float: left; font-size: 16px; line-height: 34px; font-weight: bold;}
.green{ color: green;}
.red{ color: red;}
.orange{ color: orange}
</style>
<div id="trace">
    <div id="trace-title">System Run Trace</div>
    
    <div class="trace-item">
        <div class="trace-t01">运行时间：</div>
        <div class="trace-c01 <?php
            if( $this->_debugInfo['runTime'] > 1 ){
                echo ' red';
            }elseif( $this->_debugInfo['runTime'] > 700 ){
                echo ' orange';
            }else{
                echo ' green';
            }
        ?>"><?php echo $this->_debugInfo['runTime'];?></div>
    </div>
    
    <div class="trace-item">
        <div class="trace-t01">当前URL：</div>
        <div class="trace-c01"><?php echo $this->_debugInfo['currentUrl']?></div>
    </div>
    
    <div class="trace-item">
        <div class="trace-t01">前一页URL：</div>
        <div class="trace-c01"><?php echo $this->_debugInfo['refererUrl']?></div>
    </div>
    
    <div class="trace-item">
        <div class="trace-t01">当前控制器：</div>
        <div class="trace-c01"><?php echo $this->_debugInfo['controller']?></div>
    </div>
    
    <div class="trace-item">
        <div class="trace-t01">当前动作：</div>
        <div class="trace-c01"><?php echo $this->_debugInfo['action']?></div>
    </div>
</div>
