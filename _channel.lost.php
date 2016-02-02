<?php
	require_once('_db.lost.php');
?>
<style type="text/css">
	.lost .content .post h3 {
		font-size: 12px;
		color: #777777;
		font-style: italic;
	}
</style>
<?php
$lost_db = new LostDB();
$lost_items = $lost_db->getCurrentItems();

if(count($lost_items) > 0) {
	?><div class="mason"><?php
	foreach($lost_items as $item) {
		echo $item;
	}
	?></div><?php
    $lost_script = <<<EOC
<script type="text/javascript">
$('.lost .content .mason').masonry({
	itemSelector: 'div.post'
});
</script>
EOC;
    if(isset($GLOBALS['page'])) {
        $GLOBALS['page']->postJQueryScript .= $lost_script;
    }
    else {
        echo $lost_script;
    }
}
else {
	$funtext = array();
	$funtext[] = "Wait, where's my cell phone?";
	$funtext[] = 'Time for a scavenger hunt!';
	$funtext[] = "There's something seriously wrong with the universe.";
	$funtext[] = 'Unless you count those Gulick keys I found yesterday...';
	?><div style="margin: 50px 30px 0 30px;">Nothing is missing right now.<br /><p style="font-size:75%;"><?php echo $funtext[rand(0,count($funtext)-1)]; ?></p></div><?php
}
?>
<div class="bottom">
	<a onclick="changeChannelWithParameters($(this).closest('section'), 'create', {type: 'lost'}); return false;" href="">I lost something.</a>
	<a onclick="changeChannelWithParameters($(this).closest('section'), 'create', {type: 'found'}); return false;" href="">I found something.</a>
</div>