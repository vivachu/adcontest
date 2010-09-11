<?
	require_once 'svedka-config.php';

	if (isset($_REQUEST["fid"])) {
		// cookies don't match. you've logged into facebook as a different user. reset the login cookie to match
		setcookie('svedka-friend-fbid', $_REQUEST['fid'], (time()+60*60*24*30), "/", $_SERVER['SERVER_NAME']);
	}
?>

<html>
	<head>
		<title><?= $title ?></title>


<script type="text/javascript">
<!--
window.location = "<?= $fan_page_url ?>&fid=<?= $_REQUEST['fid']?>";
//-->
</script>

</head>
	<body>
		<?= $fan_page_url ?>&fid=<?= $_REQUEST['fid']?>
	</body>
</html>
