<?php
if( is_admin() ) {

	/* Start of: WordPress Administration */

	/* WordPress Administration menu */
	function wpsc_wp_admin_menu() {

		add_options_page( __( 'Wholesale Pricing for WP e-Commerce', 'wpsc_wp' ), __( 'Wholesale Pricing', 'wpsc_wp' ), 'manage_options', 'wpsc_wp', 'wpsc_wp_html_page' );

	}
	add_action( 'admin_menu', 'wpsc_wp_admin_menu' );

	function wpsc_wp_init_meta_box() {

		$pagename = 'wpsc-product';
		$post_id = $_GET['post'];
		add_meta_box( 'wpsc_wp_meta_box', __( 'Wholesale Pricing', 'wpsc_wp' ), 'wpsc_wp_meta_box', $pagename, 'normal', 'high' );
		if( get_post_field( 'post_parent', $post_id ) )
			remove_meta_box( 'wpsc_wp_meta_box', 'wpsc-product', 'side' );

	}
	add_action( 'admin_menu', 'wpsc_wp_init_meta_box' );

	function wpsc_wp_add_to_product_form( $order ) {

		if( array_search( 'wpsc_wp_meta_box', (array)$order['side'] ) === false )
			$order['side'][] = 'wpsc_wp_meta_box';

		return $order;

	}
	add_filter( 'wpsc_products_page_forms', 'wpsc_wp_add_to_product_form' );

	function wpsc_wp_meta_box() {

		global $post, $wpdb, $closed_postboxes, $wpsc_wp;

		$product_data = get_post_custom( $post->ID );
		$product_data['meta'] = maybe_unserialize( $product_data );
		foreach( $product_data['meta'] as $meta_key => $meta_value )
			$product_data['meta'][$meta_key] = $meta_value[0];
		$product_meta = maybe_unserialize( $product_data['_wpsc_product_metadata'][0] );

		if( isset( $product_meta['wpsc_wp_checkbox'] ) )
			$checkbox = $product_meta['wpsc_wp_checkbox'];
		else
			$checkbox = false;
		$value = $product_meta['wpsc_wp_value'];
		$amount = $product_meta['wpsc_wp_amount'];
		$method = $product_meta['wpsc_wp_method'];
		$visibility = $product_meta['wpsc_wp_visibility'];
		$fixed = $product_meta['wpsc_wp_fixed'];
		$disregard_product = $product_meta['wpsc_wp_disregard'];
		$editable_roles = wpsc_wp_get_roles();

		include( $wpsc_wp['abspath'] . '/templates/admin/wpsc-admin_wp_product_38.php' );

	}

	/* Add/Edit Categories */
/*
	function wpsc_wp_admin_categories_edit() {

		global $wpsc_wp;

		$editable_roles = wpsc_wp_get_roles();		

		include( $wpsc_wp['abspath'] . '/templates/admin/wpsc-admin_wp_category_38.php' );

	}
	add_action( 'wpsc_product_category_edit_form_fields', 'wpsc_wp_admin_categories_edit' );
*/

	/* End of: WordPress Administration */

}
?>