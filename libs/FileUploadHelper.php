<?php
class FileUploadHelper {
	public static function isAnyFileUploaded() {
		if (empty($_FILES)) {
			return false;
		}
		$validCount = 0;
		foreach ($_FILES as $key => $file) {
			if (isset($file['error']) && !is_array($file['error'])) {
				if ($file['error'] == 0) {
					$validCount++;
				}
			} else {
				foreach ($file['error'] as $err) {
					if ($err == 0) {
						$validCount++;
					}
				}
			}
		}
		return $validCount;
	}

	public static function isAnyImageUploaded() {
		if (empty($_FILES)) {
			return false;
		}
		$validCount = 0;
		foreach ($_FILES as $key => $file) {
			if (isset($file['error']) && !is_array($file['error'])) {
				if ($file['error'] == 0 && strpos($file['type'], "image") !== false ) {
					$validCount++;
				}
			} elseif (isset($file['error']) && is_array($file['error'])) {
				$count = count($file['error']);
				for ($i=0; $i < $count; $i++) { 
					$err = $file['error'][$i];
					$type = $file['type'][$i];
					if ($err == 0 && strpos($type, "image") !== false ) {
						$validCount++;
					}
				}
			}
		}
		return $validCount;
	}

	public static function getErrorFiles() {
		if (empty($_FILES)) {
			return false;
		}
		$files = array();
		foreach ($_FILES as $key => $file) {
			if (isset($file['error']) && !is_array($file['error'])) {
				if ($file['error'] != 0) {
					$files[$key] = $file;
				}
			} elseif (isset($file['error']) && is_array($file['error'])) {
				$count = count($file['error']);
				for ($i=0; $i < $count; $i++) { 
					$err = $file['error'][$i];
					if ($err != 0) {
						$files["{$key}.{$i}"] = array('name'=>$file['name'][$i]
										, 'type'=>$file['type'][$i]
										, 'tmp_name'=>$file['tmp_name'][$i]
										, 'error'=>$file['error'][$i]
										, 'size'=>$file['size'][$i]);
					}
				}
			}
		}
		return $files;
	}

	public static function getMultiUploadedFiles() {
		if (empty($_FILES)) {
			return false;
		}
		$files = array();
		foreach ($_FILES as $key => $file) {
			if (isset($file['error']) && !is_array($file['error'])) {
				if ($file['error'] == 0) {
					$files[$key] = $file;
				}
			} elseif (isset($file['error']) && is_array($file['error'])) {
				$count = count($file['error']);
				for ($i=0; $i < $count; $i++) { 
					$err = $file['error'][$i];
					if ($err == 0) {
						$files["{$key}.{$i}"] = array('name'=>$file['name'][$i]
										, 'type'=>$file['type'][$i]
										, 'tmp_name'=>$file['tmp_name'][$i]
										, 'error'=>$file['error'][$i]
										, 'size'=>$file['size'][$i]);
					}
				}
			}
		}
		return $files;
	}

	public static function getMultiUploadedImages() {
		if (empty($_FILES)) {
			return false;
		}
		$files = array();
		foreach ($_FILES as $key => $file) {
			if (isset($file['error']) && !is_array($file['error'])) {
				if ($file['error'] == 0 && strpos($file['type'], "image") !== false ) {
					$files[$key] = $file;
				}
			} elseif (isset($file['error']) && is_array($file['error'])) {
				$count = count($file['error']);
				for ($i=0; $i < $count; $i++) { 
					$err = $file['error'][$i];
					$type = $file['type'][$i];
					if ($err == 0 && strpos($type, "image") !== false ) {
						$files["{$key}.{$i}"] = array('name'=>$file['name'][$i]
										, 'type'=>$file['type'][$i]
										, 'tmp_name'=>$file['tmp_name'][$i]
										, 'error'=>$file['error'][$i]
										, 'size'=>$file['size'][$i]);
					}
				}
			}
		}
		return $files;
	}

	public static function saveUploadedFiles($savepath=null) {
		$files = self::getMultiUploadedFiles();
		if (empty($files)) {
			return false;
		}
		if ($savepath == null) {
			$savepath = __DIR__."/uploads";
		}
		if (empty($savepath)) {
			exit("empty savepath");
			return false;
		}
		$savepath = realpath($savepath).'/';
		//$relpath = date('Ym/d/');
		//$savepath .= date('Ym/d/');
		if (!file_exists($savepath)) {
			if (!mkdir($savepath, 0755, true)) {
				exit("mkdir error");
				return false;
			}
		}
		$savedFiles = array();
		foreach ($files as $key => $file) {
			$fileExt = strtolower( substr($file['name'], strrpos($file['name'], '.')) );
			$filename = time() . substr(md5($file['name'] . mt_rand(10000, 100000)), 8, 8) . $fileExt;
			$filepath = $savepath . $filename;
			$relfilepath = /*$relpath . */$filename;
			if (move_uploaded_file($file["tmp_name"], $filepath)) {
				$savedFiles[$key] = array_merge($file, array('full_savepath'=>$filepath, 'rel_savepath'=>$relfilepath, 'file_ext'=>$fileExt));
			} else {
				//exit('move file error:'. $filepath);
			}
		}
		return $savedFiles;
	}
}