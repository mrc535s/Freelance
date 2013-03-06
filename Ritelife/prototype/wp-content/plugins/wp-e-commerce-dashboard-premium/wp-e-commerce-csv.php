<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/


// Functions required to generate a CSV for download, email or save-to-file
// Also handler for scheduled exports

function ses_wpscd_get_available_field_list() {

	global $ses_wpscd_csv_fields_available;

	if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
		require_once('wp-e-commerce-csv-fields-3.7.php');
	} else {
		require_once('wp-e-commerce-csv-fields-3.8.php');
	}

}

add_action ('plugins_loaded', 'ses_wpscd_get_available_field_list');



function ses_wpscd_merge_custom_checkout_fields ($ses_wpscd_csv_fields_available) {

	global $wpdb, $table_prefix;

	$sql = "SHOW COLUMNS FROM {$table_prefix}wpsc_checkout_forms LIKE 'checkout_set'";

	$checkout_set_exists = $wpdb->get_results($sql,ARRAY_A);

	if ($checkout_set_exists) {
		$checkout_set_orderby = "ORDER BY checkout_set";
	} else {
		$checkout_set_orderby = "";
	}

	$sql = "SELECT name 
	          FROM {$table_prefix}wpsc_checkout_forms
	         WHERE unique_name = ''
	           AND type != 'heading'
			       $checkout_set_orderby";

	$fields = $wpdb->get_results($sql, ARRAY_A);

	if (!count($fields)) {
		return $ses_wpscd_csv_fields_available;
	}

	foreach ($fields as $field) {
		
		$newfield = Array ('Title'  => $field['name'],
		                   'ShowOn' => 'Both',
		                   'QueryID'=> 'isset($assoc_checkout["'.$field['name'].'"]["value"]) ? $assoc_checkout["'.$field['name'].'"]["value"] : ""');

		$ses_wpscd_csv_fields_available[$field['name']] = $newfield;
	}
	
	return $ses_wpscd_csv_fields_available;
}

add_filter('ses-wpscd-csv-fields-available', 'ses_wpscd_merge_custom_checkout_fields');



function ses_wpscd_csv_export_upgrade_old_schedules() {

	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	if ( isset ( $settings['ses-wpscd-schedule-method'] ) ) {
		$new_settings = Array ( 0 => $settings );
		update_option ( 'ses_wpscd_csv_schedule', $new_settings );
	}

}



function ses_wpscd_schedule_filename( $schedule_id = NULL ) {

	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	if ( isset ( $settings[$schedule_id]['ses-wpscd-schedule-filename'] ) ) {
		return $settings[$schedule_id]['ses-wpscd-schedule-filename'];
	}

	$filename = md5 ( time().NONCE_SALT ) . '.csv';

	return $filename;

}



function ses_wpscd_create_htaccess($directory) {

		// Create .htaccess file
		$htaccess = "order allow,deny\ndeny from all";

		$fh = fopen( $directory.'.htaccess', 'w' );

		if (!$fh)
			return FALSE;

		fwrite( $fh, $htaccess );

		return fclose($fh);

}



function ses_wpscd_schedule_folder( $schedule_id = NULL ) { 

	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	if ( isset ( $settings[$schedule_id]['ses-wpscd-schedule-folder'] ) )
		return $settings[$schedule_id]['ses-wpscd-schedule-folder'];

	// Need a new folder
	$directory = wp_upload_dir();

	$directory = trailingslashit ( $directory['basedir'] );
	$directory .= 'ses_wpscd/';

	if ( ! is_writeable( $directory ) ) {
		wp_mkdir_p ( $directory );
		@ chmod( $directory, 0775 );

		ses_wpscd_create_htaccess ( $directory );
	}

	if ( is_writeable( $directory ) ) {

		return $directory;

	}

	return FALSE;
}



function csvescape($string) {

	$doneescape = false;
	if (stristr($string,'"')) {
		$string = str_replace('"','""',$string);
		$string = "\"$string\"";
		$doneescape = true;
	}

	$string = str_replace("\n",' ',$string);
	$string = str_replace("\r",' ',$string);

	if (stristr($string,',') && !$doneescape) {
		$string = "\"$string\"";
	}

	return $string;

}



