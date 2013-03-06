<?php
/**
 *
 * ThemeBlvd Theme Meta Box
 * Page Options Meta Box
 *
 * This meta box gets displays on pages.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Key Elements
##############################################################

$shortname = "themeblvd";

##############################################################
# Options
##############################################################

$options = array(

    array(  "name" => __("Page Title", $shortname),
            "option1" => __("Show page title.", $shortname),
            "option2" => __("Hide page title.", $shortname),
            "desc" => __("This will determine whether the title of this particular page shows or not on the front-end of your website.", $shortname),
            "id" => $shortname."_pagetitle",
            "std" => "true",
            "type" => "true_false_radio"
    )

);

##############################################################
# Information
##############################################################

$info = array(
    'id'=>'page-options',
    'title' => 'Page Options',
    'page'=> array('page'),
    'context'=>'side', //normal or side
    'priority'=>'low', //high or low
    'callback'=>''
);

##############################################################
# Activate Meta Box
##############################################################

$themeblvd_page_options = new themeblvd_meta_box($info, $options);
