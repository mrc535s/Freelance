<?php
/*

Filename: common.php
Description: common.php loads commonly accessed functions across the Visser Labs suite.

- wpsc_vl_plugin_update_prepare

- wpsc_get_action

*/

if( is_admin() ) {

	/* Start of: WordPress Administration */

	include_once( 'common-update.php' );
	include_once( 'common-dashboard_widgets.php' );

	if( !function_exists( 'wpsc_vl_plugin_update_prepare' ) ) {

		function wpsc_vl_plugin_update_prepare( $action, $args ) {

			global $wp_version;

			return array(
				'body' => array(
					'action' => $action,
					'request' => serialize( $args ),
					'api-key' => md5( get_bloginfo( 'url' ) ),
					'site' => get_bloginfo( 'url' )
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' )
			);	

		}

	}

	/* End of: WordPress Administration */

}

if( !function_exists( 'wpsc_get_action' ) ) {

	function wpsc_get_action( $switch = false ) {

		if( $switch ) {

			if( isset( $_GET['action'] ) )
				$action = $_GET['action'];
			else if( !isset( $action ) && isset( $_POST['action'] ) )
				$action = $_POST['action'];
			else
				$action = false;

		} else {

			if( isset( $_POST['action'] ) )
				$action = $_POST['action'];
			else if( !isset( $action ) && isset( $_GET['action'] ) )
				$action = $_GET['action'];
			else
				$action = false;

		}
		return $action;

	}

}
?>