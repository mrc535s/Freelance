<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/


// Functions required for the "Sales Export" UI in the dashboard area

function ses_wpscd_menu() {

	global $can_view_store_reports;

	if ( $can_view_store_reports || current_user_can ( 'view_store_sales_export' ) ) {

		// Capability for the menu item is defined as "read" so it can be accessed by any user
		// However check above will ensure menu only added if users have correct capability
		// This is because add_submenu_page doesn't allow fine grained control over capabilities
		if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
			add_submenu_page('wpsc-sales-logs', __('Sales Export','ses_wpscd'), __('Sales Export','ses_wpscd'), 'read', 'ses_wpscd_csv_export', 'ses_wpscd_csv_export_form');
			add_submenu_page('wpsc-sales-logs', __('Scheduled Sales Export','ses_wpscd'), __('Scheduled Sales Export','ses_wpscd'), 'read', 'ses_wpscd_csv_export_switch', 'ses_wpscd_csv_export_switch');
		} else {
			add_submenu_page('index.php', __('Sales Export','ses_wpscd'), __('Sales Export','ses_wpscd'), 'read', 'ses_wpscd_csv_export', 'ses_wpscd_csv_export_form');
			add_submenu_page('index.php', __('Scheduled Sales Export','ses_wpscd'), __('Scheduled Sales Export','ses_wpscd'), 'read', 'ses_wpscd_csv_export_switch', 'ses_wpscd_csv_export_switch');
		}

	}

}

add_action('wpsc_add_submenu', "ses_wpscd_menu");



function ses_wpscd_export_styles() {
	
	// Enqueue the styles and scripts necessary
	$version_identifier = WPSC_VERSION . "." . WPSC_MINOR_VERSION;
	wp_enqueue_style( 'wp-e-commerce-admin', WPSC_URL . '/wpsc-admin/css/admin.css', false, $version_identifier, 'all' );

}

add_action ( 'admin_print_styles-dashboard_page_ses_wpscd_csv_export', 'ses_wpscd_export_styles' );



function ses_wpscd_csv_download() {

	global $wpdb, $ses_wpscd_csv_fields_available, $wpsc_purchlog_statuses, $can_view_store_reports;
	
	if ( ! $can_view_store_reports && ! current_user_can ( 'view_store_sales_export' ) )
			return;

	// Save the field settings as a default for next time
	if ($_POST['ses_wpscd_csv_fields'] != "") {
		update_option('ses_wpscd_csv_fields', array_keys($_POST['ses_wpscd_csv_fields']));
	}


	if ($_POST['linesororders'] == 'orders') {
		$filename = __('Purchase Orders', 'ses_wpscd')." - ";
	} else {
		$filename = __('Purchase Order Lines', 'ses_wpscd')." - ";
	}

	$generation_time = time();

	if (is_numeric($_POST['date'])) {

		$start_date = $_POST['date'];
		$month = date('n',$start_date);
		$year = date('Y',$start_date);

		if ($month > 11) {
			$month=1;
			$year++;
		} else {
			$month++;
		}

		$end_date = mktime (0,0,0,$month,1,$year) - 1;
		$filename .= " ".date('Y-m-d',$start_date)." to ".date('Y-m-d',$end_date);

	} elseif ( $_POST['date'] == 'Today' ) { 

		$start_date = mktime(0,0,0,date('n'),date('j'),date('Y'));
		$end_date = mktime(23,59,59,date('n'),date('j'),date('Y'));
		$filename .= " ".date('Y-m-d', $start_date);

	} elseif ( $_POST['date'] == 'Custom' ) {

		list ( $start_year, $start_month, $start_date ) = explode ( '-', $_POST['ses-wpscd-sales-export-start-date-internal'] );
		list ( $end_year, $end_month, $end_date ) = explode ( '-', $_POST['ses-wpscd-sales-export-end-date-internal'] );
		$start_date = mktime ( 0,0,0,$start_month,$start_date,$start_year );
		$end_date = mktime ( 0,0,0,$end_month,$end_date,$end_year );
		$filename .= " ".date('Y-m-d', $start_date)." to ".date('Y-m-d', $end_date);

	} elseif ( substr ( $_POST['date'], 0, 6 ) == 'Since:' ) {

		$start_date = substr ( $_POST['date'], 6, 999 );
		$end_date = $generation_time;
		$filename .= " ".date('Y-m-d H:i:s', substr ( $_POST['date'], 6, 999 ) ) . " - " . date('Y-m-d H:i:s', $generation_time);

	} else {

		$start_date = 0;
		$end_date = $generation_time;
		$filename .= " All Time";

	}

	$args = Array();

	if (isset($_POST['status'])) {
		$args['status'] = $_POST['status'];
	}
	if (isset($_POST['linesororders'])) {
		$args['linesororders'] = $_POST['linesororders'];
	}
	if (isset($_POST['product'])) {
		$args['product'] = $_POST['product'];
	}

	setcookie('ses_wpscd_csv_download_time', $generation_time, time()+60*60*24*365); 

	$results = ses_wpscd_generate_csv($start_date, $end_date, $args);

	// Step through the results, and output the fields we need
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="'.apply_filters('ses_wpscd_export_filename', $filename.'.csv').'"');

	echo($results['content']);
	die();
}

