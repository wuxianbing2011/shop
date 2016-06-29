<?php

$url = $_SERVER["REQUEST_URI"];				//获取当前的url
$index = strpos($url,'refresh');			//判断是否为index页面
$business = strpos($url,'business');		//判断是否为business页面
$stationary = strpos($url,'stationary');	//判断是否为stationary页面
$customer = strpos($url,'customer');		//判断是否为customer页面
$engineering = strpos($url,'engineering');	//判断是否为engineering页面
$remote = strpos($url,'remote');			//判断是否为remote页面


$customer_sql = $db->fetchAll("select pconline_id, tag, type from refresh_tag");

$count = count($customer_sql);
for ($i = 0; $i < $count; $i++) {
	if ($customer_sql[$i]['type'] == 'laptop') {
		$pconline_id_laptop = $pconline_ids.','.$customer_sql[$i]['pconline_id'];
	}elseif ($customer_sql[$i]['type'] == '2in1') {
		$pconline_id_2in1 = $pconline_ids.','.$customer_sql[$i]['pconline_id'];
	}elseif ($customer_sql[$i]['type'] == 'desktop') {
		$pconline_id_desktop = $pconline_ids.','.$customer_sql[$i]['pconline_id'];
	}elseif ($customer_sql[$i]['type'] == 'allin1') {
		$pconline_id_allin1 = $pconline_ids.','.$customer_sql[$i]['pconline_id'];
	}
}



//index
if ($index !== false){
	$tablenames = array('tablet', '2in1', 'desktop', 'laptop', 'allin1');
	$tags = array('Customer Service Workers', 'R&D Engineering workers', 'Business Executives&Directors', 'Remote Workers with in office w', 'Stationary workers');
	//Customer Service Workers IN every table
	$count_tables = count($tablenames);
	$count_tags = count($tags);
	for ($i = 0; $i < $count_tables; $i++) {
		$tn = 'products_'.$tablenames[$i];
		for ($j = 0; $j < $count_tags; $j++) {
			$result[$i][$j] = $db->fetchAll("select * from $tn where m_usage like '%$tags[$j]%' ");
			if ($result[$i][$j] == null) {
				continue;
			}
			for ($k = 0; $k < count($result[$i][$j]); $k++) {
				$result[$i][$j][$k]['tableName'] = $tablenames[$i];
			}
		}
	}
	
	$products = array_merge($result[0][0],$result[0][1],$result[0][2],$result[0][3],$result[0][4],$result[1][0],$result[1][1],$result[1][2],$result[1][3],$result[1][4],$result[2][0],$result[2][1],$result[2][2],$result[2][3],$result[2][4],$result[3][0],$result[3][1],$result[3][2],$result[3][3],$result[3][4],$result[4][0],$result[4][1],$result[4][2],$result[4][3],$result[4][4]);
}

//business
if ($business !== false){
	$tablenames = array('tablet', '2in1', 'desktop', 'laptop', 'allin1');
	$tags = array('Business Executives&Directors');
	//Customer Service Workers IN every table
	$count_tables = count($tablenames);
	$count_tags = count($tags);
	for ($i = 0; $i < $count_tables; $i++) {
		$tn = 'products_'.$tablenames[$i];
		for ($j = 0; $j < $count_tags; $j++) {
			$result[$i][$j] = $db->fetchAll("select * from $tn where m_usage like '%$tags[$j]%' ");
			if ($result[$i][$j] == null) {
				continue;
			}
	
			for ($k = 0; $k < count($result[$i][$j]); $k++) {
				$result[$i][$j][$k]['tableName'] = $tablenames[$i];
			}
		}
	}
	
	$products = array_merge($result[0][0],$result[1][0],$result[2][0],$result[3][0],$result[4][0]);
}

//stationary
if ($stationary !== false){
	$tablenames = array('tablet', '2in1', 'desktop', 'laptop', 'allin1');
	$tags = array('Stationary workers');
	//Customer Service Workers IN every table
	$count_tables = count($tablenames);
	$count_tags = count($tags);
	for ($i = 0; $i < $count_tables; $i++) {
		$tn = 'products_'.$tablenames[$i];
		for ($j = 0; $j < $count_tags; $j++) {
			$result[$i][$j] = $db->fetchAll("select * from $tn where m_usage like '%$tags[$j]%' ");
			if ($result[$i][$j] == null) {
				continue;
			}

			for ($k = 0; $k < count($result[$i][$j]); $k++) {
				$result[$i][$j][$k]['tableName'] = $tablenames[$i];
			}
		}
	}

	$products = array_merge($result[0][0],$result[1][0],$result[2][0],$result[3][0],$result[4][0]);
}

//customer
if ($customer !== false){
	$tablenames = array('tablet', '2in1', 'desktop', 'laptop', 'allin1');
	$tags = array('Customer Service Workers');
	//Customer Service Workers IN every table
	$count_tables = count($tablenames);
	$count_tags = count($tags);
	for ($i = 0; $i < $count_tables; $i++) {
		$tn = 'products_'.$tablenames[$i];
		for ($j = 0; $j < $count_tags; $j++) {
			$result[$i][$j] = $db->fetchAll("select * from $tn where m_usage like '%$tags[$j]%' ");
			if ($result[$i][$j] == null) {
				continue;
			}

			for ($k = 0; $k < count($result[$i][$j]); $k++) {
				$result[$i][$j][$k]['tableName'] = $tablenames[$i];
			}
		}
	}

	$products = array_merge($result[0][0],$result[1][0],$result[2][0],$result[3][0],$result[4][0]);
}

//engineering
if ($engineering !== false){
	$tablenames = array('tablet', '2in1', 'desktop', 'laptop', 'allin1');
	$tags = array('R&D Engineering workers');
	//Customer Service Workers IN every table
	$count_tables = count($tablenames);
	$count_tags = count($tags);
	for ($i = 0; $i < $count_tables; $i++) {
		$tn = 'products_'.$tablenames[$i];
		for ($j = 0; $j < $count_tags; $j++) {
			$result[$i][$j] = $db->fetchAll("select * from $tn where m_usage like '%$tags[$j]%' ");
			if ($result[$i][$j] == null) {
				continue;
			}

			for ($k = 0; $k < count($result[$i][$j]); $k++) {
				$result[$i][$j][$k]['tableName'] = $tablenames[$i];
			}
		}
	}

	$products = array_merge($result[0][0],$result[1][0],$result[2][0],$result[3][0],$result[4][0]);
}

//remote
if ($remote !== false){
	$tablenames = array('tablet', '2in1', 'desktop', 'laptop', 'allin1');
	$tags = array('Remote Workers with in office w');
	//Customer Service Workers IN every table
	$count_tables = count($tablenames);
	$count_tags = count($tags);
	for ($i = 0; $i < $count_tables; $i++) {
		$tn = 'products_'.$tablenames[$i];
		for ($j = 0; $j < $count_tags; $j++) {
			$result[$i][$j] = $db->fetchAll("select * from $tn where m_usage like '%$tags[$j]%' ");
			if ($result[$i][$j] == null) {
				continue;
			}

			for ($k = 0; $k < count($result[$i][$j]); $k++) {
				$result[$i][$j][$k]['tableName'] = $tablenames[$i];
			}
		}
	}

	$products = array_merge($result[0][0],$result[1][0],$result[2][0],$result[3][0],$result[4][0]);
}

