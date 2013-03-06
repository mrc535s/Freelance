<?php
/**
 *
 * Alyeska Shortcodes
 *
 * Toggle
 *
 * @author  Jason Bobich
 *
 */

function toggle_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'title' => 'Enter a Title',
            'style' => 'normal' //normal or fancy
    ), $atts));

    if($style == 'fancy'){
        $styleClass = ' toggle-fancy';
    } else {
        $styleClass = '';
    }

    $output = '<div class="themeblvd-toggle'.$styleClass.'">';
    $output .= '<a href="#" class="trigger"><span>+</span>'.$title.'</a>';
    $output .= '<div class="box">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .box (end) -->';
    $output .= '</div><!-- .themeblvd-toggle (end) -->';

    return $output;

}

add_shortcode('toggle', 'toggle_shortcode');
?>