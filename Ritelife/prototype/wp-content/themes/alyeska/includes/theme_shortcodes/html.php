<?php
/**
 *
 * Alyeska Shortcodes
 *
 * HTML Styles
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Lists
##############################################################

function icon_list_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'style' => 'check' //check, crank, delete, doc, plus, star, star2, warning, write
    ), $atts));

    $output = '<div class="icon-list icon-'.$style.'">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .icon-list (end) -->';

    return $output;

}

add_shortcode('icon_list', 'icon_list_shortcode');

##############################################################
# Frames
##############################################################

function frame_shortcode($atts, $content = null) {

    $output = '<div class="frame">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame', 'frame_shortcode');

function frame_left_shortcode($atts, $content = null) {

    $output = '<div class="frame alignleft">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame_left', 'frame_left_shortcode');

function frame_right_shortcode($atts, $content = null) {

    $output = '<div class="frame alignright">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame_right', 'frame_right_shortcode');

##############################################################
# Button
##############################################################

function button_shortcode($atts, $content = null) {

	extract(shortcode_atts(
        array(
            'link' => 'http://www.google.com',
            'text' => 'Button Text'
    ), $atts));
    
    $output =  '<a href="'.$link.'" title="'.$text.'" class="button">';
	$output .= '	<span class="left">';
	$output .= '		<span class="right">';
	$output .= '			<span class="middle">'.$text.'</span>';
	$output .= '		</span><!-- .right (end) -->';
	$output .= '	</span><!-- .left (end) -->';
	$output .= '</a><!-- .button (end) -->';

    return $output;

}

add_shortcode('button', 'button_shortcode');

##############################################################
# Icon Link
##############################################################

function icon_link_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'icon' => 'check',
            'link' => 'Link Text',
            'text' => 'http://www.google.com'
    ), $atts));

    $output =	'<span class="icon-link">';
    $output .=	'	<a href="'.$link.'" title="'.$text.'" class="icon-link-'.$icon.'">';
    $output .=	'		'.$text;
    $output .=	'	</a>';
    $output .= 	'</span>';

    return $output;

}

add_shortcode('icon_link', 'icon_link_shortcode');

##############################################################
# Text Highlight
##############################################################

function highlight_shortcode($atts, $content = null) {

    $output = '<span class="text-highlight">';
    $output .= do_shortcode($content);
    $output .= '</span><!-- .text-highlight (end) -->';

    return $output;

}

add_shortcode('highlight', 'highlight_shortcode');

##############################################################
# Dropcaps
##############################################################

function dropcap_shortcode($atts, $content = null) {

    $output = '<span class="dropcap">';
    $output .= do_shortcode($content);
    $output .= '</span><!-- .dropcap (end) -->';

    return $output;

}

add_shortcode('dropcap', 'dropcap_shortcode');

##############################################################
# Horizontal Rule
##############################################################

function hr_shortcode($atts, $content = null) {

    $output = '<div class="hr"><!-- --></div>';

    return $output;

}

add_shortcode('hr', 'hr_shortcode');

##############################################################
# Remove WP Automatic Formatting
##############################################################

function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 10);
?>