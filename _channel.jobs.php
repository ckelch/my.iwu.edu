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
<?php
$jobs_db = new JobsDB();
$jobs_ads = $jobs_db->getCurrentJobs();

foreach($jobs_ads as $ad) {
	echo $ad;
}
?>