function ses_wpscd_generate_csv($start_date, $end_date, $args) {

	global $wpdb, $ses_wpscd_csv_fields_available, $wpsc_purchlog_statuses;
	
	// Add custom checkout variables
	$ses_wpscd_csv_fields_available = apply_filters('ses-wpscd-csv-fields-available', $ses_wpscd_csv_fields_available);

	$ses_wpscd_csv_fields = get_option('ses_wpscd_csv_fields');
	if ( ! $ses_wpscd_csv_fields || $ses_wpscd_csv_fields == "" || !count($ses_wpscd_csv_fields)) {
		update_option ('ses_wpscd_csv_fields',Array ('order-id','order-date', 'order-time', 'tax-total', 'order-total', 'order-status', 'totalqty', 'orderline-sku', 'orderline-unitprice', 'orderline-qty', 'orderline-lineprice', 'orderline-tax', 'orderline-linetotal'));
		$ses_wpscd_csv_fields = get_option('ses_wpscd_csv_fields');
	}

	$date_filter = "date >= $start_date AND date <= $end_date";

	ob_start();

	if (isset($args['status'])) {

		$cnt = 0;
		$status_filter = '`pl`.`processed` IN (';

		foreach(array_keys($args['status']) as $status_id) {

			if ($cnt) {
				$status_filter .= ',';
			}

			$status_filter .= $status_id;
			$cnt++;

		}

		$status_filter .= ')';

	} else {

		$status_filter = "1";

	}

	$extra_tables = apply_filters ( 'ses_wpscd_extra_sql_tables', '' );
	$extra_filters = apply_filters ( 'ses_wpscd_extra_sql_filters', '1' );

	if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 )  {

		$sql = "SELECT `pl`.*,
						DATE_FORMAT(FROM_UNIXTIME(`pl`.`date`),'%Y-%m-%d') as frmtdate,
						DATE_FORMAT(FROM_UNIXTIME(`pl`.`date`),'%H:%i:%s') as frmttime,
		                `ps`.`name`
		           FROM `".WPSC_TABLE_PURCHASE_LOGS."` pl
				        $extra_tables
		      LEFT JOIN `".WPSC_TABLE_PURCHASE_STATUSES."` ps
		             ON `pl`.`processed` = `ps`.`id`
		            AND `ps`.`active` = '1'
		          WHERE $date_filter
		            AND $status_filter
					AND $extra_filters
		       ORDER BY id DESC";

	} else {

		// Need a sensibly indexed status array
		$statuses = Array();

		foreach ($wpsc_purchlog_statuses as $status) {

			$statuses[$status['order']] = $status;

		}

		$sql = "SELECT `pl`.*,
						DATE_FORMAT(FROM_UNIXTIME(`pl`.`date`),'%Y-%m-%d') as frmtdate,
						DATE_FORMAT(FROM_UNIXTIME(`pl`.`date`),'%H:%i:%s') as frmttime
		           FROM `".WPSC_TABLE_PURCHASE_LOGS."` pl
				        $extra_tables
		          WHERE $date_filter
		            AND $status_filter
					AND $extra_filters
		       ORDER BY id DESC";

	}

	$return_array['generation_time'] = time();

	$results = $wpdb->get_results($sql, ARRAY_A);

	// See what fields we need to output
	$ses_wpscd_csv_fields = get_option('ses_wpscd_csv_fields');

	if (!$ses_wpscd_csv_fields || $ses_wpscd_csv_fields == "" || !count($ses_wpscd_csv_fields)) {

		update_option ('ses_wpscd_csv_fields',Array ('order-id','order-date', 'order-time', 'tax-total', 'order-total', 'order-status', 'totalqty', 'orderline-sku', 'orderline-unitprice', 'orderline-qty', 'orderline-lineprice', 'orderline-tax', 'orderline-linetotal'));
		$ses_wpscd_csv_fields = get_option('ses_wpscd_csv_fields');

	}

	// Show heading line
	$done_first = 0;
	foreach ($ses_wpscd_csv_fields as $field) {

		if (    ($ses_wpscd_csv_fields_available[$field]['ShowOn'] == 'Both')
		     || ($args['linesororders'] == 'orders' &&
		         $ses_wpscd_csv_fields_available[$field]['ShowOn'] == 'Orders') 
                     || ($args['linesororders'] == 'lines' &&
		         $ses_wpscd_csv_fields_available[$field]['ShowOn'] == 'Lines'))
		{
			if ($done_first)
				echo ',';

			echo $ses_wpscd_csv_fields_available[$field]['Title'];
			$done_first=1;
		}

	}
	echo "\n";

	if (!count($results)) {
		$return_array['content'] = ob_get_clean();
		return $return_array;
	}

	foreach ($results as $purchase) {

		$sql = "SELECT `fd`.`value`,
		               `cf`.`name`,
		               `cf`.`unique_name`
		          FROM `".WPSC_TABLE_SUBMITED_FORM_DATA."` fd
		     LEFT JOIN `".WPSC_TABLE_CHECKOUT_FORMS."` cf
		            ON `fd`.`form_id` = `cf`.`id`
		         WHERE `log_id` = '".$purchase['id']."'
		           AND `cf`.active = '1'";

		$checkout_data = $wpdb->get_results($sql, ARRAY_A);

		$assoc_checkout = Array();
		if (is_array($checkout_data) && count($checkout_data)) {

			foreach ($checkout_data as $checkout_field) {

				if ($checkout_field['unique_name'] != "") {
					$assoc_checkout[$checkout_field['unique_name']] = $checkout_field;
				} else {
					$assoc_checkout[$checkout_field['name']] = $checkout_field;
				}

			}

		}

		if ($args['linesororders'] == 'orders') {

			$cartsql = "SELECT SUM(quantity) AS qty,
			                   SUM(tax_charged) AS tax,
							   SUM(pnp) AS pnp
			              FROM `".WPSC_TABLE_CART_CONTENTS."`
			             WHERE `purchaseid`=".$purchase['id']."";
			$cart_data_lines = $wpdb->get_results($cartsql, ARRAY_A);

		} else {

			if ( isset ( $args['product']) && is_array ( $args['product'] )) {
				if ( $args['product'][0] == 'all' ) {
					$product_where = '1';
				} else {
					$product_where = ' ( `cc`.prodid IN ( '. esc_sql ( implode ( ',', $args['product'] ) ) . ' ) OR `p`.post_parent IN ( ' . esc_sql ( implode ( ',', $args['product'] ) ) . ' ) )';
				}
			} else {
				$product_where = '1';
			}

			if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

				$cartsql = "SELECT cc.*,
				                   pm.meta_value as sku,
								   cc.price - (cc.tax_charged/quantity) as unit_price,
								   tax_charged / quantity as unit_tax,
				                   (cc.price * quantity) - cc.tax_charged as line_price,
				                   tax_charged as line_tax,
				                   price * quantity as line_total
				              FROM `".WPSC_TABLE_CART_CONTENTS."` cc
				         LEFT JOIN `".WPSC_TABLE_PRODUCTMETA."` pm
				                ON `cc`.`prodid` = `pm`.`product_id`
				               AND `pm`.`meta_key` = 'sku'
				             WHERE `cc`.`purchaseid`=".$purchase['id']."
				               AND $product_where";
			
			} else {

				$cartsql = "SELECT cc.*,
				                   pm.meta_value as sku,
								   cc.price - (cc.tax_charged/quantity) as unit_price,
								   tax_charged / quantity as unit_tax,
				                   (cc.price * quantity) - cc.tax_charged as line_price,
				                   tax_charged as line_tax,
				                   price * quantity as line_total,
								   p.post_parent
				              FROM `".WPSC_TABLE_CART_CONTENTS."` cc
				         LEFT JOIN $wpdb->postmeta pm
				                ON `cc`.`prodid` = `pm`.`post_id`
				               AND `pm`.`meta_key` = '_wpsc_sku'
				         LEFT JOIN $wpdb->posts p
				                ON cc.prodid = p.ID
				             WHERE `cc`.`purchaseid`=".$purchase['id']."
				               AND $product_where";
			
			}

			$cart_data_lines = $wpdb->get_results($cartsql, ARRAY_A);

		}

		if (count($cart_data_lines)) {

			foreach ($cart_data_lines as $cart_data) {

				reset($ses_wpscd_csv_fields);
				$done_first = 0;

				if ($args['linesororders'] == 'lines') {

					if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

						$cat_sql = 'SELECT name
									FROM '.WPSC_TABLE_ITEM_CATEGORY_ASSOC.' ca
								LEFT JOIN '.WPSC_TABLE_PRODUCT_CATEGORIES.' pc
										ON ca.category_id = pc.id
									WHERE ca.product_id = %d';

						$categories = $wpdb->get_results ( $wpdb->prepare ( $cat_sql, $cart_data['prodid'] ) );
					
					} else {

						$categories = wp_get_object_terms ( $cart_data['prodid'], 'wpsc_product_category' ) ;

					}

					if ( ! $categories ) 
						$cart_data['product_categories'] = Array();
					else 
						$cart_data['product_categories'] = &$categories;

				}

				foreach ($ses_wpscd_csv_fields as $field) {
		
					if (    ($ses_wpscd_csv_fields_available[$field]['ShowOn'] == 'Both')
		     				|| ($args['linesororders'] == 'orders' &&
		         	    		$ses_wpscd_csv_fields_available[$field]['ShowOn'] == 'Orders') 
                     				|| ($args['linesororders'] == 'lines' &&
		         	    		$ses_wpscd_csv_fields_available[$field]['ShowOn'] == 'Lines'))
					{
						if ($done_first) 
							echo ',';
			
						eval ('$item'." = ".$ses_wpscd_csv_fields_available[$field]['QueryID'].";");
						$item = maybe_unserialize($item);
						if (is_array($item)) {
							echo csvescape($item[0]);
						} else {
							echo csvescape($item);
						}
						$done_first = 1;
			
					}
	
				}
		
				echo "\n";
			}

		}

	}
	$return_array['content'] = ob_get_clean();
	return $return_array;
}



