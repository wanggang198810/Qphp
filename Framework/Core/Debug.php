<?php

/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Q_Debug {
    //put your code here
    public static function output($debugInfo){
        
    }
}
?>

<style>
#trace{ margin-top: 50px;}
.trace{ border: 3px dashed #ccc; padding: 10px;  position: relative; font-family: 微软雅黑,serif; background: #f1f1f1;}
.trace-title{ position: absolute; margin-top: -24px; margin-left: 12px; padding:0 5px;  background: #FFF; z-index: 10; font-size: 17px; font-weight: bold; color: #666; cursor: pointer;}
.trace-item{ height: 34px; line-height: 34px; color: #333; }
.trace-item .trace-t01{ float: left; color: #666; font-size: 13px; line-height: 34px; }
.trace-item .trace-c01{ float: left; font-size: 16px; line-height: 34px; font-weight: bold;}
.green{ color: green;}
.red{ color: red;}
.orange{ color: orange}
.clear{ clear: both;}
</style>
<div id="trace" class="trace">
    <div id="trace-title" class="trace-title">System Run Trace</div>
    
    <div class="trace-item">
        <div class="trace-t01">运行时间：</div>
        <div class="trace-c01 <?php
            if( $this->_debugInfo['runTime'] > 1 ){
                echo ' red';
            }elseif( $this->_debugInfo['runTime'] > 0.7 ){
                echo ' orange';
            }else{
                echo ' green';
            }
        ?>"><?php echo $this->_debugInfo['runTime'];?></div>
    </div>
    
    <div class="trace-item">
        <div class="trace-t01">占用内存：</div>
        <div class="trace-c01"><?php echo $this->_debugInfo['uageMemory']?>KB</div>
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



<div class="trace">
    <div class="trace-title" id="include-switch" onclick="openInfoBox('include-file')">载入文件</div>
    
    <div id="include-file" style=" display: none">
        <div class="trace-item">
            <?php
                foreach($this->_debugInfo['includeFile'] as $k => $v){
            ?>
            <div class="trace-t01"><?php echo $v;?></div><Br>
            <?php }?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="trace">
    <div class="trace-title" id="include-switch" onclick="openInfoBox('header')">页面请求</div>
    
    <div id="header" style=" display: none">
        <div class="trace-item">
            <?php
                foreach($this->_debugInfo['header'] as $k => $v){
            ?>
            <div class="trace-t01"><?php echo "<b>".$k ."</b> : ". $v;?></div><Br>
            <?php }?>
        </div>        
    </div>
    <div class="clear"></div>
</div>


<script>
    function openInfoBox(id){
        if(document.getElementById(id).style.display=='none'){
            document.getElementById(id).style.display='block'
        }else{
            document.getElementById(id).style.display='none'
        }
    }
</script>