<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * File Includes
 * 
 * This file includes all files needed for this theme
 * framwork to work properly.
 *
 * @author  Jason Bobich
 * @version	1.1
 *
 */

##############################################################
# Define Theme Constants
##############################################################

define("CLASSES", TEMPLATEPATH . "/framework/classes/");
define("FUNCTIONS", TEMPLATEPATH . "/framework/functions/");


##############################################################
# (1) Theme Hints
##############################################################

include_once(FUNCTIONS . "themeblvd_theme_hints.php");

##############################################################
# (2) Theme Options
##############################################################

include_once(FUNCTIONS . "themeblvd_admin_head.php");
include_once(CLASSES . "themeblvd_options.php");
include_once(CLASSES . "themeblvd_meta_box.php");

##############################################################
# (3) SEO
##############################################################

include_once(CLASSES . "themeblvd_seo.php");

##############################################################
# (4) Helper Functions
##############################################################

include_once(FUNCTIONS . "comments.php"); //depreciated
include_once(FUNCTIONS . "themeblvd_audio.php");
include_once(FUNCTIONS . "themeblvd_breadcrumbs.php");
include_once(FUNCTIONS . "themeblvd_copyright.php");
include_once(FUNCTIONS . "themeblvd_columns.php"); //depreciated
include_once(FUNCTIONS . "themeblvd_font.php");
include_once(FUNCTIONS . "themeblvd_media.php");
include_once(FUNCTIONS . "themeblvd_menu_fallback.php");
include_once(FUNCTIONS . "themeblvd_pagination.php");
include_once(FUNCTIONS . "themeblvd_rand.php");
include_once(FUNCTIONS . "themeblvd_title.php");
include_once(FUNCTIONS . "themeblvd_video.php");
include_once(FUNCTIONS . "themeblvd_widget_columns.php");
?>