function ses_wpscd_schedule_next_run_time ( $schedule_id ) {

	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	if ( ! isset ( $settings[$schedule_id] ) || ! is_numeric ( $schedule_id ) )
		return FALSE;

	$schedule_settings = $settings[$schedule_id];

	$target_frequency = $schedule_settings['ses-wpscd-schedule-freq'];
	$target_dow = $schedule_settings['ses-wpscd-schedule-day'];
	$target_hour = $schedule_settings['ses-wpscd-schedule-hour'];
	$target_minute = $schedule_settings['ses-wpscd-schedule-minute'];

	list ( $year,$month,$day,$dow,$hour,$minute ) = explode ( '-', date('Y-m-d-w-H-i', time()+65 ) );

	//error_log ( "TF: $target_frequency");
	//error_log ( "TD: $target_dow");
	//error_log ( "TH: $target_hour");
	//error_log ( "TM: $target_minute");
	//error_log ( "YY: $year");
	//error_log ( "MM: $month");
	//error_log ( "DOW $dow");
	//error_log ( "HH: $hour");
	//error_log ( "mm: $minute");

	switch ($target_frequency) {
		case 'hourly':
			// Pick next hour, and zero the minutes
			$target_time = mktime ( $hour == 23 ? 0 : $hour+1, 0, 0, $month, $hour == 23 ? $day+1 : $day, $year );
			break;
		case 'daily':
			// Pick time today - if less than time() then add 86400
			$target_time = mktime ( $target_hour, $target_minute, 0);
			if ( $target_time < time() )
				$target_time += 86400;
			break;
		case 'weekly':
			// Pick time today
			$target_time = mktime ( $target_hour, $target_minute, 0);
			$target_time += ($target_dow - $dow) * 86400;
			if ( $target_time < time() )
				$target_time += 86400 * 7;
			break;
		default:
			$target_time = time();
	}

	//error_log ("CURRENT_TIME: ".date('Y-m-d-H-i',time()));
	//error_log ("TARGET_TIME: ".date('Y-m-d-H-i',$target_time));

	// Uncomment this for testing. Sets the first export for now + 5 seconds, rather than the proper time
	//if ( isset ( $_POST['ses-wpscd-schedule-method'] ) ) {
		//wp_schedule_single_event ( time() + 5, 'ses_wpscd_cron_export', array((int)$schedule_id) );
	//} else {
		wp_schedule_single_event ( $target_time, 'ses_wpscd_cron_export', array((int)$schedule_id) );
	//}

	return $target_time;
}



