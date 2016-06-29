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
			,"平板电脑"=>array(588551)//array(577282,577283,581864,577828,582972,580326,580319,588551,588542,581372)
			//, "手机"=>"20937"
			//,"2in1"=>array(581505)//array(577289,581438,581720,581505,588538,576969)//,
			//, "笔记本"=>array(576659)//array(567713,582201,587328,587791,587429,487025,576659,576969)//array(582201)//
			//, "SSD"=>"42997"
			//, "台式机"=>"20806"
			//,"一体电脑"=>array(575694,575756,580015,570630)
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
		
		$db->replaceData($tableName, $data, "pconline_id='{$p['product_id']}'", true);

		debug($msg);
		$i++;
		//exit;
	}
}













