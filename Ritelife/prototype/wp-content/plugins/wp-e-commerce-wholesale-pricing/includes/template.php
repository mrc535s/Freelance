<?php
function wpsc_wp_original_price() {

	$product_id = wpsc_the_product_id();
	if( $product_id ) {
		$price = wpsc_wp_get_original_price( $product_id );
		switch( wpsc_get_major_version() ) {

			case '3.7':
				return nzshpcrt_currency_display( $price, true, true );
				break;

			case '3.8':
				return wpsc_currency_display( $price );
				break;

		}
	}

}

function wpsc_wp_get_original_price( $product_id = null ) {

	global $wpdb;

	if( !$product_id )
		$product_id = wpsc_the_product_id();

	if( $product_id ) {
		switch( wpsc_get_major_version() ) {

			case '3.7':
				$full_price = $wpdb->get_var( "SELECT `price` FROM `" . $wpdb->prefix . "wpsc_product_list` WHERE `id` = " . $product_id . " LIMIT 1" );
				$special_price = $wpdb->get_var( "SELECT `special_price` FROM `" . $wpdb->prefix . "wpsc_product_list` WHERE `id` = " . $product_id . " LIMIT 1" );
				$price = $full_price;
				if( ( $full_price > $special_price ) && ( $special_price > 0 ) )
					$price = $full_price - $special_price;
				break;

			case '3.8':
				$full_price = get_product_meta( $product_id, 'price', true );
				$special_price = get_product_meta( $product_id, 'special_price', true );
				$price = $full_price;
				if( ( $full_price > $special_price ) && ( $special_price > 0 ) )
					$price = $special_price;
				break;

		}
		return $price;
	}

}

function wpsc_wp_you_save( $args = null ) {

	$defaults = array(
		'type' => 'percentage',
		'echo' => true,
		'product_id' => wpsc_the_product_id(),
		'symbol' => '%'
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	if( $product_id ) {

		$original_price = wpsc_wp_get_original_price();
		$wholesale_price = wpsc_vl_product_price( $product_id, false );
		if( $original_price ) {
			switch( $type ) {

				case 'amount':
					$output = wpsc_vl_currency_display( $original_price - $wholesale_price, false );
					break;

				default:
					$output = number_format( ( $original_price - $wholesale_price ) / $original_price * 100 );
					if( $symbol )
						$output .= $symbol;
					break;

			}
		}
		if( $echo )
			echo $output;
		else
			return $output;
	}

}

function wpsc_wp_role_price( $role = null ) {

	$args = array(
		'role' => $role
	);
	wpsc_wp_get_role_price( $args );

}

	function wpsc_wp_get_role_price( $args = null ) {

		$defaults = array(
			'role' => '',
			'product_id' => wpsc_the_product_id(),
			'echo' => true
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		if( $role ) {
			$original_price = wpsc_wp_get_original_price( $product_id );
			$wholesale_price = wpsc_wp_wholesale_price( $original_price, $product_id, $role );
			$output = wpsc_vl_currency_display( $wholesale_price, false );
		}
		if( $echo )
			echo $output;
		else
			return $output;

	}
?>