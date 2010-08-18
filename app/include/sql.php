<?php
	function connectDatabase() {
        # DB connection params
        $dbuser = "adcontest";
        $dbpw = "adcontest";
        $dbhost = "localhost";
        $db = "adcontest";
        mysql_connect($dbhost, $dbuser, $dbpw) or die(mysql_error());
        mysql_select_db($db) or die(mysql_error());
	}

	function executeQueryList($sql) {
		connectDatabase();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
		$items = array();
		while ($row = mysql_fetch_array($rows)) {
			array_push($items, $row);
		}
		return $items;
	}

	function executeQueryObject($sql) {
		connectDatabase();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
		return mysql_fetch_array($rows);
	}

	function executeUpdate($sql) {
		connectDatabase();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
//		return mysql_fetch_array($rows);
	}

	function executeInsert($sql) {
		connectDatabase();
		$rows = mysql_query($sql) or die(mysql_error() . printError($sql));
		return mysql_insert_id();
	}

	function getPlayer($id) {
		return executeQueryObject("select * from players where id=" . $id);
	}

// TODO replace hardcoded date with now()
	function getWinningPrize() {
		$sql = "select p.*, ps.id as prize_schedule_id from prize_schedule ps, prizes p where ps.prize_id=p.id and winner_id is null and win_date <= '2010-10-22 24:33' order by win_date desc limit 1;";
		$prize = executeQueryObject($sql);
	}

?>