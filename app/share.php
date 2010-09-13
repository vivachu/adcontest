<?php
	require_once 'svedka-config.php';

	$title = "Play SVEDKA Vodka \"BOT or NOT?\"";
	if (isset($_REQUEST['username'])) {
		$title = $_REQUEST['username'] . " is playing SVEDKA Vodka \"BOT or NOT?\"";
	}
	$facebook_id = $_REQUEST['facebookId'];
	$grandPrize = $_REQUEST['grandPrize'];
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
		var attachment = {
			   name: '<?= $title ?>',
			   caption: 'Give it a shot and you could win an amazing BOT prize or a fun NOT prize. Just go to the SVEDKA Vodka Facebook page to play! This week\'s BOT prize: <?= $grandPrize ?>',
			   href: '<?= $share_url ?>&fid=<?= $facebook_id ?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/images/svedka_icon.png', href: '<?= $share_url ?>&fid=<?= $facebook_id ?>' }
               ]
			 };

		var action_links = [
			   { text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $facebook_id ?>' }
			 ];

   		FB_RequireFeatures(["Connect"], function() {

   		FB.init('<?= $facebook_api_key ?>', 'xd_receiver.htm');

   		FB.ensureInit(function() {
   			FB.Connect.streamPublish('', attachment, action_links, null, null, callback);
     		});
   		});
	};
</script>
</body>
</html>