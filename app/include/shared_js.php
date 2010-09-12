<?php
	$title = "Play SVEDKA Vodka \"BOT or NOT?\"";
	if ($player) {
		$title = $player['username'] . " is playing SVEDKA Vodka \"BOT or NOT?\"";
	}
?>

	function resizeHeight(height) {
		//We need to call FB.CanvasClient.stopTimerToSizeToContent() first because we have called FB.CanvasClient.startTimerToSizeToContent() earlier
		FB.CanvasClient.stopTimerToSizeToContent();
		FB.XdComm.Server.init("xd_receiver.htm");
		FB.CanvasClient.setCanvasHeight("1000px");
	}

	function shareInline() {
		var attachment = {
			   name: '<?= $title ?>',
			   caption: 'Give it a shot and you could win an amazing BOT prize or a fun NOT prize. Just go to the SVEDKA Vodka Facebook page to play! This week\'s BOT prize: <?= $grandPrize['name']?>',
			   href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/images/svedka_icon.png', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }
               ]
			 };

		var action_links = [
			   { text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }
			 ];

   		FB_RequireFeatures(["Connect"], function() {

   		FB.init('<?= $facebook_api_key ?>', 'xd_receiver.htm');

   		FB.ensureInit(function() {
   			FB.Connect.streamPublish('', attachment, action_links);
     		});
   		});
	}


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

 	function publishFeedStoryInline(userPrompt) {
		var prizeName = "<?= $prizeSchedule['prize_name'] ?>";
		var attachment = {
			   name: '<?= $prizeSchedule['username'] ?> just "won" ' + prizeName + ' by playing SVEDKA Vodka "BOT or NOT?"',
			   caption: 'They didn\'t win the <?= $grandPrize['short_name'] ?> but you could. Click above to play.',
			   href: '<?= $share_url ?>&fid=<?= $player["facebook_id"] ?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/prizes/FacebookPrizes/<?= $prizeSchedule['prize_image'] ?>_90x90.png', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"] ?>' }
               ]
			 };

   		var action_links = [{ text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }];

   		FB_RequireFeatures(["Connect"], function() {

   		FB.init('<?= $facebook_api_key ?>', 'xd_receiver.htm');

   		FB.ensureInit(function() {
   			FB.Connect.streamPublish('', attachment, action_links, null, userPrompt);
     		});
   		});
 	}


	function publishFeedStory(userPrompt) {
		var prizeName = "<?= $prizeSchedule['prize_name'] ?>";
		 FB.ui(
		   {
		   	 display: 'popup',
			 method: 'stream.publish',
			 attachment: {
			   name: '<?= $prizeSchedule['username'] ?> just "won" ' + prizeName + ' by playing SVEDKA Vodka "BOT or NOT?"',
			   caption: 'They didn\'t win the <?= $grandPrize['short_name'] ?> but you could. Click above to play.',
			   href: '<?= $share_url ?>&fid=<?= $player["facebook_id"] ?>',
               media: [
               	{ type: 'image', src: 'http://www.adcontests.com/svedka/app/prizes/FacebookPrizes/<?= $prizeSchedule['prize_image'] ?>_90x90.png', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"] ?>' }
               ]
			 },
			 action_links: [
			   { text: 'Svedka Vodka BOT or NOT?', href: '<?= $share_url ?>&fid=<?= $player["facebook_id"]?>' }
			 ],
			 user_message_prompt: userPrompt
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