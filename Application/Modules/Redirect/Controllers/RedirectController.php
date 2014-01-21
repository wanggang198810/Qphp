<?php
/**
 * Description of RedirectController
 *
 * @author air
 */
class RedirectController extends Controller{
    
    public function index(){
        header("content-type:text/html; charset=utf-8");
        $link = Request::getGet('link');
        $link = $this->deparseUrl($link);
        
        $this->data['url'] = $link;
        $this->render('Redirect');
    }
    
    public function parseUrl($url){
        return base64_encode($url);
    }
    
    public function deparseUrl($url){
        if($url == base64_encode(base64_decode($url))){
            return urldecode(base64_decode($url));
        }else{
            return urldecode($url);
        }
    }
}

?>
