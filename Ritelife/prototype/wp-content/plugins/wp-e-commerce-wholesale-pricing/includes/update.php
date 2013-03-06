<?php
function wpsc_wp_admin_notice() {

	if( wpsc_wp_check_options_exist() )
		wpsc_wp_update_options();

}
add_action( 'admin_notices', 'wpsc_wp_admin_notice' );

function wpsc_wp_update_options() {

	$options = array();
	$options[] = array( 'old_name' => 'defaults' );

	$old_prefix = 'vl_wpscwp';
	$new_prefix = 'wpsc_wp';

	wpsc_vl_migrate_prefix_options( $options, $old_prefix, $new_prefix );

}
?>