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
    
    
    public function softUseRecord(){
        
        
    }
    

    //记录用户使用软件信息 tnBoxAuthorVerify
    public function getCommonInfo(){
        $verify = $this->verify();
        if(!$verify){
            echo __LINE__ . ' :ERROR';
            return;
        }
        
        //$gameid = Request::getIntGet('game_id');
        $username = addslashes( urldecode( Request::getGet('username') ) );
        $password = addslashes( Request::getGet('password') );
        $isuid = Request::getIntGet('isuid');
        if($isuid > 2 || $isuid < 0){$isuid = 0;}
        
        $return_data = __LINE__. ' :ERROR';
        if(  empty($username) || empty($password) ){
            echo __LINE__. ' :ERROR';
            return;
        }

        load_uc();
        $uc_info = uc_user_login($username, $password, $isuid);
        if($uc_info[0] <= 0){
            echo __LINE__. ' :ERROR';
            return;
        }

		$uid = $uc_info[0];
        $ip = get_ip();
		
		/*
        $this->loadModel('Api');
        $dao = new ApiModel();
        $boxinfo = $dao->getTnBoxInfo($uid);
        if( empty($boxinfo) ){
            $boxinfo['firstlogin'] = 0;
            $boxinfo['times'] = 0;
            $boxinfo['lastlogin'] = 0;
        }*/

        $count = uc_user_getcredit2(11, $uc_info[0], 0);
        $avatar = uc_get_avatar( intval ($uc_info['0']) , 'small');
        //hprint($avatar, 1);
        //http://bbs.rgss.cn/uc_server/data/avatar/000/00/00/01_avatar_small.jpg
        //000/00/00/01_avatar_small.jpg
        $avatar = '/data/avatar/'.  $avatar;
        //$realpath = '/home/wwwroot/air/bbs2014/uc_server' . $avatar;
        
//         if( !file_exists($realpath) ){
//         	echo '/home/wwwroot/air/bbs2014/uc_server' . $avatar;die();
//             $avatar = 'http://bbs.rgss.cn/uc_server/images/noavatar_small.gif';
//         }else{
//             $avatar = UC_API . $avatar;
//         }
        
		$avatar = UC_API . $avatar;
       	$file = file_get_contents( $avatar);
       	if(!$file){
			$avatar = 'http://bbs.rgss.cn/uc_server/images/noavatar_small.gif';
       	}
        $groupid = $uc_info[5];
        $count['credits'] = 0;
        
        $levels = array(
            1 => '管理员',
            2 => '超级版主',  3 => '版主',  4 =>'禁止发言', 5 => '禁止访问', 6 => '禁止 IP' , 7 => '游客', 8=> '等待验证会员', 
            9 => '黑名单', 10 => '无能', 11 => '风能', 12 => '光能', 13 => '太阳能', 14 => '地热能',  15 =>'天然能', 16 => '实习版主', 
            17 => '网站编辑', 18 => '信息监察员', 19 => '审核员', 20 => 'QQ游客', 21 => '高级版主', 22 => '', 23 => '贵宾', 24 => 'QQ游客',
            25 => 'QQ游客',
        );
        $level  = isset($levels[$groupid]) ? $levels[$groupid] : '同能会员';
        $return_data = 'username='.$uc_info[1].';avatar='.$avatar .';ok='.$count['extcredits1'].';ka='.$count['extcredits2'].';vip='.$count['extcredits3'].';point='.$count['credits'] . ';uid=' . $uc_info[0]. ';group='. $level .';signpic=';

        echo $return_data;
        return;
        
        
    }
    
	
	/**
	 * 获取TNbox 信息
	 */
	 public function getTnBoxInfo(){
		$uid = Request::getIntGet('uid');
		
		$this->loadModel('Api');
        $dao = new ApiModel();

        $boxinfo = $dao->getTnBoxInfo($uid);
        if( empty($boxinfo) ){
            $boxinfo['firstlogin'] = 0;
            $boxinfo['times'] = 0;
            $boxinfo['lastlogin'] = 0;
        }
        
        load_uc();
		$uc_info = uc_user_login($uid, 123456);
		$uid = $uc_info[0];
		$groupid = $uc_info[5];
		

		$levels = array(
            1 => '管理员',
            2 => '超级版主',  3 => '版主',  4 =>'禁止发言', 5 => '禁止访问', 6 => '禁止 IP' , 7 => '游客', 8=> '等待验证会员', 
            9 => '黑名单', 10 => '无能', 11 => '风能', 12 => '光能', 13 => '太阳能', 14 => '地热能',  15 =>'天然能', 16 => '实习版主', 
            17 => '网站编辑', 18 => '信息监察员', 19 => '审核员', 20 => 'QQ游客', 21 => '高级版主', 22 => '', 23 => '贵宾', 24 => 'QQ游客',
            25 => 'QQ游客',
        );
        $level  = isset($levels[$groupid]) ? $levels[$groupid] : '同能会员';
        $return_data = 'firstlogin='.$boxinfo['writetime'].';times='.$boxinfo['times'].';lastlogin='.$boxinfo['lastlogin'] . ';status='. $boxinfo['level'] . ';level=' . $boxinfo['level'] . ';thislogin='.$boxinfo['thislogin'];

        echo $return_data;
		
	 }
    
    
    /**
     * 获取加密器，用户信息
     */
    public function setTnBoxInfo(){
        $verify = $this->verify();
        $return_data = self::$errorMsg;
        if(!$verify){
            echo $return_data;
            return;
        }
        
        $uid = Request::getIntGet('uid');
		$times = Request::getIntGet('times');
		$lastlogin = Request::getGet('lastlogin');
		$thislogin = Request::getGet('thislogin');
		$status = Request::getIntGet('status');
		$level = Request::getIntGet('level');
		
        if($uid <= 0){
            echo $return_data;
            return false;
        }
        
        $ip = get_ip();
        $this->loadModel('Api');
        $dao = new ApiModel();
        $result = $dao->setTnBoxInfo($uid, $ip, $times, $lastlogin, $thislogin, $status, $level);
        if($result){
            echo 'SUCCESS';
        }else{
            echo $return_data;
        }
        
    }


	
	/**
	 * 获取游戏信息
	 */
	 public function getTnGameInfo(){
	 	
	 	$gameid = Request::getIntGet('gameid');
	 	$uid = Request::getIntGet('uid');
	 	
	 	$this->loadModel('Api');
	 	$dao = new ApiModel();
	 	$result = $dao->getTnGameInfo($uid);
	 	if(empty($result)){
	 		$result['first_time'] = $result['last_time'] = $result['total_pay_ka'] = $result['total_pay_ok'] = 0;
	 	}
	 	
	 	echo 'firstpaytime=' . $result['first_time'] . ';lastpaytime=' . $result['last_time'] . 
	 		';allpaycount_ka=' . $result['total_pay_ka'] . ';allpaycount_vip=' . $result['total_pay_ok'];
	 }
	 
	 
	 /**
	  *
	  */
	  public function setTnGameInfo(){
	  	
		$action = Request::getIntGet('action'); // 1 加速 50卡币   , 2 换肤 20卡币
		$gameid = Request::getIntGet('gameid');
		$uid = Request::getIntGet('uid');
		
		$ka = $action == 1 ? 50 : 20;
		
		load_uc();
		$count = uc_user_getcredit2(11, $uid, 0);
		if(empty($count)){
			echo __LINE__ . ' 系统繁忙';die();
		}
		
		if(isset($count['extcredits2']) && $count['extcredits2'] < $ka){
			echo '卡币不足';die();
		}
		
		//扣卡币
		$result = uc_operate_credit(0 , $uid, 2, $ka, 0);
		if(!$result){ echo '扣除卡币失败';die();}
			
		$this->loadModel('Api');
		$dao = new ApiModel();
		$result = $dao->setTnGameInfo($uid, $ka, $gameid, 1);
		if($result){
			echo 'SUCCESS';die();
		}
		
		echo __LINE__ . ' 系统繁忙';
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