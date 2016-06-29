<?php
$tableName = "products_cpu";
$numOfFirstFilterGroup = 2;

$usageModule = array();
$hotProducts = array();

$filterNames = array(
	"price"=>"价格"
	, "m_processor"=>"处理器"
	, "main_frequency"=>"主频"
	, "jixian_model"=>"集成显卡"
	, "m_vpro"=>"vPro"
	, "m_ruipin"=>"睿频"
);
$filterData = array(
	"price"=>array("type"=>"range", "items"=>array("<500"=>"500元以下","500-999"=>"500-999元","1000-1399"=>"1000-1399元","1400-1999"=>"1400-1999元",">2000"=>"2000元以上"))
	, "m_processor"=>array("type"=>"single", "items"=>array("凌动处理器", "奔腾处理器", "赛扬处理器", "第二代酷睿i3处理器", "第二代酷睿i5处理器", "第二代酷睿i7处理器", "第三代酷睿i3处理器", "第三代酷睿i5处理器", "第三代酷睿i7处理器", "第四代酷睿i3处理器", "第四代酷睿i5处理器", "第四代酷睿i7处理器", "至强处理器", "酷睿i7至尊版处理器"))
	, "main_frequency"=>array("type"=>"range", "items"=>array("1.2-1.99"=>"1.2-1.99GHz","2.0-2.99"=>"2.0-2.99GHz","3.0-4.0"=>"3.0-4.0GHz"))
	, "jixian_model"=>array("type"=>"single", "items"=>array("Intel HD Graphic 2000", "Intel HD Graphic 2500", "Intel HD Graphic 3000", "Intel HD Graphic 4000", "Intel HD Graphic 4400", "Intel HD Graphic 4600", "Intel GMA 3150", "无集成显示核芯", "其他"))
	, "m_vpro"=>array("type"=>"single", "items"=>array("支持vPro"))
	, "m_ruipin"=>array("type"=>"single", "items"=>array("支持Turbo Mode"))
);