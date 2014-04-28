<?php
/**
 * 对外统一接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-28
 * Time: 下午6:45
 */

class ApiModel extends Model{


    // 记录游戏启动器登录记录
    public function recordGameLogin($uid, $gameid, $ip){
        $this->setTable('gameuserecord');
        $where = array('uid' => $uid, 'gameid' => $gameid );
        $exist = $this->where( $where )->fetch();
        if(empty($exist)){
            $data = array(
                'uid' => $uid,
                'gameid' => $gameid,
                'times' => 1,
                'ip' => $ip,
                'lastlogin' => date('Y:m:d H:i:s'),
            );
            return $this->insert($data);
        }else{
            $data = array(
                'times' => $exist['times'] + 1,
                'lastlogin' => date('Y:m:d H:i:s'),
            );
            return $this->where( $where )->update($data);
        }






    }

} 