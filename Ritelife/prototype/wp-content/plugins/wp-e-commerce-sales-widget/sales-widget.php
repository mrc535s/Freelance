<?php
/*
Plugin Name: WP e-Commerce - Sales Widget
Plugin URI: http://www.visser.com.au/wp-ecommerce/plugins/sales-widget/
Description: Display WP e-Commerce store sales details to site visitors through a WordPress Widget.
Version: 1.2.7
Author: Visser Labs
Author URI: http://www.visser.com.au/about/
License: GPL2
*/

load_plugin_textdomain( 'wpsc_sw', null, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

include_once( 'includes/functions.php' );

include_once( 'includes/common.php' );

$wpsc_sw = array(
	'filename' => basename( __FILE__ ),
	'dirname' => basename( dirname( __FILE__ ) ),
	'abspath' => dirname( __FILE__ ),
	'relpath' => basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ )
);

$wpsc_sw['prefix'] = 'wpsc_sw';
$wpsc_sw['name'] = __( 'Sales Widget for WP e-Commerce', 'wpsc_sw' );
$wpsc_sw['menu'] = __( 'Sales Widget', 'wpsc_sw' );

if( is_admin() ) {

	include_once( dirname( __FILE__ ) . '/includes/update.php' );

}

/**
 * Sales widget class
 *
 * Takes the settings, works out if there is anything to display, if so, displays it.
 *
 */
class WP_Widget_Sales_Widget extends WP_Widget {

	/**
	 * Widget Constuctor
	 */
	function WP_Widget_Sales_Widget() {

		$widget_ops = array(
			'classname' => 'widget_wpsc_sales',
			'description' => __( 'Sales Widget', 'wpsc_sw' )
		);
		$this->WP_Widget( 'wpsc_sw_sales', __( 'Sales Widget', 'wpsc_sw' ), $widget_ops );

	}

	/**
	 * Widget Output
	 *
	 * @param $args (array)
	 * @param $instance (array) Widget values.
	 */
	function widget( $args,$instance ) {

		global $wpdb, $wpsc_sw;

		extract($args);
		$title = apply_filters( 'widget_title',empty( $instance['title'] ) ? __( 'Sales Widget' ) : $instance['title'] );
		$display_currency = $instance['currency'];
		$thousand_separator = ',';

		$sales_sql = "SELECT SUM(`totalprice`) FROM `" . $wpdb->prefix . "wpsc_purchase_logs` WHERE `processed` IN (2,3,4)";
		$sales = number_format( $wpdb->get_var( $sales_sql ),2,'.',$thousand_separator );
		$orders_sql = "SELECT COUNT(`id`) FROM `" . $wpdb->prefix . "wpsc_purchase_logs` WHERE `processed` IN (2,3,4)";
		$orders = $wpdb->get_var( $orders_sql );

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		if( !$sales )
			$sales = '0.00';

		$currency_type = get_option( 'currency_type' );

		$currency_sign_sql = "SELECT `symbol_html`, `code`, `currency` FROM `" . $wpdb->prefix . "wpsc_currency_list` WHERE id = " . $currency_type;
		$currency_sign = $wpdb->get_row( $currency_sign_sql );

		$currency_sign_location = get_option('currency_sign_location');
		switch($currency_sign_location) {

			case 1:
				$output = $sales . $currency_sign->symbol_html;
				break;
	
			case 2:
				$output = $sales . ' ' . $currency_sign->symbol_html;
				break;
	
			case 3:
				$output = $currency_sign->symbol_html . $sales;
				break;
	
			case 4:
				$output = $currency_sign->symbol_html . '  ' . $sales;
				break;

		}

		if( $display_currency )
			$output .= '&nbsp;<abbr title="' . $currency_sign->currency . '">' . $currency_sign->code . '</abbr>';

		if ( file_exists( STYLESHEETPATH . '/wpsc-sales_widget.php' ) )
			include( STYLESHEETPATH . '/wpsc-sales_widget.php' );
		else
			include( $wpsc_sw['abspath'] . '/templates/store/wpsc-sales_widget.php' );

		echo $after_widget;

	}

	/**
	 * Update Widget
	 *
	 * @param $new_instance (array) New widget values.
	 * @param $old_instance (array) Old widget values.
	 *
	 * @return (array) New values.
	 */
	function update( $new_instance,$old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['currency'] = $new_instance['currency'] ? 1 : 0;
		return $instance;

	}

	/**
	 * Widget Options Form
	 *
	 * @param $instance (array) Widget values.
	 */
	function form( $instance ) {

		global $wpdb;

		// Defaults
		$instance = wp_parse_args( (array)$instance, array(
			'title' => ''
		) );

		// Values
		$title = esc_attr( $instance['title'] );
		$currency = (bool) $instance['currency']; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'currency' ); ?>" name="<?php echo $this->get_field_name( 'currency' ); ?>"<?php checked( $currency ); ?> />
			<label for="<?php echo $this->get_field_id( 'currency' ); ?>"><?php _e('Display Currency', 'wpsc_sw'); ?></label>
		</p>
<?php
	}

}
add_action( 'widgets_init',create_function( '', 'return register_widget("WP_Widget_Sales_Widget");' ) );
?>