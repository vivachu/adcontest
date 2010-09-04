<?
	require_once 'include/config.php';
	require_once 'include/sql.php';
	require_once 'include/facebook.php';

	$grandPrize = getGrandPrize($test_date);
	include 'include/facebook-authenticate-create-player.php';

	$title = "Play SVEDKA \"BOT or NOT?\"";
	if ($friend) {
		$title = $friend['username'] . " is playing SVEDKA \"BOT or NOT?\"";
	}
?>

<html>
	<head>
		<title><?= $title ?></title>
<script type="text/javascript">
<!--
//window.location = "<?= $fan_page_url ?>&fid=<?= $_REQUEST['fid']?>";
//-->
</script>

	</head>
	<body>
		<img src="images/svedka_icon.png"/>
		<h3><?=$title ?></h3>
		<p>
			Give it a shot and you could win an amazing BOT prize or a fun NOT prize. Just go to the SVEDKA Vodka Facebook page to play! This week's BOT prize: <?= $grandPrize['name']?>
		<p>
		<p><a href="<?= $fan_page_url ?>&fid=<?= $_REQUEST['fid']?>">Play Now</a></p>
	</body>
</html>