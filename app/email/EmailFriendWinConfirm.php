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
   			<div class="emailfriend ipad" style="margin-left: -54px;margin-top: 108px; width: 352px;"><img src="<?= $web_url ?>/prizes/FormPrizes/<?= $_REQUEST['prizeImage']; ?>_Form.png" alt="ipad2" width="200" height="200" /></div>
        	<h2 style="padding-top: 30px; margin-top: 0; background: none;"><img src="<?= $web_url ?>/email/images/botornot2.jpg" alt="botornot2" width="457" height="66" /></h2>
            <div class="clear"></div>
            <p class="text">Are you prepared to feel the white-hot envy of your acquaintances? Well, you better get ready because your FREE <?= $_REQUEST['prizeName'] ?> will be on its way shortly!</p>

			<p class="text" style="padding-bottom: 190px;">While you’re waiting for your BOT prize
to arrive, keep the party going at <a href="http://www.facebook.com/svedka">www.facebook.com/svedka.</a></p>
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
