<?php
function output($message, $newline=true){
	if(isWindows()){
		$message = iconv("utf-8", "gbk", $message);
	}
	if($newline){
		$message .= "\n";
	}
	fwrite(STDOUT, $message);
}

function debug($message, $newline=true){
	if($newline){
		$message = date('[H:i:s] : ').$message."\n";
	}
	if(isWindows()){
		$message = iconv("utf-8", "gbk", $message);
		echo $message;
		flush();
	}else{
		echo $message;
		ob_flush();
	}
}
function showProgress($persent, $maxBacklength = 7){
	$persent = round(100 * $persent, 2)."%";
	if(strlen($persent) < $maxBacklength){
		$persent .= str_repeat(" ", $maxBacklength - strlen($persent));
	}
	$backspace = chr(8);
	echo str_repeat($backspace, $maxBacklength);
	debug($persent, false);
}

function isWindows(){
	return PHP_OS == 'WINNT' || PHP_OS == 'WIN32';
}