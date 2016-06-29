<?php
error_reporting(E_ALL ^ E_STRICT);

require_once __DIR__.'/../../libs/HttpWebRequest.php';

$productId = '589947';
/* 
//load basic info 
$basicInfoRawData = HttpWebRequest::get("http://pdlib.pconline.com.cn/product/intel/product_base_array_js.jsp?productId="."$productId");
$basicInfo = decodeData($basicInfoRawData['content']);
print_r( $basicInfo );
 */
/*
//load properties
$propertiesRawData = HttpWebRequest::get("http://pdlib.pconline.com.cn/product/intel/product_item_array_js.jsp?productId=".$productId);
$properties = decodeData($propertiesRawData['content']);
print_r($properties);
 */ 
  
//new basic info
$newBasicInfoRawData = HttpWebRequest::get("http://pdlib.pconline.com.cn/product/intel/base_info_json.jsp?productId={$productId}&encoding=utf-8");
$newBasicInfo = decodeData($newBasicInfoRawData['content']);
print_r($newBasicInfo);





function decodeData($rawData) {
	$data = json_decode($rawData, true);
	if (!empty($data)) {
		return $data;
	}
	$data = iconv("gbk", "utf-8", $rawData);
	$data = preg_replace(array("/\/\/[\<\>a-zA-Z\/\s]+?\n/", "/\/\*[\s\S]+?\*\//"), "", $data);
	$data = trim($data);
	$data = substr($data, 1, strlen($data)-(strrpos($data, ";")==strlen($data)-1 ? 3 : 2));
	$data = str_replace("'", '"', $data);
	$data = preg_replace("/([a-zA-Z]+)\:([^\/])/", '"$1":$2', $data);
	$realData = json_decode($data, true);
	return $realData;
}