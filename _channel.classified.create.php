<?php
	require_once('_db.php');
	require_once('_functions.php');
?>
<form onsubmit="submitForm($(this), 'post'); return false;">
	<input type="text" name="testField" />
	<input type="submit" />
</form>
