<?php

if ( ! class_exists ( 'ses_wpscd_product_ratings_widget' ) ) {

	class ses_wpscd_product_ratings_widget {


		private $settings;



		function __construct() {

			$this->settings = get_option ( 'ses_wpscd_widget_settings' );
	
			if ( empty ( $this->settings['ses_wpscd_recent_product_ratings_count'] ) ||
				! is_numeric ( $this->settings['ses_wpscd_recent_product_ratings_count'] ) ) {
	
				$this->limit = 'LIMIT 5';
	
			} else {
	
				$this->limit = 'LIMIT '.$this->settings['ses_wpscd_recent_product_ratings_count'];
	
			}
	
		}


		function render() {

			global $wpdb, $table_prefix;

			if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
				$product_title_var = 'name';
				$product_table = 'wpsc_product_list';
				$product_id_var = 'id';
			} else {
				$product_title_var = 'post_title';
				$product_table = 'posts';
				$product_id_var = 'ID';
			}
	
			$sql = "SELECT DATE_FORMAT(FROM_UNIXTIME(pr.time), '%%d %%b %%y') as rating_date,
			               pr.ipnum,
			               p.{$product_title_var} as prod_title,
			               p.{$product_id_var} as prod_id,
			               pr.rated
			          FROM {$table_prefix}wpsc_product_rating pr
			     LEFT JOIN {$table_prefix}{$product_table} p
			            ON pr.productid = p.id
			      ORDER BY time DESC ";
	
			$sql .= apply_filters('ses_wpscd_recent_product_ratings_limit', $this->limit );
	
			$results = $wpdb->get_results ( $wpdb->prepare ( $sql ), ARRAY_A);
	
			?>
			<table width="100%" class="ses-wpscd-table">
			<tr class="ses-wpscd-headerrow"><th><?php _e('Date', 'ses_wpscd'); ?></th><th><?php _e('IP Address', 'ses_wpscd'); ?></th><th><?php _e('Item', 'ses_wpscd'); ?></th><th><?php _e('Rating', 'ses_wpscd'); ?></th></tr>
		<?php
			if (!count($results)) {
				echo "<td class=\"ses-wpscd-cell\" colspan=4>".__('No Ratings Yet', 'ses_wpscd')."</td>";
			} else {
				foreach ( $results as $row) {
					?>
						<tr class="ses-wpscd-row">
							<td class="ses-wpscd-cell"><?php echo esc_html($row['rating_date']); ?></td>
								<td class="ses-wpscd-cell"><?php echo esc_html($row['ipnum']); ?></td>
							<td class="ses-wpscd-cell"><a href="<?php echo esc_attr(wpsc_product_url($row['prod_id'])); ?>"><?php echo esc_html($row['prod_title']); ?></a></td>
							<td class="ses-wpscd-cell"><?php echo esc_html($row['rated']); ?></td>
						</tr>
					<?php
					}
			}
			echo "</table>";
		}



		function config() {

			if ( ! isset ( $this->settings['ses_wpscd_recent_product_ratings_count'] ) )
				$this->settings['ses_wpscd_recent_product_ratings_count'] = '5';

			if ( ! empty ( $_REQUEST['ses_wpscd_recent_product_ratings_count'] ) ) {
		
				if ( wp_verify_nonce ( $_REQUEST['_wpnonce'], 'ses_wpscd_recent_product_ratings_count') ) {
		
					$this->settings['ses_wpscd_recent_product_ratings_count'] = $_REQUEST['ses_wpscd_recent_product_ratings_count'];
					update_option( 'ses_wpscd_widget_settings', $this->settings );
		
				} 
		
			}
		
			echo wp_nonce_field('ses_wpscd_recent_product_ratings_count');
			?>
			<?php _e('Maximum number of ratings to show:', 'ses_wpscd'); ?> <input type="text" size=3 name="ses_wpscd_recent_product_ratings_count" value="<?php echo esc_attr($this->settings['ses_wpscd_recent_product_ratings_count']); ?>">
			<?php
		}
		
	}

}
				
