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

	function printError($sql){
		global $_debug;
		$_debug=true;
		if ($_debug){
			echo "sql = [".$sql. "]\n" . var_dump(debug_backtrace());
		} else{
			return '';
		}
	}


	function getPlayer($fbid) {
		$player = executeQueryObject("select id, username, friend_id, facebook_id, liked, date_format(last_played, '%Y-%m-%d') as last_played, date_format(now(), '%Y-%m-%d') as now_date from players where facebook_id=" . $fbid);
		if (!isset($player['last_played']) || $player['last_played'] != $player['now_date']) {
			$player['has_played'] = 0;
		} else {
			$player['has_played'] = 1;
		}
		return $player;
	}

	function getPlayerFromId($id) {
		$sql = "select * from players where id=$id";
		return executeQueryObject($sql);
	}

// TODO replace hardcoded date with now()

	function getWinningPrize($test_date) {
		$sql = "select p.*, ps.id as prize_schedule_id from prize_schedule ps, prizes p where ps.prize_id=p.id and winner_id is null and win_date <= " . $test_date . " order by win_date desc limit 1";
		$prize = executeQueryObject($sql);
		return $prize;
	}

	function getRandomNotPrize() {
		$sql = "select p.* from prizes p where place=0 order by rand()*id limit 1";
		$prize = executeQueryObject($sql);
		return $prize;
	}

	function getGrandPrize($test_date) {
		$sql = "select p.* from prize_schedule ps, prizes p, contests c where ps.contest_id=c.id and ps.prize_id=p.id and " . $test_date . " >= c.start_date and " . $test_date . " <= c.end_date and p.place=1 limit 1";
		$prize = executeQueryObject($sql);
		return $prize;
	}

	function like($fbid) {
		$sql = "update players set liked=1 where facebook_id=" . $fbid;
		executeUpdate($sql);
	}

	function playGame($fbid) {
		$sql = "update players set last_played=now() where facebook_id=" . $fbid;
		executeUpdate($sql);
	}

	function insertPlayer($fbid, $friendId, $username) {
		$sql = "insert into players(facebook_id, friend_id, username) values($fbid, $friendId, '$username')";
		return executeInsert($sql);
	}

	function winPrize($prizeScheduleId, $playerId) {
		$sql = "update prize_schedule set winner_id=$playerId, redemption_code=sha1(now()*rand()) where id=$prizeScheduleId";
		executeUpdate($sql);
		return executeQueryObject("select * from prize_schedule where id=$prizeScheduleId");
	}

	function getPrizeScheduleFromCode($code) {
		$sql = "select ps.*, p.name as prize_name, p.place as place, p.image as prize_image, pl.username as username, pl.facebook_id as facebook_id, pl.email as email, pl.friend_id from prize_schedule ps, prizes p, players pl where redemption_code='$code' and ps.prize_id=p.id and ps.winner_id=pl.id";
		$ps = executeQueryObject($sql);
		return $ps;
	}

	function redeemPrize($prizeScheduleId, $firstName, $lastName, $address, $city, $state, $zip, $email) {
		$sql = "update prize_schedule set status=1, first_name='$firstName', last_name='$lastName', address='$address', city='$city', state='$state', email_address='$email' where id=$prizeScheduleId";
		executeUpdate($sql);
	}

	function insertReferralWinner($prizeScheduleId, $friendId) {
		$sql = "insert into referral_winners(prize_schedule_id, friend_id, status) values($prizeScheduleId, $friendId, 0)";
	}

	function redeemReferralPrize($referralPrizeId, $firstName, $lastName, $address, $city, $state, $zip, $email) {
		$sql = "update referral_winners set first_name='$firstName', last_name='$lastName', address='$address', city='$city', state='$state', email_address='$email' where id=$referralPrizeId";
		executeUpdate($sql);
	}
?>