<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 */

/* jQuery flot code based on some of the code from Jigoshop 0.9.8 - http://www.jigoshop.com/ */

if ( ! class_exists ( 'ses_wpscd_revenue_graph' ) ) {

	class ses_wpscd_revenue_graph {

		// Configuration of the output
		private $settings;
		private $from_unixtime;
		private $to_unixtime;
		private $height;
	
		// Working Variables
		private $completed_revenue = Array();
		private $pending_revenue = Array();
	
	
	
		function __construct() {
	
			$this->settings = get_option ( 'ses_wpscd_widget_settings' );

			// FIXME - should use today's date, but 23:59:59, not just time()
			switch ( $this->settings['ses_wpscd_revenue_graph_period'] ) {

				case '7':
					$this->from_unixtime = strtotime("- 6 day", time());
					break;
				case '60':
					$this->from_unixtime = strtotime("- 59 day", time());
					break;
				case '90':
					$this->from_unixtime = strtotime("- 89 day", time());
					break;
				case '120':
					$this->from_unixtime = strtotime("- 119 day", time());
					break;
				case '150':
					$this->from_unixtime = strtotime("- 149 day", time());
					break;
				case '180':
					$this->from_unixtime = strtotime("- 179 day", time());
					break;
				case '270':
					$this->from_unixtime = strtotime("- 269 day", time());
					break;
				case '365':
					$this->from_unixtime = strtotime("- 364 day", time());
					break;
				case '30':
				default:
					$this->from_unixtime = strtotime("- 29 day", time());
					break;
			}

			$this->to_unixtime = time();
			$this->height = 200;
	
			$this->completed_revenue = ses_wpscd_date_range_array ( $this->from_unixtime, $this->to_unixtime, $this->settings['ses_wpscd_revenue_graph_detail'] );
			$this->pending_revenue = ses_wpscd_date_range_array ( $this->from_unixtime, $this->to_unixtime, $this->settings['ses_wpscd_revenue_graph_detail'] );
	
		}
	
	

		private function get_currency_symbol_html() {

			global $wpdb;

			$currency_data = $wpdb->get_row( "SELECT `symbol`,`symbol_html`,`code` FROM `" . WPSC_TABLE_CURRENCY_LIST . "` WHERE `id`='" . esc_attr( get_option( 'currency_type' ) ) . "' LIMIT 1", ARRAY_A );
			$currency_position = get_option ( 'currency_sign_location' );

			$pre_space = $post_space = '';
			if ( $currency_position == 2 )
				$post_space = ' ';
			elseif ( $currency_position == 4 )
				$pre_space = ' ';

			if ( $currency_data['symbol'] != '' ) {
				$currency_sign = $post_space . esc_attr( $currency_data['symbol_html'] ) . $pre_space;
			} else {
			    $currency_sign = $post_space . esc_attr( $currency_data['code'] ) . $pre_space;
			}
			return $currency_sign;
		}



		function prepare() {
	
			global $wpdb, $table_prefix;
	
			if ( isset ( $this->settings['ses_wpscd_revenue_graph_detail'] ) && $this->settings['ses_wpscd_revenue_graph_detail'] != '1' ) {

				$period = $this->settings['ses_wpscd_revenue_graph_detail'];
				$date_idx = "DATEDIFF(from_unixtime(pl.date), from_unixtime(%s)) DIV $period AS date_idx";

			} else {

				$period = 1;
				$date_idx = 'DATEDIFF(from_unixtime(pl.date), from_unixtime(%s)) AS date_idx';

			}
			$sql = "SELECT $date_idx,
						SUM(pl.totalprice) AS totalprice,
						IF(pl.processed in (2,3,4), 'Complete','Pending') as status
					FROM {$table_prefix}wpsc_purchase_logs pl
					WHERE pl.date > %s
					AND pl.date <= %s
				GROUP BY status, date_idx
				ORDER BY date_idx ASC";
	
			$results = $wpdb->get_results ( $wpdb->prepare ( $sql, $this->from_unixtime, $this->from_unixtime, $this->to_unixtime) , ARRAY_A);
	
			if ( ! $results )
				return;
	
			foreach ( $results as $row ) {
	
				$idx = $row['date_idx'];
				$idx = ( $this->from_unixtime + ( $idx*$period*60*60*24 ) ) * 1000;
	
				if ($row['status'] == 'Complete') {
					$this->completed_revenue["$idx"] += $row['totalprice'];
				} else {
					$this->pending_revenue["$idx"] += $row['totalprice'];
				}
	
			}
	
			return;
	
		}
	
	
	
		function output_data_array ( $data ) {
	
			if ( ! $data || ! count ( $data ) )
				return '0';
	
			$cnt = 0;
			$output = '';
	
			foreach ( $data as $key => $value ) {
	
				if ( $cnt )
					$output .= ', ';
				$output .= '[ ' . $key . ', ' . $value . ']';
				$cnt++;
		
			}
	
			return $output;
	
			}
	
	
	
		function render() {
	
			$this->prepare();
	
			?>
			<div id="ses-wpscd-revenue-graph" style="width:100%; height:<?php echo $this->height; ?>px; position:relative;"></div>
	
			<script type="text/javascript">
	
				var revenue_completed = [ <?php echo $this->output_data_array ( &$this->completed_revenue ); ?> ];
				var revenue_pending = [ <?php echo $this->output_data_array ( &$this->pending_revenue ); ?> ];
	
				jQuery(function(){
						
					function weekendAreas(axes) {
						var markings = [];
						var d = new Date(axes.xaxis.min);
						// go to the first Saturday
						d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
						d.setUTCSeconds(0);
						d.setUTCMinutes(0);
						d.setUTCHours(0);
						var i = d.getTime();
						do {
							markings.push({ xaxis: { from: i, to: i + 2 * 24 * 60 * 60 * 1000 } , color: "#f9f9f9" } );
							i += 7 * 24 * 60 * 60 * 1000;
						} while (i < axes.xaxis.max);
					
						return markings;
					}
	
					var plot = jQuery.plot(jQuery("#ses-wpscd-revenue-graph"), [ { label: "<?php _e( 'Revenue', 'ses_wpscd'); ?>", data: revenue_completed }
					<?php 
						if ( ! empty ( $this->settings['ses_wpscd_revenue_graph_show_pending'] ) ) {
							echo ', { label: "'.__('Pending Revenue', 'ses_wpscd').'", data: revenue_pending }';
						}  ?>
						], {
						series: {
							lines: { show: true },
							points: { show: false }
						},
						grid: {
							show: true,
							aboveData: false,
							color: '#999',
							backgroundColor: '#fff',
							borderWidth: 1,
							borderColor: '#ccc',
							clickable: false,
							hoverable: true,
							markings: weekendAreas
						},
						xaxis: { 
							mode: "time",
							timeformat: "%d %b", 
							tickLength: 1
						},
						yaxes: [ { min: 0, tickDecimals: 0 } ],
						colors: ["#11658B", "#999999"]
					});
	
					function showTooltip(x, y, contents) {
						jQuery('<div id="tooltip">' + contents + '</div>').css( {
							position: 'absolute',
							display: 'none',
							top: y + 5,
							left: x + 5,
							border: '1px solid #fdd',
							padding: '2px',
							'background-color': '#fee',
							opacity: 0.80
						}).appendTo("body").fadeIn(200);
					}
					var revenue_previousPoint = null;
					jQuery("#ses-wpscd-revenue-graph").bind("plothover", function (event, pos, item) {
						if (item) {
							if (revenue_previousPoint != item.dataIndex) {
								revenue_previousPoint = item.dataIndex;
								
								jQuery("#tooltip").remove();
								
								var y = item.datapoint[1];
								<?php
								$currency_position = get_option ( 'currency_sign_location' );
								if ( $currency_position == 3 || $currency_position == 4 )
									//Before
									echo 'showTooltip(item.pageX, item.pageY, item.series.label + ": '.$this->get_currency_symbol_html().'" + y)';
								else
									echo 'showTooltip(item.pageX, item.pageY, item.series.label + ": " + y + "'.$this->get_currency_symbol_html().'")';
								?>
	
							}
						}
						else {
							jQuery("#tooltip").remove();
							revenue_previousPoint = null;            
						}
					});
					
				});
								
			</script>
	
			<?php
		}



		function config() {

			if ( ! empty ( $_REQUEST['ses_wpscd_revenue_graph_period'] ) ) {
		
				if ( wp_verify_nonce ( $_REQUEST['_wpnonce'], 'ses_wpscd_revenue_graph') ) {
		
					$this->settings['ses_wpscd_revenue_graph_period'] = $_REQUEST['ses_wpscd_revenue_graph_period'];
					$this->settings['ses_wpscd_revenue_graph_detail'] = $_REQUEST['ses_wpscd_revenue_graph_detail'];
					$this->settings['ses_wpscd_revenue_graph_show_pending'] = $_REQUEST['ses_wpscd_revenue_graph_show_pending'];
					update_option( 'ses_wpscd_widget_settings', $this->settings );
		
				} 
		
			}
		
			echo wp_nonce_field('ses_wpscd_revenue_graph');
			?>
			<?php
				$checked = Array();
				$checked['7'] = '';
				$checked['30'] = '';
				$checked['60'] = '';
				$checked['90'] = '';
				$checked['120'] = '';
				$checked['150'] = '';
				$checked['180'] = '';
				$checked['270'] = '';
				$checked['365'] = '';
				if ( isset ( $this->settings['ses_wpscd_revenue_graph_period'] ) ) {
					$checked[$this->settings['ses_wpscd_revenue_graph_period']] = ' selected';
				} else {
					$checked['30'] = ' selected';
				}

			?>
			<p>
			<label for="ses_wpscd_revenue_graph_period"><?php _e('Show: ', 'ses_wpscd'); ?></label><br/>
			<select name="ses_wpscd_revenue_graph_period">
				<option value="7" <?php echo $checked['7']; ?>><?php _e ( 'Last 7 days', 'ses_wpscd' ); ?></option>
				<option value="30" <?php echo $checked['30']; ?>><?php _e ( 'Last 30 days', 'ses_wpscd' ); ?></option>
				<option value="60" <?php echo $checked['60']; ?>><?php _e ( 'Last 60 days', 'ses_wpscd' ); ?></option>
				<option value="90" <?php echo $checked['90']; ?>><?php _e ( 'Last 90 days', 'ses_wpscd' ); ?></option>
				<option value="120" <?php echo $checked['120']; ?>><?php _e ( 'Last 120 days', 'ses_wpscd' ); ?></option>
				<option value="150" <?php echo $checked['150']; ?>><?php _e ( 'Last 150 days', 'ses_wpscd' ); ?></option>
				<option value="180" <?php echo $checked['180']; ?>><?php _e ( 'Last 180 days', 'ses_wpscd' ); ?></option>
				<option value="270" <?php echo $checked['270']; ?>><?php _e ( 'Last 270 days', 'ses_wpscd' ); ?></option>
				<option value="365" <?php echo $checked['365']; ?>><?php _e ( 'Last 365 days', 'ses_wpscd' ); ?></option>
			</select>
			</p>
			<?php
				$checked = Array();
				$checked['1'] = '';
				$checked['7'] = '';
				$checked['14'] = '';
				$checked['21'] = '';
				$checked['28'] = '';
				if ( isset ( $this->settings['ses_wpscd_revenue_graph_detail'] ) ) {
					$checked[$this->settings['ses_wpscd_revenue_graph_detail']] = ' selected';
				} else {
					$checked['1'] = ' selected';
				}
			?>
			<p>
			<label for="ses_wpscd_revenue_graph_period"><?php _e('Group results by: ', 'ses_wpscd'); ?></label><br/>
			<select name="ses_wpscd_revenue_graph_detail">
				<option value="1" <?php echo $checked['1']; ?>><?php _e ( 'Nothing, show a result for each day', 'ses_wpscd' ); ?></option>
				<option value="7" <?php echo $checked['7']; ?>><?php _e ( '7 days', 'ses_wpscd' ); ?></option>
				<option value="14" <?php echo $checked['14']; ?>><?php _e ( '14 days', 'ses_wpscd' ); ?></option>
				<option value="21" <?php echo $checked['21']; ?>><?php _e ( '21 days', 'ses_wpscd' ); ?></option>
				<option value="28" <?php echo $checked['28']; ?>><?php _e ( '28 days', 'ses_wpscd' ); ?></option>
			</select>
			</p>
			<p>
			<input <?php if ( ! empty ( $this->settings['ses_wpscd_revenue_graph_show_pending'] ) ) echo "checked='checked'"; ?> type="checkbox" name="ses_wpscd_revenue_graph_show_pending">
			<label for="ses_wpscd_revenue_graph_show_pending"><?php _e('Show Pending Revenue: ', 'ses_wpscd'); ?></label><br/>
			</p>
			<?php
		}
	}

}
	
	
?>
