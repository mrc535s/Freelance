<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 */

if ( ! class_exists ( 'ses_wpscd_stock_alerts_widget' ) ) {

	class ses_wpscd_stock_alerts_widget {
	
		private $settings;
		private $amber_limit;
		private $red_limit;
		
		function __construct() {
			
			$this->settings = get_option ( 'ses_wpscd_widget_settings' );
	
			if ( empty ( $this->settings['ses_wpscd_stock_red_limit'] ) ||
				! is_numeric ( $this->settings['ses_wpscd_stock_red_limit'] ) ) {
				$this->red_limit = '5';
			} else {
				$this->red_limit = $this->settings['ses_wpscd_stock_red_limit'];
			}
	
			if ( empty ( $this->settings['ses_wpscd_stock_amber_limit'] ) ||
				! is_numeric ( $this->settings['ses_wpscd_stock_amber_limit'] ) ) {
				$this->amber_limit = '10';
			} else {
				$this->amber_limit = $this->settings['ses_wpscd_stock_amber_limit'];
			}
	
		}
	
	
		function render() {
	
			global $wpdb, $table_prefix;
	
			$sql_limit = max ( $this->amber_limit, $this->red_limit );
	
			if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
	
				$sql = "SELECT id AS prod_id,
				               name AS prod_title,
				               quantity AS meta_value
				          FROM {$table_prefix}wpsc_product_list
				         WHERE quantity < %d
						   AND quantity != ''
						   AND quantity IS NOT NULL
				      ORDER BY quantity DESC";
		
			} else {
		
				$sql = "SELECT id AS prod_id,
				               post_title AS prod_title,
				               meta_value
				          FROM {$table_prefix}posts p
				     LEFT JOIN {$table_prefix}postmeta pm
				            ON p.ID = pm.post_id
				           AND pm.meta_key = '_wpsc_stock'
				         WHERE pm.meta_value < %d
				           AND pm.meta_value IS NOT NULL
				           AND pm.meta_value != ''
				      ORDER BY pm.meta_value DESC";
			
			}
	
			$sql = $wpdb->prepare ( $sql, $sql_limit );
	
			$results = $wpdb->get_results ( $sql, ARRAY_A );
	
			?>
			<table width="100%" class="ses-wpscd-table">
			<tr class="ses-wpscd-headerrow"><th><?php _e('Product','ses_wpscd'); ?></th><th><?php _e('Current Stock','ses_wpscd'); ?></th></tr>
			<?php
				if (!count($results)) {
					echo "<td class=\"ses-wpscd-cell\" colspan=2>".__('No Low Stock Items','ses_wpscd')."</td>";
				} else {
					foreach ( $results as $row) {
						?>
							<tr class="ses-wpscd-row">
								<td class="ses-wpscd-left ses-wpscd-cell"><a href="post.php?post=<?php echo esc_attr($row['prod_id']); ?>&action=edit"><?php echo esc_html($row['prod_title']); ?></a></td>
								<td class="ses-wpscd-cell <?php echo $row['meta_value'] < $this->red_limit ? 'ses-wpscd-red-stock' : 'ses-wpscd-amber-stock'; ?>"><?php echo esc_html($row['meta_value']); ?></td>
							</tr>
						<?php
					}
				} ?>
			</table>
			<?php
					
		}



		/**
		* Allow configuration 
		*/
		function config() {

			if ( ! isset ( $this->settings['ses_wpscd_stock_amber_limit'] ) )
				$this->settings['ses_wpscd_stock_amber_limit'] = '5';

			if ( ! isset ( $this->settings['ses_wpscd_stock_red_limit'] ) )
				$this->settings['ses_wpscd_stock_red_limit'] = '5';


			if ( ! empty ( $_REQUEST['ses_wpscd_stock_amber_limit'] ) ) {

				if ( wp_verify_nonce ( $_REQUEST['_wpnonce'], 'ses_wpscd_stock_alerts') ) {

					$this->settings['ses_wpscd_stock_amber_limit'] = $_REQUEST['ses_wpscd_stock_amber_limit'];
					$this->settings['ses_wpscd_stock_red_limit'] = $_REQUEST['ses_wpscd_stock_red_limit'];
					update_option( 'ses_wpscd_widget_settings', $this->settings );

				} 
		
			}
		
			echo wp_nonce_field('ses_wpscd_stock_alerts');
			?>
			<?php _e('Medium Stock Level (Amber):', 'ses_wpscd'); ?> <input type="text" size=3 name="ses_wpscd_stock_amber_limit" value="<?php echo esc_attr($this->settings['ses_wpscd_stock_amber_limit']); ?>"><br/>
			<?php _e('Low Stock Level (Red):', 'ses_wpscd'); ?> <input type="text" size=3 name="ses_wpscd_stock_red_limit" value="<?php echo esc_attr($this->settings['ses_wpscd_stock_red_limit']); ?>">
			<?php
		}
		
			
	
	}

}
	
?>
