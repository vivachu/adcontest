<?php
	require_once 'svedka-config.php';
?>

@charset "utf-8";

/* =================================

CSS created by:

Achmad Kamal Chaneman :: http://kamalchaneman.co.nr

Copyrights 2010

==================================== */

body {

	background:#000;

	color:#fff;

	font:13px/18px Tahoma;

	margin:0 auto;

	padding:0;

	position:relative;

}

/**************************************************** GLOBAL STYLES ****/

.clear{ display:block; clear:both; }

h1{ font-size:28px;}

h2{ font-size:26px;}

h3{ font-size:18px;}

h4{ font-size:16px;}

h5{ font-size:14px;}

h6{ font-size:12px;}

h1,h2,h3,h4,h5,h6{ color:#563D64;}

small{ font-size:10px;}

b, strong{ font-weight:bold;}

a{ color:#D81F80;}

a:hover{ color:#563D64; }

p{ padding:0px; line-height:22px;}

.left { float:left; }

.right { float:right; }

/* =================================

			CONTAINER

==================================== */

#container { background:#000 url(<?= $web_url ?>/email/images/bg.jpg) repeat-y; margin:0 auto; padding-bottom:45px; position:relative; width:520px; }

#container2 { background:#000 url(<?= $web_url ?>/email/images/bg2.jpg) repeat-y; margin:0 auto; padding-bottom:25px; position:relative; width:742px; }

h1 { margin:0 auto; padding:15px 0 0 0; width:485px; }

h1 a { background:url(<?= $web_url ?>/email/images/logo.png) no-repeat; display:block; height:35px; margin-left:10px; text-indent:-9999px; width:136px; }

#container2 h1 { margin:0 30px; padding:15px 0 0 0; width:485px; };

#container2 h1 a { background:url(<?= $web_url ?>/email/images/logo.png) no-repeat; display:block; height:35px; margin-left:10px; text-indent:-9999px; width:136px; }

#container2 h2.tagInner { background:url("<?= $web_url ?>/email/images/facebook-friendship.jpg") no-repeat scroll 0 0 transparent; display:block; height:88px; margin:30px 0 0 5px; width:463px; }

/* =================================

				TOP

==================================== */

#top { background:#1a1861; height:36px; margin:0 0 15px 0; }

#top p { font-size:12px; padding:6px 0 6px 15px; }

#top a { color:#fff; margin:0 10px 0 0; text-decoration:none; text-transform:uppercase; }

/* =================================

				MAIN CONTENT

==================================== */

#mainContent { background:#000; margin:0 auto; position:relative; width:485px; }

#container2 #mainContent { background:#000; margin:0 auto; position:relative; width:680px; }

h2 { background:url(<?= $web_url ?>/email/images/bot-or-not.jpg) no-repeat; display:block;/*  height:54px; */ margin:30px 0 0 5px; text-indent:-9999px; width:370px; }

h2.tagInner { background:url(<?= $web_url ?>/email/images/facebook-friendship.jpg) no-repeat; display:block; height:51px; margin:30px 0 0 5px; width:457px; }

h2.congrats { background:url(<?= $web_url ?>/email/images/congrat.jpg) no-repeat; display:block; height:51px; width:457px; }

h2.notBot { background:url(<?= $web_url ?>/email/images/itsNotBot-butYouAre.jpg) no-repeat; display:block; height:40px; width:457px; }

.badges { background:url(<?= $web_url ?>/email/images/badge.jpg) no-repeat; display:block; height:96px; margin:25px 32px 0 0; text-indent:-9999px; width:96px; }

.round { background:url(<?= $web_url ?>/email/images/play-n-win.png) no-repeat; display:block; height:63px; margin:25px 20px 0 0; text-indent:-9999px; width:63px; }

#mainContent p { font: 13px/21px tahoma; margin:23px auto 0 20px; width:405px; }

#mainContent p.text { font:normal 11px/18px Tahoma; margin:23px auto 0 35px; width:403px; }

#mainContent p.text a { color:#07a6da; display:block; }

#mainContent p.title { color:#fccd06; font:bold 16px Helvetica; margin-bottom:35px; text-transform:uppercase; }

#mainContent p.title span { color:#fff; font:bold 16px Helvetica; text-transform:none; }

#mainContent p.title a { color:#fccd06; font:bold 16px Helvetica; margin-bottom:35px; text-transform:uppercase; text-decoration: none; position: relative; z-index: 20; }

#mainContent img { display:block; margin:0 auto; }

#mainContent .left img { margin:60px 20px 0 28px; }

#mainContent .left img.small { height:137px; margin:5px 20px 0 28px; width:130px; }

.bot { margin:60px 0 0 0; position:absolute; top:180px; right:0; }

#mainContent a.playBtn { background:url(<?= $web_url ?>/email/images/play-btn.png) no-repeat; bottom:550px; height:100px; position:absolute; right:100px; text-indent:-9999px; width:230px; }

#mainContent a.youWin { background: url(<?= $web_url ?>/email/images/itsbot-youwin.png) no-repeat; position: absolute; width: 401px; height: 74px; text-indent: -7777px; display: block;margin-top: 100px; margin-left: 50px; z-index: 10;}

#mainContent a.youLose { background: url(<?= $web_url ?>/email/images/itsnotbot-youlose.png) no-repeat; position: absolute; width: 401px; height: 74px; text-indent: -7777px; display: block;margin-top: 100px; margin-left: 90px; z-index: 10;}

#mainContent a.invite { background:url(<?= $web_url ?>/email/images/invite-friends.png) no-repeat; display:block; height:28px; margin:60px auto 0 auto; text-indent:-9999px; width:254px; }

#mainContent a.redeem { background:url(<?= $web_url ?>/email/images/redeem.png) no-repeat; display:block; height:28px; margin:165px auto 0 auto; text-indent:-9999px; width:285px; }

#mainContent a.redeem-insole { background:url(<?= $web_url ?>/email/images/redeem-gelinsoles.png) no-repeat; display:block; height:28px; margin:90px auto 0 auto; text-indent:-9999px; width:264px; position: relative; z-index: 20; }

.titleBar { background:url(<?= $web_url ?>/email/images/this-week-bot-prize.png) no-repeat; height:37px; text-indent:-9999px; width:383px; }

.redeemiPad { background:#e30065; margin:35px 0 130px 35px; padding:8px 0; text-align:center; text-transform:uppercase; width:202px; }

.redeemiPad a { color:#fff; font:bold 18px Helvetica; text-decoration:none; }

.desc { margin:135px 0 0 0; }

#mainContent .desc p { margin:0; padding:0; width:465px; }

.emailfriend {

	position: absolute;

	/* float: right; */

	padding-left: 386px;

	margin-top: 0px;

	z-index: 1;

}

#container2 .redeemiPad {margin-bottom: 95px;}

#container2 p.text {position: relative; z-index: 5; font-size: 16px;}

#container2 #footer p {position: relative; z-index: 5; padding-left: 10px;}

#footer p a {color: #ffc821;}

/* =================================

				POPUP

==================================== */

.popupContainer { background:#525252; bottom:300px; height:150px; padding:10px; position:absolute; right:30px; width:390px; z-index:1; -moz-border-radius:8px; }

.popup { background:#fff; border:10px solid #525252; bottom:510px; height:160px; padding:10px; position:absolute; right:55px; width:340px; -moz-border-radius:8px; z-index:1; }

.popupInvite { background:#fff; height:150px; position:absolute; width:390px; z-index:1; }

.popupInvite h2 { background:#d4d4d4; height:39px; margin:0; text-indent:inherit; width:390px; }

.popupInvite h2 span { color:#3f5a8f; display:block; font:bold 13px Arial; padding:13px 30px; }

.popupContent { margin:15px 30px; padding:0; }

#mainContent .popupContent img { margin:0 10px 0 0; }

.popupInvite h3 { color:#3f5a8f; font:bold 14px Helvetica; }

.popup h3 { color:#3f5a8f; font:bold 15px Helvetica; margin:30px 0 0 40px; }

#mainContent .popup p { color:#5f5f5f; font:bold 12px/18px Helvetica; margin:0 0 0 40px; width:290px; }

#mainContent .popupInvite p { color:#5f5f5f; display:block; font:normal 10px/18px Helvetica; margin:0; width:256px; }

.popup a { background:url(<?= $web_url ?>/email/images/close.jpg) no-repeat; display:block; height:25px; margin:17px 0 0 0; text-indent:-9999px; width:52px; }

.popupInvite a { background:url(<?= $web_url ?>/email/images/send.jpg) no-repeat; clear:both; display:block; height:21px; margin:0 7px 0 0; text-indent:-9999px; width:45px; }

/* =================================

				FORM

==================================== */

#form { margin:0 0 0 30px; padding:20px 0 0 0; width:470px }

label { font:normal 12px Trebuchet MS; }

#form input, select { background:#000; border:1px solid #fff; color:#fff; display:block; font:normal 12px Tahoma; margin:0 10px 0 0; padding:5px 0 5px 3px; }

#form .name { width:165px; }

#form .street { width:250px; }

#form .apt { width:80px; }

#form .city { width:200px; }

#form .zip { width:70px; }

#form div { float:left; margin:0 0 15px 0; }

#submit { clear:both; }

#submit input { background:#e30065; border:none; font:bold 16px Helvetica; margin:10px 0 0 0; padding:3px 7px; text-transform:uppercase; }

/* =================================

				FOOTER

==================================== */

#footer p { font:normal 10px Helvetica; margin:50px auto 0 auto; text-align:center; width: 600px; }

#btm { background:url(<?= $web_url ?>/email/images/footer-bg.png) repeat-y; height:12px; margin:10px 0 0 0; }