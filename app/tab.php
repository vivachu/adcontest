<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';


	$test_date = "'2010-10-22 24:33'";
//	$test_date = "'now()'";
	$grandPrize = getGrandPrize($test_date);

?>

<script><!--
	function inviteFriends() {
		new Dialog().showMessage('Dialog', 'Hello World.');
	}

	function share() {
	new Dialog().showMessage('Dialog', 'Hello World.');
	}

	function like() {
		new Dialog().showMessage('Dialog', 'Hello World.');
	}

	function play() {
 		var isFan = false;
		if (isFan) {
			document.location = "https://graph.facebook.com/oauth/authorize?client_id=<?= $facebook_app_id ?>&redirect_uri=<?= $app_url ?>/&scope=email,publish_stream,user_birthday,user_likes";
		} else {
			document.getElementById("likePopup").setStyle("display","block");
		}		
	}
	document.getElementById('playLink').addEventListener('click', play);
	document.getElementById('shareLink').addEventListener('click', share);
	document.getElementById('inviteFriendsLink').addEventListener('click', inviteFriends);
//--></script>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/reset.css" />
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/style_520.php?v=1.2" />

<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/ie.css" />
<![endif]-->
	<div id="fb-root"></div>
	<div id="container2">
    	<div id="top">
        	<p class="left">Like us? Click the button above.</p>
            <p class="right"><a id="shareLink" href="#" onclick="share(); return false;">Share</a></p>
        </div>
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
        	<h2 class="left">bot or not?</h2>
            <div class="round right">play and win</div>
            <div class="clear"></div>

            <div id="playGame">
	<!-- Static HTML landing page -->
				<p><b font="Arial">Everyone is a winner!</b> Sort of. Just pick a door to see if you win this week's amazing SVEDKA BOT prize or end up with a fun consolation NOT prize. <b font="Arial">Increase your chances to win</b> by inviting friends. If one of them wins a Bot Grand Prize, you do too! Click below to play.  <span style="font-size:10px;"><a target="_blank" href="<?=$web_url?>/rules.php" style="color:#ffc821;">See Official Rules</a> for details.</span></p>
				<p class="title">This week's bot prize: <span><?= $grandPrize['name'] ?></span></p>
				<a id="playLink" href="#" onclick="return false" class="playBtn">play</a>
				<div class="bot" style="top:240px;"><img src="<?= $web_url ?>/images/bot2.png" alt="" /></div>
				<img src="<?= $web_url ?>/images/door2.png" alt="" />
				<div id="likePopup" class="popup" style="display:block;">
					<h3>I "Like" SVEDKA Vodka</h3>
					<p>To win a "BOT or NOT?" prize, you need to click the "Like" button at the top of the page. Swedish imported, five times distilled and a chance to win amazing BOT prizes ... what's not to like?</p>
					<a href="#" class="right" onclick="document.getElementById('likePopup').setStyle('display', 'none'); return false;">close</a>
				</div>
				<div id="alreadyPlayedPopup" class="popup" style="display:none;">
					<h3>Play Responsibly</h3>
					<p>Sorry but you've already played today. Come back tomorrow to play again. Or better yet invite your friends to play now.  If one of them wins the BOT prize, you do too!</p>
					<a href="#" class="right" onclick="document.getElementById('alreadyPlayedPopup').style.display='none';">close</a>
					<a href="#" class="right" onclick="inviteFriends();" style="margin-left:10px;width:111px;height:25px;background:url(images/invite-friends-button.png) no-repeat;">invite friends</a>
				</div>

				<div class="left"><img src="<?= $web_url ?>/prizes/Prize_<?= $grandPrize['image'] ?>_Icon_1.png" alt="<?= $grandPrize['name'] ?>" width="200" height="200" /></div>
				<div class="desc">
				<p class="title"><?= $grandPrize['name'] ?></p>
				<p><?= $grandPrize['description'] ?></p>
				</div>
				<div class="clear"></div>
				<a id="inviteFriendsLink" href="#" onclick="return false" class="invite" >invite friends to play</a>
			</div> <!-- end playGame -->

	<?php include "include/footer.php"; ?>

            <div id="btm"></div>
        </div>
    </div>

