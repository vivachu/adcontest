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
		alert("like");
	}
	function play() {
		window.top.location = "https://graph.facebook.com/oauth/authorize?client_id=<?= $facebook_app_id ?>&redirect_uri=<?= $app_url ?>/&scope=email,publish_stream,user_birthday,user_likes";
	}
//--></script>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/reset.css" />
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/style.css?v=1.0" />

<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/ie.css" />
<![endif]-->

	<div id="fb-root"></div>
	<div id="container">
    	<div id="top">
        	<p class="left">Like us? Click the button above.</p>
            <p class="right"><a href="#" onclick="share();">Share</a></p>
        </div>
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
        	<h2 class="left">bot or not?</h2>
            <div class="round right">play and win</div>
            <div class="clear"></div>

            <div id="playGame">
	<!-- Static HTML landing page -->
				<p><b>Everyone is a winner!</b> Sort of. Just pick a door to see if you win this week’s amazing SVEDKA BOT prize … or end up with a fun consolation NOT prize. <b>Increase your chances to win</b> by inviting friends — If one of them wins a Bot Grand Prize, you do too! Click below to play.</p>
				<p class="title">This week's bot prize: <span><?= $grandPrize['name'] ?></span></p>
				<a href="#" class="playBtn" onclick="play();">play</a>
				<div class="bot" style="top:240px;"><img src="<?= $web_url ?>/images/bot.png" alt="" /></div>
				<img src="<?= $web_url ?>/images/door.png" alt="" />
				<div id="likePopup" class="popup" style="display:none;">
					<h3>I "Like" SVEDKA Vodka</h3>
					<p>To win a "BOT or NOT?" prize, you need to click the "Like" button at the top of the page. Swedish imported, five times distilled and a chance to win amazing BOT prizes ... what's not to like?</p>
					<a href="#" class="right" onclick="document.getElementById('likePopup').style.display='none';">close</a>
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
				<a href="#" onclick="inviteFriends();" class="invite" >invite friends to play</a>
			</div> <!-- end playGame -->

	<?php include "include/footer.php"; ?>

            <div id="btm"></div>
        </div>
    </div>
