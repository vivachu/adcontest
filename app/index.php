<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';


	$test_date = "'2010-10-22 24:33'";
//	$test_date = "'now()'";
	$grandPrize = getGrandPrize($test_date);
//echo $grandPrize['name'];
//exit;

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

		$likes = $facebook->api('/me/likes');
		$likes = $likes['data'];

		$player = getPlayer($fbid);
		// check to see if player exists
		if (!isset($player)) {
			$friendId = $_REQUEST['friendId'];
			$player = insertPlayer($fbid, $me['name'], $me['email'], $friendId);
		}

		$player['has_played'] = 0; // temporarily set to false
		$player['liked'] = 0;

		foreach ($likes as $l) {
			if ($l['id'] == $like_app_id) {  // like the page
				$player['liked'] = 1;
			}
		}



		// play the game
		playGame($fbid);
		$prize = getWinningPrize($test_date);
		if (!isset($prize) || $prize['name'] == null) {
			$prize = getRandomNotPrize();
		} else {
			$prizeSchedule = winPrize($prize['prize_schedule_id'], $player['id']);
		}
		if ($prize['place'] == 1) {
			$win = "true";
		} else {
			$win = "false";
		}
		$thumb = "prizes/DoorPrizes/" . $prize['image'] . "_Door.png";
		$bigImage = "prizes/BigPrizes/" . $prize['image'] . "_Big.png";
		$prizeNameUrl = "prizes/TypeBoxes/" . $prize['image'] . "_TypeBox.png";
	  } catch (FacebookApiException $e) {
		error_log($e);
	  }
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bot or Not!</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="style.css?v=1.1" />
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>

<? if ($player): ?>
	var liked = <?= $player['liked'] ?>;
	var hasPlayed = <?= $player['has_played'] ?>;
<? else: ?>
	var liked = 1;
	var hasPlayed = 0;
<? endif; ?>


	function onDoorSelected() {
		document.getElementById("redeemContainer").style.display="block";
	}

	function inviteFriends() {
		alert("Invite friends");
	}

	function share() {
		 var share = {
		   method: 'stream.share',
		   u: '<?= $app_url ?>'
		 };

		 FB.ui(share, function(response) { console.log(response); });
	}

	function like() {
	  if (liked == 0) {
		  jQuery.ajax({
			  type: "GET",
			  url: "do.php?what=like&fbid=<?= $fbid ?>",
			  cache: false,
			  success: function (response) {liked = 1;},
			  error: function () {}
		  });
	  }
	}

	function play() {
		if (liked == 0) {
			document.getElementById("likePopup").style.display="block";
			return;
		}
		if (hasPlayed == 0) {
			window.top.location = "https://graph.facebook.com/oauth/authorize?client_id=<?= $facebook_app_id ?>&redirect_uri=<?= $app_url ?>/&scope=email,publish_stream,user_birthday,user_likes";
		}
		else {
			document.getElementById("alreadyPlayedPopup").style.display="block";
			return;
		}
	}

</script>
<!-- include jQuery library -->
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="javascript/jquery.cycle.all.2.74.js"></script>

<script type="text/javascript" src="javascript/util.js"></script>

<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="ie.css" />
<script src="DD_belatedPNG_0.0.8a.js"></script>
<script>
  DD_belatedPNG.fix('h1 a, .left img, .bot img, a.playBtn, .round, a.invite');
</script>
<![endif]-->
</head>
<body>
	<div id="fb-root"></div>
	<script>
	  window.fbAsyncInit = function() {
		FB.init({appId: '<?= $facebook_app_id ?>', status: true, cookie: true,
				 xfbml: true});
	  };
	  (function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol +
		  '//connect.facebook.net/en_US/all.js';
		document.getElementById('fb-root').appendChild(e);
	  }());
	</script>
	<div id="container">
    	<div id="top">
        	<p class="left">Like us? Click the button above.</p>
            <p class="right"><a href="javascript:{}" onclick="share();">Share</a></p>
        </div>
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
        	<h2 class="left">bot or not?</h2>
            <div class="round right">play and win</div>
            <div class="clear"></div>

            <div id="playGame">
