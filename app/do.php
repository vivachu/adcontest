<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';

	$what = $_REQUEST['what'];
	if ($what == "like") {
		$fbid = $_REQUEST['fbid'];
		like($fbid);
	} else if ($what == "redeem") {
		$redemptionCode = $_REQUEST['c'];
		$prizeSchedule = getPrizeScheduleFromCode($redemptionCode);
		if (!isset($prizeSchedule) || $prizeSchedule['status'] != 0) {
			exit();
		}
		$address = $_REQUEST['street'];
		if (isset($_REQUEST['apt']) && strlen($_REQUEST['apt']) > 0) {
			$address = $address . ", " . $_REQUEST['apt'];
		}
		redeemPrize($prizeSchedule['id'], $_REQUEST['first'], $_REQUEST['last'], $address, $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip'], $_REQUEST['email']);
	} else if ($what == "redeemFriend") {
		redeemReferralPrize($_REQUEST['referralPrizeId'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['address'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip'], $_REQUEST['email']);
	}
?>