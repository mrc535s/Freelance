<?php
/**
 *
 * Alyeska WordPress Theme
 * Slideshows
 *
 * This file setups the custom post type Slide
 * and creates an associated taxonomy, Slideshows.
 *
 * @author  Jason Bobich
 *
 */

global $shortname;

##############################################################
# Register custom post type
##############################################################

$labels_slide = array(
    'add_new_item' => __('Add New Slide', 'themeblvd'),
    'edit_item' => __('Edit Slide', 'themeblvd'),
    'new_item' => __('New Slide', 'themeblvd'),
    'view_item' => __('Preview Slide', 'themeblvd'),
    'search_items' => __('Search Slides', 'themeblvd'),
    'not_found' => __('No slides found.', 'themeblvd'),
    'not_found_in_trash' => __('No slides found in Trash.', 'themeblvd')
);

register_post_type('slide', array(
    'label' => __('Slides', 'themeblvd'),
    'labels' => $labels_slide,
    'singular_label' => __('Slide', 'themeblvd'),
    'public' => true,
    'show_ui' => true, // UI in admin panel
    '_builtin' => false, // It's a custom post type, not built in
    'exclude_from_search' => true, // Exclude from Search Results
    'capability_type' => 'page',
    'hierarchical' => true,
    'rewrite' => array("slug" => "slide"), // Permalinks
    'query_var' => "slide", // This goes to the WP_Query schema
    'supports' => array('title', 'thumbnail', 'page-attributes', 'editor'/*,'author', 'excerpt' ,'custom-fields'*/), // Let's use custom fields for debugging purposes only
    'menu_icon' => get_template_directory_uri() . '/framework/layout/images/icon_slides.png'
));

##############################################################
# Register associated taxonomy
##############################################################

$labels_slideshow = array(
    'name' => __('Slideshows', 'post type general name'),
    'all_items' => __('All Slideshows', 'all items'),
    'add_new_item' => __('Add New Slideshow', 'adding a new item'),
    'new_item_name' => __('New Slideshow Name', 'adding a new item'),
);

$args_slideshow = array(
    'labels' => $labels_slideshow,
    'hierarchical' => true
);

register_taxonomy( 'slideshows', 'slide', $args_slideshow );

##############################################################
# Customize Manage Posts interface
##############################################################

function edit_columns_slide($columns) {
    
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Slide Title",
        "themeblvd_slideshows" => "Slideshow",
        "themeblvd_slide_type" => "Slide Type",
        "themeblvd_slide_image" => "Image"
    );

    return $columns;
}

function custom_columns_slide($column) {
    global $post;
    switch ($column) {

        case "themeblvd_slide_image":
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('slideshow-admin');
            } else {

                $slide_type = get_post_meta($post->ID, "themeblvd_slide_type", true);

                if($slide_type == 'true') {
                    _e("Oops! This is an image slide, but you forgot a featured image.", "themeblvd");
                } else {
                    _e("No featured image.", "themeblvd");
                }

                //print __('No featured image.', 'themeblvd');
            }
            break;

        case "themeblvd_slideshows":

            $slideshows = get_the_terms(0, "slideshows");
            $slideshows_html = array();
            if($slideshows) {
                foreach ($slideshows as $slideshow)
                    array_push($slideshows_html, $slideshow->name);

                echo implode($slideshows_html, ", ");
            }
            break;

        case "themeblvd_slide_type":

            $slide_type = get_post_meta($post->ID, "themeblvd_slide_type", true);

            if($slide_type == 'true') {
                _e("Image Slide", "themeblvd");
            } else {
                _e("Content Slide", "themeblvd");
            }

            break;

    }
}

add_filter("manage_edit-slide_columns", "edit_columns_slide");
add_action("manage_pages_custom_column", "custom_columns_slide");

##############################################################
# Define metaboxs
##############################################################

//General options
$slide_meta_box1 = array(

    array(  "name" => __("What kind of slide is this?", "themeblvd"),
            "option1" => __("Image Slide", "themeblvd"),
            "option2" => __("Content Slide"),
            "desc" => __("An image slide will use the featured image for the slide area, while a content slide will output the content entered above in the main content editor.", "themeblvd"),
            "id" => "themeblvd_slide_type",
            "std" => "true",
            "type" => "true_false_radio"
    )
    
);

$slide_meta_info1 = array(
    'id'=>'slide1',
    'title' => 'General Slide Options',
    'page'=> array('slide'),
    'context'=>'normal', //normal or side
    'priority'=>'high', //high or low
    'callback'=>''
);

$themeblvd_slide1 = new themeblvd_meta_box($slide_meta_info1 , $slide_meta_box1);

//Image Slide options
$slide_meta_box2 = array(

    array(  "desc" => __("If you selected for this to be an \"Image Slide\" in the general option above, these options will configure this image slide. If you've selected this to be an image slide, and you leave the following options blank, nothing but your featured image set over to the right will show. The featured image will automatically be scaled and cropped to be 960x350. So, make sure you upload an image that is atleast that large. Completely ignore these options if this is a content slide.", $shortname),
            "type" => "description"
    ),

    array(  "name" => __("Description (optional)", $shortname),
            "desc" => __("Enter in a description you want to show over the image. Leave blank if you do not want a description to show.", $shortname),
            "id" => "themeblvd_slide_description",
            "std" => "",
            "type" => "textarea"
    ),

    array(  "name" => __("Image Link (optional)", "themeblvd"),
            "desc" => __("Enter where you'd like this image slide to link to. Leave this option blank if you do not want this slide to be clickable.", "themeblvd"),
            "id" => "themeblvd_slide_link",
            "std" => "",
            "type" => "text",
    )

);

$slide_meta_info2 = array(
    'id'=>'slide2',
    'title' => 'Image Slide Options',
    'page'=> array('slide'),
    'context'=>'normal', //normal or side
    'priority'=>'high', //high or low
    'callback'=>''
);

$themeblvd_slide2 = new themeblvd_meta_box($slide_meta_info2 , $slide_meta_box2);


?>