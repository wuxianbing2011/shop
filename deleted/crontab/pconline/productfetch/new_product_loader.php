<?php 


$add_new_prod = array(
		'key'=>0
		,'tablet'=>array(537414,582954,592308,589693,586669,)
		//,'2in1'=>array()
		//,'desktop'=>array(593433)//,598983
		,'laptop'=>array(575578,577212,582565,588539,588540,588541,588542,574580,574581,574582,
					 	 597789,592714,581428,585273,591051,598720,596135,575464,588717,591329,
						 591328)
		//589947,599182,593400,585273,593861,587693,584947,591740,586734,593347,580083,579745,583529,593934,599273,599289,582201,599064,576896,595434,577787,586467,587316,590819,586444,592308,561271,569210,593853,588717				 
		//,'allin1'=>array(598974,580014,570630) 		
		//,'mobile'=>array()
		//,'cpu'=>array()
		//,'ssd'=>array()
		//,'mainboard'=>array()
);


function newProductLoad( $add_new_prod , $return_type ){
	$types_en_prodlist = array( 'key'=>0 );
	
	$types_cn_prodlist = array(	'key'=>0 );
	
	if ( $return_type == 'en' ){
		foreach ( $add_new_prod as $type => $ids ){
			if($ids==0){continue;}
			$type = 'products_'.$type;
			$types_en_prodlist[$type] = $ids;
		}
		return $types_en_prodlist;
	}else if( $return_type == 'cn' ){
		foreach ( $add_new_prod as $type => $ids ){
			if($ids==0){continue;}
			switch ($type){
				case 'tablet':
					$types_cn_prodlist['平板电脑'] = $ids; break;
				case '2in1':
					$types_cn_prodlist['2in1'] = $ids; break;
				case 'desktop':
					$types_cn_prodlist['台式机'] = $ids; break;
				case 'laptop':
					$types_cn_prodlist['笔记本'] = $ids; break;
				case 'allin1':	
					$types_cn_prodlist['一体电脑'] = $ids; break;
				case 'mobile':
					$types_cn_prodlist['手机'] = $ids; break;
				case 'cpu':
					$types_cn_prodlist['CPU'] = $ids; break;
				case 'ssd':
					$types_cn_prodlist['SSD'] = $ids; break;
				case 'mainboard':
					$types_cn_prodlist['主板'] = $ids; break;					
			}
		}
		return $types_cn_prodlist;
	}	
}


function decodeData($rawData) {
	$data = json_decode($rawData, true);
	if (!empty($data)) {
		return $data;
	}
	$data = iconv("gbk", "utf-8", $rawData);
	$data = preg_replace(array("/\/\/[\<\>a-zA-Z\/\s]+?\n/", "/\/\*[\s\S]+?\*\//"), "", $data);
	$data = trim($data);
	$data = substr($data, 1, strlen($data)-(strrpos($data, ";")==strlen($data)-1 ? 3 : 2));
	$data = str_replace("'", '"', $data);
	$data = preg_replace("/([a-zA-Z]+)\:([^\/])/", '"$1":$2', $data);
	$realData = json_decode($data, true);
	return $realData;
}