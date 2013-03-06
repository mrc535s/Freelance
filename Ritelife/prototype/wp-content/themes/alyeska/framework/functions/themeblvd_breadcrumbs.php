<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Breadcrumbs
 *
 * This is a simple function that displays
 * breadcrumbs.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_breadcrumbs(){
	
	if(function_exists('bcn_display')){
	
		echo '<div id="breadcrumbs">';
    	bcn_display();
    	echo '</div>';
	
	}
	
##################################################################
} # end themeblvd_breadcrumbs function
##################################################################
?>