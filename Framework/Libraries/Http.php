<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Http extends Q_Http{
	
}
/**
 * 来自Qp(vquicphp.com)
 * */
class Q_Http{
	
	/**
	 * 异步请求一个http地址
	 * @param string $url 请求的url
	 * @param int $port 请求的服务器的端口
	 * @param array $postarray 要使用post提交的一组值，默认为null，如果为null则使用get方式请求
	 */
	public static function async($url='127.0.0.1', $port=80, $postarray=null, $errno='', $errstr='', $timeout=30) {
	    $fp = fsockopen($url, $port, $errno, $errstr, $timeout);
	    if (!$fp) {
	        return;
	    }
	    $end = "\r\n";
	    $method = empty($postarray) ? 'GET' : 'POST';
	    $input = "$method /HTTP/1.0$end";
	    $input.="Host: $url$end";
	    $input.="Connection: Close$end";
	    if ('POST' == $method) {
	        $input.="Content-Type: application/x-www-form-urlencoded$end";
	        $first = true;
	        $postval = '';
	        foreach ($postarray as $key => $val) {
	            if (!$first) {
	                $postval.='&';
	            } else {
	                $first = false;
	            }
	            $postval.="$key=$val";
	        }
	        $input.="Content-Length: " . strlen($postval) . $end;
	    }
	    //$input.="User-Agent: Mozilla/5.0 (Windows NT 5.2) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.121 Safari/535.2$end";
	    $input.="Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8$end";
	    //$input.="Accept-Encoding: gzip,deflate,sdch$end";
	    $input.="$end";
	    if ('POST' == $method) {
	        $input.="$postval$end";
	    }
	    fputs($fp, $input);
	   
	    fclose($fp);   
	}
		
	
	/**
	 * 触发一个地址，自动生成缓存
	 * @param unknown_type $url
	 */
	public static function triggerUrl($url , $timeout = 5){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
		$ret = curl_exec($ch);
		//$info = curl_getinfo($ch);
		//print_r($info);exit;
		curl_close($ch);
		return $ret;
	}
	
	/**
	 * 
	 * */
	public static function getBrowser($user_agent=null, $return_array=true){
		return get_browser($user_agent,$return_array);
	}
	
	/**
	 * 取得服务器响应一个 HTTP 请求所发送的所有标头
	 * */
	public static function getHeaders($url, $fromat=''){
		return get_headers($url);
	}
	
    
    public static function getAllHeaders(){
		return getallheaders();
	}
    
    public static function getResonse(){
        return $http_response_header;
    }
	/**
	* 发送HTTP状态头
	*/
	public static function sendStatus($code){
		static $_status = array
		(
			// Informational 1xx
			100 => 'Continue',
			101 => 'Switching Protocols',

			// Success 2xx
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',

			// Redirection 3xx
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',  // 1.1
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			// 306 is deprecated but reserved
			307 => 'Temporary Redirect',

			// Client Error 4xx
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',

			// Server Error 5xx
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			509 => 'Bandwidth Limit Exceeded',
		);
		if(array_key_exists($code,$_status)) {
			header('HTTP/1.1 '.$code.' '.$_status[$code]);
		}
	}
	
	
	/**
	* 发送 HTTP AUTH USER 请求
	*
	* 使其弹出一个用户名／密码输入窗口。当用户输入用户名和密码后,脚本将会被再次调用.
	* 这时就可以调用 Http::getAuthUser()方法得到输入的用户名和密码了
	*/
	public static function sendAuthUser($hintMsg,$errorMsg=''){
		header("WWW-Authenticate: Basic realm=\"{$hintMsg}\"");
		header('HTTP/1.0 401 Unauthorized');
		exit($errorMsg);
	}

	/**
	* 得到 HTTP AUTH USER 请求后的用户名和密码
	*
	* 如果没有发送该请求该会返回 false,否则返回包含用户名和密码的数组，格式如下:
	* array('user'=>'yuanwei',
	*       'pwd'=>'123456');
	*/
	public static function getAuthUser(){
		if (isset($_SERVER['PHP_AUTH_USER']))		{
			return array('user'=>$_SERVER['PHP_AUTH_USER'],
					'pwd' =>$_SERVER['PHP_AUTH_PW']);
		}else{
			return false;
		}
	}
	
	/**
	* 设置页面缓存,使表单在返回时不清空,必须在session_start之前
	* 等同 header('Cache-control: private, must-revalidate');
	*/
	public static function setFormCache(){
		session_cache_limiter('private,must-revalide');
	}
	
	
	/**
	 * 返回客户端IP
	 */
	public static function clientip() {
		$viewclientip = "";
		if (! empty ( $_SERVER ["HTTP_CDN_SRC_IP"] )) {
			$viewclientip = $_SERVER ["HTTP_CDN_SRC_IP"];
		} elseif (! empty ( $_SERVER ["HTTP_CLIENT_IP"] ))
			$viewclientip = $_SERVER ["HTTP_CLIENT_IP"];
		else if (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] ))
			$viewclientip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		else if (! empty ( $_SERVER ["REMOTE_ADDR"] ))
			$viewclientip = $_SERVER ["REMOTE_ADDR"];
		else
			$viewclientip = "127.0.0.1";
		return $viewclientip;
	}
}

?>
