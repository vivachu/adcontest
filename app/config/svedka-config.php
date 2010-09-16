<?php
//$fan_page_url = "http%3A%2F%2Fwww.facebook.com%2Fsvedka&t=Svedka%20BOT%20or%20NOT";
//$fan_page_url = "http%3A%2F%2Fwww.facebook.com%2Fpages%2FAd-Contest%2F153004184716221%3Fv%3Dapp_103646963029008";
$fan_page_url = "http://www.facebook.com/pages/Ad-Contest/153004184716221?v=app_103646963029008";

$web_url = "http://dev.adcontests.com";
//$web_url = "http://www.adcontests.com/svedka/app";


// dev
$app_url = "http://apps.facebook.com/bot-or-not-dev";
// production
//$app_url = "http://apps.facebook.com/bot-or-not";

// dev
$facebook_app_id = '152817858073681';
$facebook_api_key = '1bcb20b1617d7ddbb1b20790ba70c5fa';
$facebook_secret_key = 'db54a2e99126c08f27e40d6b142937f4';
$like_app_id = '153004184716221';  // App Contest Page

// production
//$facebook_app_id = '103646963029008';
//$facebook_api_key = '89908958ac1940173e8888ebd3dc16f1';
//$facebook_secret_key = 'c9ba1c23c11f8b28c33bb69d0b3fd641';
//$like_app_id = "60649471874";  // Svedka Page

$smtp_host = "smtpout.secureserver.net";
$smtp_port = "80";
$smtp_username = "sendmail1@handipoints.com";
$smtp_password = "handipointsY0";
$smtp_from = "do-not-reply@svedka.com";
$svedka_admin_email = "vivaqu@gmail.com";


//$test_date = "'2010-09-14 24:33'";
$test_date = "now()";

$share_url = "https://graph.facebook.com/oauth/authorize?client_id=" . $facebook_app_id . "&scope=email,publish_stream,user_birthday,user_likes&redirect_uri=" . $app_url . "/?";
?>
