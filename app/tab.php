<?php
	require_once 'svedka-config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';
	require_once 'include/Browser.php';

	$grandPrize = getGrandPrize($test_date);

	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => $facebook_app_id,
	  'secret' => $facebook_secret_key,
	  'cookie' => true,
	));
	$session = $facebook->getSession();

	$me = null;
	if ($session) {
	  try {
		$me = $facebook->api('/me');
		// get the Facebook user
		$fbid = $me['id'];
	  } catch (FacebookApiException $e) {
		error_log($e);
	  }
	}
	$title = "Play SVEDKA \"BOT or NOT?\"";
	$browser = new Browser();
?>

<script><!--
	function inviteFriends() {
		document.getElementById("inviteFriendsPopup").setStyle("display","block");
	}

        function share() {
		var attachment = {
			   name: '<?= $title ?>',
			   caption: 'Give it a shot and you could win an amazing BOT prize or a fun NOT prize. Just go to the SVEDKA Vodka Facebook page to play! This week\'s BOT prize: <?= $grandPrize['name']?>',
			   href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>',
               		   media: [
               			    { type: 'image', src: 'http://www.adcontests.com/svedka/app/images/svedka_icon.png', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>'
				    }
				  ]
		};
		var actionLinks = [ { text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' } ];
		Facebook.streamPublish('', attachment, actionLinks);
        }


	function showLike() {
		document.getElementById("likePopup").setStyle("display","block");
	}
//--></script>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/reset.css" />
<? if ( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() < 8 ): ?>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/ie.css?v=2.5" />
<? else: ?>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/style_520.php?v=2.4" />
<? endif; ?>



	<div id="fb-root"></div>
	<div id="top">
		<p class="left">Like us? Click the button above.</p>
		<p class="right"><a href="#" onclick="share(); return false;">Share</a></p>
	</div>
	<div id="container2">
        <h1><a>svedka</a></h1>
        <div id="mainContent" style="height: 900px;">
        	<h2 class="left">bot or not?</h2>
            <div class="round right">play and win</div>
            <div class="clear"></div>

            <div id="playGame">
	<!-- Static HTML landing page -->
				<p>Everyone is a winner! Sort of. Just pick a door to see if you win this week's amazing SVEDKA BOT prize or end up with a fun consolation NOT prize. Increase your chances to win by inviting friends. If one of them wins a Bot Grand Prize, you do too! Click below to play.  <a target="_blank" href="<?=$web_url?>/rules.php" style="color:#ffc821;">See Official Rules</a> for details.</p>
				<p class="title">This week's bot prize: <span><?= $grandPrize['name'] ?></span></p>
<fb:visible-to-connection>
	<a id="playLink" href="https://graph.facebook.com/oauth/authorize?client_id=<?= $facebook_app_id ?>&scope=email,publish_stream,user_birthday,user_likes&redirect_uri=<?= $app_url ?>/" class="playBtn">play</a>
<fb:else>
	<a id="playLink" href="#" onclick="showLike(); return false" class="playBtn">play</a>
</fb:else>
</fb:visible-to-connection>
				<div class="bot" style="top:285px;margin-right:36px;"><img src="<?= $web_url ?>/images/bot2.png" alt="" /></div>
				<img src="<?= $web_url ?>/images/door2.png?v=1.0" alt="" />
				<div id="likePopup" class="popup" style="display:none;">
					<div class="popupWrap">
					<h3>I "Like" SVEDKA Vodka</h3>
					<p>To win a "BOT or NOT?" prize, you need to click the "Like" button at the top of the page. Swedish imported, five times distilled and a chance to win amazing BOT prizes ... what's not to like?</p>
					<a href="#" class="right" onclick="document.getElementById('likePopup').setStyle('display', 'none'); return false;">close</a>
					</div>
				</div>
				<div id="alreadyPlayedPopup" class="popup" style="display:none;">
					<div class="popupWrap">
					<h3>Play Responsibly</h3>
					<p>Sorry but you've already played today. Come back tomorrow to play again. Or better yet invite your friends to play now.  If one of them wins the BOT prize, you do too!</p>
					<a href="#" class="right" onclick="document.getElementById('alreadyPlayedPopup').style.display='none';">close</a>
					<a href="#" class="right" onclick="inviteFriends();" style="margin-left:10px;width:111px;height:25px;background:url(images/invite-friends-button.png) no-repeat;">invite friends</a>
					</div>
				</div>

				<div class="left"><img width="200" height="200" src="<?= $web_url ?>/prizes/FormPrizes/<?= $grandPrize['image'] ?>_Form.png?v=1.0" alt="<?= $grandPrize['name'] ?>" /></div>
				<div class="desc">

				<p class="title"><?= $grandPrize['name'] ?></p>
				<p><?= $grandPrize['description'] ?></p>

				</div>
				<div class="clear"></div>
				<a id="inviteFriendsLink" href="#" onclick="inviteFriends(); return false;" class="invite" >invite friends to play</a>
			</div> <!-- end playGame -->
            <div id="footer">
	            <p>PLAY RESPONSIBLY. SVEDKA® Vodka - 40% alc/vol. (80 proof), 100% grain neutral <br/>spirits product of Sweden,
	            sole U.S. Importer: Spirits Marque One LLC, New York, NY.</p>
			</div>
            <div id="btm"></div>
        </div>
    </div>
    <div id="inviteFriendsPopup" style="position:absolute;top:400px;left:15px;display:none;">
   	<fb:request-form action="<?= $fan_page_url ?>" method="get" type="Svedka Vodka BOT or NOT?" invite="true"  content="You've been invited to play and win Svedka BOT or NOT? It's free. Win an amazing BOT prize or a bunch of fun NOT prizes each week. Invite your Facebook friends to play, because if they win the BOT prize, so do you! This week's BOT prize: <?= $grandPrize['name'] ?><fb:req-choice url='<?= $share_url ?>&fid=<?= $fbid ?>' label='Play Now' /> ">
        	<fb:multi-friend-selector cols="3" actiontext="Tell your friends about us" rows="4" showborder="true" bypass="cancel" />
   	</fb:request-form>
    </div>
