<?php
	require_once 'svedka-config.php';
?>
<table width="700" height="600" border="0" cellpadding="0" cellspacing="0" background="<?= $web_url ?>/email/SECONDARY/<?= $_REQUEST['prizeImage'] ?>Email.png" style="font-family:sans-serif;color:white; text-align: left;">
	<tr>
		<td width="221" height="450" align="left" valign="top">

        <table width="700" border="0" cellpadding="0" cellspacing="0" style="margin-top:130px;">
		  <tr>
		    <th width="8%" scope="col">&nbsp;</th>
		    <th width="62%" scope="col" style="color:#ffffff; text-align:left; font-size: 14px; font-family: Tahoma, Geneva, sans-serif;font-weight: normal;"><p><font color="#ffffff">While this prize is nice, the BOT prize is still out there!</font><br />
		      <font color="#ffffff">Be sure to invite your friends to play for an extra shot</font> <br />
		      <font color="#ffffff">at the BOT prize - If they win, you win too!</font></p>
            <p style="margin-top:5px;margin-bottom:5px;"> <a href="<?= $fan_page_url ?>"><img src="<?= $web_url ?>/email/SECONDARY/invite.png" alt="Click Here to Invite Friends to Play" width="338" height="32" style="border: none;" /></a>
            </p>
            <p style="color:#ffffff;">
            	<font color="#ffffff">While you're waiting for your prize</font> <br />
<font color="#ffffff">to arrive, keep the party going at:</font><br />
			<a href="http://www.facebook.com/svedka" style="color: #07a6da;">www.facebook.com/svedka</a>
            </p>
            <p>
            <a href="<?= $web_url ?>/rules.php" style="font-size: 9px;color: #fec622;">See Official Rules</a>
            </p>
            </th>
		    <th width="30%" scope="col">&nbsp;</th>
	      </tr>
		  </table>

        </td>
	</tr>
</table>