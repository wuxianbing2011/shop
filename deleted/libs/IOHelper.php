<?php
class IOHelper{
	public static function getAllSubFiles($dirPath){
		if(empty($dirPath) || !is_dir($dirPath)){
			return array();
		}
		$result = array();
		if ($handle = opendir($dirPath)) {  
			while (false !== ($file = readdir($handle))) {
				if (in_array($file, array(".", ".."))){
					continue;
				}elseif(is_file(realpath($dirPath)."/".$file)){
					$result[] = $file;
				}  
			}
		}
		closedir($handle);
		return $result;
	}
	
	public static function getAllSubDirs($dirPath){
		if(empty($dirPath) || !is_dir($dirPath)){
			return array();
		}
		$result = array();
		if ($handle = opendir($dirPath)) {  
			while (false !== ($file = readdir($handle))) {
				if (in_array($file, array(".", ".."))){
					continue;
				}elseif(is_dir(realpath($dirPath)."/".$file)){
					$result[] = $file;
				}  
			}
		}
		closedir($handle);
		return $result;
	}

	public static function dirIswritable($dirPath){
		$dirPath= realpath($dirPath);
		if(!is_dir($dirPath)){
			return false;
		}else{
			$fileHd=@fopen($dirPath.'/test.txt','w');
			if(!$fileHd){
				@fclose($fileHd);
				@unlink($dirPath.'/test.txt');
				return false;
			}
			// $dir_hd=opendir($dir_path);
			// while(false!==($file=readdir($dir_hd))){
			// 	if ($file != "." && $file != "..") {
			// 		if(is_file($dir_path.'/'.$file)){
			// 			//文件不可写，直接返回
			// 			if(!is_writable($dir_path.'/'.$file)){
			// 				return 0;
			// 			}
			// 		}else{
			// 			$file_hd2=@fopen($dir_path.'/'.$file.'/test.txt','w');
			// 			if(!$file_hd2){
			// 				@fclose($file_hd2);
			// 				@unlink($dir_path.'/'.$file.'/test.txt');
			// 				$is_writale=0;
			// 				return $is_writale;
			// 			}
			// 			//递归
			// 			$is_writale=dir_iswritable($dir_path.'/'.$file);
			// 		}
			// 	}
			// }
		}
		return true;
	} 
}