<?php if (isset($me) && !isset($_REQUEST['test'])): ?>
	<!-- load the game if logged in -->
				<p>To play, just click on one of the doors to open it and reveal what's inside.  It could be BOT, it could be NOT.  Good Luck! <span style="font-size:10px;"><a href="#" onclick="window.open('rules.php', 'Rules', 'toolbar=no,location=no,menubar=no,width=785,height=800,scrollbars=yes');" style="color:#ffc821;">See Official Rules</a> for details.</span></p>
				<div id="gameSwf" style="margin-top:30px;">
					<object width="670" height="437" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab" id="Game" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
						<param value="DoorAnim.swf" name="movie">
						<param value="high" name="quality">
						<param value="transparent" name="wmode">
						<param value="all" name="allowNetworking">
						<param value="always" name="allowScriptAccess">
						<param value="prizeName=<?= $prizeNameUrl ?>&prizeImageUrl=<?= $thumb ?>&prizeImageBigUrl=<?= $bigImage ?>&win=<?= $win ?>" name="flashvars">
						<embed width="670" height="437" align="middle" pluginspage="http://www.adobe.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="always" allownetworking="all"
						flashvars="prizeName=<?= $prizeNameUrl ?>&prizeImageUrl=<?= $thumb ?>&prizeImageBigUrl=<?= $bigImage ?>&win=<?= $win ?>" quality="high" loop="false" play="true" name="Game" id="Game" wmode="transparent"
						src="DoorAnim.swf">
					</object>
				</div>
				<div id="inviteFriends" style="margin-top:30px;"><a href="javascript:{}" onclick="inviteFriends();" class="invite" >invite friends to play</a></p>

				<div id="redeemContainer" style="display:none;">
	<?php if (isset($prizeSchedule)): ?>
					<div id="clickToRedeem"><a href="redeem.php?c=<?= $prizeSchedule['redemption_code'] ?>"><img src="prizes/Buttons/Redeem_Btn.png"/></a></p>
	<?php elseif (isset($prize['link'])): ?>
					<div id="clickToRedeem"><a href="<?= $prize['link'] ?>"><img src="prizes/Buttons/View_Btn.png"/></a></p>
	<?php endif; ?>
				</div>
<?php elseif (isset($_REQUEST['test'])): ?>
	<!-- test the output -->
				<p><?= $me['id'] ?> <?= $me['name'] ?> <?= $me['email'] ?> <?= $me['birthday'] ?> <?= $age ?></p>
				<p>
				<?= $player['liked']; ?>
				</p>
				<p>
				<?= print_r($likes); ?>
				</p>
<?php else: ?>
	<!-- Static HTML landing page -->
				<p><b>Everyone is a winner!</b> Sort of. Just pick a door to see if you win this week’s amazing SVEDKA BOT prize … or end up with a fun consolation NOT prize. <b>Increase your chances to win</b> by inviting friends — If one of them wins a Bot Grand Prize, you do too! Click below to play.</p>
				<p class="title">This week's bot prize: <span><?= $grandPrize['name'] ?></span></p>
				<a href="javascript:{}" class="playBtn" onclick="play();">play</a>
				<div class="bot" style="top:240px;"><img src="images/bot.png" alt="" /></div>
				<img src="images/door.png" alt="" />
				<div id="likePopup" class="popup" style="display:none;">
					<h3>I "Like" SVEDKA Vodka</h3>
					<p>To win a "BOT or NOT?" prize, you need to click the "Like" button at the top of the page. Swedish imported, five times distilled and a chance to win amazing BOT prizes ... what's not to like?</p>
					<a href="javascript:{};" class="right" onclick="document.getElementById('likePopup').style.display='none';">close</a>
				</div>
				<div id="alreadyPlayedPopup" class="popup" style="display:none;">
					<h3>Play Responsibly</h3>
					<p>Sorry but you've already played today. Come back tomorrow to play again. Or better yet invite your friends to play now.  If one of them wins the BOT prize, you do too!</p>
					<a href="javascript:{};" class="right" onclick="document.getElementById('alreadyPlayedPopup').style.display='none';">close</a>
					<a href="javascript:{};" class="right" onclick="inviteFriends();" style="margin-left:10px;width:108px;height:26px;background:url(images/invite-friends-button.png) no-repeat;">invite friends</a>
				</div>

				<div class="left"><img src="prizes/Prize_<?= $grandPrize['image'] ?>_Icon_1.png" alt="<?= $grandPrize['name'] ?>" width="200" height="200" /></div>
				<div class="desc">
				<p class="title"><?= $grandPrize['name'] ?></p>
				<p><?= $grandPrize['description'] ?></p>
				</div>
				<div class="clear"></div>
				<a href="javascript:{}" onclick="inviteFriends();" class="invite" >invite friends to play</a>
<?php endif; ?>
			</div> <!-- end playGame -->

	<?php include "include/footer.php"; ?>

            <div id="btm"></div>
        </div>
    </div>

<script type="text/javascript">
window.fbAsyncInit = function() {
  FB.Canvas.setSize({ height: 950 });
}
</script>
</body>
</html>
