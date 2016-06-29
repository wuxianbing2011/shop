<?php
$tableName = "products_ssd";
$numOfFirstFilterGroup = 4;

$usageModule = array();
$hotProducts = array();

$filterNames = array(
	"price"=>"价格"
	, "rongliang"=>"容量"
	, "jiekou_leixing"=>"接口类型"
	, "waike"=>"有无外壳"
);
$filterData = array(
	"price"=>array("type"=>"range", "items"=>array("<1000"=>"1000元以下","1000-1999"=>"1000-1999元","2000-2999"=>"2000-2999元","3000-3999"=>"3000-3999元","4000-4999"=>"4000-4999元", ">5000"=>"5000元以上"))
	, "rongliang"=>array("type"=>"range", "items"=>array("<100"=>"100GB以内","100-299"=>"100-299GB","300-499"=>"300-499GB", ">500"=>"500GB以上"))
	, "jiekou_leixing"=>array("type"=>"single", "items"=>array("SATA II", "SATA III", "Micro SATA"))
	, "waike"=>array("type"=>"single", "items"=>array("有外壳", "无外壳"))
);