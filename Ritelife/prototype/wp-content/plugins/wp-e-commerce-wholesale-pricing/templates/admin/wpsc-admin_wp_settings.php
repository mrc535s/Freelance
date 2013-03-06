<form method="post" action="<?php the_permalink(); ?>" enctype="multipart/form-data" id="your-profile">
	<h3><?php _e( 'Pricing Settings', 'wpsc_wp' ); ?></h3>
	<p><?php _e( 'Enable a User Role to override default pricing for that User Role.', 'wpsc_wp' ); ?></p>
	<table class="widefat fixed">
		<thead>
			<tr>
				<th class="manage-column column-cb check-column">&nbsp;</th>
				<th class="manage-column"><?php _e( 'Role', 'wpsc_wp' ); ?></th>
				<th class="manage-column"><?php _e( 'Markup', 'wpsc_wp' ); ?></th>
				<th class="manage-column"><?php _e( 'Users', 'wpsc_wp' ); ?></th>
			</tr>
		</thead>
<?php
foreach( $editable_roles as $role => $details ) {
	$name = translate_user_role( $details['name'] ); ?>
		<tr id="role_<?php echo $role; ?>">
			<th scope="row" class="check-column">
				<input type="checkbox" id="checkbox_<?php echo $role; ?>" name="checkbox[<?php echo $role; ?>]"<?php checked( $defaults[$role]['status'], 'on' ); ?> />
			</th>
			<td scope="row">
				<label for="checkbox_<?php echo $role; ?>"><strong><?php echo $name; ?></strong></label>
			</td>
			<td scope="row">
				<select id="value_<?php echo $role; ?>" name="value[<?php echo $role; ?>]">
<?php
	switch( $defaults[$role]['value'] ) {

		case '+':
			$output = '<option value="+" selected="selected">+&nbsp;</option>';
			$output .= '<option value="-">-&nbsp;</option>';
			break;

		case '-':
			$output = '<option value="+">+&nbsp;</option>';
			$output .= '<option value="-" selected="selected">-&nbsp;</option>';
			break;

		default:
			$output = '<option value="+">+&nbsp;</option>';
			$output .= '<option value="-">-&nbsp;</option>';
			break;

	}
	echo $output; ?>
				</select>
				<input type="text" id="amount_<?php echo $role; ?>" name="amount[<?php echo $role; ?>]" class="text" size="5" value="<?php if( $defaults[$role]['amount'] ) echo $defaults[$role]['amount']; else echo '0'; ?>" />
				<select id="method_<?php echo $role; ?>" name="method[<?php echo $role; ?>]">
<?php
	switch( $defaults[$role]['method'] ) {

		case '$':
			$output = '<option value="%">%&nbsp;</option>';
			$output .= '<option value="$" selected="selected">$&nbsp;</option>';
			break;

		case '%':
			$output = '<option value="%" selected="selected">%&nbsp;</option>';
			$output .= '<option value="$">$&nbsp;</option>';
			break;

		default:
			$output = '<option value="%">%&nbsp;</option>';
			$output .= '<option value="$">$&nbsp;</option>';
			break;

	}
	echo $output; ?>
				</select>
			</td>
			<td scope="row">
<?php
	if( $avail_roles[$role] ) {
		echo '<a href="' . get_bloginfo( 'url' ) . '/wp-admin/users.php?role=' . $role . '">' . $avail_roles[$role] . '</a>';
	} else {
		if( $role == 'guest' )
			echo '-';
		else
			echo '0';
	} ?>
			</td>
		</tr>
<?php
} ?>
	</table>
	<p class="submit">
		<input type="submit" value="<?php _e( 'Save Changes', 'wpsc_wp' ); ?>" class="button-primary" />
	</p>
	<input type="hidden" name="action" value="update" />
</form>