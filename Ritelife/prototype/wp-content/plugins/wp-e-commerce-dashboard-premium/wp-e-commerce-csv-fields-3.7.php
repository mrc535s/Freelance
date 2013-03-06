<?php 

function parse_state ($country_state_array) {

	$data = unserialize ( $country_state_array['value'] ) ;

	if ( ! count ( $data ) )
		return $country_state_array['value'];

	$state = $data[1];

	if ( is_numeric($state) ) {

		return wpsc_get_region ($state);

	} else {

		return $state;

	}

}



function output_product_categories ($categories) {

	$cnt = 0;
	$result = '';

	foreach ( $categories as $cat ) {

		if ($cnt)
			$result .= '; ';

		$result .= $cat->name;

		$cnt++;

	}

	return $result;

}



$ses_wpscd_csv_fields_available = Array (
	'order-id' => Array ('Title'=>__('Order ID', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["id"]'),
	'order-date' => Array (	'Title'=>__('Order Date', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["frmtdate"]'),
	'order-time' => Array (	'Title'=>__('Order Time', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["frmttime"]'),
	'tax-total' => Array (	'Title'=>__('Total Order Tax', 'ses_wpscd'),
				'ShowOn' => 'Orders',
				'QueryID'=>'$cart_data["tax"]'),
	'order-total' => Array ('Title'=>__('Total Order Value', 'ses_wpscd'),
				'ShowOn' => 'Orders',
				'QueryID'=>'$purchase["totalprice"]'),
	'discount-code' => Array ('Title'=>__('Discount Code', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["discount_data"]'),
	'discount-amt' => Array ('Title'=>__('Discount Amount', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["discount_value"]'),
	'order-status' => Array ('Title'=>__('Order Status', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["name"]'),
	'totalqty' => Array (	'Title'=>__('Total Items', 'ses_wpscd'),
				'ShowOn' => 'Orders',
				'QueryID'=>'$cart_data["qty"]'),
	'first-name' => Array (	'Title'=>__('First Name', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingfirstname"]["value"]'),
	'surname' => Array (	'Title'=>__('Surname', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billinglastname"]["value"]'),
	'user-id' => Array (	'Title'=>__('User ID', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["user_ID"]'),
	'billing-address' => Array ('Title'=>__('Address', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingaddress"]["value"]'),
	'billing-city' => Array ('Title'=>__('City', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingcity"]["value"]'),
	'billing-state' => Array ('Title'=>__('State', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'parse_state($assoc_checkout["billingcountry"])'),
	'billing-country' => Array ('Title'=>__('Country', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingcountry"]["value"]'),
	'billing-pcode' => Array ('Title'=>__('Postcode', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingpostcode"]["value"]'),
	'billing-email' => Array ('Title'=>__('Email', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingemail"]["value"]'),
	'billing-phone' => Array ('Title'=>__('Phone', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["billingphone"]["value"]'),
	'shipping-name' => Array (	'Title'=>__('Shipping First Name', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["shippingfirstname"]["value"]'),
	'shipping-surname' => Array (	'Title'=>__('Shipping Surname', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["shippinglastname"]["value"]'),
	'shipping-address' => Array ('Title'=>__('Shipping Address', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["shippingaddress"]["value"]'),
	'shipping-city' => Array ('Title'=>__('Shipping City', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["shippingcity"]["value"]'),
	'shipping-state' => Array ('Title'=>__('Shipping State', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'parse_state($assoc_checkout["shippingcountry"])'),
	'shipping-country' => Array ('Title'=>__('Shipping Country', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["shippingcountry"]["value"]'),
	'shipping-pcode' => Array ('Title'=>__('Shipping Postcode', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$assoc_checkout["shippingpostcode"]["value"]'),
	'shipping-module' => Array ('Title'=>__('Shipping Module', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["shipping_method"]'),
	'shipping-quote' => Array ('Title'=>__('Chosen Shipping Rate', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$purchase["shipping_option"]'),
	'shipping-quote-amt' => Array ('Title'=>__('Shipping Rate Amount', 'ses_wpscd'),
				'ShowOn' => 'Orders',
				'QueryID'=>'$purchase["base_shipping"]'),
    'tracking-id' => Array ( 'Title' => __('Tracking ID', 'ses_wpscd'),
                             'ShowOn' => 'Both',
                             'QueryID' => '$purchase["track_id"]'),
	'per-line-shipping' => Array ('Title'=>__('Per Item Shipping', 'ses_wpscd'),
				'ShowOn' => 'Both',
				'QueryID'=>'$cart_data["pnp"]'),
	'orderline-sku' => Array ('Title'=>__('Product SKU', 'ses_wpscd'),
				'ShowOn' => 'Lines',
				'QueryID'=>'$cart_data["sku"]'),
	'orderline-product' => Array ('Title'=>__('Product Description', 'ses_wpscd'),
				'ShowOn' => 'Lines',
				'QueryID'=>'$cart_data["name"]'),
	'orderline-unittax' => Array('Title'=>__('Unit Tax', 'ses_wpscd'),
                                'ShowOn' => 'Lines',
                                'QueryID'=>'$cart_data["unit_tax"]'),
	'orderline-unitprice' => Array('Title'=>__('Unit Price', 'ses_wpscd'),
                                'ShowOn' => 'Lines',
                                'QueryID'=>'$cart_data["unit_price"]'),
	'orderline-qty' => Array ('Title'=>__('Item Qty', 'ses_wpscd'),
				'ShowOn' => 'Lines',
				'QueryID'=>'$cart_data["quantity"]'),
	'orderline-lineprice' => Array ('Title'=>__('Item Line Price', 'ses_wpscd'),
				'ShowOn' => 'Lines',
				'QueryID'=>'$cart_data["line_price"]'),
	'orderline-tax' => Array ('Title'=>__('Total Line Tax', 'ses_wpscd'),
				'ShowOn' => 'Lines',
				'QueryID'=>'$cart_data["line_tax"]'),
	'orderline-linetotal' => Array ('Title'=>__('Total Line Value', 'ses_wpscd'),
				'ShowOn' => 'Lines',
				'QueryID'=>'$cart_data["line_total"]'),
	'orderline-customisation' => Array ('Title'=>__('Personalisation Info', 'ses_wpscd'),
			'ShowOn' => 'Lines',
			'QueryID'=>'$cart_data["custom_message"]'),
	'orderline-productcats' => Array ('Title'=>__('Product Categories', 'ses_wpscd'),
			'ShowOn' => 'Lines',
			'QueryID'=>'output_product_categories($cart_data["product_categories"])'),

	);

?>
