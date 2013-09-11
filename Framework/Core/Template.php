<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Template {
    //put your code here
    
    //模板引擎解析
    public function compile($content){
        $content = str_replace('{$', '<?php echo $', $content);
        $content = str_replace('}', ' ?> ', $content);
        
        return $content;
    }
    
    
    
    
}

?>
