<?php

if ( ! class_exists ( 'ses_wpscd_recent_orders_widget' ) ) {

	class ses_wpscd_recent_orders_widget {

		private $settings;
		private $limit;

		function __construct() {

			$this->settings = get_option ( 'ses_wpscd_widget_settings' );
	
			if ( empty ( $this->settings['ses_wpscd_recent_orders_count'] ) ||
				! is_numeric ( $this->settings['ses_wpscd_recent_orders_count'] ) ) {
		
				$this->limit = 'LIMIT 5';
		
			} else {
		
				$this->limit = 'LIMIT '.$this->settings['ses_wpscd_recent_orders_count'];
		
			}

		}
	

		function render() {

			global $table_prefix;

			$sql = "SELECT pl.id,
			               date_format(from_unixtime(pl.date), '%%d %%b %%Y'),
			               SUM(c.quantity) AS num_items,
			               pl.totalprice,
			               pl.processed
			          FROM {$table_prefix}wpsc_purchase_logs pl
			     LEFT JOIN {$table_prefix}wpsc_cart_contents c
			            ON pl.id = c.purchaseid
			      GROUP BY pl.id
			      ORDER BY pl.date DESC ";
	
			$sql .= apply_filters('ses_wpscd_recent_orders_limit', $this->limit ) ;
	
			ses_wpscd_output_data($sql);

		}



		function config() {

			if ( ! empty ( $_REQUEST['ses_wpscd_recent_orders_count'] ) ) {
		
				if ( wp_verify_nonce ( $_REQUEST['_wpnonce'], 'ses_wpscd_recent_orders_count') ) {
		
					$this->settings['ses_wpscd_recent_orders_count'] = $_REQUEST['ses_wpscd_recent_orders_count'];
					update_option( 'ses_wpscd_widget_settings', $this->settings );
		
				} 
		
			}
		
			echo wp_nonce_field('ses_wpscd_recent_orders_count');
			?>
			<?php _e('Maximum number of orders to show:', 'ses_wpscd'); ?> <input type="text" size=3 name="ses_wpscd_recent_orders_count" value="<?php echo esc_attr($this->settings['ses_wpscd_recent_orders_count']); ?>">
			<?php
		}
		
			
	}

}
	
?>
