<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';

	$fbid = 1644085704;
	$test_date = "'2010-10-22 24:33'";


	$player = getPlayer($fbid);
	$grandPrize = getGrandPrize($test_date);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bot or Not!</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script>

	var liked = <?= $player['liked'] ?>;
	var hasPlayed = <?= $player['has_played'] ?>;

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
				<p>Everyone is a winner! Sort of. Just pick a door to see if you win this week’s amazing SVEDKA BOT prize … or end up with a fun consolation NOT prize. Increase your chances to win by inviting friends — If one of them wins a Bot Grand Prize, you do too! Click below to play.</p>
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
					<a href="javascript:{};" class="right" onclick="inviteFriends();">invite friends</a>
					<a href="javascript:{};" class="right" onclick="document.getElementById('alreadyPlayedPopup').style.display='none';">close</a>
				</div>

				<div class="left"><img src="images/iPad.png" alt="" /></div>
				<div class="desc">
				<p class="title"><?= $grandPrize['name'] ?></p>
				<p><?= $grandPrize['description'] ?></p>
				</div>
				<div class="clear"></div>
				<a href="javascript:{}" onclick="inviteFriends();" class="invite" >invite friends to play</a>
			</div> <!-- end playGame -->
			<div id="footer">
	            <p>PLAY RESPONSIBLY. SVEDKA® Vodka - 40% alc/vol. (80 proof), 100% grain neutral spirits, product of Sweden,<br />sole U.S. Importer: Spirits Marque One LLC, New York, NY.</p>
			</div>
            <div id="btm"></div>
        </div>
    </div>
</body>
</html>