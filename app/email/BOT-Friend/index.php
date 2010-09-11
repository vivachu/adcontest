<?php
	require_once 'svedka-config.php';
?>
<table width="700" height="600" border="0" cellpadding="0" cellspacing="0" background="<?= $web_url ?>/email/BOT-Friend/<?= $_REQUEST['prizeImage'] ?>Email.png" style="font-family:sans-serif;color:white; text-align: left;">
	<tr>
		<td width="221" height="300" align="left" valign="top">

        <p style="height:165px; margin:0;padding:0;">&nbsp;</p>
        <table width="700" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <th width="8%" scope="col">&nbsp;</th>
		    <th width="62%" scope="col" style="color:#fff; text-align:left; font-size: 14px; font-family: Tahoma, Geneva, sans-serif;font-weight: normal;">
            <p>Congratulations! You invited your friend <?= $_REQUEST['friend'] ?> to play SVEDKA <br />
              &quot;BOT or NOT?&quot;. Your friend just won a pair of <?= $_REQUEST['prizeName'] ?> and now you have won the same thing! Now <br />
              both of you can brag about it to all your friends, because isn't that <br />
              what Facebook is for?</p>
            <p style="font-size:9px">If you're eligible and satisfy the <a href="<?= $web_url ?>/rules.php" style="color: #fec622;">Official Rules</a>:<br />
              <a href="<?= $app_url ?>/redeem-friend.php?c=<?= $_REQUEST['c'] ?>"><img src="<?= $web_url ?>/email/BOT-Friend/redeem.jpg" alt="click Here to Redeem" width="224" height="34" style="margin-top: 3px; border: none;" /></a></p>
            </th>
		    <th width="30%" scope="col">&nbsp;</th>
	      </tr>
		  </table>

        </td>
	</tr>
</table>