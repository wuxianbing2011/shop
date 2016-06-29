<?php
require_once __DIR__.'/../libs/lcdb.php';
require_once __DIR__.'/../libs/HttpWebRequest.php';
require_once __DIR__.'/../libs/debug.php';

$fieldMap = array(
	"products_tablet"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "m_cpu"=>"cpu", "m_brand_en"=>"brand_en", "screen_size"=>"screen_size", "mem_rongliang"=>"mem_size", "mem_type"=>"mem_type", "m_system"=>"operating_system")
	,"products_2in1"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"cpu", "brand_name_en"=>"brand_en", "screen_size"=>"screen_size", "harddisc_size"=>"disk_size", "harddist_type"=>"disk_type", "operating_system"=>"operating_system")
	,"products_desktop"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "m_cpu"=>"cpu", "m_brand_en"=>"brand_en", "leixing"=>"product_type", "xianka_type"=>"xianka_type", "mem_daxiao"=>"mem_size", "mem_type"=>"mem_type")
	,"products_laptop"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "m_cpu"=>"cpu", "m_brand_en"=>"brand_en", "screen_size"=>"screen_size", "disk_size"=>"disk_size", "disk_type"=>"disk_type", "operating_system"=>"operating_system")
	,"products_allin1"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu_type"=>"cpu", "m_brand_en"=>"brand_en", "screen_size"=>"screen_size", "disk_size"=>"disk_size", "disk_type"=>"disk_type", "operating_system"=>"operating_system")
	,"products_mobile"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"cpu", "mainscreen_size"=>"screen_size", "screen_ratio"=>"screen_ratio", "product_tezheng"=>"product_spec")
	,"products_cpu"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "m_processor"=>"cpu", "interface"=>"interface", "core_num"=>"core_num", "packaging"=>"packaging")
	,"products_ssd"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "rongliang"=>"disk_size", "disk_chicun"=>"disk_dimension", "read_speed"=>"read_speed", "main_chip"=>"main_chip")
	,"products_mainboard"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "m_support_cpu"=>"cpu", "waixing_chicun"=>"outline_dimension", "max_mem"=>"max_mem_size", "fit_model"=>"fit_type")
);

$firstFields = array(
	"products_tablet"=>array("name", "cpu", "price", "m_brand_en"=>"brand_en")
	,"products_2in1"=>array("name", "cpu", "price", "brand_name_en"=>"brand_en")
	,"products_desktop"=>array("name", "cpu", "price", "m_brand_en"=>"brand_en")
	,"products_laptop"=>array("name", "cpu", "price", "m_brand_en"=>"brand_en")
	,"products_allin1"=>array("name", "cpu", "price", "m_brand_en"=>"brand_en")
	,"products_mobile"=>array("name", "price", "cpu")
	,"products_cpu"=>array("name", "cpu", "price")
	,"products_ssd"=>array("name", "disk_size", "price")
	,"products_mainboard"=>array("name", "cpu", "price")
);

$secondFields = array(
	"products_tablet"=>array("#0英寸高清屏幕" => "screen_size", "#0GB内存 #1"=>array("mem_size", "mem_type"), "#0 操作系统"=>"operating_system")
	,"products_2in1"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"products_desktop"=>array("#0"=> "product_type", "#0"=>"xianka_type", "#0GB内存 #1"=>array("mem_size", "mem_type"))
	,"products_laptop"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"products_allin1"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"products_mobile"=>array("#0英寸高清屏幕" => "screen_size", "#0"=>"screen_ratio", "#0"=>"product_spec")
	,"products_cpu"=>array("#0 接口"=>"interface", "核心数量 #0"=>"core_num", "包装 #0"=>"packaging")
	,"products_ssd"=>array("#0"=>"disk_dimension", "#0 读取速度"=>"read_speed", "#0 主控芯片"=>"main_chip")
	,"products_mainboard"=>array("#0 外形尺寸"=>"outline_dimension", "最大支持内存容量 #0B"=>"max_mem_size", "适用类型 #0"=>"fit_type")
);


// $fieldMap = array(
// 	"products_allin1"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu_type"=>"cpu", "m_brand_en"=>"brand_en", "screen_size"=>"screen_size", "disk_size"=>"disk_size", "disk_type"=>"disk_type", "operating_system"=>"operating_system")
// );

// $firstFields = array(
// 	"products_allin1"=>array("name", "cpu", "price", "m_brand_en"=>"brand_en")
// );

// $secondFields = array(
// 	"products_allin1"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
// );

// $newIds = array(579887,579883,579889,580334,579881,580332,580333,579888,579884,579885,579876,579882);

$ids = array(
			"key"=>0
			//, "CPU"=>"20812"
			//, "主板"=>"20811"
			//, "超级本"=>"95585"
			,"products_tablet"=>array(579907)
			//, "手机"=>"20937"
			,"products_2in1"=>array(553421, 576560, 594852)
			,"products_laptop"=>array(574575,594610,  584230)
			//, "SSD"=>"42997"
			//, "台式机"=>"20806"
			,"products_allin1"=>array(579972)
);

$cols = $db->getColumns("products_all");

foreach ($fieldMap as $tableName => $fields) {
	if (empty($ids[$tableName])) {
		continue;
	}
	$newIds = $ids[$tableName];
	$products = $db->fetchAll("select * from $tableName where pconline_id in ('".implode("','", $newIds)."')");
	//exit("select * from $tableName where pconline_id in ('".implode("','", $newIds)."')");
	debug($tableName." ".count($products));
	$fields = $fieldMap[$tableName];
	foreach ($fields as $oldField => $newField) {
		if (!in_array($newField, $cols)) {
			$db->query("ALTER TABLE `products_all` ADD `{$newField}` VARCHAR( 50 ) NOT NULL;");
			$cols[] = $newField;
		}
	}
	$i=1;
	$total = count($products);
	foreach ($products as $p) {
		$data = array("`type`"=>$tableName);
		foreach ($fields as $oldField => $newField) {
			$data[$newField] = $p[$oldField];
		}
		$db->replaceData("products_all", $data, "pconline_id='{$p['pconline_id']}'");
		debug($tableName." $i/$total ");
		$i++;
	}

	debug($tableName . " done");
}
