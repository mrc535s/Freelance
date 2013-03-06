<?php
if( is_admin() ) {

	/* Start of: WordPress Administration */

	/* WordPress Administration menu */
	function wpsc_wp_add_modules_admin_pages( $page_hooks, $base_page ) {

		$page_hooks[] = add_submenu_page( $base_page, __( 'Wholesale Pricing for WP e-Commerce', 'wpsc_wp' ), __( 'Wholesale Pricing', 'wpsc_wp' ), 7, 'wpsc_wp', 'wpsc_wp_html_page' );
		return $page_hooks;

	}
	add_filter( 'wpsc_additional_pages', 'wpsc_wp_add_modules_admin_pages', 10, 2 );

	function wpsc_wp_init_meta_box() {

		$pagename = 'store_page_wpsc-edit-products';
		add_meta_box( 'wpsc_wp_meta_box', __( 'Wholesale Pricing', 'wpsc_wp' ), 'wpsc_wp_meta_box', $pagename, 'normal', 'high' );

	}
	add_action( 'admin_menu', 'wpsc_wp_init_meta_box' );

	function wpsc_wp_add_to_product_form( $order ) {

		$pagename = 'store_page_wpsc-edit-products';
		if(array_search( 'wpsc_wp_meta_box', (array)$order ) === false)
			$order[] = 'wpsc_wp_meta_box';

		return $order;

	}
	add_filter( 'wpsc_products_page_forms', 'wpsc_wp_add_to_product_form' );

	function wpsc_wp_meta_box( $product_data = array() ) {

		global $wpdb, $closed_postboxes, $wpsc_wp;

		$editable_roles = wpsc_wp_get_roles();		
		$checkbox = get_product_meta( $product_data['id'], 'wpsc_wp_checkbox', true );
		$value = get_product_meta( $product_data['id'], 'wpsc_wp_value', true );
		$amount = get_product_meta( $product_data['id'], 'wpsc_wp_amount', true );
		$method = get_product_meta( $product_data['id'], 'wpsc_wp_method', true );
		$fixed = get_product_meta( $product_data['id'], 'wpsc_wp_fixed', true );
		$visibility = get_product_meta( $product_data['id'], 'wpsc_wp_visibility', true );
		$disregard_product = get_product_meta( $product_data['id'], 'wpsc_wp_disregard', true );

		include( $wpsc_wp['abspath'] . '/templates/admin/wpsc-admin_wp_product_37.php' );

	}

	/* End of: WordPress Administration */

}
?>