add_action('wp_ajax_ses_wpscd_csvdownload','ses_wpscd_csv_download');



function ses_wpsc_csv_date_filter($selected) {

	global $wpdb;

	$output = ''; 

	$earliest_record_sql = "SELECT MIN(`date`) AS `date` FROM `".WPSC_TABLE_PURCHASE_LOGS."` WHERE `date`!=''";
	$earliest_record = $wpdb->get_results($earliest_record_sql,ARRAY_A) ;
	
	$current_timestamp = time();
	$earliest_timestamp = $earliest_record[0]['date'];
	
	$current_year = date("Y");
	$current_month = date("n");
	$earliest_year = date("Y",$earliest_timestamp);
	$earliest_month = date("n",$earliest_timestamp);
	
	for($year = $earliest_year; $year <= $current_year; $year++) {

		for($month = 1; $month <=12 ; $month++) {

			if ($year == $earliest_year && $month < $earliest_month)
				continue;
			if ($year == $current_year && $month > $current_month)
				break;

			$timestamp = mktime(0, 0, 0, $month, 1, $year);
			$option = "<option value=\"$timestamp\"";

			if ($timestamp == $selected)
				$option .= " selected=\"on\"";

			$option .= ">".date('F Y', $timestamp)."</option>";
			$output = $option . $output;

		}

	}

	if ( ! empty ( $_COOKIE['ses_wpscd_csv_download_time'] ) ) { 
		$output = "<option value=\"Since:".$_COOKIE['ses_wpscd_csv_download_time']."\">".__('Since last download', 'ses_wpscd')." (".date('d-M-Y H:i:s',$_COOKIE['ses_wpscd_csv_download_time']).")</option>" . $output;
	}
	
	return $output;

}



function ses_wpscd_order_status_filter($html_key = 'status', $current_selection = Array() ) {

	global $wpdb, $wpsc_purchlog_statuses;

	if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

		$sql = "SELECT name,id FROM ".WPSC_TABLE_PURCHASE_STATUSES;

		$results = $wpdb->get_results($sql, ARRAY_A);

		if (!$results) {
			return;
		}


	} else {


		$results = $wpsc_purchlog_statuses;


	}

	foreach($results as $key => $status) {

		echo '<input type="checkbox"';

		if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
			if ( isset ( $current_selection[$status['id']] ) || !count ( $current_selection ) )
				echo ' checked';
		} else {
			if ( isset ( $current_selection[$status['order']] ) || !count ( $current_selection ) )
				echo ' checked';
		}

		echo ' name="'.$html_key.'[';

		if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
			echo $status['id'];
		} else {
			echo $status['order'];
		}
		
		echo ']"> ';

		if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
			echo esc_html($status['name']);
		} else {
			echo esc_html($status['label']);
		}

		echo '<br/>';
	}

}



