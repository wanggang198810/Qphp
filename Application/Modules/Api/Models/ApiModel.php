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
    
    
    
    
     // 记录加密器登录记录
    public function setTnBoxInfo($uid, $ip, $times=0, $lastlogin=null, $thislogin=null){
        $this->setTable('jiamiqirecord');
        $where = array('uid' => $uid );
        $exist = $this->where( $where )->fetch();
        if(empty($exist)){
            $data = array(
                'uid' => $uid,
				'times' => 1,
                'times2' => 1,
                'ip' => $ip,
                'lastlogin2' => date('Y:m:d H:i:s'),
				'lastlogin' => date('Y:m:d H:i:s'),
            );
            $reulst = $this->insert($data);
            if($reulst){
                return $data;
            }else{
                return false;
            }
        }else{
            $data = array(
                'times2' => $exist['times2'] + 1,
                'lastlogin2' => date('Y:m:d H:i:s'),
            );
			if(!empty($times) && intval($times) > 0){
				$data['times'] = $times;
			}else{
				$data['times'] = $exist['times'] + 1;
				
			}
			
			if(!empty($lastlogin)){
				$data['lastlogin'] = $lastlogin;
			}else{
				$data['lastlogin'] = $exist['thislogin'];
			}
			
			if(!empty($thislogin)){
				$data['thislogin'] = $thislogin;
			}else{
				$data['thislogin'] = date('Y:m:d H:i:s');
			}
			
            $result = $this->where( $where )->update($data);
            if($result){
                $exist['times'] += 1;
                return $exist;
            }else{
                return false;
            }
        }

    }
    
    
    public function getTnBoxInfo($uid){
        $this->setTable('jiamiqirecord');
        $where = array('uid' => $uid );
        return $this->where( $where )->fetch();
    }
    
	
	
	public function getTnGameInfo($uid, $gameid=0){
		$this->setTable('gamepay');
		$result = $this->where( array('uid' => $uid) )->fetch();
		return $result;
	}
	
	
	/**
	 * type 1 ka  2 vip
	 */
	public function setTnGameInfo($uid, $num, $gameid=0, $type=1){
		$this->setTable('gamepaylog');
		$insert_data = array(
			'uid' => $uid,
			'type' => $type,
			'pay' => $num,
			'gameid' => $gameid
		);
		$this->insert($insert_data);
		
		$exist = $this->getTnGameInfo($uid, $gameid);
		if(empty($exist)){
			return $this->insert($insert_data);
		}else{
			
			$update_data = array(
				'last_time' => date('Y-m-d H:i:s'),
			);
			
			if($type == 1){
				$update_data['total_pay_ka'] = $exist['total_pay_ka'] + $num;
			}elseif($type == 2){
				$update_data['total_pay_ok'] = $exist['total_pay_ok'] + $num;
			}
			
			return $this->where( array('uid' => $uid) )->update($update_data);
		}
		
	}
	
    

} 