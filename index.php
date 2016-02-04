<?php
$DEV = strpos($_SERVER['REQUEST_URI'], '~') != 0;
set_include_path(get_include_path() . PATH_SEPARATOR . ($DEV ? '/home/mgorman/public_html/_resources/php' : '/var/www/php.iwu.edu/htdocs/_resources/php'));
require_once('_class.IWU_DB.php');
require_once('_class.IWU_DataRow.php');
require_once('_class.IWU_Auth.php');
require_once('_class.IWU_Template.php');
require_once('_db.php');
require_once('_functions.php');

$db = new PortalDB();

if(isset($_POST['action'])) {
    if($_POST['action'] === 'ToggleChannel') {
        $db->updateChannelStatus(array(
            'Channel' => $_POST['channel'],
            'Status' => $_POST['newStatus'],
            'NetID' => IWU_Auth::getUser()
        ));
    }
}

$page = new IWU_Template();
$page->wwwPath = '/its/';
$page->headTitle = 'Campus Portal';
$page->headerBG = '/_resources/images/banners/full/aspiration-sculpture.jpg';
$page->headerDepartment = 'Information Technology Services';
$page->bodyTitle = 'Campus Portal';
//$page->contactNetID = 'aaubry';
//$page->newsHeader = 'Campus News &amp; Events';
//$page->newsFeed = 'news-and-events';
//$page->newsCategory = 'news';
//$page->newsFilterShow = true;
//$page->newsSort = 'date';
//$page->newsStyle = 'sidebar';
//$page->newsCount = '3';
ob_start();
?>
<script type="text/javascript" src="jquery.masonry.min.js"></script>
<script type="text/javascript">
function runMasonry() {
	$('#portal').masonry({
		itemSelector: 'section.highlight'
	});
}

function toggleChannel(channel) {
	$(channel).find('div.content').toggleClass('hiddenChannel');
	runMasonry();
    $.post( "./", { action: "ToggleChannel", channel: $(channel).data('channel-name'), newStatus: ($(channel).find('div.content').hasClass('hiddenChannel') ? 'hidden' : 'visible' ) } );
}

function changeChannel(channel, state) {
	var contentBlock = $(channel).find('.content');

	$.get($(channel).attr('data-url-'+state), function(data){
		$(contentBlock).html(data);
		runMasonry();
	});
	return false;
}

function changeChannelWithParameters(channel, state, params) {
	$.get($(channel).attr('data-url-'+state), params, function(data){
		$(channel).find('.content').html(data);
		runMasonry();
	});
	return false;
}

function submitForm(form, state) {
	var channel = $(form).closest('section');
	$.post($(channel).attr('data-url-'+state), $(form).serialize(), function(data){
		$(channel).find('.content').html(data);
		runMasonry();
	});
	return false;
}

$().ready(function(){
	runMasonry();
});

