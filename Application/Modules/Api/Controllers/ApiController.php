<?php
/**
 * Created by PhpStorm.
 * User: Air
 * Date: 14-4-28
 * Time: 下午1:16
 */

require( APP_PATH ."Modules/Common/Controllers/BaseController.php" );
class ApiController extends BaseController{

    //记录用户使用软件信息
    public function softUseRecord(){
        $gameid = Request::getIntGet('game_id');
        $username = Request::getGet('username');
        $password = Request::getGet('password');
        $data = array('success' => 0, 'msg' => '未知错误');

        load_uc();
        $uc_info = uc_user_login($username, $password);
        if($uc_info[0] <= 0){
            return json_encode($data);
        }
        hprint($uc_info);
        $ip = get_ip();
        $this->loadModel('Api');
        $dao = new ApiModel();
        $result = $dao->recordGameLogin($uc_info[0], $gameid, $ip);
        hprint($result, 1);
    }






} 