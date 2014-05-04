<?php
/**
 * Created by PhpStorm.
 * User: Air
 * Date: 14-4-28
 * Time: 下午1:16
 */

require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class ApiController extends BaseController{
    
    static $errorMsg = 'ERROR';

    //记录用户使用软件信息
    public function softUseRecord(){
        $verify = $this->verify();
        if(!$verify){
            echo 'ERROR';
            return;
        }
        
        $gameid = Request::getIntGet('game_id');
        $username = addslashes( urldecode( Request::getGet('username') ) );
        $password = addslashes( Request::getGet('password') );
        $data = array('success' => 0, 'msg' => '未知错误');
        $return_data = 'ERROR';
        if( empty($gameid) || empty($username) || empty($password) ){
            echo $return_data;
            return;
        }
        
        load_uc();
        $uc_info = uc_user_login($username, $password);
        if($uc_info[0] <= 0){
            echo $return_data;
            return;
        }
        
        $ip = get_ip();
        $this->loadModel('Api');
        $dao = new ApiModel();
        $result = $dao->recordGameLogin($uc_info[0], $gameid, $ip);
        if($result){
            
            $count = uc_user_getcredit2(2, $uc_info[0], 0);
            $avatar = uc_get_avatar( intval ($uc_info['0']) , 'small');
            $avatar = UC_API.'/data/avatar/'.  $avatar;
            //$file = file_get_contents( $avatar);
    //        if(!$file){
    //            $avatar = 'http://bbs.rgss.cn/uc_server/images/noavatar_small.gif';
    //        }
            $count['credits'] = 0;
            $return_data = 'username='.$uc_info[1].';avatar='.$avatar .';ok='.$count['extcredits1'].';ka='.$count['extcredits2'].';vip='.$count['extcredits3'].';point='.$count['credits'] . ';uid=' . $uc_info[0];
            
            echo $return_data;
            return;
        }
        echo $return_data;
    }
    
    
    
    /**
     * 获取加密器，用户信息
     */
    public function getJiamiqiInfo(){
        $verify = $this->verify();
        $return_data = self::$errorMsg;
        if(!$verify){
            echo $return_data;
            return;
        }
        
        $uid = Request::getIntGet('uid');
        if($uid <= 0){
            echo $return_data;
            return false;
        }
        
        $ip = get_ip();
        $this->loadModel('Api');
        $dao = new ApiModel();
        $result = $dao->recordJiamiqi($uid, $ip);
        if($result){
            $return_data = 'uid=' . $uid . ';times=' . $result['times'] . ';lastlogin=' . $result['lastlogin'];
            
        }
        
        echo $return_data;
    }


    
    
    /**
     * 验证
     */
    private function verify(){
        $tnrgss = Request::getIntGet('tnrgss');
        if($tnrgss != 147269 && empty($_GET['test1'])){
            return false;
        }
        return true;
    }



} 