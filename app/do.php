<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';
	require_once "Mail.php";
	require_once 'Mail/mime.php';

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
	} else if ($what == "testEmail") {

		 $from = "Sandra Sender <viva@handipoints.com>";
		 $to = "Viva Chu <viva@handipoints.com>";
		 $subject = "Hi!";


		$text = 'Text version of email';
		$html = '<html><body><b>HTML</b> <a href="http://www.yahoo.com">version</a> of email</body></html>';
		$crlf = "\n";

		$mime = new Mail_mime($crlf);

		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);

		//do not ever try to call these lines in reverse order
		$body = $mime->get();


		 $headers = array ('From' => $from,
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