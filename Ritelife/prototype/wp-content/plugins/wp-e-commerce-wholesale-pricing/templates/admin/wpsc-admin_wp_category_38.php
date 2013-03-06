<tr>
	<td colspan="2">
		<h3><?php _e( 'Wholesale Pricing', 'wpsc_wp' ); ?></h3>
	</td>
</tr>
<tr class="form-field">
	<th scope="row" valign="top">&nbsp;</th>
	<td>

		<table class="widefat fixed">
			<thead>

				<tr>
					<th class="manage-column column-cb check-column">&nbsp;</th>
					<th class="manage-column"><?php _e( 'Role', 'wpsc_wp' ); ?></th>
					<th class="manage-column"><?php _e( 'Markup', 'wpsc_wp' ); ?></th>
				</tr>

			</thead>
<?php
foreach ( $editable_roles as $role => $details ) {
	$name = translate_user_role( $details['name'] ); ?>
			<tr id="role_<?php echo $role; ?>">
				<th scope="row" class="check-column">
					<input type="checkbox" id="wpsc_wp_checkbox_<?php echo $role; ?>" name="meta[_wpsc_product_metadata][wpsc_wp_checkbox][<?php echo $role; ?>]"<?php checked( $checkbox[$role], 'on' ); ?> />
				</th>
				<td scope="row" style="padding-top:0.8em;">
					<label for="wpsc_wp_checkbox_<?php echo $role; ?>"><strong><?php echo $name; ?></strong></label>
				</td>
				<td scope="row">
					<select id="wpsc_wp_value_<?php echo $role; ?>" name="meta[_wpsc_product_metadata][wpsc_wp_value][<?php echo $role; ?>]">
<?php
	switch( $value[$role] ) {

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
	echo $output;
	unset( $output ); ?>
					</select>
					<input type="text" id="wpsc_wp_amount_<?php echo $role; ?>" name="meta[_wpsc_product_metadata][wpsc_wp_amount][<?php echo $role; ?>]" class="text" size="5" value="<?php if( $amount[$role] ) echo $amount[$role]; else echo '0'; ?>" style="width:50px" />
					<select id="wpsc_wp_method_<?php echo $role; ?>" name="meta[_wpsc_product_metadata][wpsc_wp_method][<?php echo $role; ?>]">
<?php
	switch( $method[$role] ) {

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
	echo $output;
	unset( $output ); ?>
					</select>
				</td>
			</tr>
<?php
} ?>
		</table>
		<p class="description"><?php _e( 'Enable a User Role to override default pricing for that User Role.', 'wpsc_wp' ); ?></p>

	</td>
</tr>