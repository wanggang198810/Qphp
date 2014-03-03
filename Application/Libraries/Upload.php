<?php

/**
 * 上传类
 * @author Mike
 */

class Upload{
    
    private $savePath;
    private $allowTypes = array('jpg' , 'jpeg' , 'gif', 'png' , 'txt' , 'zip', 'rar');//
    private $maxSize=2000; //单位kb
    public static $sizeType = array(
        '',
    );
    
    private static $uploadPath = '/data/upload/';
    
    /**
     * 
     */
    public function doUpload(){
        $_FILES;
        
    }
    
    //构建file信息
    private function _buildFileInfo($name){
        $tmp = $_FILES[$name];
        $file = array();
        if(empty($tmp)){
            return false;
            /*
            $imageType = pathinfo($url, PATHINFO_EXTENSION);
            $file['ext'] = $imageType;
            $file['size'] = filesize($url);
            $file['name'] = $file['tmp_name'] = basename($url);*/
        }
        
        $file['tmp_name'] = $tmp['tmp_name'];
        $file['name'] = $tmp['name'];
        $file['ext'] = $this->getExt($tmp['name']);
        $file['size'] = $tmp['size'];
        return $file;
    }
    
    
    // 上传文件   
    public function save($name){
        //$name = (array)$name;
        $file = $this->_buildFileInfo($name);

        $newfilename = $this->getPath() . 'ori/';
        $newfilename .= $this->getNewFilename($file['ext']);
        
        //检测图片
        if(!$this->checkExt($file['ext'])){
            return array('success' => -1, 'result' => $this->errorCode(-1));
        }
        if(!$this->checkSize($file['ext'])){
            return array('success' => -2, 'result' => $this->errorCode(-2));
        }
        
        $this->checkPath($newfilename);
        $ext = $this->getExt($file['name']);
        
        //$file['tmp_name'] 没上传，暂时copy
        //copy($oldfile, $newfilename);
        if(!move_uploaded_file($file['tmp_name'], $newfilename)) {
            $this->error = '文件上传保存错误！';
            return array('success' => 0, 'result' => $this->errorCode(0));
        }
        
        // 上传图片时，则生成缩略图
        if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png'))){
            import('Image');
            $imgObj = new Image();
            foreach(Image::$imageSize as $k => $v){
                $thumbname = str_replace('ori', $k, $newfilename);
                $this->checkPath($thumbname);
                $result = $imgObj->thumb($newfilename, $thumbname, '', $v);
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
        if($size / 1024 > $this->maxSize){
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
        $path = ROOT_PATH .self::$uploadPath .date('Y') . '/' . date('m') . '/' . date('d') . '/';
        return !empty($this->savePath) ? $this->savePath : $path;
        
    }

    //检测上传路径, 没有则创建目录
    public function checkPath($path){
        $path = pathinfo($path);
        $pathArr = explode('/', trim($path['dirname'], '/'));
        $dir = '';
        foreach ($pathArr as $k => $v){
            $dir .= $v.'/';
            if(!empty($v) && !is_dir($dir)){
                mkdir($dir, 0777);
            }
        }
        return true;
    }
    
    
    /**
     * 创建新文件名，
     */
    public function getNewFilename($ext, $oldname = 0){
        
        if(empty($oldname)){
            $randkey = uniqid() . rand(1000,9999) . microtime();
            $oldname = 'rs' . md5($randkey) . '.'. $ext; //. '_' . date("Ymd")
        }
        $filename = $oldname;
        return $filename;
    }
    

    //错误信息
    public function errorCode($key){
        $errorCode = array(
            '-1' => '不允许图片类型',
            '-2' => '超过最大允许上传大小',
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




