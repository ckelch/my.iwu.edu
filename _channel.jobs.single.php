<?php
	require_once('_db.jobs.php');
?>
<style type="text/css">
	.jobs .content .job:hover {
		text-decoration: none;
		background-color: #DDDDDD;
	}
	.jobs .content .job .specs {
		padding-left: 15px;
		font-size: 10px;
		color: #555555;
		line-height: normal;
	}
</style>
<style type="text/css">
section.jobs .content {
	font-family: Helvetica, Arial, sans-serif;
	text-align: left;
}
.jobs .content h1 {
	font-size: 20px;
}
.jobs .content h2 {
	font-size: 16px;
	color: #666666;
	text-transform: uppercase;
}
.jobs .content .description {
	font-size: 14px;
}
.jobs .content .skills {
	font-size: 14px;
	font-weight: bold;
}
.jobs .content dl {
	padding: 2em;
	font-size: 12px;
}
.jobs .content dt {
	font-style: italic;
	font-size: 11px;
}
.jobs .content a.back {
	text-decoration: none;
	color: #000000;
	font-weight: bold;
	font-size: 48px;
	text-align: center;
	display: block;
}
</style>
<?php
$jobs_db = new JobsDB();
$jobs_ads = $jobs_db->getSingleJob($_GET['id']);

foreach($jobs_ads as $ad) {
	echo $ad->displaySingle();
}
?>
<div class="bottom">
	<a onclick="changeChannel($(this).closest('section'), 'default'); return false;" href="">&larr;</a>
</div>