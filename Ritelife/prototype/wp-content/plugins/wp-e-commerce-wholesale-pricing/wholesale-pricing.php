<?php
/*
Plugin Name: WP e-Commerce - Wholesale Pricing
Plugin URI: http://www.visser.com.au/wp-ecommerce/plugins/wholesale-pricing/
Description: Add wholesale pricing controls to your WP e-Commerce store.
Version: 1.7.5
Author: Visser Labs
Author URI: http://www.visser.com.au/about/
License: GPL2
*/

load_plugin_textdomain( 'wpsc_wp', null, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

include_once( 'includes/functions.php' );

include_once( 'includes/common.php' );

switch( wpsc_get_major_version() ) {

	case '3.7':
		include_once( 'includes/release-3_7.php' );
		break;

	case '3.8':
		include_once( 'includes/release-3_8.php' );
		break;

}

$wpsc_wp = array(
	'filename' => basename( __FILE__ ),
	'dirname' => basename( dirname( __FILE__ ) ),
	'abspath' => dirname( __FILE__ ),
	'relpath' => basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ )
);

$wpsc_wp['prefix'] = 'wpsc_wp';
$wpsc_wp['name'] = __( 'Wholesale Pricing for WP e-Commerce', 'wpsc_wp' );
$wpsc_wp['menu'] = __( 'Wholesale Pricing', 'wpsc_wp' );

if( is_admin() ) {

	include_once( dirname( __FILE__ ) . '/includes/update.php' );

	function wpsc_wp_html_page() {

		global $wpsc_wp;

		$action = wpsc_get_action();
		wpsc_wp_template_header();
		switch( $action ) {

			case 'update':
				$message = __( 'Settings saved.', 'wpsc_wp' );
				$output = '<div class="updated settings-error"><p>' . $message . '</p></div>';
				echo $output;

				$checkbox = $_POST['checkbox'];
				$value = $_POST['value'];
				$amount = $_POST['amount'];
				$method = $_POST['method'];
				$editable_roles = wpsc_wp_get_roles();

				$roles = array();
				foreach( $editable_roles as $role => $details ) {
					switch( $checkbox[$role] ) {

						case 'on':
							$roles[$role] = array( 'status' => 'on', 'value' => $value[$role], 'amount' => $amount[$role], 'method' => $method[$role] );
							break;

						case 'off':
						default:
							$roles[$role] = array( 'status' => 'off', 'value' => $value[$role], 'amount' => $amount[$role], 'method' => $method[$role] );
							break;

					}
				}

				if( $roles ) {
					$roles = serialize( $roles );
					update_option( 'wpsc_wp_defaults', $roles );
				}

				wpsc_wp_options_form();
				break;

			default:
				wpsc_wp_options_form();
				break;

		}
		wpsc_wp_template_footer();

	}

	function wpsc_wp_options_form() {

		$defaults = maybe_unserialize( get_option( 'wpsc_wp_defaults' ) );
		$editable_roles = wpsc_wp_get_roles();
		$users_of_blog = count_users();
		$avail_roles =& $users_of_blog['avail_roles'];
		unset( $users_of_blog );

		include( 'templates/admin/wpsc-admin_wp_settings.php' );

	}

} else {

	include_once( 'includes/legacy.php' );

	include_once( 'includes/template.php' );

}
?>