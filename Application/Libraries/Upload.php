<?php

/**
 * 上传类
 * @author Mike
 */

class Upload{
    
    private $savePath;
    private $allowTypes;//
    private $maxSize=2000; //单位kb
    public static $sizeType = array(
        '',
    );
    
    /**
     * 
     */
    public function doUpload(){
        $_FILES;
        
    }
    
    
    // 上传文件   
    public function save($oldfile, $savePath){
        $file = $this->buildFileInfo($oldfile);
        if(empty($savePath)){
            $savePath = $this->savePath;
        }
      
        //检测图片
        if(!$this->checkExt($file['ext'])){
            return array('success' => -1, 'result' => $this->errorCode(-1));
        }
        if(!$this->checkSize($file['ext'])){
            return array('success' => -2, 'result' => $this->errorCode(-2));
        }
        
        // 根据uid 划分目录，模100
        $this->checkPath($savePath);
        
        $ext = $this->getExt($file['name']);
        $newfilename = $savePath;
        
        //$file['tmp_name'] 没上传，暂时copy
        //copy($oldfile, $newfilename);
        if(!move_uploaded_file($file['tmp_name'], $newfilename)) {
            $this->error = '文件上传保存错误！';
            return array('success' => 0, 'result' => $this->errorCode(0));
        }
        
        // 上传图片时，则生成缩略图
        if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png'))){
            import('Image');
            $imgObg = new Image();
            foreach(Image::$avatarSize as $k => $v){
                $thumbname = str_replace('ori', $k, $newfilename);
                $this->checkPath($thumbname);
                $result = $imgObg->thumb($newfilename, $thumbname, '', Image::$avatarSize[$k]['width'], Image::$avatarSize[$k]['height']);
            }
            //暂不考虑多种尺寸的情况
            if($result){
                return array('success'=>1, 'result' => $thumbname);
            }
        }
        return array('success'=>1, 'result' => true);
    }
    
    
    //构建file信息
    public function buildFileInfo($url=''){
        $tmp = $_FILES['file'];
        
        $file = array();
        if(empty($tmp)){
            $imageType = pathinfo($url, PATHINFO_EXTENSION);
            
            $file['ext'] = $imageType;
            $file['size'] = filesize($url);
            $file['name'] = $file['tmp_name'] = basename($url);
            
        }else{
            $file['tmp_name'] = $tmp['tmp_name'];
            $file['name'] = $tmp['name'];
            $file['ext'] = $this->getExt($tmp['name']);
            $file['size'] = $tmp['size'];
        }
        return $file;
    }

    
    
    // 检测后缀
    public function checkExt($ext){
        if(!in_array($ext, $this->allowTypes)){
            return false;
        }
        return true;
    }
    
    // 检测文件大小
    public function checkSize($size){
        if($size/1024 > $this->maxSize){
            return false;
        }
        return true;
    }
    
    /**
     * 取得上传文件的后缀
     * @param <String> $filename 文件名
     */
    public function getExt($filename) {
        $pathinfo = pathinfo($filename);
        return $pathinfo['extension'];
    }
    
    
    // 根据实际需求设置具体参数
    public function setOption($data){
        $vars = get_class_vars('Upload');
        foreach($data as $k => $v){
            if(array_key_exists($k, $vars)){
                $this->$k = $v;
            }
        }
    }
    
    
    //设置上传路径
    public function setPath($path){
        $this->savePath = $path;
    }
    
    // 获取上传路径
    public function getPath(){
        return $this->savePath;
    }

    //检测上传路径, 没有则创建目录
    public function checkPath($path){
        $path = pathinfo($path);
        $pathArr = explode('/', trim($path['dirname']));
        $dir = '';
        foreach ($pathArr as $k => $v){
            $dir .= $v.'/';
            if(!empty($v) && !is_dir($dir)){
                mkdir($dir, 0777);
            }
        }
        return true;
    }

    //错误信息
    public function errorCode($key){
        $errorCode = array(
            '-1' => '超过最大允许上传大小',
            '-2' => '不允许图片类型',
            '-3' => '非法上传图片',
            '0' => ' 系统繁忙',
        );
        if(isset($errorCode[$key])){
            return $errorCode[$key];
        }
        return '未知错误';
    }
    
    
    public function getError(){
        return $this->error;
    }
    
    
    
}




