<?php
	require_once 'svedka-config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';


	$grandPrize = getGrandPrize($test_date);

	include 'include/facebook-authenticate-create-player.php';
	if ($player) {
		$player['has_played'] = 0; // temporarily set to false
		$player['liked'] = 1;
		// play the game
		playGame($fbid);
		$prize = getWinningPrize($test_date);
		if (!isset($prize) || $prize['name'] == null) {
			$prize = getRandomNotPrize();
			$prizeSchedule['prize_name'] = $prize['name']; // for feed story
			$prizeSchedule['username'] = $player['username'];
			$prizeSchedule['prize_image'] = $prize['image'];
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
		if ($prize['place'] == 1) {
			$prizeNameUrl = "prizes/TypeBoxes/ItsBot_TypeBox.png";
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>SVEDKA "BOT or NOT?"</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="style.css?v=1.3" />
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

	function inviteFriends(){
		document.getElementById('inviteContainer').style.display = 'block';
		document.getElementById('inviteFrame').src = "invite.php?fbid=<?= $player['facebook_id'] ?>";
	}

	function hideInvite(){
		document.getElementById('inviteContainer').style.display = 'none';
		document.getElementById('inviteFrame').src = "about:blank";
	}

<? include 'include/shared_js.php'; ?>

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
    <div id="top">
		<p class="left"></p>
		<p class="right"><a href="javascript:{}" onclick="share();">Share</a></p>
    </div>
	<div id="container">
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
        	<h2 class="left">bot or not?</h2>
            <div class="round right">play and win</div>
            <div class="clear"></div>

            <div id="playGame">
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
				<div id="inviteContainer" style="display:none;">
					<iframe id="inviteFrame"></iframe>
				</div>
				<div id="redeemContainer" style="display:none;">
	<?php if (isset($prizeSchedule['id'])): ?>
					<div id="clickToRedeem"><a href="redeem.php?c=<?= $prizeSchedule['redemption_code'] ?>&signed_request=$_REQUEST['signed_request']"><img src="prizes/Buttons/Redeem_Btn.png"/></a></p>
	<?php elseif (isset($prize['link'])): ?>
					<div id="clickToRedeem"><a target="_blank" href="<?= $prize['link'] ?>" onclick="publishFeedStory();"><img src="prizes/Buttons/View_Btn.png"/></a></p>
	<?php endif; ?>
				</div>
			</div> <!-- end playGame -->
			<div class="clear"></div>
			<a href="javascript:{}" onclick="inviteFriends();" class="invite" >invite friends to play</a>
			<?php include "include/footer.php"; ?>

            <div id="btm"></div>
        </div>
    </div>

<script type="text/javascript">
window.fbAsyncInit = function() {
  FB.Canvas.setSize({ height: 932 });
}

</script>
</body>
</html>
