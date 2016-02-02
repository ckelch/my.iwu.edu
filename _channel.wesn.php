<style type="text/css">
	#wesn_logo, .wesn div.block {
		color: black;
        width: 50%;
		/*text-decoration: none;
		display: inline-block;
		vertical-align: top;
		width: 143px;
		padding: 0.5em;*/
	}
	#wesn_logo:hover {
		background-color: #EEEEEE;
	}
	#wesn_logo {
		text-align: center;
	}
	#wesn_logo img {
		border: 0;
	}
	#wesn_logo h1 {
		font-size: 20px;
		margin-bottom: 0;
		color: #000000;
	}
	#wesn_logo h2 {
		font-size: 12px;
		margin-bottom: 0;
		text-transform: uppercase;
	}
	#wesn_song {
		font-size: 18px;
		color: #AAAAAA;
	}
	#wesn_song .title {
		font-weight: bold;
		color: #222222;
		font-size: 18px;
		text-transform: uppercase;
	}
	#wesn_song .artist {
		color: #222222;
		font-size: 18px;
		text-transform: uppercase;
	}
	.wesn .content a {
		color: #000000;
	}
	.wesn .content h1 {
		font-size: 20px;
		text-transform: uppercase;
		color: #999999;
		background-color: transparent;
	}
	.wesn .content h1 div {
		font-size: 24px;
		color: #000000;
	}
	.wesn .content p {
		font-size: 12px;
	}
</style>
<a class="content_block" href="http://www.wesn.org/881/" id="wesn_logo">
	<img src="https://php.iwu.edu/wesn/logo.png" width="143" height="150">
</a>
<div class="block content_block" id="wesn_recent">
	<p>Last track played on WESN 88.1 FM and <a href="http://fmt01.egihosting.com:20471/listen.pls">streamed on wesn.org</a>:</p>
	<div id="wesn_song">
		<?php include '/var/www/php.iwu.edu/htdocs/wesn/listone.php'; ?>
	</div>
</div>
<div class="block content_block" id="wesn_phone">
	<h1>Make a <div>Request.</div></h1>
	<p>Call 556-2634 or AIM <a href="aim:goim?screenname=wesn881">wesn881</a>.</p>
</div>
<div class="block content_block" id="wesn_show_request">
	<h1>Broadcast <div>Yourself.</div></h1>
	<p>Interested in your own show now, next semester, or next year? <a href="javascript: void(0)" onclick="window.open('wesn.html', 'windowname1', 'width=550, height=500'); return false;">Let us know.</a></p>
</div>
<div class="bottom">
	<a href="http://www.wesn.org/881/?page_id=26" target="_new">WESN schedule</a>
</div>