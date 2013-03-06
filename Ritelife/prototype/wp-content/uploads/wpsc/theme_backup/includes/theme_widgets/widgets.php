<?php
/**
 *
 * Widgets and Widget Areas
 *
 * All widget files are included here, and all
 * of the widgeta areas for this theme are setup.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Include Widgets
##############################################################

include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_ad_square_buttons.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_audio.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_author.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_feedback.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_info_box.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_news.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_recent_posts.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_simple_contact.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_tabs.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_twitter.php");
include_once(TEMPLATEPATH . "/includes/theme_widgets/widget_video.php");


##############################################################
# Widget Areas
##############################################################


//Setup widget areas

$page_sidebar = array (
    'name' => 'Pages Sidebar',
    'description' => __('This is your main sidebar that gets shown on most of your pages.'),
    'id' => 'page-sidebar',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
);

$blog_sidebar = array (
    'name' => 'Blog Sidebar',
    'description' => __('This is the sidebar that gets shown on your Blog Page template, blog posts, and pretty much anything else "blog" related.'),
    'id' => 'blog-sidebar',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
);

// Check for static widgets in widget-ready areas
function is_sidebar_active( $index ){

	global $wp_registered_sidebars;
	$widgetcolums = wp_get_sidebars_widgets();
	if ( isset($widgetcolums[$index]) ){
		return true;
	} else {
		return false;
	}
	
}

function theme_widgets_init() {

    ##############################################################
    # Default Widget Areas
    ##############################################################

    //Available Widget Areas
    global $page_sidebar; //Sidebar for Wordpress Pages
    global $blog_sidebar; //Sidebar for Single Posts and Blog Page template pages

    // Pages
    register_sidebar($page_sidebar);

    // Blog Sidebar
    register_sidebar($blog_sidebar);

	##############################################################
    # Homepage Columns
    ##############################################################

    global $themeblvd_homepage_columns;
    
    themeblvd_widget_columns("Homepage Column", "homepage", $themeblvd_homepage_columns);

    ##############################################################
    # Footer Columns
    ##############################################################

    global $themeblvd_footer_columns;
    
    themeblvd_widget_columns("Footer Column", "footer", $themeblvd_footer_columns);

}

add_action( 'init', 'theme_widgets_init' );

?>