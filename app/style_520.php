<?php
	require_once 'svedka-config.php';
?>
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
h1{ font-size:28px; height: 44px;} /* Added height */
h2{ font-size:26px;}
h3{ font-size:18px;}
h4{ font-size:16px;}
h5{ font-size:14px;}
h6{ font-size:12px;}
h1,h2,h3,h4,h5,h6{ color:#563D64;}
small{ font-size:10px;}
b, strong{ font-weight:bold;}
p{ padding:0px; line-height:22px;}
.left { float:left; }
.right { float:right; }
/* =================================
			CONTAINER
==================================== */
#container2 { background:#000
url(<?= $web_url ?>/images/bg.png) no-repeat bottom center; margin:0 auto; position:relative; width:520px; color:#fff;
font:13px/18px Tahoma; padding-bottom: 25px;}
h1 a { background:url(<?= $web_url ?>/images/logo.png) no-repeat bottom left; display:block; height:36px; margin-left:18px; text-indent:-9999px; width:211px; padding-top: 9px; position: absolute; margin-top: 5px; z-index: 10;} /* Background image changed */
#container2 .round {
background:url(<?= $web_url ?>/images/play-n-win2.png)
no-repeat; display:block; height:63px; margin:10px 20px 0 0;
text-indent:-9999px; width:63px;} /* Added */
/* =================================
				MAIN CONTENT
==================================== */
#container2 #mainContent { background:#000; margin:0 auto;
position:relative; width:480px; padding-bottom: 20px; padding-top: 17px; height: 900px /* <-- adjust the height to get perfect position at top dot // can be as inline style in HTML */}
#container2 h2 {
background:url(<?= $web_url ?>/images/bot-or-not-2.jpg)
no-repeat; display:block; height:54px; margin:15px 0 0 0px;
text-indent:-9999px; width:370px; } /* Added */
#container2 #mainContent a.playBtn
{background:url(<?= $web_url ?>/images/play-btn2.png)
no-repeat; bottom:550px; height:100px; position:absolute; right:100px;
text-indent:-9999px; width:230px; top: 365px} /* Added */
#mainContent img { display:block; margin:0 auto; }
.bot { margin:0; position:absolute; top:138px; right:0; } /* Margin and
top changed */
#mainContent a.invite {
background:url(<?= $web_url ?>/images/invite-friends.png)
no-repeat; display:block; height:28px; margin:10px auto 0;
text-indent:-9999px; width:254px; }
#mainContent .desc p { margin:0 !important; padding:0; width:600px; }
.desc { margin:90px 0 0; }
#mainContent p.title span { color:#fff; font:bold 16px Arial;
text-transform:uppercase; }
#container2 #mainContent p {font: 13px/18px tahoma; margin:23px auto 0
23px; width:415px;}
#container2 #mainContent p.title { color:#fccd06; font:bold 16px Arial;
margin-bottom:35px; text-transform:uppercase; }
#mainContent .left img { margin:48px 20px 0 0px; }

/* =================================
				TOP
==================================== */
#top { background:#1a1861; height:32px; margin:0 0 15px 0; font-family:
"Helvetica Condensed", Arial, Helvetica, Sans-Serif; width: 520px; margin: 0 auto; color: #fff; }
#top p { font-size:12px; padding:6px 0 6px 15px; }
#top a { color:#fff; margin:0 10px 0 0; text-decoration:none;
text-transform:uppercase; }

/* =================================
				FOOTER
==================================== */
#container2 #footer p { font:normal 10px Helvetica; margin:50px auto 0
auto; text-align:center; }
#btm { background:url(<?= $web_url ?>/images/footer-bg2.png)
repeat-y center bottom; height:25px; margin:8px 0 0 0; display: none; }


/* =================================
				POPUP
==================================== */
.popupContainer { background: url(<?= $web_url ?>/images/trans-bg.png); bottom:300px; height:150px;
padding:10px; position:absolute; right:30px; width:390px; z-index:1;
-moz-border-radius:8px; -webkit-border-radius: 8px; }
.popup { background: url(<?= $web_url ?>/images/trans-bg.png); bottom:510px;
height:160px; padding:10px; position:absolute; right:55px; width:340px;
-moz-border-radius:8px; -webkit-border-radius: 8px; z-index:1; font-family: "Lucida Grande"; }
.popupInvite { background:#fff; height:150px; position:absolute;
width:390px; z-index:1; }
.popupInvite h2 { background:#d4d4d4; height:39px; margin:0;
text-indent:inherit; width:390px; font-family: "Lucida Grande"; }
.popupInvite h2 span { color:#3f5a8f; display:block; font:bold 13px
Arial; padding:13px 30px; }
.popupContent { margin:15px 30px; padding:0; }
#container2 #mainContent .popupContent img { margin:0 10px 0 0; }
.popupInvite h3 { color:#3f5a8f; font:bold 14px "Lucida Grande"; }
.popup h3 { color:#3f5a8f; font:bold 14px "Lucida Grande"; margin:0px 0 0 40px; }
#container2 #mainContent .popup p { color:#5f5f5f; font:11px/14px
Arial; margin:0 0 0 40px; width:290px; font-family: "Lucida Grande"; }
#container2 #mainContent .popupInvite p { color:#5f5f5f; display:block;
font:normal 10px/18px "Lucida Grande"; margin:0; width:256px; }
.popup a { background:url(<?= $web_url ?>/images/close.png)
no-repeat; display:block; height:26px; margin:17px 0 0 0;
text-indent:-9999px; width:49px; }
.popupInvite a {
background:url(<?= $web_url ?>/images/send.jpg) no-repeat;
clear:both; display:block; height:21px; margin:0 7px 0 0;
text-indent:-9999px; width:45px; }
.popupWrap { /* Added by pupung on 8-sept */
	background: #fff;
	height: 130px;
	padding-top: 30px;
}
