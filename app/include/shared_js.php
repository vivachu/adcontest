<?php
	$title = "Play SVEDKA Vodka \"BOT or NOT?\"";
	if ($player) {
		$title = $player['username'] . " is playing SVEDKA Vodka \"BOT or NOT?\"";
	}
?>


	function share() {
		 FB.ui(
		   {
		   	 display: 'popup',
			 method: 'stream.publish',
			 attachment: {
			   name: '<?= $title ?>',
			   caption: 'Give it a shot and you could win an amazing BOT prize or a fun NOT prize. Just go to the SVEDKA Vodka Facebook page to play! This week\'s BOT prize: <?= $grandPrize['name']?>',
			   href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/images/svedka_icon.png', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }
               ]
			 },
			 action_links: [
			   { text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }
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

	function publishFeedStory() {
		var prizeName = "<?= $prizeSchedule['prize_name'] ?>";
		 FB.ui(
		   {
		   	 display: 'popup',
			 method: 'stream.publish',
			 attachment: {
			   name: '<?= $prizeSchedule['username'] ?> just "won" a ' + prizeName + ' by playing SVEDKA Vodka "BOT or NOT?"',
			   caption: 'They didn\'t win the BOT prize but you could. Click to play.',
			   href: '<?= $share_url ?>&fid=<?= $player["facebook_id"] ?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/prizes/FacebookPrizes/<?= $prizeSchedule['prize_image'] ?>_90x90.png', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"] ?>' }
               ]
			 },
			 action_links: [
			   { text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }
			 ],
			 user_message_prompt: 'Thanks! Your information was received.'
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