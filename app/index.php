<?php
	require_once 'svedka-config.php';
?>
<fb:iframe src="<?= $web_url ?>/game.php?code=<?=$_REQUEST['code'] ?>&fid=<?= $_REQUEST['fid']?>&test_date=<?= $_REQUEST['test_date'] ?>" smartsize="false" width="100%" height="932" frameborder="0" scrolling="no" name="myMainFrame">
</fb:iframe>
