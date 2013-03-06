<?php
/*
 Plugin Name: WP E-Commerce Dashboard (Premium)
 Plugin URI: http://plugins.leewillis.co.uk/?utm_campaign=wp-e-commerce-dashboard-premium
 Description: Reports on WP E-Commerce stores
 Version: 4.9
 Author: Lee Willis
 Author URI: http://www.leewillis.co.uk/?utm_campaign=wp-e-commerce-dashboard-premium
 */

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 */



// If not in admin area just drop straight out
if (is_admin()) {

	include ("widgets/support-functions.php");     
	include ("wp-e-commerce-widgets.php");
	include ("wp-e-commerce-sales-export.php");
	include ("wp-e-commerce-sales-schedule.php");


	function ses_wpscd_init() {
		
		global $can_manage_options, $can_view_store_reports;

		$can_manage_options = current_user_can ( 'manage_options' );
		$can_view_store_reports = $can_manage_options || current_user_can ( 'view_store_reports' );

		load_plugin_textdomain( 'ses_wpscd', false, basename( dirname( __FILE__ ) ) . '/languages' );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-flot', get_bloginfo('wpurl').'/wp-content/plugins/wp-e-commerce-dashboard-premium/js/jquery.flot.min.js');
		wp_enqueue_style( 'ses-wpscd-styles', WP_PLUGIN_URL.'/wp-e-commerce-dashboard-premium/ses-wpscd-styles.css');


		// WPEC only enqueues datepicker-ui if the user is admin
		if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
			wp_enqueue_script( 'datepicker-ui', WPSC_URL . '/js/ui.datepicker.js', array ( 'jquery-ui-core' ) ) ;
		} else {
			wp_enqueue_script( 'datepicker-ui', WPSC_CORE_JS_URL . '/ui.datepicker.js', array( 'jquery-ui-core' ) );
		}

		$ses_wpscd_dashboard_widgets = new ses_wpscd_dashboard_widgets;

	}

	add_action('init','ses_wpscd_init');

}

// Generic CSV generation functions
include ("wp-e-commerce-csv.php");



?>
