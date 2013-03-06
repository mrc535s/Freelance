<?php
if( is_admin() ) {

	/* Start of: WordPress Administration */

	function wpsc_sw_check_options_exist() {

		$sample = get_option( 'widget_vl_wpscsw_sales' );
		if( $sample )
			return true;

	}

	/* End of: WordPress Administration */

}
?>