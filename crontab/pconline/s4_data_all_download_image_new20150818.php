<?php
require_once __DIR__.'/../libs/lcdb.php';
require_once __DIR__.'/../libs/HttpWebRequest.php';
require_once __DIR__.'/../libs/debug.php';

// $tableName = $argv[1];
// if (empty($tableName)) {
// 	//exit("input a tableName");
// }

// $tableName = "products_allin1";
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


foreach ($ids as $tableName => $newIds) {
	if (empty($newIds)) {
		continue;
	}








	$products = $db->fetchAll("select * from $tableName where pconline_id in ('".implode("','", $newIds)."')");
	$cols = $db->getColumns($tableName);
	if (!array_key_exists("cover_image", $cols)) {
		$db->query("ALTER TABLE `{$tableName}` ADD `cover_image` VARCHAR( 50 ) NOT NULL;");
	}
	$i = 0;
	$total = count($products);
	foreach($products as $p) {
		$i++;
		$data = array();
		$imageUrl = $p['pic_url'];
		if (empty($imageUrl)) {
			debug("{$i}/{$total} 0");
			continue;
		}
		$imageData = HttpWebRequest::get($imageUrl);
		file_put_contents("product_images/".$p['pconline_id'].".jpg", $imageData['content']);
		$db->query("update $tableName set cover_image='{$p['pconline_id']}.jpg' where id='{$p['id']}'");
		$db->query("update products_all set cover_image='{$p['pconline_id']}.jpg' where id='{$p['id']}'");
		
	 	debug("{$i}/{$total} 1");
	}









}