function ses_wpscd_send_csv ( $results, $settings ) {
	
	if ( ! isset ( $settings['ses-wpscd-schedule-email-address'] ) )
		return;

	// Save export to file ready for attaching
	if ( ! isset ( $settings['ses-wpscd-schedule-folder'] ) )
		return FALSE;
	else
		$folder = $settings['ses-wpscd-schedule-folder'];

	$cnt = 0;

	$full_filename = $folder;

	// If first time - or there's a conflict
	while ( !$cnt || is_file ($full_filename) ) {

		if ($cnt)
			sleep ( 1 ) ;

		$filename = md5 ( NONCE_SALT . time() );
		$full_filename = $folder . $filename . '.csv';
		$cnt++;

	}

	$full_filename = apply_filters ( 'ses_wpscd_scheduled_export_filename', $full_filename );

	if ( ! file_put_contents ( $full_filename, $results['content'] ) ) {
		return FALSE;
	}

	$to = $settings['ses-wpscd-schedule-email-address'];
	$subject = __( 'Scheduled Export', 'ses_wpscd' ) ;
	$message = __('Your scheduled export is attached', 'ses_wpscd');

	$success = wp_mail ( $to, $subject, $message, '', Array($full_filename));

	unlink ( $full_filename ) ;

	return $success;

}



