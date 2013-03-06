<?php
/**
 *
 * ThemeBlvd Theme Options
 * Theme Help
 *
 * This file constructs the Help page.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Key Elements
##############################################################

$themename = "Alyeska";
$shortname = "themeblvd";

##############################################################
# Options
##############################################################

$options_help = array (

    //Theme Hints
    array(  "type" => "start",
            "name" => "Theme Hints",
            "id" => "hints",
            "icon" => "help"
    ),

    array(  "desc" => __("Don't you hate when you first install a premium WordPress theme and everything looks blank? You wonder why it doesn't look like that awesome live demo you saw before you bought it? Well, now your journey to setting up your site begins, and Theme Hints can help. When turned on, <em>Theme Hints</em> will help you setup your website by giving you little hints as you browse the front-end of your website that explain how different elements of your website are effected and where to edit them. Then, simply switch <em>Theme Hints</em> off when you're ready to go live to the world!", $shortname),
            "type" => "description"
    ),

    array(  "name" => __("Show Theme Hints?", $shortname),
            "desc" => __("When turned on, you can browse the front-end of your website and see clues on editing all the different areas of your site.", $shortname),
            "id" => $shortname."_theme_hints",
            "std" => "false",
            "type" => "true_false_radio",
            "option1" => __("Yes, turn on Theme Hints.", $shortname),
            "option2" => __("No, turn them off.", $shortname)
    ),

    array ( "type" => "end"),

    //Video tutorials
    array(  "type" => "start",
            "name" => "Video Tutorials",
            "id" => "videos",
            "icon" => "video"
    ),
    
    array(  "type" => "vimeo",
        "name" => "Theme Overview",
        "video-url" => "http://vimeo.com/20280926",
        "desc" => "This perhaps the most important video to get started with Alyeska. It will walk through exactly how the demo's homepage is setup and show you how each element is controlled."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Browse Theme Options",
	        "video-url" => "http://vimeo.com/20280547",
	        "desc" => "One of the first things you should do after installing the theme is browse your theme options."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Built-in Documentation",
	        "video-url" => "http://vimeo.com/20280407",
	        "desc" => "Utilize the theme's built-in documentation."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Theme Hints",
	        "video-url" => "http://vimeo.com/20280489",
	        "desc" => "Theme Hints explained."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Font Control",
	        "video-url" => "http://vimeo.com/20158583",
	        "desc" => "Learn more about the font control settings."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Creating Menus",
	        "video-url" => "http://vimeo.com/16685579",
	        "desc" => "Learn how to create menus under Appearance > Menus."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Lightbox Integration",
	        "video-url" => "http://vimeo.com/16686084",
	        "desc" => "Learn how to link to a lightbox popup from any page or post."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Creating Galleries",
	        "video-url" => "http://vimeo.com/16686184",
	        "desc" => "See how you can quickly create a gallery with WordPress and then see how the theme applies lightbox functionality to it."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Page Templates - Archives & Sitemap",
	        "video-url" => "http://vimeo.com/16686604",
	        "desc" => "Learn how to use the Archives and Sitemap page templates."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Page Templates - Contact Page",
	        "video-url" => "http://vimeo.com/16687043",
	        "desc" => "Learn how to use the Contact page template."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Page Templates - Full Width Page",
	        "video-url" => "http://vimeo.com/16687075",
	        "desc" => "Learn how to use the Full Width page template."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Page Templates - Page Redirect",
	        "video-url" => "http://vimeo.com/16687272",
	        "desc" => "Learn how to use the Page Redirect template."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Slideshows",
	        "video-url" => "http://vimeo.com/20279926",
	        "desc" => "Learn how slidshows work."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Slideshow Shortcode",
	        "video-url" => "http://vimeo.com/20280115",
	        "desc" => "Learn how to insert a slideshow on any post or page."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Portfolios",
	        "video-url" => "http://vimeo.com/16688488",
	        "desc" => "Learn how portfolios work."
	),
	
	array(  "type" => "vimeo",
	        "name" => "ThemeBlvd SEO Plugin Overview",
	        "video-url" => "http://vimeo.com/16689126",
	        "desc" => "Learn how this theme's built-in SEO plugin works."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Alyeska Bonus Content",
	        "video-url" => "http://vimeo.com/20323976",
	        "desc" => "Alyeska comes with tons of bonus content. Learn how to utilize it in your site."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Configuring Your Logo",
	        "video-url" => "http://vimeo.com/20324342",
	        "desc" => "This video is for absolute newbies and will guide you through getting a logo up on to your site."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Using Child Themes",
	        "video-url" => "http://vimeo.com/20325009",
	        "desc" => "Learn how to make customizations to your theme the 'right' way."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Hiding the Theme Options Panels",
	        "video-url" => "http://vimeo.com/20325307",
	        "desc" => "You may want to hide the ThemeBlvd options panels in order not to confuse your users or your clients. This video will show you how to do that."
	),
	
	array(  "type" => "vimeo",
	        "name" => "Setting a blog as your homepage",
	        "video-url" => "http://vimeo.com/20324662",
	        "desc" => "This video will show you to how to set a blog for your homepage like a more classic style WordPress theme."
	),
	
	array(  "type" => "vimeo",
	        "name" => "How to show widgets on certain pages only",
	        "video-url" => "http://vimeo.com/20159211",
	        "desc" => "You can accomplish showing widgets on certain pages only by using the Widget Logic WordPress Plugin. This video will explain how."
	),

    array ( "type" => "end"),
    

);

##############################################################
# Information
##############################################################

$info = array(
    "pageTitle" => "Theme Help",
    "menuTitle" => "Help",
    "pageLevel" => "child",
    "pageSlug" => "help",
    "linkSupport" => "http://themeforest.net/user/themeblvd",
    "linkSite" => "http://themeforest.net/user/themeblvd/portfolio",
    "linkAuthor" => "http://www.jasonbobich.com",
    "linkProfile" => "http://www.themeforest.net/user/themeblvd"
);

##############################################################
# Activate Options Page
##############################################################

$themeblvd_options_seo = new themeblvd_options($info, $shortname, $themename, $options_help);

##############################################################
# Activate SEO Plugin
##############################################################

$seo = new themeblvd_seo($options_seo);

?>