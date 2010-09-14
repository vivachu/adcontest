<?php
	require_once 'svedka-config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';

	$grandPrize = getGrandPrize($test_date);

	$redemptionCode = $_REQUEST['c'];
	$prizeSchedule = getPrizeScheduleFromCode($redemptionCode);
	if (!isset($prizeSchedule) || $prizeSchedule['status'] != 0) {
		exit();
	}
	if (isset($prizeSchedule['friend_id'])) {
		$friend = getPlayerFromId($prizeSchedule['friend_id']);
	}
	$player['facebook_id'] = $prizeSchedule['facebook_id']; // for share and feed posts
	$player['username'] = $prizeSchedule['username']; // for share and feed posts
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bot Prize Redeem Form</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="style.css?v=1.8" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="ie.css" />
<script src="DD_belatedPNG_0.0.8a.js"></script>
<script>
  DD_belatedPNG.fix('h1 a, #mainContent .left img.small, .bot img');
</script>
<![endif]-->
<!-- include jQuery library -->
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="javascript/jquery.cycle.all.2.74.js"></script>

<? include 'include/log-events-js.php'; ?>

<script>
<?php if ($prizeSchedule['place'] == 1): ?>
	var trackPath = "/BOT";
<?php elseif ($prizeSchedule['place'] >= 2 || $prizeSchedule['place'] <= 5): ?>
	var trackPath = "/SECONDARY";
<?php else: ?>
	var trackPath = "/NOT";
<?php endif; ?>

	var prizeImage = "<?= $prizeSchedule['prize_image'] ?>";


	function share(){
		document.getElementById('shareContainer').style.display = 'block';
		document.getElementById('shareFrame').src = "share.php?facebookId=<?= $player['facebook_id'] ?>&username=<?= $player['username'] ?>&grandPrize=<?= $grandPrize['short_name'] ?>";
		logEvent("/share/redeem");
	}

	function publishFeedStory(){
		document.getElementById('shareContainer').style.display = 'block';
		document.getElementById('shareFrame').src = "feedform.php?facebookId=<?= $player['facebook_id'] ?>&username=<?= $player['username'] ?>&grandPrize=<?= $grandPrize['short_name'] ?>&prizeName=<?= $prizeSchedule['prize_name'] ?>&prizeImage=<?= $prizeSchedule['prize_image'] ?>&place=<?= $prizeSchedule['place'] ?>";
		var s = "/publish-feed-story/" + trackPath + "/" + prizeImage;
		logEvent(s);
	}


	function hideShare(){
		document.getElementById('shareContainer').style.display = 'none';
		document.getElementById('shareFrame').src = "about:blank";
		logEvent("/hide-viral/redeem");
	}


	function submitForm() {
		logEvent("/redeem/submit");
		if (document.getElementById('fname').value.length < 1) {
			alert("Please enter your first name.");
			document.getElementById('fname').focus();
			return;
		}
		else if (document.getElementById('lname').value.length < 1) {
			alert("Please enter your last name.");
			document.getElementById('lname').focus();
			return;
		}
		else if (document.getElementById('street').value.length < 1) {
			alert("Please enter your street.");
			document.getElementById('street').focus();
			return;
		}
		else if (document.getElementById('city').value.length < 1) {
			alert("Please enter your city.");
			document.getElementById('city').focus();
			return;
		}
		else if (document.getElementById('state').value.length < 1) {
			alert("Please enter your state.");
			document.getElementById('state').focus();
			return;
		}
		else if (document.getElementById('zip').value.length < 1) {
			alert("Please enter your zip.");
			document.getElementById('zip').focus();
			return;
		}
		else if (document.getElementById('email').value.length < 1) {
			alert("Please enter your email address.");
			document.getElementById('email').focus();
			return;
		}
		if (document.getElementById('state').value == "CA") {
			document.getElementById('popupCA').style.display='block';
			var url = "do.php?what=unredeem&c=<?= $redemptionCode ?>";
			jQuery.ajax({
			  type: "POST",
			  url: url,
			  cache: false,
			  success: function (response) { },
			  error: function () {}
			});

			return;
		}
		logEvent("/redeem/validated");
		document.body.style.cursor = 'wait';
		var url = "do.php?what=redeem&c=<?= $redemptionCode ?>";
		url += "&first=" + document.getElementById('fname').value;
		url += "&last=" + document.getElementById('lname').value;
		url += "&street=" + document.getElementById('street').value;
		url += "&apt=" + document.getElementById('apt').value;
		url += "&city=" + document.getElementById('city').value;
		url += "&state=" + document.getElementById('state').value;
		url += "&zip=" + document.getElementById('zip').value;
		url += "&email=" + document.getElementById('email').value;
		document.getElementById("submit").innerHTML = "";
		jQuery.ajax({
		  type: "POST",
		  url: url,
		  cache: false,
		  success: function (response) { onSubmitForm(response); },
		  error: function () {alert('error');document.body.style.cursor = 'default';}
		});

	}

	function closeCA() {
		document.getElementById('popupCA').style.display='none';
		window.top.location = "<?= $fan_page_url ?>";
	}

	function onSubmitForm(response) {
		document.body.style.cursor = 'default';
		logEvent("/redeem/redeemed");
<? if (isset($friend) && $prizeSchedule['place'] == 1): ?>
		document.getElementById("popInvite").style.display = "block";
<? elseif ($prizeSchedule['place'] == 1): ?>
		document.getElementById("thanksPopup").style.display = "block";
<? elseif ($prizeSchedule['place'] != 1): ?>
		publishFeedStory();
		document.getElementById("thanksPopup").style.display = "block";
<? endif; ?>
	}

	function sendFriendEmail() {
		document.getElementById("popInvite").style.display = "none";

		var url = "do.php?what=sendFriendEmail&c=<?= $redemptionCode ?>";
		jQuery.ajax({
		  type: "POST",
		  url: url,
		  cache: false,
		  success: function (response) { document.getElementById("thanksPopup").style.display = "block";  },
		  error: function () {}
		});

	}
