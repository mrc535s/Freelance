<?php

if ( ! class_exists ( 'ses_wpscd_items_to_ship_widget' ) ) {

	class ses_wpscd_items_to_ship_widget {


		private $settings;
		private $limit;


		function __construct() {

			$this->settings = get_option ( 'ses_wpscd_widget_settings' );

			if ( empty ( $this->settings['ses_wpscd_items_to_ship_count'] ) ||
				! is_numeric ( $this->settings['ses_wpscd_items_to_ship_count'] ) ) {

				$this->limit = 'LIMIT 5';

			} else {

				$this->limit = 'LIMIT '.$this->settings['ses_wpscd_items_to_ship_count'];

			}

		}

		function render() {

			global $table_prefix;

            if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
                $accepted_payment = 2;
            } else {
                $accepted_payment = 3;
            }

			$sql = " SELECT pl.id,
			                date_format(from_unixtime(pl.date), '%%d %%b %%Y'),
			                c.quantity AS num_items,
			                pl.processed
			           FROM {$table_prefix}wpsc_purchase_logs pl
			      LEFT JOIN {$table_prefix}wpsc_cart_contents c
			             ON pl.id = c.purchaseid
			          WHERE pl.processed = $accepted_payment 
			       ORDER BY pl.date DESC ";

			// Legacy filter support
			$sql .= apply_filters('ses_wpscd_items_to_ship_limit', 
									apply_filters('ses_wpscd_orders_to_ship_limit', $this->limit));

			ses_wpscd_output_data($sql, Array( __( 'ID', 'ses_wpscd' ), __ ( 'Order Date', 'ses_wpscd'), __ ( 'Items', 'ses_wpscd' ), __ ( 'Status', 'ses_wpscd')));

		}



		function config() {

			if ( ! isset ( $this->settings['ses_wpscd_items_to_ship_count'] ) )
				$this->settings['ses_wpscd_items_to_ship_count'] = '5';

			if ( ! empty ( $_REQUEST['ses_wpscd_items_to_ship_count'] ) ) {
		
				if ( wp_verify_nonce ( $_REQUEST['_wpnonce'], 'ses_wpscd_items_to_ship_count') ) {
		
					$this->settings['ses_wpscd_items_to_ship_count'] = $_REQUEST['ses_wpscd_items_to_ship_count'];
					update_option( 'ses_wpscd_widget_settings', $this->settings );
		
				} 
		
			}
		
			echo wp_nonce_field('ses_wpscd_items_to_ship_count');
			?>
			<?php _e('Maximum number of items to show:', 'ses_wpscd'); ?> <input type="text" size=3 name="ses_wpscd_items_to_ship_count" value="<?php echo esc_attr($this->settings['ses_wpscd_items_to_ship_count']); ?>">
			<?php
		}


	}

}

?>
