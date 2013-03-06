<?php
if( is_admin() ) {

	/* Start of: WordPress Administration */

	function wpsc_wp_check_options_exist() {

		$sample = get_option( 'vl_wpscwp_defaults' );
		if( $sample )
			return true;

	}

	function wpsc_wp_template_header() {

		global $wpsc_wp; ?>
<div id="profile-page" class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php echo $wpsc_wp['menu']; ?></h2>
<?php
	}

	function wpsc_wp_template_footer() { ?>
</div>
<?php
	}

	function wpsc_wp_pd_options_addons( $options ) {

		$roles = wpsc_wp_get_roles();
		if( $roles ) {
			foreach( $roles as $key => $role )
				$options[] = array( 'wholesale_' . $key, __( 'Wholesale Pricing', 'wpsc_wp' ) . ' - ' . $role['name'] );
		}
		return $options;

	}
	add_filter( 'wpsc_pd_options_addons', 'wpsc_wp_pd_options_addons', null, 1 );

	function wpsc_wp_pd_import_addons( $import, $csv_data ) {

		$import->roles = wpsc_wp_get_roles();
		if( $import->roles ) {
			$import->csv_wholesale = array();
			foreach( $import->roles as $key => $role ) {
				if( isset( $csv_data['wholesale_' . $key ] ) ) {
					$import->csv_wholesale[$key] = $csv_data['wholesale_' . $key ];
					$import->log .= "<br />>>> " . __( 'Wholesale Pricing has been detected: ', 'wpsc_pd' ) . $role['name'];
				}
			}
		}
		return $import;

	}
	add_filter( 'wpsc_pd_import_addons', 'wpsc_wp_pd_import_addons', null, 2 );

	function wpsc_wp_pd_product_addons( $product, $import, $count ) {

		if( isset( $import->roles ) ) {
			$product->wholesale = array();
			foreach( $import->roles as $key => $role ) {
				if( $import->csv_wholesale[$key][$count] )
					$product->wholesale[$key] = $import->csv_wholesale[$key][$count];
			}
		}
		return $product;

	}
	add_filter( 'wpsc_pd_product_addons', 'wpsc_wp_pd_product_addons', null, 3 );

	function wpsc_wp_pd_create_product_log_addons( $import, $product ) {

		if( $import->roles && function_exists( 'wpsc_wp_insert_wholesale_price' ) ) {
			foreach( $import->roles as $key => $role ) {
				if( $product->wholesale[$key] )
					wpsc_wp_insert_wholesale_price( $product->ID, $key, $product->wholesale[$key] );
			}
			$import->log .= "<br />>>>>>> " . __( 'Linking Wholesale Pricing', 'wpsc_pd' );
		}
		return $import;

	}
	add_filter( 'wpsc_pd_create_product_log_addons', 'wpsc_wp_pd_create_product_log_addons', null, 2 );

	/* End of: WordPress Administration */

} else {

	/* Start of: Storefront */

	/**
	 * The Wholesale Pricing front-end function.
	 *
	 * The function is responsible for returning the adjusted Product price within the WP e-Commerce Product page.
	 *
	 * @param string $price Original price from WP e-Commerce.
	 * @param string $product_id Optional, Product ID within WP e-Commerce.
	 * @return string Adjusted Product price.
	 */
	function wpsc_wp_wholesale_price( $price, $product_id = null, $role = null ) {

		switch( wpsc_get_major_version() ) {

			case '3.7':
				break;

			case '3.8':
				global $post;

				$post_id = $post->ID;
				if( !$post_id )
					$post_id = $product_id;
				if( get_post_field( 'post_parent', $post_id ) )
					$post_id = get_post_field( 'post_parent', $post_id );
				$product_data = get_post_custom( $post_id );
				$product_data['meta'] = maybe_unserialize( $product_data );
				if( $product_data['meta'] ) {
					foreach( $product_data['meta'] as $meta_key => $meta_value )
						$product_data['meta'][$meta_key] = $meta_value[0];
					$product_meta = maybe_unserialize( $product_data['_wpsc_product_metadata'][0] );
					if( isset( $product_meta['wpsc_wp_disregard'] ) )
						$disregard_product = $product_meta['wpsc_wp_disregard'];
				}
				break;

		}

		if( !isset( $disregard_product ) )
			$disregard_product = 'off';

		if( is_user_logged_in() ) {

			if( !$role ) {

				global $current_user;

				get_currentuserinfo();
				$role = $current_user->roles[0];

			}
			switch( wpsc_get_major_version() ) {

				case '3.7':
					$checkbox = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_checkbox', true );
					break;

				case '3.8':
					if( isset( $product_meta['wpsc_wp_checkbox'] ) )
						$checkbox = $product_meta['wpsc_wp_checkbox'];
					break;

			}
		} else {
			if( !$role )
				$role = 'guest';
		}
		if( !isset( $checkbox ) )
			$checkbox = false;
		if( $checkbox[$role] == 'on' ) {

			// User per-Product pricing for that User Role, including Site Visitors
			switch( wpsc_get_major_version() ) {

				case '3.7':
					$value = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_value', true );
					$amount = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_amount', true );
					$method = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_method', true );
					$fixed = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_fixed', true );
					break;

				case '3.8':
					$value = $product_meta['wpsc_wp_value'][$role];
					$amount = $product_meta['wpsc_wp_amount'][$role];
					$method = $product_meta['wpsc_wp_method'][$role];
					$fixed = $product_meta['wpsc_wp_fixed'][$role];
					break;

			}

		} else {

			$defaults = maybe_unserialize( get_option( 'wpsc_wp_defaults' ) );
			if( $role <> 'guest' ) {

				// Use default per-User Role pricing for that Product

				$value = $defaults[$role]['value'];
				$amount = $defaults[$role]['amount'];
				$method = $defaults[$role]['method'];

			} else {

				// Use default per-User Role pricing for that Product

				$value = $defaults['guest']['value'];
				$amount = $defaults['guest']['amount'];
				$method = $defaults['guest']['method'];

			}

		}

		if( !isset( $fixed ) )
			$fixed = false;
		if( $fixed && !wpsc_wp_is_empty_fixed_price( $fixed ) ) {

			$price = $fixed;

		} else if( $value && $amount && $method ) {

			if( $amount > 0 ) {
				switch( $method ) {

					case '$':
						switch( $value ) {

							case '+':
							default:
								$price = $price + $amount;
								break;

							case '-':
								$price = $price - $amount;
								break;

						}
						break;

					case '%':
						switch( $value ) {

							case '+':
							default:
								$price = $price + ( ( $price / 100 ) * $amount );
								break;

							case '-':
								$price = $price - ( ( $price / 100 ) * $amount );
								break;

						}
						break;

				}
			}
			if( $price < 0 )
				$price = 0;

		}

		return $price;

	}
	add_filter( 'wpsc_do_convert_price', 'wpsc_wp_wholesale_price', 10, 1 );
	add_filter( 'wpsc_price', 'wpsc_wp_wholesale_price', 10, 2 );

/*
	function wpsc_wp_tax_exemption() {

		$wpec_taxes->taxes_options['wpec_taxes_enabled'] = 0;

		global $wpsc_cart;

		$wpsc_cart->tax_percentage = 0.00;
		$wpsc_cart->total_tax = 0.00;
		if( $wpsc_cart->cart_items ) {
			foreach( $wpsc_cart->cart_items as $key => $cart_item ) {
				$wpsc_cart->cart_items[$key]->tax = 0.00;
				$wpsc_cart->cart_items[$key]->apply_tax = 0;
				$wpsc_cart->cart_items[$key]->tax_rate = 0;
			}
		}
		print_r( $wpsc_cart );
*/
		//print_r( $_SESSION['wpsc_cart'] );

		//global $wpec_taxes;

		//$wpec_taxes = new wpec_taxes();
		//$wpec_taxes->taxes_options['wpec_taxes_enabled'] = 0;

/*
		$options = array(
			'wpec_taxes_enabled' => 0
		);
		$wpec_taxes->wpec_taxes_set_options( $options );
		print_r( $wpec_taxes );

	}
	add_filter( 'wpec_taxes_get_rate', 'wpsc_wp_tax_exemption' );
*/

	function wpsc_wp_is_empty_fixed_price( $price ) {

		switch( $price ) {

			case '0';
			case '0.00':
				return true;
				break;

		}

	}

	function wpsc_wp_is_product_visible() {

		switch( wpsc_get_major_version() ) {

			case '3.7':
				$checkbox = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_checkbox', true );
				break;

			case '3.8':

				global $post;

				$post_id = $post->ID;
				if( !$post_id )
					$post_id = $product_id;
				$product_data = get_post_custom( $post_id );
				$product_data['meta'] = maybe_unserialize( $product_data );
				if( $product_data['meta'] ) {
					foreach( $product_data['meta'] as $meta_key => $meta_value )
						$product_data['meta'][$meta_key] = $meta_value[0];
					$product_meta = maybe_unserialize( $product_data['_wpsc_product_metadata'][0] );
					if( isset( $product_meta['wpsc_wp_checkbox'] ) )
						$checkbox = $product_meta['wpsc_wp_checkbox'];
				}
				break;

		}

		if( is_user_logged_in() ) {
			global $current_user;
			get_currentuserinfo();
			$role = $current_user->roles[0];
		} else {
			$role = 'guest';
		}
		if( isset( $checkbox ) ) {
			if( $checkbox[$role] == 'on' ) {

				// User per-Product visibility for that User Role, including Site Visitors
				switch( wpsc_get_major_version() ) {

					case '3.7':
						$visibility = get_product_meta( wpsc_the_product_id(), 'wpsc_wp_visibility', true );
						break;

					case '3.8':
						$visibility = $product_meta['wpsc_wp_visibility'][$role];
						break;

				}

			}
			switch( $visibility ) {

				case '0':
					return false;
					break;

				case '1':
					return true;
					break;

			}

		} else {

			return true;

		}

	}

	/* End of: Storefront */

}

function wpsc_wp_get_roles() {

	$roles = get_editable_roles();
	$roles['guest'] = array( 'name' => 'Site Visitor / Guest' );
	return $roles;

}
?>