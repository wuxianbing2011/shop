<?php
//查询refresh_tag 数据表
$customer_sql = $db->fetchAll("select pconline_id, tag, type from refresh_tag");

//把每个表中的pconline_id 统计出来
$count = count($customer_sql);
for ($i = 0; $i < $count; $i++) {
	if ($customer_sql[$i]['type'] == 'laptop') {
		$pconline_id_laptop = $customer_sql[$i]['pconline_id'].','.$pconline_id_laptop;
	}elseif ($customer_sql[$i]['type'] == '2in1') {
		$pconline_id_2in1 = $customer_sql[$i]['pconline_id'].','.$pconline_id_2in1;
	}elseif ($customer_sql[$i]['type'] == 'desktop') {
		$pconline_id_desktop = $customer_sql[$i]['pconline_id'].','.$pconline_id_desktop;
	}elseif ($customer_sql[$i]['type'] == 'allin1') {
		$pconline_id_allin1 = $customer_sql[$i]['pconline_id'].','.$pconline_id_allin1;
	}elseif ($customer_sql[$i]['type'] == 'tablet') {
		$pconline_id_tablet = $customer_sql[$i]['pconline_id'].','.$pconline_id_tablet;
	}
}

//pconline_id 统计成数组后去掉最后的“,”符号
$pconline_id = 
	array(
	$pconline_id_laptop = rtrim($pconline_id_laptop, ","),
	$pconline_id_2in1 = rtrim($pconline_id_2in1, ","),
	$pconline_id_desktop = rtrim($pconline_id_desktop, ","),
	$pconline_id_allin1 = rtrim($pconline_id_allin1, ","),
	$pconline_id_tablet = rtrim($pconline_id_tablet, ","),
	);
// 	print_r($pconline_id);exit;

//所有的表整理成一个数组
$tablenames = array( 'laptop', '2in1', 'desktop', 'allin1', 'tablet');
//所有的tag整理成一个数组
$tags = array('Customer Service Workers', 'R&D Engineering workers', 'Business Executives&Directors', 'Remote Workers with in office w', 'Stationary workers');

//conditions
$conditions = array(
	$condition_laptop = 'cover_image,pconline_id,price,name,m_usage,cpu_type,screen_size,screen_ratio,mem_rongliang,disk_size,weight,thickness,xianka_chip,xiancun_rongliang',	//屏幕尺寸、分辨率、内存容量、硬盘容量、重量、厚度、显卡芯片、显卡容量
	$condition_2in1   = 'cover_image,pconline_id,price,name,m_usage,cpu_type,screen_size,screen_radio,memory_size,harddisc_size,weight,thickness,xianka_chip,xianka_rongliang',	//屏幕尺寸、分辨率、内存容量、硬盘容量、重量、厚度、显卡芯片、显卡容量
	$condition_desktop = 'cover_image,pconline_id,price,name,m_usage,cpu_type,mem_daxiao,disk_size',	//内存容量、显卡芯片
	$condition_allin1  = 'cover_image,pconline_id,price,name,m_usage,cpu_type,screen_size,screen_ratio,mem_rongliang,xianka_chip',	//屏幕尺寸、分辨率、内存容量、显卡芯片
	$condition_tablet = 'cover_image,pconline_id,price,name,m_usage,cpu_type,screen_size,screen_ratio,mem_rongliang,disk_size,weight,m_thickness,xianka_chip',	//屏幕尺寸、分辨率、内存容量、硬盘容量、重量、厚度、显卡芯片
);
// print_r($conditions);exit;

//在二维数组增加元素
$count_tables = count($tablenames);
$count_tags = count($tags);
for ($i = 0; $i < $count_tables; $i++) {
	$tn = 'products_'.$tablenames[$i];
	for ($j = 0; $j < $count_tags; $j++) {
		$result[$i][$j] = $db->fetchAll("SELECT $conditions[$i] FROM $tn WHERE pconline_id IN ($pconline_id[$i]) AND m_usage LIKE '%$tags[$j]%'");
		if ($result[$i][$j] == null) {
			continue;
		}
		for ($k = 0; $k < count($result[$i][$j]); $k++) {
			$result[$i][$j][$k]['tableName'] = $tablenames[$i];
		}
	}
}
$products = array_merge($result[0][0],$result[0][1],$result[0][2],$result[0][3],$result[0][4],$result[1][0],$result[1][1],$result[1][2],$result[1][3],$result[1][4],$result[2][0],$result[2][1],$result[2][2],$result[2][3],$result[2][4],$result[3][0],$result[3][1],$result[3][2],$result[3][3],$result[3][4],$result[4][0],$result[4][1],$result[4][2],$result[4][3],$result[4][4]);
// print_r($products);exit;