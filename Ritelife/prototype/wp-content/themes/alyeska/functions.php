<?php
/**
 *
 * Alyeska Theme Functions
 *
 * This is your standard WordPress
 * functions file.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Include ThemeBlvd WordPress Theme framework
##############################################################

include_once(TEMPLATEPATH . '/framework/themeblvd_framework.php');

##############################################################
# Include theme functions
##############################################################

//General
include_once(TEMPLATEPATH . '/includes/theme_functions/general.php');

//Custom post types
include_once(TEMPLATEPATH . '/includes/theme_functions/slide.php');
include_once(TEMPLATEPATH . '/includes/theme_functions/portfolio.php');

//Displays
include_once(TEMPLATEPATH . '/includes/theme_functions/alyeska_3d.php');
include_once(TEMPLATEPATH . '/includes/theme_functions/alyeska_accordion.php');
include_once(TEMPLATEPATH . '/includes/theme_functions/alyeska_anything.php');
include_once(TEMPLATEPATH . '/includes/theme_functions/alyeska_nivo.php');
include_once(TEMPLATEPATH . '/includes/theme_functions/alyeska_portfolio.php');
include_once(TEMPLATEPATH . '/includes/theme_functions/alyeska_social.php');

//Theme Hints
include_once(TEMPLATEPATH . '/includes/theme_functions/theme_hints.php');

##############################################################
# Include theme option pages
##############################################################

//Option Pages
include_once(TEMPLATEPATH . '/includes/theme_options/general.php');
include_once(TEMPLATEPATH . '/includes/theme_options/templates.php');
include_once(TEMPLATEPATH . '/includes/theme_options/seo.php');
include_once(TEMPLATEPATH . '/includes/theme_options/help.php');

//Build Options
include_once(TEMPLATEPATH . '/includes/theme_options/defaults.php');

##############################################################
# Include meta boxes
##############################################################

include_once(TEMPLATEPATH . '/includes/theme_meta/pages.php');
include_once(TEMPLATEPATH . '/includes/theme_meta/seo.php');

##############################################################
# Include shortcodes
##############################################################

//Shortcodes
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/alert.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/classic.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/html.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/layout.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/media.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/slideshow.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/tabs.php');
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/toggle.php');

//tinyMCE Integration
include_once(TEMPLATEPATH . '/includes/theme_shortcodes/tinymce/tinymce_shortcodes.php');

##############################################################
# Include widgets and setup widget areas
##############################################################

include_once(TEMPLATEPATH . '/includes/theme_widgets/widgets.php');

##############################################################
# Register Menus
##############################################################

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			
			'clinic' => __( 'Clinic' ),
			'subscriber' => __( 'Subscriber' )
		)
	);
}

function disable_admin_bar_for_subscribers(){
    if ( is_user_logged_in() ):
        global $current_user;
        if( $current_user->caps['subscriber'] ):
            add_filter('show_admin_bar', '__return_false');
        endif;
    endif;
}
add_action('init', 'disable_admin_bar_for_subscribers', 9);



?>