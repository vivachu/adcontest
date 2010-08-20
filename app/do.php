<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';

	$what = $_REQUEST['what'];
	$fbid = $_REQUEST['fbid'];
	if ($what == "like") {
		like($fbid);
	} else if ($what == "redeem") {
		redeemPrize($_REQUEST['prizeScheduleId'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['address'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip'], $_REQUEST['email']);
	} else if ($what == "redeemFriend") {
		redeemReferralPrize($_REQUEST['referralPrizeId'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['address'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip'], $_REQUEST['email']);
	}
?>