<?php
	require_once('_db.php');
    require_once('_db.announcements.php');
	require_once('_functions.php');
?>
<form onsubmit="submitForm($(this), 'post'); return false;">
	<fieldset class="only_indent_lists">
		<legend>Target Audience</legend>
		<ul id="announcement_create_target_audience">
			<li>
				<label for="announcements_target_audience_everyone">
					<input type="checkbox" name="target_audience" id="announcements_target_audience_everyone" value="Everyone" />
					Everyone
				</label>
				<ul>
					<li>
						<label for="announcements_target_audience_all_students">
							<input type="checkbox" name="target_audience" id="announcements_target_audience_all_students" value="All Students" />
							All Students
						</label>
						<ul>
							<li>
								<label for="announcements_target_audience_male_students">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_male_students" value="Male Students" />
									Male Students
								</label>
								<label for="announcements_target_audience_female_students">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_female_students" value="Female Students" />
									Female Students
								</label>
							</li>
							<li>
								<label for="announcements_target_audience_first_year_students">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_first_year_students" value="First-Year Students" />
									First-Year Students
								</label>
								<label for="announcements_target_audience_sophomores">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_sophomores" value="Sophomores" />
									Sophomores
								</label>
								<label for="announcements_target_audience_juniors">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_juniors" value="Juniors" />
									Juniors
								</label>
								<label for="announcements_target_audience_seniors">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_seniors" value="Seniors" />
									Seniors
								</label>
							</li>
                            <li>
                                <label for="announcements_target_audience_may_term_students">
                                    <input type="checkbox" name="target_audience" id="announcements_target_audience_may_term_students" value="May Term Students" />
                                    May Term Students
                                </label>
                            </li>
						</ul>
					</li>
					<li>
						<label for="announcements_target_audience_all_faculty_staff">
							<input type="checkbox" name="target_audience" id="announcements_target_audience_all_faculty_staff" value="All Faculty/Staff" />
							All Faculty/Staff
						</label>
                        <ul>
                            <li>
                                <label for="announcements_target_audience_faculty_fulltime">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_faculty_fulltime" value="Faculty - full-time" />
									Faculty - full-time
								</label>
								<label for="announcements_target_audience_faculty_parttime">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_faculty_parttime" value="Faculty - part-time" />
									Faculty - part-time
								</label>
                            </li>
                            <li>
                                <label for="announcements_target_audience_staff_exempt">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_staff_exempt" value="Staff - exempt" />
									Staff - exempt
								</label>
								<label for="announcements_target_audience_staff_nonexempt">
									<input type="checkbox" name="target_audience" id="announcements_target_audience_staff_nonexmpt" value="Staff - non-exempt" />
									Staff - non-exempt
								</label>
                            </li>
                        </ul>
					</li>
					<li>
						<label for="announcements_target_audience_retirees">
							<input type="checkbox" name="target_audience" id="announcements_target_audience_retirees" value="Retirees" />
							Retirees
						</label>
					</li>
					<li>
						<label for="announcements_target_audience_alumni">
							<input type="checkbox" name="target_audience" id="announcements_target_audience_alumni" value="Alumni" />
							Alumni
						</label>
					</li>
				</ul>
			</li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Dates</legend>
		<label for="announcements_start_date">
			<p><strong>Start Date</strong></p>
			<p><small>Indicate when the announcement should be posted</small></p>
			<input type="date" name="start_date" id="announcements_start_date" value="<?php echo date('Y-m-d'); ?>" />
		</label>
		<label for="announcements_end_date">
			<p><strong>End Date</strong></p>
			<p><small>Announcements may run for a maximum of 7 days and may be re-posted by request.</small></p>
			<input type="date" name="end_date" id="announcements_end_date" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" />
		</label>
	</fieldset>
	<fieldset>
		<legend>Content</legend>
		<label for="announcements_headline">
			<p><strong>Headline</strong></p>
			<p><small>50 characters or fewer</small></p>
			<input type="text" name="headline" id="announcements_headline" maxlength="50" />
		</label>
		<label for="announcements_when">
			<p><strong>When?</strong></p>
			<p><small>If you're promoting an event, please include the date and time of the event.</small></p>
			<input type="text" name="when" id="announcements_when" />
		</label>
		<label for="announcements_where">
			<p><strong>Where?</strong></p>
			<p><small>If you're promoting an event, please include the location.</small></p>
			<input type="text" name="where" id="announcements_where" />
		</label>
		<label for="announcements_body">
			<p><strong>Body of Announcement</strong></p>
			<p><small>No more than 150 words</small></p>
			<textarea name="body" id="announcements_body"></textarea>
		</label>
		<label for="announcements_sponsor">
			<p><strong>Sponsor</strong></p>
			<p><small>Committee, Club, or other IWU affiliation</small></p>
			<input type="text" name="sponsor" id="announcements_sponsor" />
		</label>
		<label for="announcements_contact">
			<p><strong>Contact</strong></p>
			<p><small>Your name and contact information</small></p>
			<input type="text" name="contact" id="announcements_contact" value="<?php echo get_name_from_netid($user); ?> (<?php echo $user; ?>@iwu.edu)" />
		</label>
	</fieldset>
	<input type="submit" /> or <a onclick="changeChannel($(this).closest('section'), 'default'); return false;" href="">go back</a>
</form>
<script type="text/javascript">
    $('#announcement_create_target_audience input[type="checkbox"]').change(function() {
        if(this.checked) {
            // mark all sub-checkboxes
            $(this).closest('li').children('ul').find('input[type="checkbox"]').attr('checked', 'checked');
            
            // check all sibling checkboxes; if all are checked, mark parent
            //if($(this).closest('li').find('input[type="checkbox"]').length == $(this).closest('li').find('input[type="checkbox"][checked="checked"]').length) {
               // $(this).closest('li').closest('ul').closest('li').children('label').find('input[type="checkbox"]').attr('checked', 'checked');
            //}
        }
        else {
            // unmark parent and all descendents
            $(this).closest('li').find('input[type="checkbox"]').attr('checked', false);
            
            // unmark all descendents
        }
    });
</script>