<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 */


	if ( ! function_exists ( 'ses_wpscd_date_range_array' ) ) {

		function ses_wpscd_date_range_array ( $start, $end, $freq = 1) {

			if ( empty ( $freq ) )
				$freq = 1;

			$range = array();
	
			if (is_string($start) === true) $start = strtotime($start);
			if (is_string($end) === true ) $end = strtotime($end);
			
			do {
				$range[$start] = 0;
				$start += ( 86400 * $freq ) ;
			} while($start <= $end);
	
			// JS needs this in ms, not seconds
			foreach ( $range as $key => $value ) {
				$newkey = $key * 1000;
				$newrange["$newkey"] = $value;
			}
	
			return $newrange;
	
		}

	}

	

if ( ! function_exists ( 'ses_wpscd_output_data' ) ) {

	function ses_wpscd_output_data ($ses_wpscd_query, $headings = Array('ID','Order Date','Items','Total','Status')) {
	
		global $wpdb, $table_prefix;

		if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

			$sql = "SELECT * FROM {$table_prefix}wpsc_purchase_statuses";
			$wpsc_purchlog_statuses = $wpdb->get_results($sql, OBJECT_K);

		} else {

			global $wpsc_purchlog_statuses;
			$statuses = Array();

			foreach ($wpsc_purchlog_statuses as $status) {

				$statuses[$status['order']] = $status;

			}

		}

 		$ses_wpscd_result_rows = $wpdb->get_results($wpdb->prepare($ses_wpscd_query),ARRAY_A);

		?>
			<table width="100%" class="ses-wpscd-table">
					<tr class="ses-wpscd-headerrow">
					<?php 
						foreach ($headings as $heading) {
							echo "<th>".htmlentities($heading)."</th>";
						}
					?>
					</tr>
		<?php
			if (!count($ses_wpscd_result_rows)) {
				echo "<td class=\"ses-wpscd-cell\" colspan=5>".__('No Results','ses_wpscd')."</td>";
			} else {
				foreach ($ses_wpscd_result_rows as $row) {
					echo "<tr class=\"ses-wpscd-row\">";

					while (list($key,$value) = each($row)) {

						if ($key == 'id') {

							echo "<td class=\"ses-wpscd-cell\">";
							echo "<a href=\"admin.php?page=wpsc-sales-logs&purchaselog_id=".htmlentities($value)."\">";
							echo htmlentities($value)."</a></td>";

						} elseif ($key == 'processed') {

							if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {

								echo "<td class=\"ses-wpscd-cell\">";
								$status = $wpsc_purchlog_statuses[$value];
								echo esc_html($status->name);
								echo "</td>";

							} else {

								echo "<td class=\"ses-wpscd-cell\">".esc_html($statuses[$value]['label'])."</td>";

							}

						} elseif ($key == 'totalprice') {

							if ( function_exists ( 'wpsc_currency_display' ) ) {
								$args = array(
									'display_currency_symbol' => true,
									'display_decimal_point'   => true,
									'display_currency_code'   => false,
									'display_as_html'         => false
								);
								$value = wpsc_currency_display($value, $args);
							}
							echo "<td class=\"ses-wpscd-cell\">".esc_html($value)."</td>";

						} else {

							echo "<td class=\"ses-wpscd-cell\">".esc_html($value)."</td>";
						}
					}
					echo "</tr>";
				}
			}
			echo "</table>";
		
	}

}

?>
