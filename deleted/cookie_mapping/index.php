<?php
require_once __DIR__.'/../webconfig.php';

$intelCookieUid = empty($_COOKIE['shop_dmp_uid']) ? false : str_replace("uid=", "", $_COOKIE['shop_dmp_uid']);

if (empty($intelCookieUid)) {
	exit("no intel uid");
}

$adMasterUid = empty($_GET['admaster_id']) ? false : $_GET['admaster_id'];
if (empty($adMasterUid)) {
	exit("no admaster id");
}

$existedRow = $db->fetchRow("select * from cookie_mapping where intel_uid='{$intelCookieUid}'");
if (!empty($existedRow)) {
	$db->query("update cookie_mapping set admaster_uid='{$adMasterUid}' where intel_uid='{$intelCookieUid}'");
} else {
	$db->query("insert into cookie_mapping (admaster_uid, intel_uid) values ('{$adMasterUid}', '{$intelCookieUid}')");
}

header("Location: http://v.admaster.com.cn/mrm/callback?c={$intelCookieUid}");