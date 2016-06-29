<?php
class HttpWebRequest{
	private static $headers = array();
	
	public static function get($url, $cookie=null, $options=null){
		return self::requestByGet($url, $cookie, $options);
	}
	public static function requestByGet($url, $cookie=null, $options=null){
		if(!preg_match('/^http[s]?:\/\/[\w\-_]+(\.[\w\-_]+)+([\/\?][\S]+)?$/', $url)){
			return array('error_code'=>999, 'error'=>'url error');
		}
		$defaultOptions = self::getDefaultCurlOptions();
		if(strpos($url, 'https:') === 0){
			$defaultOptions[CURLOPT_SSL_VERIFYPEER] = false;
		}
		if(!empty($cookie)){
			$defaultOptions[CURLOPT_COOKIE] = $cookie;
		}
		
		$ch = curl_init($url);
		if(!empty($options)){
			foreach($options as $optName=>$optValue){
				$defaultOptions[$optName] = $optValue;
			}
		}
		foreach($defaultOptions as $optName=>$optValue){
			curl_setopt($ch, $optName, $optValue);
		}
		
		$responseData = curl_exec($ch);
		$errorCode = curl_errno($ch);
		if($errorCode){
			$error = curl_error($ch);
			$result = array('error_code'=>$errorCode, 'error'=>$error, 'header'=>self::$headers[$ch], 'content'=>$responseData);
		}else{
			$result = array('header'=>self::$headers[$ch], 'content'=>$responseData);
		}
		unset(self::$headers[$ch]);
		return $result;
	}
	
	public static function requestByPost($url, $postData, $cookie=null, $options=null){
		if(!preg_match('/^http[s]?:\/\/[\w\-_]+(\.[\w\-_]+)+([\/\?][\S]+)?$/', $url)){
			return array('error_code'=>999, 'error'=>'url error');
		}
		$defaultOptions = self::getDefaultCurlOptions(false);
		if(strpos($url, 'https:') === 0){
			$defaultOptions[CURLOPT_SSL_VERIFYPEER] = false;
		}
		if(!empty($cookie)){
			$defaultOptions[CURLOPT_COOKIE] = $cookie;
		}
		if(!empty($postData)){
			$defaultOptions[CURLOPT_POSTFIELDS] = $postData;
		}
		if(!empty($options)){
			foreach($options as $optName=>$optValue){
				$defaultOptions[$optName] = $optValue;
			}
		}
		
		$ch = curl_init($url);
		foreach($defaultOptions as $optName=>$optValue){
			curl_setopt($ch, $optName, $optValue);
		}
		
		$responseData = curl_exec($ch);
		$errorCode = curl_errno($ch);
		if($errorCode){
			$error = curl_error($ch);
			$result = array('error_code'=>$errorCode, 'error'=>$error, 'header'=>self::$headers[$ch], 'content'=>$responseData);
		}else{
			$result = array('header'=>self::$headers[$ch], 'content'=>$responseData);
		}
		unset(self::$headers[$ch]);
		return $result;
	}
	
	public static function downloadFile($url, $locaPath, $cookie=null, $options=null){
		$result = self::get($url,$cookie,$options);
		if(isset($result['error_code'])){
			return $result;
		}
		//write to file
	}
	
	private static function getDefaultCurlOptions($isGet = true){
		$options = array(CURLOPT_RETURNTRANSFER=>true
						, CURLOPT_BINARYTRANSFER=>true
						, CURLOPT_HEADERFUNCTION=>array('self', 'getHeader')
						, CURLOPT_USERAGENT=>'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:9.0.1) Gecko/20100101 Firefox/9.0.1'
						, CURLOPT_CONNECTTIMEOUT=>10
						, CURLOPT_TIMEOUT=>30);
		if(!$isGet){
			$options[CURLOPT_POST] = 1;
		}
		return $options;
	}
	
	private static function getHeader($ch, $header){
		$index = strpos($header, ':');
		if (!empty($index)) {
			$key = substr($header, 0, $index);
			$value = trim(substr($header, $index + 2));
			if($key == 'Set-Cookie'){
				$cookieLength = strpos($value, "Path") > 0 ? strpos($value, "Path") : (strpos($value, "path") > 0 ? strpos($value, "path") : strlen($value));
				$value = trim(substr($value, 0, $cookieLength));
				$value = array_key_exists($key, self::$headers[$ch]) ? self::$headers[$ch][$key].$value : $value;
			}
			self::$headers[$ch][$key] = $value;
		}elseif(strpos($header, 'HTTP') === 0){
			$key1 = 'Status-Code';
			$value1 = preg_replace('/^HTTP[\S]+[\s]([\d]+)[\s][\s\S]+$/isU','$1',$header);
			$key2 = 'Status-Text';
			$value2 = preg_replace('/^HTTP[\S]+[\s][\d]+[\s]([\s\S]+)$/isU','$1',$header);
			self::$headers[$ch][$key1] = trim($value1);
			self::$headers[$ch][$key2] = trim($value2);
		}
		
		return strlen($header);
	}
}