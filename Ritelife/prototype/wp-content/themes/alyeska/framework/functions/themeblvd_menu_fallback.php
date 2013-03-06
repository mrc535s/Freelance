<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Menu Fallback
 *
 * This function shows a menu of pages to
 * be styled with the current theme if the
 * user hasn't assigned a menu under
 * Appearance > Menus.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_menu_fallback(){
	
	$home_text = __("Home", "themeblvd");
	
	echo '<ul class="menu">';
	echo '<li><a href="'.get_bloginfo('url').'" title="'.$home_text.'">'.$home_text.'</a></li>';
	wp_list_pages('title_li=');
	echo '</ul>';

##################################################################
} # end themeblvd_menu_fallback function
##################################################################
?>