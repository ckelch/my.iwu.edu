<?php
require_once('_db.classified.php');

$classified_db = new ClassifiedDB();
$classified_ads = $classified_db->getCurrentAds();

if(count($classified_ads) > 0) {
	?><div class="mason"><?php
	foreach($classified_ads as $ad) {
		echo $ad;
	}
	?></div><?php
    $classifieds_script = <<<EOC
<script type="text/javascript">
$('.classified .content .mason').masonry({
	itemSelector: 'div.ad'
});
</script>
EOC;
    if(isset($GLOBALS['page'])) {
        $GLOBALS['page']->postJQueryScript .= $classifieds_script;
    }
    else {
        echo $classifieds_script;
    }
}
else {
	$funtext = array();
	$funtext[] = 'Got anything good to sell?';
	$funtext[] = 'Anyone need a roommate?';
	$funtext[] = 'Someone <em>must</em> have a first-gen iPod they never use...';
	$funtext[] = "Who'll be next to try to get a few bucks for an old textbook?";
	?><div style="margin: 50px 30px 0 30px;">Nothing is being listed right now.<br /><p style="font-size:75%;"><?php echo $funtext[rand(0,count($funtext)-1)]; ?></p></div><?php
}
?>
<div class="bottom">
	<a onclick="changeChannelWithParameters($(this).closest('section'), 'create', {type: 'classified'}); return false;" href="">post an ad</a>
</div>