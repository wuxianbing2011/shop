<?php
$tableName = "products_mainboard";
$numOfFirstFilterGroup = 3;

$usageModule = array();
$hotProducts = array();

$filterNames = array(
	"price"=>"价格"
	, "m_support_cpu"=>"支持处理器"
	, "fit_model"=>"适用平台"
);
$filterData = array(
	"price"=>array("type"=>"range", "items"=>array("<500"=>"500元以下","500-999"=>"500-999元","1000-1499"=>"1000-1499元",">1500"=>"1500元以上"))
	, "m_support_cpu"=>array("type"=>"single", "items"=>array("英特尔酷睿处理器", "英特尔凌动处理器",  "英特尔奔腾处理器"))//"英特尔至强处理器",, "英特尔赛扬处理器", "其他"
	, "fit_model"=>array("type"=>"single", "items"=>array("台式机平台"))//, "HTPC平台", "台式机+HTPC平台", "工控平台"
);