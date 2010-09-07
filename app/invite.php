<?php
	require_once 'svedka-config.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<style type='text/css'>
	<!--
		body {margin:0px;overflow:hidden;}
		html, body {width:100%;height:100%;outline:none;}
	-->
	 </style>
	 <title>Invite Friends</title>
</head>
<body>
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
	window.onload = function()
	{
		FB_RequireFeatures(["XFBML"], function()
		{
	            FB.Facebook.init("<?= $facebook_api_key ?>", "xd_receiver.htm");
		});
	};
</script>
<fb:serverFbml>
	<script type="text/fbml">
		<fb:fbml>
			<fb:request-form  action="<?= $web_url ?>/invite_callback.html" method="get" type="Svedka - BOT or NOT Contest" invite="true"
				content="You've been invited to play and win Svedka BOT or NOT? It's free. Win an amazing BOT prize or a bunch of fun NOT prizes each week. Invite your Facebook friends to play, because if they win the BOT prize, so do you! This week's BOT prize: <?= $grandPrize['name'] ?><fb:req-choice url='<?= $share_url ?>&fid=<?= $_REQUEST["fbid"]?>' label='Play Now' /> ">
				<fb:multi-friend-selector cols="4" actiontext="Tell your friends about us" rows="3" showborder="true" bypass="cancel" />
			</fb:request-form>
		</fb:fbml>
	</script>
</fb:serverFbml>
</body>
</html>