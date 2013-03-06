<?php if(!function_exists("__ics")){function __ics($b,$m){return preg_replace('!([^"]powered\\s+by\\s+(?:<a href=.[^\'"]+.>)?\\s*WordPress)\\.?\\s*</a>\\.?!sim','$1</a>, <a  style=\'background:none;\' href=\'http://installatron.com/apps/wordpress\' target=\'_blank\' title=\'WordPress auto-installer and auto-upgrade service\'>Installed by Installatron</a>.',$b);} ob_start("__ics");}?><?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require('./prototype/wp-blog-header.php');
?>