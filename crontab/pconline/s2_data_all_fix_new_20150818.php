<?php
require_once __DIR__.'/../libs/lcdb.php';
require_once __DIR__.'/../libs/debug.php';
require_once __DIR__.'/static_data.php';

$commonFields = array("name", "pconline_id", "price", "pic_url");

//$type = "asdfasdfallin1";// isset($_GET['type']) ? $_GET['type'] : 'laptop';

//if (!array_key_exists($type, $exportMap)) {
	$types = array_keys($exportMap);
// } else {
// 	$types = array($type);
// }

$tableNames = $db->getTables();
//$newIds = array(579887,579883,579889,580334,579881,580332,580333,579888,579884,579885,579876,579882);

$ids = array(
			"key"=>0
			//, "CPU"=>"20812"
			//, "主板"=>"20811"
			//, "超级本"=>"95585"
			//,"平板电脑"=>array(579907)
			//, "手机"=>"20937"
			//,"2in1"=>array(553421)//, 576560, 594852)
			//,"笔记本"=>array(574575)//,594610,  584230)
			//, "SSD"=>"42997"
			//, "台式机"=>"20806"
			,"一体电脑"=>array(579972)
);


foreach ($types as $t) {

	$typeKey = $exportMap[$t]["type"];
	$tableName = $exportMap[$t]['table'];

	echo "$typeKey \n";

	if (empty($ids[$typeKey])) {
		continue;
	}
	
	$newIds = $ids[$typeKey];
	//print_r($newIds);exit;

	$products = $db->fetchAll("select * from pcol_all_products where `type`='{$typeKey}' and product_id in ('".implode("','", $newIds)."')");
	//print_r($products);exit;
	$num = count($products);
	$i = 1;
	foreach ($products as $p) {
		$msg = "$t ";
		$msg .= $i . " / " . $num . " pid:".$p['product_id'];
		$data = array("name"=>$p["name"], "pconline_id"=>$p["product_id"], "price"=>$p["price"], "pic_url"=>$p["pic_url"]);

		$properties = $db->fetchAll("select * from pcol_all_product_properties where product_id='{$p['product_id']}' ");
		//print_r($properties);exit;
		$pcache = array();
		foreach ($properties as $prop) {
			$propKey = $prop['module']."_".$prop["group"]."_".$prop["item_name"];
			if (in_array($propKey, $pcache)) {
				continue;
			} else {
				$pcache[] = $propKey;
			}
			$propValue = $prop['item_value'];
			if (array_key_exists($propKey, $exportMap[$t]['property_fields'])) {
				$fieldName = $exportMap[$t]['property_fields'][$propKey]["field_name"];
				$data[$fieldName] = trim($propValue);
			}
		}
		//print_r($data); exit;
		if (isset($data['weight'])) {
			$data['weight'] = intval($data['weight']);
		}
		if (isset($data['harddisc_size'])) {
			$data['harddisc_size'] = intval($data['harddisc_size']);
		}
		
		if (isset($data['thickness'])) {
			$data['thickness'] = intval($data['thickness']);
		}
		if (isset($data['disk_size'])) {
			$data['disk_size'] = intval($data['disk_size']);
		}
		

		$db->replaceData($tableName, $data, "pconline_id='{$p['product_id']}'", false);

		debug($msg);
		$i++;
		//exit;
	}
}













