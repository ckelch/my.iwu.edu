<?php
	require_once('_db.php');
    require_once('_db.announcements.php');
	require_once('_functions.php');
?>
<?php
    $announcements_db = new AnnouncementsDB();
	$announcements = $announcements_db->getCurrentAnnouncementsForUser($user);
    $announcements_pagination = new IWU_Paginate($announcements, 6, 'announcements_page');
    $announcements_to_show = $announcements_pagination->getResults();
?>
<?php foreach($announcements_to_show as $announcement) { ?>
	<article class="announcement">
		<h3><?php echo $announcement['title']; ?></h3>
		<div class="body"><?php echo $announcement['body']; ?></div>
	</article>
<?php } ?>
<?php
    echo $announcements_pagination->getLinks();
?>
<div class="bottom">
	<a onclick="changeChannel($(this).closest('section'), 'create'); return false;" href="">Post an Announcement</a>
</div>