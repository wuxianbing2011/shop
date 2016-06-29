<?php
require_once __DIR__.'/libs/lcdb.php';
require_once __DIR__.'/libs/functions.php';

$config = array(
	'db' => array('host'=>'127.0.0.1', 'user'=>'root', 'password'=>'root', 'dbname'=>'intel_shop_mobile')
);

if (!isset($autoInit) || $autoInit==true) {
	//init
	Config::init($config);
	//db
	$db = LcDb::factory($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['dbname']);
}

if (empty($_COOKIE['shop_dmp_uid'])) {
	$remoteKey = (empty($_SERVER['REMOTE_ADDR']) ? '' : $_SERVER['REMOTE_ADDR']) .":". (empty($_SERVER['REMOTE_PORT']) ? '' : $_SERVER['REMOTE_PORT']);
	$dmpCookieUid = md5(mt_rand(10000, 99999)."_".time()."_".$remoteKey);
	setcookie("shop_dmp_uid", $dmpCookieUid, time()+3600*24*30*12,"/");
	$_COOKIE['shop_dmp_uid'] = $dmpCookieUid;
}
if (!empty($_GET['dmp_cookie_debug'])) {
	exit($_COOKIE['shop_dmp_uid']);
}


class Config {
	public static $config = array();
	public static function init($config) {
		self::$config = $config;
	}
}