<?php
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => $facebook_app_id,
	  'secret' => $facebook_secret_key,
	  'cookie' => true,
	));

	// We may or may not have this data based on a $_GET or $_COOKIE based session.
	//
	// If we get a session here, it means we found a correctly signed session using
	// the Application Secret only Facebook and the Application know. We dont know
	// if it is still valid until we make an API call using the session. A session
	// can become invalid if it has already expired (should not be getting the
	// session back in this case) or if the user logged out of Facebook.
	$session = $facebook->getSession();

	$me = null;
	// Session based API call.
	$friendFacebookId = $_REQUEST['fid'];
	if ($friendFacebookId) {
		$friend = getPlayer($friendFacebookId);
		$friendId = $friend['id'];
	}
	if ($session) {
	  try {
		$me = $facebook->api('/me');
		// get the Facebook user
		$fbid = $me['id'];
		$bd = explode("/", $me['birthday']);
		$dob1 = $me['birthday']; //$dob1='mm/dd/yyyy' format
		list($m, $d, $y) = explode('/', $dob1);
		$mk = mktime(0, 0, 0, $m, $d, $y);
		$now = time();
		$diff = $now - $mk;
		$age = floor($diff/60/60/24/365);

		$player = getPlayer($fbid);
		// check to see if player exists
		if (!isset($player)) {
			$player = insertPlayer($fbid, $me['name'], $me['email'], $friendId);
		}
	  } catch (FacebookApiException $e) {
		error_log($e);
	  }
	}
	if (!isset($me)) {
		header( 'Location: ' . $fan_page_url . '&fid=' . $friendFacebookId) ;
	}
?>