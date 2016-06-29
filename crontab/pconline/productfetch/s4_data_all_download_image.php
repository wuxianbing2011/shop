<?php
//error_reporting(E_ALL ^ E_STRICT);
require_once __DIR__.'/../../libs/lcdb.php';
require_once __DIR__.'/../../libs/HttpWebRequest.php';
require_once __DIR__.'/../../libs/debug.php';
require_once __DIR__.'/new_product_loader.php';

$types_en_prodlist = newProductLoad($add_new_prod,'en');
// $tableName = $argv[1];
// if (empty($tableName)) {
// 	//exit("input a tableName");
// }

// $tableName = "products_allin1";
// $newIds = array(579887,579883,579889,580334,579881,580332,580333,579888,579884,579885,579876,579882);


foreach ($types_en_prodlist as $tableName => $newIds) {
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
		file_put_contents(__DIR__.'/../../../'."product_images/".$p['pconline_id'].".jpg", $imageData['content']);

		$db->query("update $tableName set cover_image='{$p['pconline_id']}.jpg' where pconline_id='{$p['pconline_id']}'");
		$db->query("update products_all set cover_image='{$p['pconline_id']}.jpg' where pconline_id='{$p['pconline_id']}'");
		
	 	debug("{$i}/{$total} 1");
	}

}

