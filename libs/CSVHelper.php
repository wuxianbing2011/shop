<?php
class CSVHelper{
	public static function generateCSVStr(array $data){
		if(empty($data)){
			return "";
		}
		$resultRows = array();
		foreach($data as $item){
			foreach($item as $key=>$colItem){
				$item[$key] = self::formatForCSV($colItem);
			}
			$resultRows[] = implode(",", $item);
		}
		return implode("\r\n", $resultRows);
	}
	
	public static function formatForCSV($str){
		if(empty($str)){
			return "";
		}
		if(preg_match("/^[\d]+(\.[\d]+)?$/", $str)){
			return $str."\t";
		}
		$str = str_replace(array(',','"',"\n\r"),array('，','""',''),$str);
		if($str == ""){
			$str = '""';
      	}
      	$str = iconv('utf-8', 'gbk', $str);
		return $str;
	}
	
	public static function getDataArrayFromCSV($str){
		if(empty($str)){
			return array();
		}
		$lines = explode("\r\n", $str);
		$data = array();
		foreach($lines as $line){
			if(trim($line) == ""){
				continue;
			}
			$line = iconv("gbk", "utf-8", $line);
			$cols = explode(",", $line);
			$data[] = $cols;
		}
		return $data;
	}
	public static function exportCsv($filename,$data) { 
	    header("Content-type:text/csv"); 
	    header("Content-Disposition:attachment;filename=".$filename); 
	    header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
	    header('Expires:0'); 
	    header('Pragma:public'); 
	    echo $data;
	    exit;
	} 
}