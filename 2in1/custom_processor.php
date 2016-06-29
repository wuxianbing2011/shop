<?php
$where = "1";
$pageUrl = "index.php?page={page}";

//usage param
$platform = getParam('platform');
if ($platform == 'baytrail') {
	$usage = '高性价比';
} elseif ($platform == 'haswell') {
	$usage = '性能超群';
}

//url params
if (!empty($platform)) {
	$where .= " and platform='{$platform}'";
	$pageUrl .= "&platform=".rawurlencode($platform);
}
$formFactor = getParam('form_factor');
$formFactors = array("convertible"=>"翻转", "detachable"=>"插拔");
if (!empty($formFactor)) {
	$where .= " and product_form='{$formFactors[$formFactor]}'";
	$pageUrl .= "&product_form=".rawurlencode($formFactor);
}

//kv display
$kv = "k8";
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if ($platform == 'baytrail' && $formFactor=='') {
	$kv = "k5";
} elseif ($platform == 'haswell' && $formFactor=='') {
	$kv = "k7";
} elseif ($platform == 'baytrail' && $formFactors[$formFactor] == '翻转') {
	$kv = "k2";
} elseif ($platform == 'baytrail' && $formFactors[$formFactor] == '插拔') {
	$kv = "k4";
} elseif ($platform == 'haswell' && $formFactors[$formFactor] == '翻转') {
	$kv = "k6";
} elseif ($platform == 'haswell' && $formFactors[$formFactor] == '插拔') {
	$kv = "k1";
} elseif (strpos($agent, 'iphone') || strpos($agent, 'ipad')){
	$kv = "k3";
}
