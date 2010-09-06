	function share() {
<?php
	$title = "Play SVEDKA \"BOT or NOT?\"";
	if ($player) {
		$title = $player['username'] . " is playing SVEDKA \"BOT or NOT?\"";
	}
?>

		 FB.ui(
		   {
		   	 display: 'dialog',
			 method: 'stream.publish',
			 attachment: {
			   name: '<?= $title ?>',
			   caption: 'Give it a shot and you could win an amazing BOT prize or a fun NOT prize. Just go to the SVEDKA Vodka Facebook page to play! This week\'s BOT prize: <?= $grandPrize['name']?>',
			   href: '<?= $share_url ?>?fid=<?= $_REQUEST["fid"]?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/images/svedka_icon.png', href: '<?= $share_url ?>?fid=<?= $_REQUEST["fid"]?>' }
               ]
			 },
			 action_links: [
			   { text: 'BOT or NOT', href: '<?= $share_url ?>?fid=<?= $_REQUEST["fid"]?>' }
			 ]
		   },
		   function(response) {
			 if (response && response.post_id) {
			   //alert('Post was published.');
			 } else {
			   //alert('Post was not published.');
			 }
		   }
		 );
	}
