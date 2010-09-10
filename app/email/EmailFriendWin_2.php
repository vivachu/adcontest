<?php
	require_once 'svedka-config.php';
?>

<body style="font:13px Tahoma;">
        	<h2>A Facebook Friendship Paid Off</h2>
            <p>Congratulations! You invited your friend <?= $_REQUEST['friendName'] ?> to play SVEDKA "BOT or NOT?”. Your friend just won an <?= $_REQUEST['prizeName'] ?> and now you have won an <?= $_REQUEST['prizeName'] ?> too! Now both of you can brag about it to all your friends, because isn't that what Facebook is for? </p>
            <p><a href="<?= $app_url?>/redeem-friend.php?c=<?= $_REQUEST['c'] ?>">Click here to redeem!</a></p>
	            <p style="text-align: left;">PLAY RESPONSIBLY. SVEDKA&reg; Vodka - 40% alc/vol. (80 proof), 100% grain neutral spirits, <br />
product of Sweden, sole U.S. Importer: Spirits Marque One LLC, New York, NY. See <a href="<?= $web_url ?>/rules.php">Official Rules</a></p>
</body>
