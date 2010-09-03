<?php
	require_once 'include/config.php';
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
#container2 { background:#000 url(<?= $web_url ?>/images/bg.jpg) repeat-y; margin:0 auto; padding-bottom:45px; position:relative; width:520px; color:#fff; font:13px/18px Tahoma;}
h1 a { background:url(<?= $web_url ?>/images/logo.png) no-repeat; display:block; height:36px; margin-left:10px; text-indent:-9999px; width:211px; } /* Background image changed */
#container2 .round { background:url(<?= $web_url ?>/images/play-n-win2.png) no-repeat; display:block; height:63px; margin:25px 20px 0 0; text-indent:-9999px; width:63px;} /* Added */
/* =================================
				MAIN CONTENT
==================================== */
#container2 #mainContent { background:#000; margin:0 auto; position:relative; width:480px;} /* Added */
#container2 h2 { background:url(<?= $web_url ?>/images/bot-or-not-2.jpg) no-repeat; display:block; height:54px; margin:30px 0 0 5px; text-indent:-9999px; width:370px; } /* Added */
#container2 #mainContent a.playBtn {background:url(<?= $web_url ?>/images/play-btn2.png) no-repeat; bottom:550px; height:100px; position:absolute; right:100px; text-indent:-9999px; width:230px; top: 340px} /* Added */
#mainContent img { display:block; margin:0 auto; }
.bot { margin:0; position:absolute; top:138px; right:0; } /* Margin and top changed */
#mainContent a.invite { background:url(<?= $web_url ?>/images/invite-friends.png) no-repeat; display:block; height:28px; margin:10px auto 0; text-indent:-9999px; width:254px; }
#mainContent .desc p { margin:0; padding:0; width:600px; }
.desc { margin:90px 0 0; }
#mainContent p.title span { color:#fff; font:bold 16px Helvetica; text-transform:none; }
#container2 #mainContent p {font: 13px/21px tahoma; margin:23px auto 0 20px; width:460px;}
#container2 #mainContent p.title { color:#fccd06; font:bold 16px Helvetica; margin-bottom:35px; text-transform:uppercase; }
#mainContent .left img { margin:70px 20px 0 28px; }

/* =================================
				TOP
==================================== */
#top { background:#1a1861; height:36px; margin:0 0 15px 0; }
#top p { font-size:12px; padding:6px 0 6px 15px; }
#top a { color:#fff; margin:0 10px 0 0; text-decoration:none; text-transform:uppercase; }

/* =================================
				FOOTER
==================================== */
#container2 #footer p { font:normal 10px Helvetica; margin:50px auto 0 auto; text-align:center; }
#btm { background:url(<?= $web_url ?>/images/footer-bg.png) repeat-y; height:12px; margin:10px 0 0 0; }