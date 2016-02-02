<?php
	require_once('_db.php');
	require_once('_functions.php');
?>

<form onsubmit="submitForm($(this), 'search'); return false;">
    <label for="user_search">
        Search terms:
        <input type="text" name="user_search" id="user_search" />
    </label>
	<input type="submit" value="Search" />
</form>