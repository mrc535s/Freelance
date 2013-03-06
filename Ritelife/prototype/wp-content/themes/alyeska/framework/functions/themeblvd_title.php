<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Default <Title>
 *
 * This function gets used in header.php if built-in
 * SEO is disabled or the site is set to private.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_title(){

    if ( is_single() ) {

        bloginfo('name');
        print ' | ';
        single_post_title();

    } elseif ( is_home() || is_front_page() ) {

        bloginfo('name');
        print ' | ';
        bloginfo('description');
        
        if (get_query_var('paged')) {
	        print ' | ' . __( 'Page ' , 'themeblvd') . get_query_var('paged');
	    }

    } elseif ( is_page() ) {

        bloginfo('name');
        print ' | ';
        single_post_title();
        
        if (get_query_var('paged')) {
	        print ' | ' . __( 'Page ' , 'themeblvd') . get_query_var('paged');
	    }

    } elseif ( is_search() ) {

        bloginfo('name');
        print ' | ' . __('Search results for ', 'themeblvd') . wp_specialchars($s);
        
        if (get_query_var('paged')) {
	        print ' | ' . __( 'Page ' , 'themeblvd') . get_query_var('paged');
	    }

    } elseif ( is_404() ) {

        bloginfo('name');
        print ' | Not Found';

    } else {

        bloginfo('name');
        wp_title('|');
        
        if (get_query_var('paged')) {
	        print ' | ' . __( 'Page ' , 'themeblvd') . get_query_var('paged');
	    }

    }
  
##################################################################
} # end themeblvd_title function
##################################################################
?>