$('.jobs .content').masonry({
	itemSelector: 'a'
});
</script>
<?php
$page->postJQueryScript = ob_get_clean();
ob_start();
?>
<style type="text/css">
.only_indent_lists ul {
	list-style-type: none;
	padding-left: 2em;
}
#portal, #portal section {
	  -webkit-transition-duration: 0.3s;
	     -moz-transition-duration: 0.3s;
	      -ms-transition-duration: 0.3s;
	       -o-transition-duration: 0.3s;
	          transition-duration: 0.3s;
}
#portal section {
	  -webkit-transition-property: all;
	     -moz-transition-property: all;
	      -ms-transition-property: all;
	       -o-transition-property: all;
	          transition-property: all;
	  -webkit-transition-timing-function: linear;
	     -moz-transition-timing-function: linear;
	      -ms-transition-timing-function: linear;
	       -o-transition-timing-function: linear;
    width: 30%;
	min-width: 340px;
	border: 1px solid #ccc;
	margin: 1em;
	overflow-y: scroll;
	position: relative;
}
section h1.channelname {
	cursor: pointer;
}
section div.content {
	margin-top: 0.5em;
	padding: 0.5em;
}
section article {
	padding: 0.5em;
}
section form {
	padding-bottom: 15px;
}
section form fieldset {
	padding-bottom: 1em;
	border: 0;
	border-bottom: 2px solid #ccc;
	margin-bottom: 2em;
}
section form legend {
	font-size: 140%;
	font-weight: bold;
}
section form label {
	display: block;
	margin: 1em 0;
}
section form label p {
	margin: 0;
}
section form input[type=text] {
	width: 100%;
}
section form textarea {
	width: 100%;
	height: 6em;
}
section.lost, section.jobs {
	max-height: 500px;
}
section.blocks .content {
	text-align: center;
}
section.blocks .content .content_block {
	text-align: left;
	display: inline-block;
	vertical-align: top;
	width: 143px;
	padding: 5px;
}
section.blocks .content .content_block h1 {
	font-size: 14px;
	color: #000000;
	background-color: transparent;
	margin: 0.67em 0;
	padding: 0;
}
section.blocks .content .content_block h2 {
	font-size: 12px;
	color: #666666;
	background-color: transparent;
	text-transform: uppercase;
	margin: 0.83em 0;
	padding: 0;
}
section.blocks .content .content_block h2 a {
	text-decoration: none;
	color: #666666;
}
section.blocks .content .content_block p {
	font-size: 10px;
	color: #555555;
	line-height: normal;
}
section div.hiddenChannel {
    display: none;
	opacity: 0;
	height: 0;
	margin: 0;
	padding: 0;
}
</style>
<div id="portal" class="container">
	<?php
		$channels = array();

		$channels['announcements'] = new Channel('announcements', 'Announcements');
		$channels['announcements']->addContext('default', '_channel.announcements.php');
		$channels['announcements']->addContext('create', '_channel.announcements.create.php');
		$channels['announcements']->addContext('post', '_channel.announcements.post.php');

		//$channels['calendar'] = new Channel('calendar', 'Campus Calendar');
		//$channels['calendar']->addContext('default', '_channel.calendar.php');

		//$channels['titantv'] = new Channel('titantv', 'Titan TV Schedule');
		//$channels['titantv']->addContext('default', '_channel.titantv.php');

		$channels['classified'] = new Channel('classified', 'Classified Ads');
		$channels['classified']->addContext('default', '_channel.classified.php');
		$channels['classified']->addContext('create', '_channel.classified.create.php');
		$channels['classified']->addContext('post', '_channel.classified.post.php');
		$channels['classified']->addClass('blocks');

		//$channels['wesn'] = new Channel('wesn', 'WESN');
		//$channels['wesn']->addContext('default', '_channel.wesn.php');
		//$channels['wesn']->addClass('blocks');

		$channels['lost'] = new Channel('lost', 'Lost and Found');
		$channels['lost']->addContext('default', '_channel.lost.php');
		$channels['lost']->addContext('create', '_channel.lost.create.php');
		$channels['lost']->addContext('post', '_channel.lost.post.php');
		$channels['lost']->addClass('blocks');

		$channels['jobs'] = new Channel('jobs', 'Student Jobs');
		$channels['jobs']->addContext('default', '_channel.jobs.php');
		$channels['jobs']->addContext('single', '_channel.jobs.single.php');
		$channels['jobs']->addClass('blocks');

		//$channels['weekly'] = new Channel('weekly', 'Campus Weekly');
		//$channels['weekly']->addContext('default', '_channel.weekly.php');

		$channels['athletics'] = new Channel('athletics', 'Titan Athletics');
		$channels['athletics']->addContext('default', '_channel.athletics.php');

        $channels['dosa_forms'] = new Channel('dosa_forms', 'Online Forms');
		$channels['dosa_forms']->addContext('default', '_channel.dosa_forms.php');
    
        $channels['service_requests'] = new Channel('service_requests', 'Service Requests');
        $channels['service_requests']->addContext('default', '_channel.service_requests.php');

        $channels['physical_plant'] = new Channel('physical_plant', 'Physical Plant');
		$channels['physical_plant']->addContext('default', '_channel.physical_plant.php');

        $channels['helpdesk'] = new Channel('helpdesk', 'ITS Helpdesk');
		$channels['helpdesk']->addContext('default', '_channel.helpdesk.php');
    
        $channels['media'] = new Channel('media', 'Media & Publications');
		$channels['media']->addContext('default', '_channel.media.php');
    
        $channels['student_life'] = new Channel('student_life', 'Student Life');
		$channels['student_life']->addContext('default', '_channel.student_life.php');
    
        $channels['departments'] = new Channel('departments', 'Departments & Offices');
		$channels['departments']->addContext('default', '_channel.departments.php');
    
		foreach($channels as $name => $channel) {
            if($db->getChannelStatus($name, IWU_Auth::getUser()) === 'hidden') {
                $channel->addClass('hiddenChannel');
            }
			echo $channel;
		}
	?>
</div>
<div class="clearfix" style="clear: both;"></div>
<?php
$page->contentPrimary = ob_get_clean();
echo $page;
?>