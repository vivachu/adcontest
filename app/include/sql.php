<?php
	function connect_database() {
        # DB connection params
        $dbuser = "adcontest";
        $dbpw = "adcontest";
        $dbhost = "localhost";
        $db = "adcontest";
        mysql_connect($dbhost, $dbuser, $dbpw) or die(mysql_error());
        mysql_select_db($db) or die(mysql_error());
	}

	function executeQueryList($sql) {
		connect_database();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
		$items = array();
		while ($row = mysql_fetch_array($rows)) {
			array_push($items, $row);
		}
		return $items;
	}

	function executeQueryObject($sql) {
		connect_database();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
		return mysql_fetch_array($rows);
	}

	function executeUpdate($sql) {
		connect_database();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
//		return mysql_fetch_array($rows);
	}

	function executeInsert($sql) {
		connect_database();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
		return mysql_insert_id();
	}
?>