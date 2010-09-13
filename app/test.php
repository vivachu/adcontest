<?php
	require_once 'svedka-config.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<body>
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>

<script type="text/javascript">

 function publish() {

   var attachment = {
     'name':'FriendMatch',
     'href':'http://apps.facebook.com/frmatch',
     'caption':'{*actor*} is playing FriendMatch!',
     'media':[{
       'type':'image',
       'src':'http://www.ugadevelopers.com/frmatch/tile.png',
       'href':'http://apps.facebook.com/frmatch/'
     }]};

   var action_links = [{'text':'Match Friends','href':'http://apps.facebook.com/frmatch'}];

   FB_RequireFeatures(["Connect"], function() {

     FB.init('<?= $facebook_api_key ?>', 'xd_receiver.htm');

     FB.ensureInit(function() {

         FB.Connect.streamPublish('', attachment, action_links);

     });

   });

 }

</script>

<p>Stream Publish Test</p>
<a href="#" onclick="publish(); return false;">Post a story</a>
</body>
</html>