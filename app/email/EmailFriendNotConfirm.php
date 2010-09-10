<?php
	require_once 'svedka-config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email Friends Win</title>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/email/reset.css" />

<style>
<?php include 'style.php'; ?>
</style>

<!--[if lte IE 8]>
<link rel="stylesheet" type="text/css" href="<?= $web_url ?>/email/ie.css" />
<![endif]-->
</head>
<body>
	<div id="container2">
        <h1><a href="#">svedka</a></h1>
        <div id="mainContent">
   			<div class="emailfriend ipad" style="padding-top: 120px; width: 324px;"><img src="<?= $web_url ?>/prizes/FormPrizes/<?= $_REQUEST['prizeImage']; ?>_Form.png" width="200" height="200" /></div>
        	<h2 style="padding-top: 30px; margin-top: 0; background: none;"><img src="<?= $web_url ?>/email/images/title-botterthan.png" alt="title-botterthan" width="611" height="48" /></h2>
            <div class="clear"></div>
            <p class="text">You seem to be a connoisseur of the NOT BOT things in life. But if you want to see how the BOT half lives, invite your friends to play for another shot at the BOT prize. If they win, you win too!</p>
			<p style="margin-left: 0;"><a href="<?= $fan_page_url ?>"><img src="<?= $web_url ?>/email/images/click-invite.png" alt="click-invite" width="338" height="32" /></a></p>

			<p class="text" style="padding-bottom: 150px;">While you're waiting for your BOT prize
			to arrive, keep the party going at:<br/>
			<a href="http://www.facebook.com/svedka">www.facebook.com/svedka.</a></p>

            <div id="footer">
	            <p style="text-align: left;">PLAY RESPONSIBLY. SVEDKA&reg; Vodka - 40% alc/vol. (80 proof), 100% grain neutral spirits, <br />
product of Sweden, sole U.S. Importer: Spirits Marque One LLC, New York, NY.  <a href="<?= $web_url ?>/rules.php">See Official Rules</a></p>
			</div>
            <div class="clear"></div>
            <div id="btm"></div>
        </div>
    </div>
</body>
</html>