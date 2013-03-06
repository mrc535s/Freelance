<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 */


if ( ! class_exists ( 'ses_wpscd_dashboard_widgets' ) ) {

	class ses_wpscd_dashboard_widgets {



		public $widgets = Array();



		function __construct() {

			add_action ( 'admin_init', array ( &$this, 'init' ) );
			add_action ( 'wp_dashboard_setup', array ( &$this, 'add_dashboard_widgets' ) );

		}



		// Any widgets with AJAX handlers are instantiated and hooked AJAX here, rather than waiting for wp_dashboard_setup
		function init() {

			global $can_view_store_reports;

			if ( $can_view_store_reports || current_user_can('view_store_sales_widget') ) {

				include("widgets/product_sales.php");
				$this->widgets['product_sales'] = new ses_wpscd_product_sales_widget;
				add_action('wp_ajax_ses_wpscd_ps_ajax', array ( &$this->widgets['product_sales'], 'render_data' ) );

			}
		}



		function add_dashboard_widgets() {
	
			global $can_view_store_reports;
	
			if ( $can_view_store_reports || current_user_can('view_store_sales_graph') ) {
	
				include( 'widgets/sales_graph.php' );
				$this->widgets['sales_graph'] = new ses_wpscd_sales_graph;
				wp_add_dashboard_widget( 'ses_wpscd_sales_widget', 'Store &raquo; Sales', array ( &$this->widgets['sales_graph'], 'render' ), array ( &$this->widgets['sales_graph'], 'config' ) );	
			}
	
			if ( $can_view_store_reports || current_user_can('view_store_revenue_graph') ) {

				include("widgets/revenue_graph.php");
				$this->widgets['revenue_graph'] = new ses_wpscd_revenue_graph;
				wp_add_dashboard_widget( 'ses_wpscd_revenue_widget', 'Store &raquo; Revenue', array ( &$this->widgets['revenue_graph'], 'render' ), array ( &$this->widgets['revenue_graph'], 'config' ) );

			}
	
			if ( $can_view_store_reports || current_user_can('view_store_stock_alerts') ) {

				include("widgets/stock_alerts.php");
				$this->widgets['stock_alerts'] = new ses_wpscd_stock_alerts_widget;
				wp_add_dashboard_widget ( 'ses_wpscd_stock_alerts', 'Store &raquo; Stock Alerts', array ( &$this->widgets['stock_alerts'], 'render' ), array ( &$this->widgets['stock_alerts'], 'config') );

			}

			if ( $can_view_store_reports || current_user_can('view_store_orders_widget') ) {

				include("widgets/recent_orders.php");
				$this->widgets['recent_orders'] = new ses_wpscd_recent_orders_widget;
				wp_add_dashboard_widget ( 'ses_wpscd_recent_orders_widget', 'Store &raquo; Recent Orders', array ( &$this->widgets['recent_orders'], 'render' ), array ( &$this->widgets['recent_orders'], 'config' ) );

			}
	
			if ( $can_view_store_reports || current_user_can('view_store_items_to_ship_widget') ) {

				include("widgets/items_to_ship.php");
				$this->widgets['items_to_ship'] = new ses_wpscd_items_to_ship_widget;
				wp_add_dashboard_widget ( 'ses_wpscd_items_to_ship_widget', 'Store &raquo; Items To Ship', array ( &$this->widgets['items_to_ship'], 'render' ), array ( &$this->widgets['items_to_ship'], 'config' ));

			}
	
			if ( $can_view_store_reports || current_user_can('view_store_ratings_widget') ) {

				include("widgets/product_ratings.php");
				$this->widgets['product_ratings'] = new ses_wpscd_product_ratings_widget;
				wp_add_dashboard_widget('ses_wpscd_recent_product_ratings', 'Store &raquo; Recent Ratings', array ( &$this->widgets['product_ratings'], 'render' ), array ( &$this->widgets['product_ratings'], 'config' ));

			}
	
			if ( $can_view_store_reports || current_user_can('view_store_sales_widget') ) {

				// Already instantiated - see init()
				wp_add_dashboard_widget ( 'ses_wpscd_product_sales', 'Store &raquo; Product Sales', array ( &$this->widgets['product_sales'], 'render' ), array ( &$this->widgets['product_sales'], 'config' ));

			}
	
		} 

	}

}
	
	
	
/***********************************************************
** Graph of financial purchase volumes
***********************************************************/
	
function ses_wpscd_revenue_graph() {

	include("widgets/revenue_graph.php");

} 
	


?>