function ses_wpscd_product_filter() {

	global $wpdb;

	if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

		$sql = "SELECT id, name FROM ".WPSC_TABLE_PRODUCT_LIST;

	} else {

		$sql = "SELECT id,
		               post_title AS name,
					   post_parent,
					   IF ( post_parent = 0, id, post_parent ) AS orderfield
		          FROM ".$wpdb->posts."
		         WHERE post_type = 'wpsc-product'
		      ORDER BY orderfield ASC,
		               post_parent desc,
		               id ASC";

	}

	$results = $wpdb->get_results($sql, ARRAY_A);

	if (!$results) {
		return;
	}

	echo '<select multiple size="10" style="height: 20em;" name="product[]">';
	echo '  <option value="all">'.__('All Products','ses_wpscd').'</option>';

	$parent_variations = Array();

	foreach ($results as $product) {

		if ( $product['post_parent'] != 0 )
			$parent_variations[$product['post_parent']] = 1;

		if ( isset ( $parent_variations[$product['id']] ) )  {

			echo '<option value="'.$product['id'].'">'.htmlentities($product['name']).' ('.__('All Variations', 'ses_wpscd').')</option>';

		} else { 

			echo '<option value="'.$product['id'].'">'.htmlentities($product['name']).'</option>';
			
		}
	}

	echo '</select>';
	echo '<br />';
}



function ses_wpscd_csv_export_form() {

	global $can_view_store_reports;

	if ( ! $can_view_store_reports && ! current_user_can( 'view_store_sales_export' ) )
			return;

	if ( ! isset ( $_POST['view_purchlogs_by'] ) )
		$_POST['view_purchlogs_by'] = '';

?>
	<div class="wrap">
	<h2><?php _e("Sales Export",'ses_wpscd'); ?></h2>
	<form method='post' action='admin-ajax.php?action=ses_wpscd_csvdownload'>
		<input type="hidden" name="action" value="download">
  	  	<div class='wpsc_purchaselogs_options'>
  			<?php /* View functions for purchlogs */?>
  			<label for='date'><?php _e('Date Range:'); ?></label><br/>
  			<select id='date' name='date'>
				<option value="All"><?php _e('All', 'ses_wpscd'); ?></option>
				<option value="Today"><?php _e('Today', 'ses_wpscd'); ?></option>
  				<?php echo ses_wpsc_csv_date_filter($_POST['view_purchlogs_by']); ?>
				<option value="Custom"><?php _e('Custom', 'ses_wpscd'); ?></option>
  			</select>
			<span id="ses-wpscd-sales-export-start-date-span"><?php _e('From: ','ses_wpscd'); ?>
				<input type="text" name="ses-wpscd-sales-export-start-date" id="ses-wpscd-sales-export-start-date" size="9">&nbsp;
				<input type="hidden" name="ses-wpscd-sales-export-start-date-internal" id="ses-wpscd-sales-export-start-date-internal">
			</span>
			<span id="ses-wpscd-sales-export-end-date-span"><?php _e('To: ','ses_wpscd'); ?>
				<input type="text" name="ses-wpscd-sales-export-end-date" id="ses-wpscd-sales-export-end-date" size="9">
				<input type="hidden" name="ses-wpscd-sales-export-end-date-internal" id="ses-wpscd-sales-export-end-date-internal">
			</span>
			<br/>
  			<label for='linesororders'><?php _e('Download:', 'ses_wpscd'); ?></label><br/>
  			<select id='linesororders' name='linesororders'>
				<option value="orders"><?php _e('Orders', 'ses_wpscd'); ?></option>
				<option value="lines"><?php _e('Order Lines', 'ses_wpscd'); ?></option>
  			</select>
			<br />
  			<div id='ses-wpscd-product-filter'>
			<label for='product'><?php _e('Products:', 'ses_wpscd'); ?></label>
			<br />
			<?php ses_wpscd_product_filter(); ?>
			<br/></div>
			<?php do_action ( 'ses_wpscd_export_form_fields' ); ?>
  			<label for='statuses'><?php _e('Order Statuses:', 'ses_wpscd'); ?></label>
			<br />
			<?php ses_wpscd_order_status_filter(); ?>
			<?php ses_wpscd_csv_fields_selection(); ?>
  			<input type="submit" value="<?php _e('Go', 'ses_wpscd'); ?>" name="Submit" class="button-primary action" /><br/><br/>

			</form>
		</div>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			if (jQuery('#linesororders').val() == 'orders') {
     				jQuery('#ses-wpscd-product-filter').hide();
			}
  			jQuery('#linesororders').change(function(){
				if (jQuery(this).val() == 'orders') {
     					jQuery('#ses-wpscd-product-filter').fadeOut();
				} else {
					jQuery('#ses-wpscd-product-filter').fadeIn();
				}
  			});
  			jQuery('#ses-wpscd-csv-choose-fields-button').click(function(){
     			jQuery('#ses-wpscd-csv-choose-fields-button-span').fadeOut();
     			jQuery('#ses-wpscd-csv-fields-selection').fadeIn();
  			});
			jQuery('#date').change(function() {
					if (jQuery(this).val() == 'Custom') {
						jQuery("#ses-wpscd-sales-export-start-date-span").show();
						jQuery("#ses-wpscd-sales-export-end-date-span").show();
					} else {
						jQuery("#ses-wpscd-sales-export-start-date").val("");
						jQuery("#ses-wpscd-sales-export-end-date").val("");
						jQuery("#ses-wpscd-sales-export-start-date-span").hide();
						jQuery("#ses-wpscd-sales-export-end-date-span").hide();
					}
				}
			);
			jQuery("#ses-wpscd-sales-export-start-date-span").hide();
			jQuery("#ses-wpscd-sales-export-end-date-span").hide();
			jQuery("#ses-wpscd-sales-export-start-date").datepicker({ altField : "#ses-wpscd-sales-export-start-date-internal",
				altFormat : 'yy-mm-dd',
				dateFormat: 'dd-M-yy'
			});
			jQuery("#ses-wpscd-sales-export-end-date").datepicker({ altField : "#ses-wpscd-sales-export-end-date-internal",
				altFormat : 'yy-mm-dd',
				dateFormat: 'dd-M-yy'
			});
		});

	</script>

	<?php

	}



