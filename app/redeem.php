<?php
	require_once 'include/config.php';
	require_once 'include/sql.php';

	$redemptionCode = $_REQUEST['c'];
	$prizeSchedule = getPrizeScheduleFromCode($redemptionCode);
	if (!isset($prizeSchedule) || $prizeSchedule['status'] != 0) {
		exit();
	}
	if (isset($prizeSchedule['friend_id'])) {
		$friend = getPlayerFromId($prizeSchedule['friend_id']);
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bot Prize Redemption Friend Confirmation</title>
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
		alert("share");
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
		var url = "do.php?what=redeem&c=<?= $redemptionCode ?>";
		url += "&first=" + document.getElementById('fname').value;
		url += "&last=" + document.getElementById('lname').value;
		url += "&street=" + document.getElementById('street').value;
		url += "&apt=" + document.getElementById('apt').value;
		url += "&city=" + document.getElementById('city').value;
		url += "&state=" + document.getElementById('state').value;
		url += "&zip=" + document.getElementById('zip').value;
		url += "&email=" + document.getElementById('email').value;
		jQuery.ajax({
		  type: "POST",
		  url: url,
		  cache: false,
		  success: function (response) { onSubmitForm(response); },
		  error: function () {}
		});

	}
	function onSubmitForm(response) {
<?php
if (isset($friend) ) { //&&  $prizeSchedule['place'] == 1) {
?>
		document.getElementById("popInvite").style.display = "block";
<?php
}
?>
	}
</script>
</head>
<body>
	<div id="container">
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
        	<h2 class="congrats left">bot or not?</h2>
            <div class="clear"></div>
            <div class="left img"><img src="images/iPad.png" class="small" alt="" /></div>
<?php
	if ($prizeSchedule['place'] == 1) {
?>
            <p class="text" style="margin:5px auto 0 35px;width:440px;">You won this week’s BOT Grand prize — <?= $prizeSchedule['prize_name'] ?>! And as exciting as this image of an <?= $prizeSchedule['prize_name'] ?> is, it will be even more exciting once you actually have it in your hands, so fill out the info below and we'll make that happen.</p>
            <p class="text" style="margin:10px auto 0 35px;width:440px;">And, because a friend invited you to play, your friend will win an <?= $prizeSchedule['prize_name'] ?> too, because that's what friends do — they win prizes for each other (in our book anyway).</p>
<?php
	}
	else {
?>
            <p class="text" style="margin:5px auto 0 35px;width:440px;">You won a BOT prize — <?= $prizeSchedule['prize_name'] ?>! And as exciting as this image of an <?= $prizeSchedule['prize_name'] ?> is, it will be even more exciting once you actually have it in your hands, so fill out the info below and we'll make that happen.</p>
<?php
	}
?>
<?php
	if (isset($friend)) {
?>
			<div id="popInvite" class="popupContainer" style="display:none;">
                <div class="popupInvite">
                    <h2 class="popupTitle"><span>Thanks! Your <?= $prizeSchedule['prize_name'] ?> is now on its way.</span></h2>
                    <div class="popupContent">
                    	<img src="images/pic.jpg" alt="" class="left" />
                        <h3 class="left">Your Friend <?= $friend['username'] ?> is a Winner Too!</h3>
                    	<p class="left">Since <?= $friend['username'] ?> invited you to play The SVEDKA Vodka “BOT or NOT?” Game, <?= $friend['username'] ?> wins an <?= $prizeSchedule['prize_name'] ?> too! Just hit “Send” and we’ll send your friend an email.</p>
					</div>
                    <a href="#" class="right">close</a>
                </div>
			</div>
  <?
  	}
  ?>
  			<div class="bot"><img src="images/bot.png" alt="" /></div>
            <form action="do.php" method="post" id="form" class="clear">
            	<div>
                	<label for="fname">First Name:</label>
                    <input id="fname" type="text" name="first" class="name" value="" tabindex="1" />
				</div>
                <div>
                	<label for="lname">Last Name:</label>
                    <input id="lname" type="text" name="last" class="name" value="" tabindex="2" />
				</div>
                <div>
                	<label for="street">Street:</label>
                    <input id="street" type="text" name="street" class="street" value="" tabindex="3" />
				</div>
                <div>
                	<label for="apt">Apt. #:</label>
                    <input id="apt" type="text" name="apt" class="apt" value="" tabindex="4" />
				</div>
                <div>
                	<label for="city">City:</label>
                    <input id="city" type="text" name="city" class="city" value="" tabindex="5" />
				</div>
                <div>
                	<label for="state">State:</label>
                    <select id="state" name="state" tabindex="6">
					<option value=""></option>
					<option value="AK">AK</option>
					<option value="AL">AL</option>
					<option value="AR">AR</option>
					<option value="AZ">AZ</option>
					<option value="CA">CA</option>
					<option value="CO">CO</option>
					<option value="CT">CT</option>
					<option value="DC">DC</option>
					<option value="DE">DE</option>
					<option value="FL">FL</option>
					<option value="GA">GA</option>
					<option value="HI">HI</option>
					<option value="IA">IA</option>
					<option value="ID">ID</option>
					<option value="IL">IL</option>
					<option value="IN">IN</option>
					<option value="KS">KS</option>
					<option value="KY">KY</option>
					<option value="LA">LA</option>
					<option value="MA">MA</option>
					<option value="MD">MD</option>
					<option value="ME">ME</option>
					<option value="MI">MI</option>
					<option value="MN">MN</option>
					<option value="MO">MO</option>
					<option value="MS">MS</option>
					<option value="MT">MT</option>
					<option value="NC">NC</option>
					<option value="ND">ND</option>
					<option value="NE">NE</option>
					<option value="NH">NH</option>
					<option value="NJ">NJ</option>
					<option value="NM">NM</option>
					<option value="NV">NV</option>
					<option value="NY">NY</option>
					<option value="OH">OH</option>
					<option value="OK">OK</option>
					<option value="OR">OR</option>
					<option value="PA">PA</option>
					<option value="RI">RI</option>
					<option value="SC">SC</option>
					<option value="SD">SD</option>
					<option value="TN">TN</option>
					<option value="TX">TX</option>
					<option value="UT">UT</option>
					<option value="VA">VA</option>
					<option value="VT">VT</option>
					<option value="WA">WA</option>
					<option value="WI">WI</option>
					<option value="WV">WV</option>
					<option value="WY">WY</option>
					</select>
				</div>
                <div>
                	<label for="zip">Zip:</label>
                    <input id="zip" type="text" name="zip" class="zip" value="" tabindex="7" />
				</div>
                <div>
                	<label for="email">Email:</label>
                    <input id="email" type="text" name="email" class="city" value="" tabindex="8" />
				</div>
                <div id="submit">
                	<input type="button" name="submit" class="submit" tabindex="9" value="submit" onclick="submitForm();"/>
                </div>
            </form>
            <div class="clear"></div>
            <div id="footer">
	            <p>PLAY RESPONSIBLY. SVEDKA® Vodka - 40% alc/vol. (80 proof), 100% grain neutral spirits, product of Sweden,<br />sole U.S. Importer: Spirits Marque One LLC, New York, NY.</p>
			</div>
            <div id="btm"></div>
        </div>
    </div>
</body>
</html>
