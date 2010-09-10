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
   			<div class="emailfriend ipad" style="padding-top: 200px; width: 263px;"><img src="<?= $web_url ?>/prizes/FormPrizes/<?= $_REQUEST['prizeImage']; ?>_Form.png" width="200" height="200" /></div>
        	<h2 style="padding-top: 30px; margin-top: 0; background: none;"><img src="<?= $web_url ?>/email/images/facebook-friendship.jpg" alt="facebook-friendship" width="463" height="88" /></h2>
            <div class="clear"></div>
            <p class="text">Congratulations! You invited your friend <?= $_REQUEST['friendName'] ?> to play SVEDKA "BOT or NOT?”. Your friend just won an <?= $_REQUEST['prizeName'] ?> and now you have won an <?= $_REQUEST['prizeName'] ?> too! Now both of you can brag about it to all your friends, because isn't that what Facebook is for? </p>
            <div class="redeemiPad" style="margin-bottom: 200px; padding: 0;"><a href="<?= $app_url?>/redeem-friend.php?c=<?= $_REQUEST['c'] ?>"><img src="<?= $web_url ?>/email/images/click-redeem.png" alt="click-redeem" width="202" height="36" /></a></div>
            <div id="footer">
	            <p style="text-align: left;">PLAY RESPONSIBLY. SVEDKA&reg; Vodka - 40% alc/vol. (80 proof), 100% grain neutral spirits, <br />
product of Sweden, sole U.S. Importer: Spirits Marque One LLC, New York, NY. See <a href="<?= $web_url ?>/rules.php">Official Rules</a></p>
			</div>
            <div class="clear"></div>
            <div id="btm"></div>
        </div>
    </div>
</body>
</html>
