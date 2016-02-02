<?php if(userHasRole($user, 'Google')) { ?>
	<li><a href="http://gmail.iwu.edu/">Email</a></li>
	<li><a href="http://cal.iwu.edu/">Calendar</a></li>
	<li><a href="http://drive.google.com/a/iwu.edu">Documents</a></li>
<?php } ?>
<?php if(userHasRole($user, 'Moodle')) { ?>
	<li><a href="http://courses.iwu.edu/">Moodle</a></li>
<?php } ?>
<?php if(userHasRole($user, 'BSS')) { ?>
	<li><a href="https://luna.iwu.edu/PPRD/twbkwbis.P_GenMenu?name=bmenu.P_MainMnu">Banner Self-Service</a></li>
<?php } ?>
<?php if(userHasRole($user, 'INB')) { ?>
	<li><a href="http://luna.iwu.edu:9099/forms/frmservlet?config=pprd_jpi">Internet Native Banner</a></li>
<?php } ?>

<li><a href="http://answers.iwu.edu/3900/ask">ITS Helpdesk</a></li>
<li><a href="https://php.iwu.edu/directory/">Campus Directory</a></li>
<li><a href="http://lists.iwu.edu/">Mailing Lists</a></li>
<li><a href="http://theiwubookstore.com/">Bookstore</a></li>

<?php if(userHasRole($user, 'Adirondack')) { ?>
	<!-- <li><a href="https://luna.iwu.edu:443/PPRD/zwgkthouse.p_redirect_housdir">MyHousing Information</a></li> -->
    <li><a href="https://iwu.datacenter.adirondacksolutions.com/iwu_thdss_test/security/iwu_login.cfm">MyHousing</a></li>
<?php } ?>
