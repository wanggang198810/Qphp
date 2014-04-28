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
        $username = urldecode( Request::getGet('username') );
        $password = Request::getGet('password');
        $data = array('success' => 0, 'msg' => '未知错误');
        if( empty($gameid) || empty($username) || empty($password) ){
            echo json_encode($data);
            return;
        }
        
        load_uc();
        $uc_info = uc_user_login($username, $password);
        if($uc_info[0] <= 0){
            echo json_encode($data);
            return;
        }
        
        $r = uc_user_getcredit(2, $uc_info[0], 3);
        hprint($r ,1);

        $ip = get_ip();
        $this->loadModel('Api');
        $dao = new ApiModel();
        $result = $dao->recordGameLogin($uc_info[0], $gameid, $ip);
        if($result){
            $data['msg'] = '记录成功';
        }
        hprint($result, 1);
    }






} 