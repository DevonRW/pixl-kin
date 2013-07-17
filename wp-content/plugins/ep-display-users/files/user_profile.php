<?php

add_action('personal_options_update', 'epdu_save_extra_profile_fields');
add_action('edit_user_profile_update', 'epdu_save_extra_profile_fields');
add_action('show_user_profile', 'epdu_show_extra_profile_fields');
add_action('edit_user_profile', 'epdu_show_extra_profile_fields');

function epdu_save_extra_profile_fields($user_id) {
	if(!current_user_can('edit_user', $user_id)) return false;

	update_usermeta($user_id, 'is_visible', $_POST['is_visible']);
	update_usermeta($user_id, 'is_sidebar', $_POST['is_sidebar']);
	update_usermeta($user_id, 'show_user_email', $_POST['show_user_email']);
	update_usermeta($user_id, 'epdu_position', $_POST['epdu_position']);
	update_usermeta($user_id, 'epdu_phone', $_POST['epdu_phone']);
	update_usermeta($user_id, 'epdu_city', $_POST['epdu_city']);
	update_usermeta($user_id, 'epdu_age', $_POST['epdu_age']);
}


function epdu_show_extra_profile_fields( $user ) {
?>
	<h3>EP Display Users Extra Fields</h3>
	
	<?php if(!is_plugin_active('user-photo/user-photo.php')) : ?>
		<div style="border-top: 3px solid #6cadcb; border-bottom: 3px solid #6cadcb; background: #bfebff; padding: 5px;">
			If you want to have more control of the avatars or just not use gravatar, EP Display Users is coded to work with the plugin User Photo. <a href="http://wordpress.org/extend/plugins/user-photo/">Download it here</a>.
		</div>
	<?php endif; ?>
	
	<table class="form-table">
		<tr>
			<th><label for="title">Position</label></th>
			<td>
				<input type="text" name="epdu_position" value="<?php echo get_the_author_meta('epdu_position',$user->ID); ?>" />
				<span class="description">Position in the company/society/union/association/coalition.</span>
			</td>
		</tr>
		<tr>
			<th><label for="company">Phone</label></th>
			<td>
				<input type="text" name="epdu_phone" value="<?php echo get_the_author_meta('epdu_phone',$user->ID); ?>" />
				<span class="description">Phone number.</span>
			</td>
		</tr>
		<tr>
			<th><label for="title">City</label></th>
			<td>
				<input type="text" name="epdu_city" value="<?php echo get_the_author_meta('epdu_city',$user->ID); ?>" />
				<span class="description">Users home city.</span>
			</td>
		</tr>
		<tr>
			<th><label for="title">Birthdate (age)</label></th>
			<td>
				<input type="text" name="epdu_age" value="<?php echo get_the_author_meta('epdu_age',$user->ID); ?>" />
				<span class="description">In YYYY-MM-DD format. This will be calculated and displayed as age on the site. The date will not be displayed.</span>
			</td>
		</tr>
		<tr>
			<th><label for="title">Display user email</label></th>
			<td>
				<input type="checkbox" name="show_user_email" value="1"<?php if(get_the_author_meta('show_user_email',$user->ID)){echo ' checked="checked"';}?>>
				<span class="description">Tick this box if the users email should be visible on the site</span>
			</td>
		</tr>
		<tr>
			<th><label for="title">Visibility</label></th>
			<td>
				<input type="checkbox" name="is_visible" value="1"<?php if(get_the_author_meta('is_visible',$user->ID)){echo ' checked="checked"';}?>>
				<span class="description">Tick this box if the user should be visible on the site</span>
			</td>
		</tr>
		<tr>
			<th><label for="title">Widget active</label></th>
			<td>
				<input type="checkbox" name="is_sidebar" value="1"<?php if(get_the_author_meta('is_sidebar',$user->ID)){echo ' checked="checked"';}?>>
				<span class="description">Tick this box if the user should be visible in the random loop in the widget</span>
			</td>
		</tr>	
	</table>
<?php
}
?>