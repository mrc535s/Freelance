<?php
/**
 *
 * Alyeska Shortcodes
 *
 * Slideshows
 *
 * @author  Jason Bobich
 *
 */
 
##############################################################
# Anything Slider
##############################################################

function shortcode_slideshow($atts, $content = null) {

    extract(shortcode_atts(array(
    		'category' => '',
            'effect' => 'fade',
            'speed' => '5',
            'color' => '000000',
            'width' => '560',
            'height' => '250'
    ), $atts));

    $output = alyeska_anything($category, $effect, $speed, $color, $width, $height);

    return $output;
    
}

add_shortcode('slideshow', 'shortcode_slideshow');

##############################################################
# Nivo Slider
##############################################################

function shortcode_nivo($atts, $content = null) {

    extract(shortcode_atts(array(
    		'category' => '',
            'effect' => 'random',
            'speed' => '5',
            'slices' => '15',
            'color' => '000000',
            'width' => '560',
            'height' => '250'
    ), $atts));

    $output = alyeska_nivo($category, $effect, $speed, $slices, $color, $width, $height);

    return $output;
    
}

add_shortcode('nivo', 'shortcode_nivo');

?>