</script>
</head>
<body>
	<div id="fb-root"></div>
	<script>
	  window.fbAsyncInit = function() {
		FB.init({appId: '<?= $facebook_app_id ?>', status: true, cookie: true,
				 xfbml: true, dialog_type: 'modal'});
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
        <h1><a>svedka</a></h1>
        <div id="mainContent">
<? if ($prizeSchedule['place'] == 1 && isset($friend)): ?>
        	<h4 class="congrats left">bot or not?</h4>
            <div class="clear"></div>
            <div class="left img" style="height:202px;"><img src="prizes/FormPrizes/<?= $prizeSchedule['prize_image'] ?>_Form.png" class="small" alt="" width="190" height="190"/></div>
            <p class="text" style="font-size: 12px; margin:5px auto 0 35px;width:615px;">You won this week’s BOT Grand prize — <?= $prizeSchedule['prize_name'] ?>! And as exciting as this image of <?= $prizeSchedule['prize_name'] ?> is, it will be even more exciting once you actually have it in your hands.  Fill out the info below and if you are eligible and satisfy the <a class="inline" href="#" onclick="window.open('rules.php', 'Rules', 'toolbar=no,location=no,menubar=no,width=785,height=800,scrollbars=yes');">Official Rules</a>, we'll make it happen.</p>
            <p class="text" style="font-size: 12px; margin:5px auto 0 35px;width:615px;">And, because a friend invited you to play, your friend will win <?= $prizeSchedule['prize_name'] ?> too, because that's what friends do — they win prizes for each other (in our book anyway).</p>
<? elseif ($prizeSchedule['place'] == 1): ?>
        	<h4 class="congrats left">bot or not?</h4>
            <div class="clear"></div>
            <div class="left img" style="height:202px;"><img src="prizes/FormPrizes/<?= $prizeSchedule['prize_image'] ?>_Form.png" class="small" alt="" width="190" height="190"/></div>
            <p class="text" style="font-size: 14px; margin:5px auto 0 35px;width:615px;">You won this week’s BOT Grand prize — <?= $prizeSchedule['prize_name'] ?>! And as exciting as this image of <?= $prizeSchedule['prize_name'] ?> is, it will be even more exciting once you actually have it in your hands.  Fill out the info below and if you are eligible and satisfy the <a class="inline" href="#" onclick="window.open('rules.php', 'Rules', 'toolbar=no,location=no,menubar=no,width=785,height=800,scrollbars=yes');">Official Rules</a>, we'll make it happen.</p>
<? elseif ($prizeSchedule['place'] >= 2 && $prizeSchedule['place'] <= 5): ?>
        	<h4 class="congrats left">bot or not?</h4>
            <div class="clear"></div>
            <div class="left img" style="height:202px;"><img src="prizes/FormPrizes/<?= $prizeSchedule['prize_image'] ?>_Form.png" class="small" alt="" /></div>
            <p class="text" style="font-size: 14px; margin:5px auto 0 35px;width:615px;">It may not be THE BOT grand prize, but <?= $prizeSchedule['prize_name'] ?> is still pretty BOT. Just fill out the form below and if you are eligible and satisfy the <a href="#" onclick="window.open('rules.php', 'Rules', 'toolbar=no,location=no,menubar=no,width=785,height=800,scrollbars=yes');" class="inline">Official Rules</a>, you will receive your prize.  And be sure to come back tomorrow for another chance at the BOT prize!</p>
<? else: ?>
			<h4 class="congrats_not left">bot or not?</h4>
            <div class="clear"></div>
            <div class="left img" style="height:202px;"><img src="prizes/FormPrizes/<?= $prizeSchedule['prize_image'] ?>_Form.png" class="small" alt="" /></div>
            <p class="text" style="font-size: 14px; margin:5px auto 0 35px;width:615px;">Sorry you didn't win the BOT prize this time, but you're still a winner to us. Just fill out the form below and if you are eligible and satisfy the <a href="#" onclick="window.open('rules.php', 'Rules', 'toolbar=no,location=no,menubar=no,width=785,height=800,scrollbars=yes');" class="inline">Official Rules</a>, you will receive your NOT prize.  And be sure to come back tomorrow for another chance at the BOT prize!</p>
<? endif; ?>


<?php
	if (isset($friend)) {
?>
			<div id="popInvite" class="popupContainer" style="display:none;">
                <div class="popupInvite">
                	<div class="popupWrap">
                    <h2 class="popupTitle"><span>Thanks! Your information was received.</span></h2>
                    <div class="popupContent">
                        <h3 class="left"><img width="32" height="32" src="http://graph.facebook.com/<?= $friend['facebook_id'] ?>/picture" alt="" class="left" /> Your Friend <?= $friend['username'] ?> is a Winner Too!</h3>
                    	<p class="left">Since <?= $friend['username'] ?> invited you to play The SVEDKA Vodka “BOT or NOT?” Game, <?= $friend['username'] ?> wins an <?= $prizeSchedule['prize_name'] ?> too! Just hit “Send” and we’ll send <?= $friend['username'] ?> an email.</p>
					</div>
                    <a href="javascript:{}" class="right" onclick="sendFriendEmail();">close</a>
                    </div>
                </div>
			</div>
  <?
  	}
  ?>
			<div id="popupCA" class="popup" style="display:none;margin:0;right:0px;left:150px;">
				<div class="popupWrap">
				<h3>California Residents Ineligible</h3>
				<p style="height:60px;">Sorry, California residents are ineligible to play.  Please see the <a href="#" onclick="window.open('rules.php', 'Rules', 'toolbar=no,location=no,menubar=no,width=785,height=800,scrollbars=yes');">Official Rules</a> for details.</p>
				<a id="closeButton" href="javascript:{};" class="right" onclick="closeCA();">close</a>
				</div>
			</div>
			<div id="thanksPopup" class="popup" style="display:none;margin:0;right:0px;left:150px;">
				<div class="popupWrap">
				<h3>Thanks! Your information was received</h3>
				<p style="height:60px;">Thanks for playing.  We'll be in touch with you soon regarding your prize.</p>
				<a href="#" class="right" onclick="window.top.location='<?= $fan_page_url ?>'; return false;" style="margin-right:5px;width:49px;height:26px;background:url(images/close.png) no-repeat;"></a>
				</div>
			</div>

<?php include "include/redeem-form.php"; ?>
            <div class="clear"></div>
<?php include "include/footer.php"; ?>
            <div id="btm"></div>
        </div>
    </div>
<script type="text/javascript">
//window.fbAsyncInit = function() {
  FB.Canvas.setSize({ height: 932 });
//}

</script>
<div id="shareContainer" style="display:none;background-color:transparent;">
	<iframe id="shareFrame" allowtransparency="true" frameborder="0" border="0"></iframe>
</div>
</body>
</html>
