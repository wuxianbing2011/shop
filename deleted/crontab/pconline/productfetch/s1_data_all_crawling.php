<?php
/**
 * Load product data from PConline API. 
 * Including basic info and detail info.
 * Then save into local database tables:  	pcol_all_products		pcol_all_product_properties
 * 
 * 
 */
//error_reporting(E_ALL ^ E_STRICT);
require_once __DIR__.'/../../libs/lcdb.php';
require_once __DIR__.'/../../libs/debug.php';
require_once __DIR__.'/../../libs/HttpWebRequest.php';
require_once __DIR__.'/new_product_loader.php';

$types_cn_prodlist = newProductLoad($add_new_prod,'cn');

$modules = array("basic", "properties");

foreach ($types_cn_prodlist as $typeName => $typeData) {
	
	if ($typeData == 0) {
		continue;
	}
	
	//search products
	// $url = "http://product.pconline.com.cn/intel/_product_search_by_small_type.jsp?smallTypeId={$typeId}";
	// $rawData = HttpWebRequest::get($url);
	// $data = json_decode(trim($rawData['content']), true);
	// if (empty($data['productIds'])) {
	// 	debug("$typeName No productIds");
	// 	continue;
	// }

	
	$data = array("productIds"=>$typeData);
	//New product ids
	$productIds = $data['productIds'];

	$moduleProductTotal = count($data['productIds']);
	debug("$typeName get $moduleProductTotal products");
	$i=1;
	
	foreach ($productIds as $productId) {
		$msg = "$typeName process $i / $moduleProductTotal productId: $productId "; 
		$data = array("product_id"=>$productId, "type"=>$typeName);

		//$existed = $db->fetchOne("select count(*) from pcol_all_products where product_id='{$productId}' and type='{$typeName}'");

		// if ($existed) {
		// 	debug($msg." existed");
		// 	$i++;
		// 	continue;
		// }

		//Load basic info from PConline
		$basicInfoRawData = HttpWebRequest::get("http://pdlib.pconline.com.cn/product/intel/product_base_array_js.jsp?productId=".$productId);
		$basicInfo = decodeData($basicInfoRawData['content']);
		
		if (!empty($basicInfo)) {
			$data['name'] = $basicInfo['name'];
			$data['pic_url'] = $basicInfo['picUrl'];
			$data['price'] = $basicInfo['price'];
			$data['brand_id'] = $basicInfo['bid'];
			$data['created_time'] = date("Y-m-d H:i:s");
			//Insert/Update basic info
			$db->replaceData("pcol_all_products", $data, "product_id='{$productId}' and type='{$typeName}'");

			foreach ($basicInfo['items'] as $item) {
				$detailData = array("product_id"=>$productId, "module"=>'basic');
				$detailData["item_name"] = $item["title"];
				$detailData["item_value"] = $item["value"];
				//Insert/Update detail info 
				$db->replaceData("pcol_all_product_properties", $detailData, "product_id='{$productId}' and module='basic' and `group`='' and item_name='{$item["title"]}'");
			}

			$msg .= "bi_1 ";
		} else {
			$msg .= "bi_0 ";
		}
		
		//Load properties 
		$propertiesRawData = HttpWebRequest::get("http://pdlib.pconline.com.cn/product/intel/product_item_array_js.jsp?productId=".$productId);
		$properties = decodeData($propertiesRawData['content']);
		if(!empty($properties)) {
			$j = 0;
			foreach ($properties['groups'] as $group) {
				$groupName = trim(str_replace($properties['name'], "", $group['groupName']));
				foreach ($group['items'] as $item) {
					$itemName = $item['title'];
					$itemValue = $item['value'];
					$db->replaceData("pcol_all_product_properties", array('product_id'=>$productId, 'module'=>'properties', '`group`'=>$groupName, 'item_name'=>$itemName, 'item_value'=>$itemValue), "product_id='{$productId}' and module='properties' and  `group`= '{$groupName}' and item_name='{$itemName}'");
					$j++;
				}
			}
			$msg .="p_".$j;
		} else {
			$_data = iconv("gbk", "utf-8", $propertiesRawData['content']);
			$_data = preg_replace(array("/\/\/[\<\>a-zA-Z\/\s]+?\n/", "/\/\*[\s\S]+?\*\//"), "", $_data);
			$_data = trim($_data);
			$_data = substr($_data, 1, strlen($_data)-(strrpos($_data, ";")==strlen($_data)-1 ? 3 : 2));
			$_data = str_replace("'", '"', $_data);
			$_data = preg_replace("/([a-zA-Z0-9]+)\:([^\/])/", '"$1":$2', $_data);
			debug($_data);
			$msg .= "p_0";
		}



 		//new basic info
		$newBasicInfoRawData = HttpWebRequest::get("http://pdlib.pconline.com.cn/product/intel/base_info_json.jsp?productId={$productId}&callback=");
		$basicInfo = json_decode(iconv("gbk", "utf-8", trim($newBasicInfoRawData['content'])), true);
		if (!empty($basicInfo['data'])) {
			//comment general/detail
			if (!empty($basicInfo['data']['comment'])) {
				$comment = $basicInfo['data']['comment'];
				foreach ($comment as $key => $value) {
					$commentData = array('product_id'=>$productId, 'module'=>'comment', '`group`'=>'general', 'item_name'=>$key, 'item_value'=>$value);
					if ($key == 'items') {
						$commentData['`group`'] = 'detail';
						$commentData['item_value'] = json_encode($value);
					}
					$db->replaceData("pcol_all_product_properties", $commentData, "product_id='{$productId}' and module='comment' and  `group`='{$commentData['`group`']}' and item_name='{$commentData['item_name']}'");
				}
				$msg .=" cmt_1";
			} else {
				$msg .=" cmt_0";
			}
			//article '' article_count / detail
			if (!empty($basicInfo['data']['article'])) {
				$article = $basicInfo['data']['article'];
				$articleData = array('product_id'=>$productId, 'module'=>'article', '`group`'=>'', 'item_name'=>'article_count', 'item_value'=>count($article));
				$db->replaceData("pcol_all_product_properties", $articleData, "product_id='{$productId}' and module='article' and item_name='{$articleData['item_name']}'");
				$articleData['item_name'] = 'detail';
				$articleData['item_value'] = json_encode($article);
				$db->replaceData("pcol_all_product_properties", $articleData, "product_id='{$productId}' and module='article' and item_name='{$articleData['item_name']}'");
				$msg .=" atl_".count($article);
			} else {
				$msg .=" atl_0";
			}


			//company
			if (!empty($basicInfo['data']['company'])) {
				$company = $basicInfo['data']['company'];
				$companyData = array('product_id'=>$productId, 'module'=>'company', '`group`'=>'', 'item_name'=>'company_count', 'item_value'=>count($company));
				$db->replaceData("pcol_all_product_properties", $companyData, "product_id='{$productId}' and module='company' and item_name='{$companyData['item_name']}'");
				$companyData['item_name'] = 'detail';
				$companyData['item_value'] = json_encode($company);
				$db->replaceData("pcol_all_product_properties", $companyData, "product_id='{$productId}' and module='company' and item_name='{$companyData['item_name']}'");
				$msg .=" cpy_".count($company);
			} else {
				$msg .=" cpy_0";
			}

			//parameter general / detail / pics
			if (!empty($basicInfo['data']['parameter'])) {
				$parameter = $basicInfo['data']['parameter'];
				$parameterDetail = false;
				$msg .=" parm_";
				foreach ($parameter as $key => $value) {
					$parameterData = array('product_id'=>$productId, 'module'=>'parameter', '`group`'=>'general');
					if ($key == 'items') {
						foreach ($parameter['items'] as $item) {
							$parameterDetail = $parameterData;
							$parameterDetail['`group`'] = 'detail';
							$parameterDetail['item_name'] = $item['key'];
							$parameterDetail['item_value'] = $item['value'];
							$parameterDetail['item_value2'] = $item['displayValue'];
							$parameterDetail['item_value3'] = $item['nValue'];
							$db->replaceData("pcol_all_product_properties", $parameterDetail, "product_id='{$productId}' and module='parameter'  and  `group`='detail'  and item_name='{$parameterDetail['item_name']}'");
						}
						$msg .="items_".count($parameter['items']);
						continue;
					} elseif ($key == 'pics') {
						foreach ($parameter['pics'] as $pic) {
							$parameterDetail = $parameterData;
							$parameterDetail['`group`'] = 'pics';
							$parameterDetail['item_name'] = $pic['name'];
							$parameterDetail['item_value'] = $pic['pic'];
							$parameterDetail['item_value2'] = $pic['thumbPic'];
							$db->replaceData("pcol_all_product_properties", $parameterDetail, "product_id='{$productId}' and module='parameter'  and  `group`='pics' and item_name='{$parameterDetail['item_name']}'");
						}
						$msg .="_pics_".count($parameter['pics']);
						continue;
					}
					$parameterData['item_name'] = $key;
					$parameterData['item_value'] = $value;
					$db->replaceData("pcol_all_product_properties", $parameterData, "product_id='{$productId}' and module='parameter'  and  `group`='general'  and item_name='{$parameterData['item_name']}'");
				}
				$msg .="_total_".count($parameter);
			} else {
				$msg .=" parm_0";
			}

		} 
		debug($msg);
		$i++;
	}

}

debug("done");
