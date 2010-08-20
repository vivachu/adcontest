<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';

	$fbid = $_REQUEST['fbid'];
	$test_date = "'2010-10-22 24:33'";


	$player = getPlayer($fbid);
	if ($player['has_played'] == 1 || $player['liked'] == 0) {
//		exit;
	}
	playGame($fbid);

	$prize = getWinningPrize($test_date);
	if (!isset($prize) || $prize['name'] == null) {
		$prize = getRandomNotPrize();
	} else {
		winPrize($prize['prize_schedule_id'], $player['id']);
	}
?>

				<p>To play, just click on one of the doors to open it and reveal what's inside.  It could be BOT, it could be NOT.  Good Luck!</p>
				<div id="game">
<?php
	if ($prize['place'] == 0) {
?>
					<h1>NOT</h1>
<?php
	}
	else {
?>
					<h1>BOT - YOU WIN!</h1>
<?php
	}
?>
					<h2><?= $prize['name'] ?></h2>
				</div>