function ses_wpscd_save_csv ( $results, $settings ) {

	if ( ! isset ( $settings['ses-wpscd-schedule-filename'] ) )
		return FALSE;
	else
		$filename = $settings['ses-wpscd-schedule-filename'];

	// Save export to file ready for attaching
	if ( ! isset ( $settings['ses-wpscd-schedule-folder'] ) )
		return FALSE;
	else
		$folder = $settings['ses-wpscd-schedule-folder'];

	$full_filename = $folder . $filename;

	if ( ! file_put_contents ( $full_filename, $results['content'] ) ) {
		return FALSE;
	}

	return TRUE;

}



function ses_wpscd_cron_export ( $schedule_id ) {

	// Upgrade pre-multi-cron settings here
	ses_wpscd_csv_export_upgrade_old_schedules();

	// Retrieve settings
	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	if ( ! isset ( $settings[$schedule_id] ) || ! is_numeric ( $schedule_id ) )
		return FALSE;

	$schedule_settings = &$settings[$schedule_id];

	// Work out when the export is from and to
	$last_scheduled_export = $schedule_settings['ses-wpscd-last-export-time'];

	if ( ! $last_scheduled_export ) 
		$last_scheduled_export = 0;

	$current_time = time();

	// Generate the CSV
	$args = Array();

	if (isset($schedule_settings['ses-wpscd-schedule-status'])) {
		$args['status'] = $schedule_settings['ses-wpscd-schedule-status'];
	}
	if (isset($schedule_settings['ses-wpscd-schedule-linesororders'])) {
		$args['linesororders'] = $schedule_settings['ses-wpscd-schedule-linesororders'];
	}

	$results = ses_wpscd_generate_csv ( $last_scheduled_export, $current_time, $args );

	// Output it / email it as required
	switch ( $schedule_settings['ses-wpscd-schedule-method'] ) {
		case 'email':
			ses_wpscd_send_csv ( &$results, &$schedule_settings );
			break;
		case 'file':
			ses_wpscd_save_csv ( &$results, &$schedule_settings ) ;
			break;
	}

	$schedule_settings['ses-wpscd-last-export-time'] = $current_time;

	update_option ( 'ses_wpscd_csv_schedule', $settings );

	ses_wpscd_schedule_next_run_time($schedule_id);
}

add_action ( 'ses_wpscd_cron_export', 'ses_wpscd_cron_export' );

?>
