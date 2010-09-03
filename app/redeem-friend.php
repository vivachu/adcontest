<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';

	$redemptionCode = $_REQUEST['c'];
	$referral = getReferralWinnerFromCode($redemptionCode);
	if (!isset($referral) || $referral['status'] != 0) {
		exit();
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bot Prize Redemption Confirmation - Friend</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
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

<script>
	function share() {
		 var share = {
		   method: 'stream.share',
		   u: '<?= $app_url ?>'
		 };

		 FB.ui(share, function(response) { console.log(response); });
	}
	function submitForm() {
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
		var url = "do.php?what=redeemFriend&c=<?= $redemptionCode ?>";
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
		  error: function () {}
		});

	}
	function onSubmitForm(response) {

	}


</script>
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
        	<h2 class="congrats left">bot or not?</h2>
            <div class="clear"></div>
            <div class="left img" style="height:202px;"><img src="prizes/FormPrizes/<?= $prizeSchedule['prize_image'] ?>_Form.png" class="small" alt="" /></div>
            <p class="text" style="font-size: 14px; margin:5px auto 0 35px;width:615px;">Isn't it good to know that Facebook friends aren't just good for poking, watering your crops, or tagging terrible photos of you? Fill out the info below and if you are eligible and satisfy the <a href="rules.php" class="inline">Official Rules</a>, we'll send your BOT prize out via snail-mail.</p>
<?php include "include/redeem-form.php"; ?>
            <div class="clear"></div>
<?php include "include/footer.php"; ?>
            <div id="btm"></div>
        </div>
    </div>
</body>
</html>
