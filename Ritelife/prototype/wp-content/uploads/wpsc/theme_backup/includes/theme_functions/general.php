<?php
/**
 *
 * Alyeska WordPress Theme
 * General functions
 *
 * This file replaces what most themes use
 * the functions.php file for. These are simply
 * some general functions that help construct
 * the theme.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Thumbnail Sizes
##############################################################

//Support
add_theme_support( 'post-thumbnails', array( 'post', 'slide', 'portfolio-item' ) );

//Sizes
add_image_size( 'micro', 45, 45, true );
add_image_size( 'blog-1', 550, 9999 );
add_image_size( 'blog-2', 200, 200, true );
add_image_size( 'portfolio', 280, 125, true );
add_image_size( 'portfolio-admin', 130, 58, true );
add_image_size( 'slideshow-subpage', 560, 9999, true );
add_image_size( 'slideshow-fullwidth', 920, 9999, true );
add_image_size( 'slideshow-homepage', 940, 350, true );
add_image_size( 'slideshow-admin', 130, 49, true );

##############################################################
# Customize Wordpress Gallery
##############################################################

add_filter('gallery_style',
    create_function(
        '$css',
        'return str_replace("border: 2px solid #cfcfcf;", "", $css);'
        )
    );

##############################################################
# Filters
##############################################################

add_filter('widget_text', 'do_shortcode');

##############################################################
# Theme Support
##############################################################

//Menu Builder
add_theme_support( 'menus' );

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'themeblvd' ),
) );

register_nav_menus( array(
    'footer' => __( 'Footer Navigation', 'themeblvd' ),
) );

//Feed Links
add_theme_support( 'automatic-feed-links' );

//Custom Background
add_custom_background();

// Make theme available for translation
// Translations can be found in the /lang/ directory
load_theme_textdomain( 'themeblvd', TEMPLATEPATH . '/lang' );
?>