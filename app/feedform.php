<?php
	require_once 'svedka-config.php';

	$username = $_REQUEST['username'];
	$facebookId = $_REQUEST['facebookId'];
	$grandPrize = $_REQUEST['grandPrize'];
	$prizeName = $_REQUEST['prizeName'];
	$prizeImage = $_REQUEST['prizeImage'];

	$place =$_REQUEST['place'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<style type='text/css'>
	<!--
		body {margin:0px;overflow:hidden;background-color:transparent;}
		html, body {width:100%;height:100%;outline:none;}
	-->
	 </style>
	 <title>Share</title>
</head>
<body>
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
	function callback (post_id, exception) {
		window.parent.hideShare();
	}

	window.onload = function()
	{
<? if ($place == 1): ?>

<? else: ?>
		var userMessage = 'Thanks for playing and don\'t forget to play again tomorrow.'
<? endif; ?>

		var prizeName = "<?= $prizeName ?>";
		var attachment = {
			   name: '<?= $username ?> just "won" ' + prizeName + ' by playing SVEDKA Vodka "BOT or NOT?"',
			   caption: 'They didn\'t win the <?= $grandPrize ?> but you could. Click above to play.',
			   href: '<?= $share_url ?>&fid=<?= $facebookId ?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/prizes/FacebookPrizes/<?= $prizeImage ?>_90x90.png', href: '<?= $share_url ?>&fid=<?= $facebookId ?>' }
               ]
			 };

   		var action_links = [{ text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $facebookId ?>' }];

   		FB_RequireFeatures(["Connect"], function() {

   		FB.init('<?= $facebook_api_key ?>', 'xd_receiver.htm');

   		FB.ensureInit(function() {
   			FB.Connect.streamPublish('', attachment, action_links, null, userMessage, callback);
     		});
   		});
	};
</script>
</body>
</html>