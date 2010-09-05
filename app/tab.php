<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';

	$grandPrize = getGrandPrize($test_date);
?>

<script><!--
	function inviteFriends() {
		document.getElementById("inviteFriendsPopup").setStyle("display","block");
	}

	function showLike() {
		document.getElementById("likePopup").setStyle("display","block");
	}
//--></script>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/reset.css" />
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/style_520.php?v=1.5" />

<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/ie.css" />
<![endif]-->
	<div id="fb-root"></div>
	<div id="container2">
    	<div id="top">
        	<p class="left">Like us? Click the button above.</p>
            <p class="right"><a id="shareLink" href="http://www.facebook.com/sharer.php?u=<?= $share_url ?>">Share</a></p>
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
<fb:visible-to-connection>
	<a id="playLink" href="https://graph.facebook.com/oauth/authorize?client_id=<?= $facebook_app_id ?>&redirect_uri=<?= $app_url ?>/&scope=email,publish_stream,user_birthday,user_likes" class="playBtn">play</a>
<fb:else>
	<a id="playLink" href="#" onclick="showLike(); return false" class="playBtn">play</a>
</fb:else>
</fb:visible-to-connection>
				<div class="bot" style="top:240px;"><img src="<?= $web_url ?>/images/bot2.png" alt="" /></div>
				<img src="<?= $web_url ?>/images/door2.png" alt="" />
				<div id="likePopup" class="popup" style="display:none;">
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
				<a id="inviteFriendsLink" href="#" onclick="inviteFriends(); return false;" class="invite" >invite friends to play</a>
			</div> <!-- end playGame -->
	<?php include "include/footer.php"; ?>

            <div id="btm"></div>
        </div>
    </div>
    <div id="inviteFriendsPopup" style="position:absolute;top:400px;left:15px;display:none;">
   	<fb:request-form  method="get" type="Svedka - BOT or NOT Contest" invite="true"  content="You've been invited to play and win Svedka BOT or NOT? It's free. Win an amazing BOT prize or a bunch of fun NOT prizes each week. Invite your Facebook friends to play, because if they win the BOT prize, so do you! This week's BOT prize: <?= $grandPrize['name'] ?><fb:req-choice url=friend.php' label='Play Now' /> ">
        	<fb:multi-friend-selector cols="3" actiontext="Tell your friends about us" rows="4" showborder="true" bypass="cancel" />
   	</fb:request-form>
    </div>
<form fbtype="feedStory" action= "http://fbmlessentials.staynalive.com/index.php">
<input type="text" name="status" value="" /> <input type="hidden" name="submit" value="1" /> <input type="hidden" name="action" value="feedforms" /> <input type="hidden" name="notabs" value="true" /> <input type="submit" value="Submit" name="submit"
</form>
label="Publish This Story" />
