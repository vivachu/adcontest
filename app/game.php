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

	if ($prize['place'] == 0) {
		$win = "false";
	} else {
		$win = "true";
	}
	$thumb = "prizes/Prize_" . $prize['image'] . "_Icon_2.png";
	$bigImage = "prizes/Prize_" . $prize['image'] . "_Icon_1.png";
?>

				<p>To play, just click on one of the doors to open it and reveal what's inside.  It could be BOT, it could be NOT.  Good Luck!</p>
				<div id="gameSwf" style="margin-top:20px;">
					<object width="480" height="350" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab" id="Game" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
						<param value="DoorAnim.swf" name="movie">
						<param value="high" name="quality">
						<param value="transparent" name="wmode">
						<param value="all" name="allowNetworking">
						<param value="always" name="allowScriptAccess">
						<param value="prizeName=<?= $prize['name'] ?>&prizeImageUrl=<?= $thumb ?>&prizeImageBigUrl=<?= $bigImage ?>&win=<?= $win ?>" name="flashvars">
						<embed width="480" align="middle" height="350" pluginspage="http://www.adobe.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="always" allownetworking="all"
						flashvars="prizeName=<?= $prize['name'] ?>&prizeImageUrl=<?= $thumb ?>&prizeImageBigUrl=<?= $bigImage ?>&win=<?= $win ?>" quality="high" loop="false" play="true" name="Game" id="Game" wmode="transparent"
						src="DoorAnim.swf">
					</object>
				</div>
				<div id="buttonOverlay">
<?php
	if (isset($prizeSchedule)) {
?>
					<p id="clickToRedeem"><a href="redeem.php?c=<?= $prizeSchedule['redemption_code'] ?>">Click to Redeem</a></p>
<?php
	} else if (isset($prize['link'])) {
?>
					<p id="clickToRedeem"><a href="<?= $prize['link'] ?>">Click to View</a></p>
					<p id="inviteFriends"><a href="javascript:{}" onclick="inviteFriends();">Invite Your Friends</a></p>
<?php
	}
?>
				</div>
