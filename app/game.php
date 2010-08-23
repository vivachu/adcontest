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
		$prizeSchedule = winPrize($prize['prize_schedule_id'], $player['id']);
	}
?>

				<p>To play, just click on one of the doors to open it and reveal what's inside.  It could be BOT, it could be NOT.  Good Luck!</p>
				<div>
<?php
	if ($prize['place'] == 0) {
?>
					<p class="title">NOT</p>
<?php
	}
	else {
?>
					<p class="title">BOT - YOU WIN!</p>
<?php
	}
?>
					<p class="title"><?= $prize['name'] ?></p>
<?php
	if (isset($prizeSchedule)) {
?>
					<p><a href="redeem.php?c=<?= $prizeSchedule['redemption_code'] ?>">Click to Redeem Your <?= $prize['name']?></a></p>
<?php
	} else if (isset($prize['link'])) {
?>
					<p><a href="<?= $prize['link'] ?>">Click to View Your Prize</a></p>
					<p><a href="javascript:{}" onclick="inviteFriends();">Invite Your Friends</a></p>
<?php
	}
?>
				</div>
