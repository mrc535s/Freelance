<?php
/**
 *
 * Alyeska Shortcodes
 *
 * Layout grids.
 *
 * @author  Jason Bobich
 *
 */

//clear
function shortcode_clear() {
	return '<div class="clear"></div>';
}

add_shortcode('clear', 'shortcode_clear');

//one-third
function shortcode_one_third($atts, $content) {

	$last = '';
	if (isset($atts[0]) && trim($atts[0]) == 'last')  $last = ' last';

	return '<div class="one-third'.$last.'">'.do_shortcode($content).'</div>';
}

add_shortcode('one-third', 'shortcode_one_third');


//two-third
function shortcode_two_third($atts, $content) {

	$last = '';
	if (isset($atts[0]) && trim($atts[0]) == 'last')  $last = ' last';

	return '<div class="two-third'.$last.'">'.do_shortcode($content).'</div>';
}

add_shortcode('two-third', 'shortcode_two_third');

//one-half
function shortcode_one_half($atts, $content) {

	$last = '';
	if (isset($atts[0]) && trim($atts[0]) == 'last')  $last = ' last';

	return '<div class="one-half'.$last.'">'.do_shortcode($content).'</div>';
}

add_shortcode('one-half', 'shortcode_one_half');

//one-fourth
function shortcode_one_fourth($atts, $content) {

	$last = '';
	if (isset($atts[0]) && trim($atts[0]) == 'last')  $last = ' last';

	return '<div class="one-fourth'.$last.'">'.do_shortcode($content).'</div>';
}

add_shortcode('one-fourth', 'shortcode_one_fourth');

//three-fourth
function shortcode_three_fourth($atts, $content) {

	$last = '';
	if (isset($atts[0]) && trim($atts[0]) == 'last')  $last = ' last';

	return '<div class="three-fourth'.$last.'">'.do_shortcode($content).'</div>';
}

add_shortcode('three-fourth', 'shortcode_three_fourth');
?>