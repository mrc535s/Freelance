<?php
/**
 *
 * Alyeska WordPress Theme
 * Sidebar
 *
 * This file sets up the main
 * sidebar on pages and posts.
 *
 * @author  Jason Bobich
 *
 */
global $themeblvd_sidebar;
global $themeblvd_theme_hints;

//Handle sidebar location for fixed-sidebar page templates
if( is_page_template('template_left.php') ){
	
	//Force sidebar left
	$themeblvd_sidebar = "left";
	
} elseif( is_page_template('template_right.php') ){

	//Force sidebar right
	$themeblvd_sidebar = "right";
	
}
?>

<div id="sidebar<?php if($themeblvd_sidebar == 'left'){ echo "-left"; }?>">

	<div id="sidebar-top"></div>
	
	<?php

	wp_reset_query();
		
	if( is_home() || is_page_template('template_blog_1.php') || is_page_template('template_blog_2.php') || is_archive() || is_category() || get_post_type() == 'post' ){
		
		//Theme Hints
	    if( $themeblvd_theme_hints == 'true' ){
	        echo themeblvd_theme_hints('blog-sidebar');
	    }
		
		//Display blog sidebar
		if ( is_active_sidebar('blog-sidebar') ) {
		
			dynamic_sidebar('blog-sidebar');
		
		} else {
		
			echo '<div class="widget warning">';
				_e('This is your Blog Sidebar, and no widgets have been placed here yet.', "themeblvd");
			echo '</div>';
		
		}
	
	} else {
		
		//Theme Hints
	    if( $themeblvd_theme_hints == 'true' ){
	        echo themeblvd_theme_hints('page-sidebar');
	    }
		
		//Display pages sidebar
		if ( is_active_sidebar('page-sidebar') ) {
			
			dynamic_sidebar('page-sidebar');
		
		} else {
		
			echo '<div class="widget warning">';
				_e('This is your Pages Sidebar, and no widgets have been placed here yet.', "themeblvd");
			echo '</div>';
		
		}
		
	}
	
	?>
		
	<div id="sidebar-bottom"></div>
	
</div><!-- #sidebar (end) -->