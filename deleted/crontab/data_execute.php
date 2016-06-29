<?php
require_once __DIR__.'/../webconfig.php';

$sqlstr = file_get_contents($_GET['name'].".sql");

$sqls = explode("\n", $sqlstr);

foreach($sqls as $sql) {
	if (empty($sql) || $sql == "") {
		continue;
	} else {
		$db->query($sql);
	}
}

exit("done");