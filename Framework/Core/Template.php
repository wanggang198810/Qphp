<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Template {
    //put your code here
    public $templateID;
    //模板引擎解析
    public function compile($content){
        /*
        $content = str_replace('{$', '<?php echo $', $content);
        $content = str_replace('}', ' ?> ', $content);*/
        
        preg_match('/\{\$(.*?)\|(.*?)=(.*?)\,{0,}###\}/i', $content, $matches);
        //hprint($matches,1);
        //'"<a href=\"".parseurl("$1","$addflag","$lxt")."\">$2"'
        $content = str_replace(array('<?php','<?='), array(' ',' '), $content);
        $content = str_replace('?>', '', $content);
        //echo $content;exit;
        $content = preg_replace('/\{\$(.*?)\|(.*?)\=(.*?)\,{1,}###\}/i', '<?php echo $2($3,$$1);?>', $content);
        $content = preg_replace('/\{\$(.*?)\|(.*?)\=###\}/i', '<?php echo $2($$1);?>', $content);
        
        $content = preg_replace('/\{\$(.*?)\}/i', "<?php echo $$1;?>", $content);
        $content = preg_replace('/\<php\>(.*?)\<\/php\>/', "<?php $1?>", $content);
        $filename = $this->getFilePath();
        file_put_contents($filename, $content);
        return $filename;
    }
    
    
    
    public function _parseFunc($str){
        
    }

    public function _parseTag(){
        
    }

    public static function parseParam($str){
        //echo $str;exit;
        $str = explode(',', $str);
        $paramStr = '';
        foreach($str as $k => $v){
            if(strpos($v, '$')){
                $paramStr .= $v;
            }else{
               $paramStr .= "'".$v."'";
            }
            $paramStr .= ',';
        }
        return $paramStr;
    }
    public function getFilePath(){
        return APP_PATH . '/Data/Runtime/' . md5($this->templateID). '.php';
    }
    
}


function parseParam($str=''){
    $str = explode(',', $str);
    $paramStr = '';
    foreach($str as $k => $v){
        if(strpos($v, '$')){
            $paramStr .= $v;
        }else{
           $paramStr .= "'".$v."'";
        }
        $paramStr .= ',';
    }
    return $paramStr;
}
?>
