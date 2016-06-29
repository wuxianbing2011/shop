<?php
$inAjax = empty($_GET['ajax']) ? false : true;
$pageUrl = empty($pageUrl) ? "index.php?page={page}" : $pageUrl;
$perPage = 8;
$page = intval(getParam('page', 1));
$page = $page>0 ? $page : 1; 
$begin = ($page - 1)*$perPage;

$where = empty($where) ? "1" : $where;
if (!in_array($module, array('tablet', 'smart-phone', 'cpu', 'ssd'))) {
	$where .= " and deleted = '0'";
}


$urlParam = array();
//$kv = "";
//filters
$usedFilters = array();
$selectedFilters = array();

if (empty($usage)) {
	$usage = getParam('usage');
}

if (!empty($usageModule) && array_key_exists($usage, $usageModule)) {
	$selectedFilters['usage'] = $usage;
	$usedFilters['usage'] = "m_usage like '%{$usage}%'";
	$urlParam['usage'] = "usage=".rawurlencode($usage);
}
if (!isset($filterData)) {
	$filterData = array();
}
foreach ($filterData as $key => $filter) {
	$param = getParam($key);
	if ($filter['type'] == 'single') {
		if (in_array($param, $filter['items'])) {
			$selectedFilters[$key] = $param;
			$usedFilters[$key] = "{$key}='{$param}'";
			$urlParam[$key] =  "{$key}=".rawurlencode($param);
		}
	} elseif ($filter['type'] == 'like') {
		if (in_array($param, $filter['items'])) {
			$selectedFilters[$key] = $param;
			$usedFilters[$key] = "{$key} like '%{$param}%'";
			$urlParam[$key] =  "{$key}=".rawurlencode($param);
		}
	} elseif ($filter['type'] == 'range') {
		if (array_key_exists($param, $filter['items'])) {
			$selectedFilters[$key] = $param;
			$usedFilters[$key] = formatRangeFilter($param, $key);
			$urlParam[$key] = "{$key}=".rawurlencode($param);
		}
	}
}

$filtersAvailble = array();

foreach ($filterData as $key => $filter) {
	$filterWhere = generateFilterWhereSql($key, $usedFilters);
	$field = $key;
	$availbleData = $db->fetchCol("select distinct {$field} from {$tableName} where {$filterWhere}");
	// if ($key == 'm_brand') {
	// 	print_r($availbleData);
	// 	exit;
	// }
	if ($filter['type'] == 'single') {
		$filtersAvailble[$key] = $availbleData;
	} elseif ($filter['type'] == 'like') {
		// if ($key == 'tech') {
		// 	$availbleTechs = array();
		// 	if (!empty($availbleData)) {
		// 		foreach ($availbleData as $ad) {
		// 			$_items = explode(",", $ad);
		// 			foreach ($_items as $_item) {
		// 				if (!in_array($_item, $availbleTechs)) {
		// 					$availbleTechs[] = $_item;
		// 				}
		// 			}
		// 		}
		// 		$filtersAvailble['tech'] = $availbleTechs;
		// 	}
		// } else {
			$availbleItems = array();
			foreach ($filter['items'] as $item) {
				foreach ($availbleData as $ad) {
					if ($item == $ad || strpos($ad, $item) !== false) {
						$availbleItems[] = $item;
					}
				}
			}
			$filtersAvailble[$key] = $availbleItems;
		// }
	} else if ($filter['type'] == 'range') {
		foreach ($filter['items'] as $itemKey => $itemValue) {
			if (itemKeyAvailable($itemKey, $availbleData)) {
				$filtersAvailble[$key][] = $itemKey;
			}
		}
	}
}


if (!empty($usedFilters) && count($usedFilters) > 0) {
	$where .= " and ".implode(" and ", $usedFilters);
}
$pageUrl .= "&".implode("&", $urlParam);

$order = getParam("order");
if (!empty($order)) {
	$orderSql = str_replace("-", " ", $order);
} else {
	$order = "";// "price-asc";
	$orderSql = "id desc";
}

$pageUrl .= "&order=".$order;

$total = $db->fetchOne("select count(*) from {$tableName} where {$where}");

$products = $db->fetchAll("select * from {$tableName} where {$where} and price > 0 order by {$orderSql} limit {$begin},{$perPage}");
$hasPriceTotal = $db->fetchOne("select count(*) from {$tableName} where {$where} and price > 0");
$noPricetotal = $total - $hasPriceTotal;
if (!empty($_GET['debug'])) {
	exit("select * from {$tableName} where {$where} and price > 0 order by {$orderSql} limit {$begin},{$perPage}");
}
if ($begin >= $hasPriceTotal) {
	$start = $begin - $hasPriceTotal;
	$products = $db->fetchAll("select * from {$tableName} where {$where} and price = 0 order by {$orderSql} limit {$start},{$perPage}");
} else if ($begin+$perPage > $hasPriceTotal) {
	$limit = $begin+$perPage - $hasPriceTotal;
	$products2 = $db->fetchAll("select * from {$tableName} where {$where} and price = 0 order by {$orderSql} limit 0,{$limit}");
	$products = array_merge($products, $products2);
}





$pagerHtml = Pager::style2($page, $perPage, $total, $pageUrl."#product", 'active', 'disable');

function itemKeyAvailable($itemKey, $availbleData) {
	foreach ($availbleData as $data) {
		if (preg_match("/^<([\d]+([\.][\d]+)?)$/", $itemKey, $match) && $match[1] > $data) {
			return true;
		} elseif (preg_match("/^>([\d]+([\.][\d]+)?)$/", $itemKey, $match) && $match[1] <= $data) {
			return true;
		} elseif (preg_match("/^([\d]+([\.][\d]+)?)\-([\d]+([\.][\d]+)?)$/", $itemKey, $match) && $data >= $match[1] && $data <= $match[3]) {
			return true;
		} elseif (preg_match("/^=([\d]+([\.][\d]+)?)$/", $itemKey, $match) && $data == $match[1]) {
			return true;
		}
	}
	return false;
}

function generateFilterWhereSql ($filterKey, $usedFilters) {
	$where = "1";
	if (!empty($usedFilters[$filterKey])) {
		unset($usedFilters[$filterKey]);
	}
	if (empty($usedFilters)) {
		return $where;
	}
	return implode(" and ", $usedFilters);
}

function formatRangeFilter($param, $sqlKey) {
	if (!empty($param)) {
		if (preg_match("/^<([\d]+([\.][\d]+)?)$/", $param, $match)) {
			$where = "{$sqlKey} < '{$match[1]}'";
		} elseif (preg_match("/^>([\d]+([\.][\d]+)?)$/", $param, $match)) {
			$where = "{$sqlKey} >= '".(floatval($match[1])-0.001)."'";
		} elseif (preg_match("/^([\d]+([\.][\d]+)?)\-([\d]+([\.][\d]+)?)$/", $param, $match)) {
			$where = "{$sqlKey} >= '".(floatval($match[1])-0.001)."' and {$sqlKey} <='".(floatval($match[3])+0.001)."'";
		} elseif (preg_match("/^=([\d]+([\.][\d]+)?)$/", $param, $match)) {
			$where = "{$sqlKey} > '".(floatval($match[1])-0.001)."' and {$sqlKey} < '".(floatval($match[1])+0.001)."'";
		} else {
			$where = "1";
		}
		return $where;
	}
	return "1";
}