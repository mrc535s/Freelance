<div id="wpsc_product_wholesale_pricing" class="postbox <?php echo ( (array_search(  'wpsc_wp_meta_box', (array)$product_data['closed_postboxes']) !== false) ? 'closed"' : '' ); ?>" <?php echo ( ( array_search( 'wpsc_wp_meta_box', (array)$product_data['hidden_postboxes'] ) !== false ) ? ' style="display: none;"' : '' ); ?>>
	<h3 class="hndle"><?php _e( 'Wholesale Pricing', 'wpsc_wp' ); ?></h3>
	<div class="inside">
		<div>
			<p><?php _e( 'Enable a User Role to override default pricing for that User Role.', 'wpsc_wp' ); ?></p>
			<table style="width:100%;">
				<thead>
					<tr>
						<td class="manage-column column-cb check-column">&nbsp;</td>
						<td class="manage-column"><strong><?php _e( 'Role', 'wpsc_wp' ); ?></strong></td>
						<td class="manage-column"><strong><?php _e( 'Markup', 'wpsc_wp' ); ?></strong></td>
						<td class="manage-column"><strong><?php _e( 'Fixed Price', 'wpsc_wp' ); ?></strong></td>
						<td class="manage-column"><strong><?php _e( 'Product Visibility', 'wpsc_wp' ); ?></strong></td>
					</tr>
				</thead>
<?php
foreach ( $editable_roles as $role => $details ) {
	$name = translate_user_role( $details['name'] ); ?>
				<tr id="role_<?php echo $role; ?>">
					<th scope="row" class="check-column">
						<input type="checkbox" id="wpsc_wp_checkbox_<?php echo $role; ?>" name="productmeta_values[wpsc_wp_checkbox][<?php echo $role; ?>]"<?php checked( $checkbox[$role], 'on' ); ?> />
					</th>
					<td scope="row" style="padding-top:0.8em;">
						<label for="wpsc_wp_checkbox_<?php echo $role; ?>"><strong><?php echo $name; ?></strong></label>
					</td>
					<td scope="row">
						<select id="wpsc_wp_value_<?php echo $role; ?>" name="productmeta_values[wpsc_wp_value][<?php echo $role; ?>]">
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
	echo $output; ?>
						</select>
						<input type="text" id="wpsc_wp_amount_<?php echo $role; ?>" name="productmeta_values[wpsc_wp_amount][<?php echo $role; ?>]" class="text" size="5" value="<?php if( $amount[$role] ) echo $amount[$role]; else echo '0'; ?>" />
						<select id="wpsc_wp_method_<?php echo $role; ?>" name="productmeta_values[wpsc_wp_method][<?php echo $role; ?>]">
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
	echo $output; ?>
						</select>
					</td>
					<td>
						<input type="text" id="wpsc_wp_fixed_<?php echo $role; ?>" name="productmeta_values[wpsc_wp_fixed][<?php echo $role; ?>]" class="text" size="5" value="<?php if( $fixed[$role] ) echo $fixed[$role]; else echo '0.00'; ?>" />
					</td>
					<td>
						<select id="wpsc_wp_visibility_<?php echo $role; ?>" name="productmeta_values[wpsc_wp_visibility][<?php echo $role; ?>]">
<?php
	switch( $visibility[$role] ) {

		case '1':
			$output = '<option value="1" selected="selected">' . __( 'Show Product', 'wpsc_wp' ) .'&nbsp;</option>';
			$output .= '<option value="0">' . __( 'Hide Product', 'wpsc_wp' ) . '&nbsp;</option>';
			break;

		case '0':
			$output = '<option value="1">' . __( 'Show Product', 'wpsc_wp' ) .'&nbsp;</option>';
			$output .= '<option value="0" selected="selected">' . __( 'Hide Product', 'wpsc_wp' ) . '&nbsp;</option>';
			break;

		default:
			$output = '<option value="1">' . __( 'Show Product', 'wpsc_wp' ) .'&nbsp;</option>';
			$output .= '<option value="0">' . __( 'Hide Product', 'wpsc_wp' ) . '&nbsp;</option>';
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
		<table>
			<tr>
				<td style="font-size:11px;"><br />
<?php
switch( $disregard_product ) {

	case 'on': ?>
					<label><input type="radio" id="wpsc_wp_disregard_off" name="productmeta_values[wpsc_wp_disregard]" value="off" /> <?php _e( 'Enable Wholesale Pricing for this Product', 'wpsc_wp' ); ?></label><br />
					<label><input type="radio" id="wpsc_wp_disregard_on" name="productmeta_values[wpsc_wp_disregard]" value="on" checked /> <?php _e( 'Disable Wholesale Pricing for this Product', 'wpsc_wp' ); ?></label>
<?php
		break;

	case 'off':
	default: ?>
					<label><input type="radio" id="wpsc_wp_disregard_off" name="productmeta_values[wpsc_wp_disregard]" value="off" checked /> <?php _e( 'Enable Wholesale Pricing for this Product', 'wpsc_wp' ); ?></label><br />
					<label><input type="radio" id="wpsc_wp_disregard_on" name="productmeta_values[wpsc_wp_disregard]" value="on" /> <?php _e( 'Disable Wholesale Pricing for this Product', 'wpsc_wp' ); ?></label>
<?php
		break;

} ?>
				</td>
			</tr>
		</table>
		</div>
	</div>
</div>