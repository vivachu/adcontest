<?php
	require_once 'svedka-config.php';
	require_once 'include/sql.php';
	require_once "Mail.php";
	require_once 'Mail/mime.php';

	$what = $_REQUEST['what'];
	if ($what == "like") {
		$fbid = $_REQUEST['fbid'];
		like($fbid);
	} else if ($what == "unredeem") {
		$redemptionCode = $_REQUEST['c'];
		unredeemPrize($redemptionCode);
	} else if ($what == "testEmail") {
		$to = $_REQUEST['email'];
		$subject = "IT'S BOTTER THAN NOTHING";
		$text = file_get_contents('./email/NOT/index.txt');
		$html = file_get_contents('http://dev.adcontests.com' . '/email/NOT/index.php?friend=Agatha&c=383273&prizeName=' . urlencode('Ant Farm') . '&prizeImage=AntFarm');
		sendEmail($to, $subject, $text, $html); // send to player

	}
	else if ($what == "redeem") {
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


		$to = $_REQUEST['email'];
		if ($prizeSchedule['place'] == 1) {
			$subject = "BOT OR NOT";
			$text = file_get_contents('./email/BOT/index.txt');
			$text = str_replace("PRIZE_NAME", $prizeSchedule['prize_name'], $text);
			$html = file_get_contents($web_url . '/email/BOT/index.php?prizeName=' . urlencode($prizeSchedule['prize_name']) . '&prizeImage=' . $prizeSchedule['prize_image']);
		} else if ($prizeSchedule['place'] >= 2 && $prizeSchedule['place'] <= 5) {
			$subject = "IT'S BOTTER THAN NOTHING";
			$text = file_get_contents('./email/SECONDARY/index.txt');
			$text = str_replace("PRIZE_NAME", $prizeSchedule['prize_name'], $text);
			$html = file_get_contents($web_url . '/email/SECONDARY/index.php?prizeName=' . urlencode($prizeSchedule['prize_name']) . '&prizeImage=' . $prizeSchedule['prize_image']);
		} else {
			$subject = "IT'S BOTTER THAN NOTHING";
			$text = file_get_contents('./email/NOT/index.txt');
			$html = file_get_contents($web_url . '/email/NOT/index.php?prizeImage=' . urlencode($prizeSchedule['prize_image']));
		}
//		$html = $text;
		sendEmail($to, $subject, $text, $html); // send to player

		$to = $svedka_admin_email;
		$subject = "New Prize Redemption";
		$html = "<h4>". $prizeSchedule['prize_name'] . "</h4><p>". $_REQUEST['first'] . " " . $_REQUEST['last']. "</p><p>". $address . "</p><p>" . $_REQUEST['city'] . ", " . $_REQUEST['state'] . " " . $_REQUEST['zip'] . "<p></p><p>" . $_REQUEST['email']. "</p>";
		$text = "";
		sendEmail($to, $subject, $text, $html); // send to admin
	} else if ($what == "redeemFriend") {
		$redemptionCode = $_REQUEST['c'];
		$referral = getReferralWinnerFromCode($redemptionCode);
		if (!isset($referral) || $referral['status'] != 0) {
			exit();
		}
		$address = $_REQUEST['street'];
		if (isset($_REQUEST['apt']) && strlen($_REQUEST['apt']) > 0) {
			$address = $address . ", " . $_REQUEST['apt'];
		}
		redeemReferralPrize($referral['id'], $_REQUEST['first'], $_REQUEST['last'], $address, $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip'], $_REQUEST['email']);

		$to = $_REQUEST['email'];
		$subject = "BOT OR NOT";
		$text = file_get_contents('./email/BOT/index.txt');
		$text = str_replace("PRIZE_NAME", $referral['prize_name'], $text);

		$html = file_get_contents($web_url . '/email/BOT/index.php?prizeImage=' . $prizeSchedule['prize_image'] . 'prizeName=' . urlencode($prizeSchedule['prize_name']));
//		$html = $text;
		sendEmail($to, $subject, $text, $html); // send to player

		$to = $svedka_admin_email;
		$subject = "New Prize Redemption - Friend";
		$html = "<h4>". $referral['prize_name'] . "</h4><p>". $_REQUEST['first'] . " " . $_REQUEST['last']. "</p><p>". $address . "</p><p>" . $_REQUEST['city'] . ", " . $_REQUEST['state'] . " " . $_REQUEST['zip'] . "<p></p><p>" . $_REQUEST['email']. "</p>";
		$text = "";
		sendEmail($to, $subject, $text, $html); // send to admin


	} else if ($what == "sendFriendEmail") {
		$redemptionCode = $_REQUEST['c'];
		$prizeSchedule = getPrizeScheduleFromCode($redemptionCode);

		if (!isset($prizeSchedule) || !isset($prizeSchedule['friend_id']) || $prizeSchedule['status'] != 1) {
			exit();
		}
		$friend = getPlayerFromId($prizeSchedule['friend_id']);
		$referral = insertReferralWinner($prizeSchedule['id'], $friend['id']);

		$to = $friend['email'];
		$subject = "A FACEBOOK FRIENDSHIP ACTUALLY PAID OFF";
		$text = file_get_contents('./email/BOT-Friend/index.txt');
		$text = str_replace("PRIZE_NAME", $prizeSchedule['prize_name'], $text);
		$text = str_replace("FRIEND_NAME", $prizeSchedule['username'], $text);
		$text = str_replace("REDEEM_URL", $app_url . "/redeem-friend.php?c=" . $referral['redemption_code'], $text);

		$html = file_get_contents($web_url . "/email/BOT-Friend/index.php?friend=" . $prizeSchedule['username'] . "&prizeName=" . $prizeSchedule['prize_name'] . "&prizeImage=" . $prizeSchedule['prize_image'] . "&c=" . $referral['redemption_code']);

		//$html = $text;
		sendEmail($to, $subject, $text, $html); // send to friend
	}

	function sendEmail($to, $subject, $text, $html) {
		include 'svedka-config.php';

		$crlf = "\n";

		$mime = new Mail_mime($crlf);

		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);

		//do not ever try to call these lines in reverse order
		$body = $mime->get();


		 $headers = array ('From' => $smtp_from,
		   'To' => $to,
		   'Subject' => $subject);
		 $smtp = Mail::factory('smtp',
		   array ('host' => $smtp_host,
		   		  'port' => $smtp_port,
			 'auth' => true,
			 'username' => $smtp_username,
			 'password' => $smtp_password));


		 $hdrs = $mime->headers($headers);

		 $mail = $smtp->send($to, $hdrs, $body);

		 if (PEAR::isError($mail)) {
		   echo("<p>" . $mail->getMessage() . "</p>");
		  } else {
		   echo("<p>Message successfully sent!</p>");
		  }
	}
?>