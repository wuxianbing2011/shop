<?php
$dbConfig = array('host'=>'10.10.3.44', 'user'=>'shop_mobile', 'password'=>'mobile', 'dbname'=>'intel_shop_mobile');
$db = LcDb::factory($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbname']);

class LcDb {

	private $host;
	private $user;
	private $pwd;
	private $dbname;
	private $conn;

	public static function factory($host, $user, $pwd, $dbname) {
		if (empty($host) || empty($user) || empty($pwd) || empty($dbname)) {
			return false;
		}
		$conn = mysql_connect($host, $user, $pwd);
		if(!$conn){
			exit('error: cannt connect to db');
			return false;
		}
		if(!mysql_select_db($dbname, $conn)) {
			return false;
		}
		return new self($conn, $host, $user, $pwd, $dbname);
	}

	private function __construct($conn, $host, $user, $pwd, $dbname) {
		$this->host = $host;
		$this->user = $user;
		$this->pwd = $pwd;
		$this->dbname = $dbname;
		$this->conn = $conn;

		mysql_query("set names utf8", $this->conn);
	}

	public function close() {
		mysql_close($this->conn);
		$this->conn = null;
	}

	public function connect() {
		if (!empty($this->conn)) {
			mysql_ping($this->conn);
		} else {
			$this->conn = mysql_connect($this->host, $this->user, $this->pwd);
			if (!$this->conn) {
				return false;
			}
			if(!mysql_select_db($dbname, $this->conn)) {
				return false;
			}
		}
		return true;
	}

	public function fetchAll($sql){
		$result = array();
		$res = mysql_query($sql, $this->conn);
		if(!$res){
			return $result;
		}
		while ($row = mysql_fetch_assoc($res)) {
			$result[] = $row;
		}
		return $result;
	}

	public function fetchRow($sql){
		$result = array();
		$res = mysql_query($sql, $this->conn);
		if(!$res){
			return $result;
		}
		$result = mysql_fetch_assoc($res);
		return $result;
	}

	public function fetchOne($sql){
		$result = array();
		$res = mysql_query($sql, $this->conn);
		if(!$res){
			return $result;
		}
		$result = mysql_fetch_assoc($res);
		if(empty($result) || !is_array($result)){
			return 0;
		}
		return current($result);
	}

	public function fetchPairs($sql){
		$result = array();
		$res = mysql_query($sql, $this->conn);
		if(!$res){
			return $result;
		}
		while ($row = mysql_fetch_assoc($res)) {
			reset($row);
			$key = current($row);
			next($row);
			$value = current($row);
			$result[$key] = $value;
		}
		return $result;
	}

	public function fetchCol($sql){
		$result = array();
		$res = mysql_query($sql, $this->conn);
		if(!$res){
			return $result;
		}
		while ($row = mysql_fetch_assoc($res)) {
			$result[] = current($row);
		}
		return $result;
	}

	public function insertData($tableName, $data, $showDebug=false){
		$sql = "insert into {$tableName} ";
		$fields = array();
		$values = array();
		foreach($data as $col=>$value){
			$fields[] = $col;
			$value = $this->checkInput($value);
			$values[] = $value;
		}
		$sql .= "(".implode(",", $fields).") values ('".implode("','", $values)."')";
		$result = mysql_query($sql, $this->conn);
		if($showDebug){
			echo "SQL:".$sql."\r\n";
			echo "result:[".$result."]";
			echo "error_num:".mysql_errno($this->conn)." error:".mysql_error($this->conn);
			exit;
		}
		if (intval(mysql_errno($this->conn)) > 0) {
			echo "SQL:".$sql."\r\n"."result:[".$result."]"."\n\nerror_num:".mysql_errno($this->conn)." error:".mysql_error($this->conn)."\n\n";
		 	exit('ERROR');
		}
		if($result){
			return mysql_insert_id();
		}
		return $result;
	}

	public function replaceData($tableName, $data, $where, $showSql=false){

		$existed = $this->fetchOne("select count(*) from {$tableName} where {$where}");
		if($existed){
			return $this->updateData($tableName, $data, $where, $showSql);
		}else{
			return $this->insertData($tableName, $data, $showSql);
		}
	}

	public function updateData($tableName, $data, $where, $showDebug=false){
		$sql = "update {$tableName} set ";
		$isFirst = true;
		foreach($data as $col=>$value){
			$value = $this->checkInput($value);
			$sql .= ($isFirst ? "" : ",") . "{$col}='{$value}'";
			$isFirst = false;
		}
		$sql .= " where {$where}";
		
		$result = mysql_query($sql, $this->conn);
		if($showDebug){
			echo "SQL:".$sql."\r\n";
			echo "result:[".$result."]";
			echo "error_num:".mysql_errno($this->conn)." error:".mysql_error($this->conn);
			exit;
		}
		if (intval(mysql_errno($this->conn)) > 0) {
			echo "SQL:".$sql."\r\n"."result:[".$result."]"."\n\nerror_num:".mysql_errno($this->conn)." error:".mysql_error($this->conn)."\n\n";
		 	exit('ERROR');
		}
		return $result;
	}

	public function deleteData($tableName, $where){
		return mysql_query("delete from {$tableName} where {$where}", $this->conn);
	}

	public function checkInput($value){
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		//如果不是数字则加引号
		$value = mysql_real_escape_string($value);
		return $value;
	}

	public function getDataBases(){
		$res = mysql_list_dbs($this->conn);
		$databases = array();
		while ($db = mysql_fetch_object($res)){
			$databases[] = $db->Database;
		}
		return $databases;
	}

	public function getTables($dbname=''){
		if ($dbname == '') {
			$dbname = $this->dbname;
		}
		$res = mysql_query("SHOW TABLES FROM $dbname", $this->conn);
		if(empty($res)){
			return array();
		}
		$tables = array();
		while ($table = mysql_fetch_row($res)) {
			$tables[] = $table[0];
		}
		return $tables;
	}

	public function getColumns($tableName){
		$res = mysql_query("SHOW COLUMNS FROM {$tableName}", $this->conn);
		if (!$res) {
			exit('get columns error: ' . mysql_error($this->conn));
		}
		$columns = array();
		if (mysql_num_rows($res) > 0) {
			while ($row = mysql_fetch_assoc($res)) {
				$column = array('name'=>$row['Field'], 'type'=>$row['Type'], 'null'=>$row['Null'],'key'=>$row['Key'],'default'=>$row['Default'],'auto_increment'=>($row['Extra']=='auto_increment'));
				$columns[$row['Field']] = $column;
			}
		}
		return $columns;
	}
	
	public function query($sql){
		return mysql_query($sql);
	}

}


