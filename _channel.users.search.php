<?php
	require_once('_db.php');
	require_once('_functions.php');
?>
<style type="text/css">
.lost form .post {
	text-align: left;
	display: inline-block;
	vertical-align: top;
	width: 143px;
	padding: 0.5em;
}
.lost form .post h1 {
	font-size: 14px;
	color: #000000;
}
.lost form .post h2 {
	font-size: 12px;
	color: #666666;
	text-transform: uppercase;
}
.lost form .post h2 a {
	text-decoration: none;
	color: #666666;
}
.lost form .post h3 {
	font-size: 12px;
	color: #777777;
	font-style: italic;
}
.lost form .post .type {
	color: #222222;
	font-style: normal;
}
.lost form .post p {
	font-size: 10px;
	color: #555555;
}
</style>
<form onsubmit="submitForm($(this), 'post'); return false;">
<div class="post <?php echo (isset($_GET['type']) ? 'found' : 'lost'); ?>">
	<h1 class="ItemName">Short Description</h1>
	<h2><?php echo get_name_from_netid($user); ?><br /><a href="mailto:<?php echo $user; ?>@iwu.edu"><?php echo $user; ?>@iwu.edu</a></h2>
	<h3><span class="type"><?php echo (isset($_GET['type']) ? 'found' : 'lost'); ?></span> <span class="Date_Month"><?php echo date('F'); ?></span> <span class="Date_Day"><?php echo date('j'); ?></span></h3>
	<p class="description"><em>Description:</em> <span class="Description"></span></p>
	<p class="location"><em>Where was it?</em> <span class="Location"></span></p>
	<div>
		<input type="submit" value="Report it!" />
	</div>
</div>

<div class="post">
	<input type="hidden" name="type" value="<?php echo (isset($_GET['type']) ? 'found' : 'lost'); ?>" />
	<div>
		<label for="lost_ItemName">
			<p><strong>Short Description</strong></p>
			<input type="text" name="ItemName" id="lost_ItemName" required="required" />
		</label>
	</div>
	<div>
		<label for="lost_Date_Month">
			<p><strong>Date <?php echo (isset($_GET['type']) ? 'Found' : 'Lost'); ?></strong></p>
			<select name="Date_Month" id="lost_Date_Month">
				<option value="1">January</option>
				<option value="2">February</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<select name="Date_Day" id="lost_Date_Day">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
		</label>
	</div>
	<div>
		<label for="lost_Description">
			<p><strong>Description</strong></p>
			<textarea name="Description" id="lost_Description" rows="7" required="required"></textarea>
		</label>
	</div>
	<div>
		<label for="lost_Location">
			<p><strong>Where was it?</strong></p>
			<input type="text" name="Location" id="lost_Location" />
		</label>
	</div>
</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('#lost_Date_Month').val("<?php echo date('n'); ?>");
		$('#lost_Date_Day').val("<?php echo date('j'); ?>");
	});

	$('#lost_ItemName').keyup(function(){
		if($(this).val() == '') {
			$('.ItemName').html('Short Description');
		}
		else {
			$('.ItemName').text($(this).val());
		}
	});

	$('#lost_Date_Month').change(function(){
		$('.Date_Month').text($('#lost_Date_Month option:selected').text());
	});

	$('#lost_Date_Day').change(function(){
		$('.Date_Day').text($('#lost_Date_Day option:selected').text());
	});

	$('#lost_Description').keyup(function(){
		if($(this).val() == '') {
			$('.Description').html('');
		}
		else {
			$('.Description').text($(this).val());
		}
	});

	$('#lost_Location').keyup(function(){
		if($(this).val() == '') {
			$('.Location').html('');
		}
		else {
			$('.Location').text($(this).val());
		}
	});
</script>
<div class="bottom">
	<a onclick="changeChannel($(this).closest('section'), 'default'); return false;" href="">actually, never mind...</a>
</div>