function ses_wpscd_csv_fields_selection( $schedule_id = FALSE ) {

	global $ses_wpscd_csv_fields_available;

	// Add custom checkout variables
	$ses_wpscd_csv_fields_available = apply_filters('ses-wpscd-csv-fields-available', $ses_wpscd_csv_fields_available);

	// Retrieve settings from the scheduled event if applicable
	if ( $schedule_id !== FALSE )  {

		$scheduling_settings = get_option ( 'ses_wpscd_csv_schedule' );

		if ( isset ( $scheduling_settings[$schedule_id]['ses_wpscd_csv_fields'] ) ) {

			$ses_wpscd_csv_fields = $scheduling_settings[$schedule_id]['ses_wpscd_csv_fields'];

		} 

	}

	// If not, grab the "defaults"
	if ( ! isset ( $ses_wpscd_csv_fields ) ) {
		$ses_wpscd_csv_fields = get_option('ses_wpscd_csv_fields');
	}

	if ( $schedule_id === FALSE && !$ses_wpscd_csv_fields || $ses_wpscd_csv_fields == "" || count($ses_wpscd_csv_fields) < 1) {

		update_option ('ses_wpscd_csv_fields',Array ('order-id','order-date', 'order-time', 'tax-total', 'order-total', 'order-status', 'totalqty', 'orderline-sku', 'orderline-unitprice', 'orderline-qty', 'orderline-lineprice', 'orderline-tax', 'orderline-linetotal'));
		$ses_wpscd_csv_fields = get_option('ses_wpscd_csv_fields');

	}

	?>
		<span id="ses-wpscd-csv-choose-fields-button-span"><br/><a class="button-secondary" id="ses-wpscd-csv-choose-fields-button"><?php _e('Click to choose fields','ses_wpscd'); ?></a><?php _e(' or ','ses_wpscd'); ?></span>
		<div id="ses-wpscd-csv-fields-selection" style="display:none;">
		<?php
			$Orders = $Lines = '';
			while (list($key,$item) = each($ses_wpscd_csv_fields_available)) {

				$stringname = $item['ShowOn'];
				if ($stringname == "Both")
					$stringname = "Orders";

				$$stringname .= '<input type="checkbox" name="ses_wpscd_csv_fields[';
				$$stringname .= htmlentities($key);
				$$stringname .= ']" value="';
				$$stringname .= $item['Title'].'" ';
				if (is_array($ses_wpscd_csv_fields) && in_array($key,array_keys($ses_wpscd_csv_fields))) {
					$$stringname .= 'checked'; 
				}
				$$stringname .= '>';
				$$stringname .= htmlentities($item['Title']);
				$$stringname .= '<br />';
			}
			echo "<h4>".__('Order Export Fields', 'ses_wpscd')."</h4>";
			echo $Orders;
			echo "<h4>".__('Order Line Export Fields', 'ses_wpscd')."</h4>";
			echo $Lines;
			?>
			<br/>
		</div>
<?php
}



?>
