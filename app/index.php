<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';

	// Create our Application instance.
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
		$uid = $facebook->getUser();
		$me = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
	  }
	}

	// login or logout url will be needed depending on current user state.
	if ($me) {
	  $logoutUrl = $facebook->getLogoutUrl();
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}

	// This call will always work since we are fetching public data.
	$naitik = $facebook->api('/naitik');




	$fbid = 1644085704;
	$test_date = "'2010-10-22 24:33'";


	$player = getPlayer($fbid);
	$grandPrize = getGrandPrize($test_date);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bot or Not!</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script>

	var liked = <?= $player['liked'] ?>;
	var hasPlayed = <?= $player['has_played'] ?>;

	function onDoorSelected() {
		document.getElementById("redeemContainer").style.display="block";
	}

	function inviteFriends() {
		alert("Invite friends");
	}

	function share() {
		alert("Share");
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
			  jQuery.ajax({
				  type: "GET",
				  url: "game.php?fbid=<?= $fbid ?>",
				  cache: false,
				  success: function (response) {hasPlayed=true; document.getElementById('playGame').innerHTML = response; },
				  error: function () {}
			  });
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
    <!--
      We use the JS SDK to provide a richer user experience. For more info,
      look here: http://github.com/facebook/connect-js
    -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo $facebook->getAppId(); ?>',
          session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
<div id="fbExample">
    <?php if ($me): ?>
    <a href="<?php echo $logoutUrl; ?>">
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>
    <?php else: ?>
    <div>
      Using JavaScript &amp; XFBML: <fb:login-button></fb:login-button>
    </div>
    <div>
      Without using JavaScript &amp; XFBML:
      <a href="<?php echo $loginUrl; ?>">
        <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
      </a>
    </div>
    <?php endif ?>

    <h3>Session</h3>
    <?php if ($me): ?>
    <pre><?php print_r($session); ?></pre>

    <h3>You</h3>
    <img src="https://graph.facebook.com/<?php echo $uid; ?>/picture">
    <?php echo $me['name']; ?>

    <h3>Your User Object</h3>
    <pre><?php print_r($me); ?></pre>
    <?php else: ?>
    <strong><em>You are not Connected.</em></strong>
    <?php endif ?>

    <h3>Naitik</h3>
    <img src="https://graph.facebook.com/naitik/picture">
    <?php echo $naitik['name']; ?>
</div>



	<div id="container">
    	<div id="top">
        	<p class="left">Like us? Click the button above.</p>
            <p class="right"><a href="javascript:{}" onclick="like();">Like</a><a href="javascript:{}" onclick="share();">Share</a></p>
        </div>
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
        	<h2 class="left">bot or not?</h2>
            <div class="round right">play and win</div>
            <div class="clear"></div>
            <div id="playGame">
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
					<a href="javascript:{};" class="right" onclick="inviteFriends();" style="margin-left:10px;width:111px;height:25px;background:url(images/invite-friends-button.png) no-repeat;">invite friends</a>
				</div>

				<div class="left"><img src="prizes/Prize_<?= $grandPrize['image'] ?>_Icon_1.png" alt="<?= $grandPrize['name'] ?>" width="200" height="200" /></div>
				<div class="desc">
				<p class="title"><?= $grandPrize['name'] ?></p>
				<p><?= $grandPrize['description'] ?></p>
				</div>
				<div class="clear"></div>
				<a href="javascript:{}" onclick="inviteFriends();" class="invite" >invite friends to play</a>
			</div> <!-- end playGame -->

	<?php include "include/footer.php"; ?>

            <div id="btm"></div>
        </div>
    </div>
</body>
</html>