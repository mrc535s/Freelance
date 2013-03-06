<?php

if ( ! class_exists ( 'ses_wpscd_product_sales_widget' ) ) {

	class ses_wpscd_product_sales_widget {

		private $settings;
		private $limit;
		private $period;
		private $exit = FALSE;

		function __construct() {

			$this->settings = get_option ( 'ses_wpscd_widget_settings' );
			if ( empty ( $this->settings['ses_wpscd_product_sales_count'] ) ||
				 ! is_numeric ( $this->settings['ses_wpscd_product_sales_count'] ) ) {
				$limit = 'LIMIT 5';
			} else {
				$limit = 'LIMIT '.$this->settings['ses_wpscd_product_sales_count'];
			}
			$this->limit = apply_filters('ses_wpscd_product_sales_limit', $limit);


		}



		function parse_or_get_period() {
		
			if (isset($_GET['period'])) {

				$period = $_GET['period'];
				if ($period != 'custom') {
					setcookie('ses_wpscd_product_sales_period', $period, time()+(86400*30));
				}
				$this->exit = TRUE;

			} elseif (isset($_COOKIE['ses_wpscd_product_sales_period'])) {

				$period = $_COOKIE['ses_wpscd_product_sales_period'];

			} else {

				$period = 'thismonth';

			}
		
			$this->period = $period;
		}
		


		function render() {

			$this->render_data();
			$this->render_selector();
		}



		function render_data() {
		
			global $wpdb, $table_prefix;
		
			$this->parse_or_get_period();
		
			switch ( $this->period ) {
				case "7days":
					// Actually today + 6 previous days
					$mindate = mktime(0,0,0,date('n'),date('j'),date('Y')) - 6*60*60*24;
					$maxdate = mktime(23,59,59,date('n'),date('j'),date('Y'));
					break;
	
				case "today":
					$mindate = mktime(0,0,0,date('n'),date('j'),date('Y'));
					$maxdate = mktime(23,59,59,date('n'),date('j'),date('Y'));
					break;
	
				case "lastmonth":
					if (date('n') == 1) {
						$mindate = mktime(0,0,0,12,date('j'),date('Y')-1);
					} else {
						$mindate = mktime(0,0,0,date('n')-1,date('j'),date('Y'));
					}
					$maxdate = mktime(0,0,0,date('n'),0,date('Y'));
					break;
	
				case "thisyear":
					$mindate = mktime(0,0,0,1,1,date('Y'));
					$maxdate = mktime(23,59,59,12,31,date('Y'));
					break;
	
				case "custom":
					$mindate = mktime(0,0,0,substr($_GET['start'],4,2),substr($_GET['start'],6,2),substr($_GET['start'],0,4));
					$maxdate = mktime(23,59,59,substr($_GET['end'],4,2),substr($_GET['end'],6,2),substr($_GET['end'],0,4));
					break;
	
				case "thismonth":
				default:
					$mindate = mktime(0,0,0,date('n'),1,date('Y'));
					if (date('n') == 12) {
						$maxdate = mktime(0,0,0,1,date('j'),date('Y')+1)-1;
					} else {
						$maxdate = mktime(0,0,0,date('n')+1,date('j'),date('Y'))-1;
					}
					break;
	
			}
			if ( $this->period != "alltime" ) {
				$date_range = "pl.date BETWEEN $mindate AND $maxdate";
			} else {
				$date_range = "1";
			}
	
			/* This is required to catch product IDs that weren't migrated and to avoid showing bogus data */
			if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

				$post_type_check = '1 AS is_product,';
				$post_type_join = '';

			} else {

				$post_type_check = 'IF ( p.ID IS NULL, 0, 1) AS is_product,';
				$post_type_join = "LEFT JOIN {$table_prefix}posts p ON c.prodid = p.ID AND p.post_type = 'wpsc-product'";

			}
	
			$sql = "SELECT c.name,
			               c.prodid,
			               $post_type_check
		                   SUM(c.quantity) AS num_items,
		                   SUM(c.quantity * c.price) AS product_revenue
	                  FROM {$table_prefix}wpsc_purchase_logs pl
			     LEFT JOIN {$table_prefix}wpsc_cart_contents c
		                ON pl.id = c.purchaseid
			               $post_type_join
		             WHERE $date_range
			           AND pl.processed in (2,3,4)
		          GROUP BY c.prodid
	 		      ORDER BY product_revenue DESC, num_items DESC ";
	
			$sql .= $this->limit;
	
			$results = $wpdb->get_results ( $wpdb->prepare ( $sql ), ARRAY_A );
		
			?>
			<div id="ses-wpscd-product-sales">
				<table width="100%" class="ses-wpscd-table">
				<tr class="ses-wpscd-headerrow"><th class="ses-wpscd-left"><?php _e('Product','ses_wpscd'); ?></th><th><?php _e('Units','ses_wpscd'); ?></th><th class="ses-wpscd-right"><?php _e('Revenue','ses_wpscd'); ?></th></tr>
				<?php
				if (!count($results)) {
					echo "<td class=\"ses-wpscd-cell\" colspan=3>".__('No Sales In The Selected Period','ses_wpscd')."</td>";
				} else {
					$total_revenue = 0;
					foreach ($results as $row) {
						if ( function_exists ( 'wpsc_currency_display' ) ) {
							$args = array(
								'display_currency_symbol' => true,
								'display_decimal_point'   => true,
								'display_currency_code'   => false,
								'display_as_html'         => false
							);
							$revenue = wpsc_currency_display($row['product_revenue'], $args);
						} else {
							$revenue = $row['product_revenue'];
						}
						echo "<tr class=\"ses-wpscd-row\">";
						if ( $row['is_product'] == 1 ) {
							echo "<td class=\"ses-wpscd-cell ses-wpscd-left\"><a href=\"".esc_attr(wpsc_product_url($row['prodid']))."\">".esc_html($row['name'])."</a></td>";
						} else {
							echo "<td class=\"ses-wpscd-cell ses-wpscd-left\">".esc_html($row['name'])."</td>";
						}
						echo "<td class=\"ses-wpscd-cell\">".esc_html($row['num_items'])."</td>";
						echo "<td class=\"ses-wpscd-cell ses-wpscd-right\">".esc_html($revenue)."</td>";
						echo "</tr>";
						$total_revenue += $row['product_revenue'];
					}
					echo "<tr class=\"ses-wpscd-row\">";
					echo "  <td class=\"ses-wpscd-cell ses-wpscd-right\" colspan=\"2\"><strong>".__('Total','ses_wpscd')."</strong></td>";
					echo "  <td class=\"ses-wpscd-cell ses-wpscd-right\">".wpsc_currency_display($total_revenue, $args)."</td>";
					echo "</tr>";
				}
				?>
				</table>
			</div>
			<?php

			if ($this->exit) {
				// This is an AJAX update - so exit()
				exit();
			} 
			
		}
	


		function render_selector() {
		
			$period = $this->period;
			?>
		
			<div width="100%" class="ses-wpscd-right">
				<form method="POST" action="#">
					<input type="text" name="ses-wpscd-product-sales-start-date" id="ses-wpscd-product-sales-start-date" size="8">&nbsp;
					<input type="hidden" name="ses-wpscd-product-sales-start-date-internal" id="ses-wpscd-product-sales-start-date-internal">
					<input type="text" name="ses-wpscd-product-sales-end-date" id="ses-wpscd-product-sales-end-date" size="8">
					<input type="hidden" name="ses-wpscd-product-sales-end-date-internal" id="ses-wpscd-product-sales-end-date-internal">
					<input type="button" id="ses-wpscd-product-sales-custom-submit" value="Go">
					<select id="ses-wpscd-product-sales-period" name="ses-wpscd-product-sales-period">
						<option value="today"<?php if($period=="today") echo " selected"; ?>><?php _e('Today', 'ses_wpscd'); ?></option>
						<option value="7days"<?php if($period=="7days") echo " selected"; ?>><?php _e('Last 7 Days', 'ses_wpscd'); ?></option>
						<option value="thismonth"<?php if($period=="thismonth") echo " selected"; ?>><?php _e('This Month', 'ses_wpscd'); ?></option>
						<option value="lastmonth"<?php if($period=="lastmonth") echo " selected"; ?>><?php _e('Last Month', 'ses_wpscd'); ?></option>
						<option value="thisyear"<?php if($period=="thisyear") echo " selected"; ?>><?php _e('This Year', 'ses_wpscd'); ?></option>
						<option value="alltime"<?php if($period=="alltime") echo " selected"; ?>><?php _e('All Time', 'ses_wpscd'); ?></option>
						<option value="custom"<?php if($period=="custom") echo " selected"; ?>><?php _e('Custom', 'ses_wpscd'); ?></option>
					</select>
				</form>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery('#ses-wpscd-product-sales-period').change(function() {
								if (jQuery(this).val() == 'custom') {
									jQuery("#ses-wpscd-product-sales-start-date").show();
									jQuery("#ses-wpscd-product-sales-end-date").show();
									jQuery("#ses-wpscd-product-sales-custom-submit").show();
								} else {
									jQuery("#ses-wpscd-product-sales-start-date").val("");
									jQuery("#ses-wpscd-product-sales-end-date").val("");
									jQuery("#ses-wpscd-product-sales-start-date").hide();
									jQuery("#ses-wpscd-product-sales-end-date").hide();
									jQuery("#ses-wpscd-product-sales-custom-submit").hide();
									jQuery.ajax( { url: "admin-ajax.php?action=ses_wpscd_ps_ajax&period="+jQuery(this).val(),
													success: function(data) { jQuery("#ses-wpscd-product-sales").html(data); }
											}
										)
								}
							}
						);
						jQuery('#ses-wpscd-product-sales-custom-submit').click(function() {
								var startDate = jQuery("#ses-wpscd-product-sales-start-date-internal").val();
								var endDate = jQuery("#ses-wpscd-product-sales-end-date-internal").val();
								jQuery.ajax( { url: "admin-ajax.php?action=ses_wpscd_ps_ajax&period=custom&start="+startDate+"&end="+endDate,
												success: function(data) { jQuery("#ses-wpscd-product-sales").html(data); }
									}
								)
						});
						jQuery("#ses-wpscd-product-sales-start-date").hide();
						jQuery("#ses-wpscd-product-sales-end-date").hide();
						jQuery("#ses-wpscd-product-sales-custom-submit").hide();
						jQuery("#ses-wpscd-product-sales-start-date").datepicker({ altField : "#ses-wpscd-product-sales-start-date-internal",
																				altFormat : 'yymmdd',
																				dateFormat: 'dd-M-yy'});
						jQuery("#ses-wpscd-product-sales-end-date").datepicker({ altField : "#ses-wpscd-product-sales-end-date-internal",
																					altFormat : 'yymmdd',
																				dateFormat: 'dd-M-yy'});
						}
					);
				</script>
			</div>
			<?php
		}
		
		
		
		function config() {
		
			if ( ! isset ( $this->settings['ses_wpscd_product_sales_count'] ) )
				$this->settings['ses_wpscd_product_sales_count'] = '5';

			if ( ! empty ( $_REQUEST['ses_wpscd_product_sales_count'] ) ) {
		
				if ( wp_verify_nonce ( $_REQUEST['_wpnonce'], 'ses_wpscd_product_sales_count') ) {
	
					$this->settings['ses_wpscd_product_sales_count'] = $_REQUEST['ses_wpscd_product_sales_count'];
					update_option( 'ses_wpscd_widget_settings', $this->settings );
	
				} 
	
			}
	
			echo wp_nonce_field('ses_wpscd_product_sales_count');
			?>
			<?php _e('Maximum number of products to show', 'ses_wpscd'); ?>: <input type="text" size=3 name="ses_wpscd_product_sales_count" value="<?php echo esc_attr($this->settings['ses_wpscd_product_sales_count']); ?>">
			<?php
		}
		
	}

}
