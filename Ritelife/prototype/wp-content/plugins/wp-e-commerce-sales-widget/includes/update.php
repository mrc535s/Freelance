<?php
function wpsc_sw_admin_notice() {

	if( wpsc_sw_check_options_exist() )
		wpsc_sw_update_options();

}
add_action( 'admin_notices', 'wpsc_sw_admin_notice' );

function wpsc_sw_update_options() {

	$widget = get_option( 'widget_vl_wpscsw_sales' );
	add_option( 'widget_wpsc_sw_sales', $widget );
	delete_option( 'widget_vl_wpscsw_sales' );

}
?>