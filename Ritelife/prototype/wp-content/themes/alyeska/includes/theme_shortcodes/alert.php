<?php
/**
 *
 * Alyeska Shortcodes
 *
 * Alert boxes.
 *
 * @author  Jason Bobich
 *
 */

//alert
function shortcode_alert($args, $content) {
	return '<div class="shortcode alert"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('alert', 'shortcode_alert');

//approved
function shortcode_approved($args, $content) {
	return '<div class="shortcode approved"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('approved', 'shortcode_approved');

//attention
function shortcode_attention($args, $content) {
	return '<div class="shortcode attention"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('attention', 'shortcode_attention');

//camera
function shortcode_camera($args, $content) {
	return '<div class="shortcode camera"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('camera', 'shortcode_camera');

//cart
function shortcode_cart($args, $content) {
	return '<div class="shortcode cart"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('cart', 'shortcode_cart');

//doc
function shortcode_doc($args, $content) {
	return '<div class="shortcode doc"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('doc', 'shortcode_doc');

//download
function shortcode_download($args, $content) {
	return '<div class="shortcode download"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('download', 'shortcode_download');

//media
function shortcode_media($args, $content) {
	return '<div class="shortcode media"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('media', 'shortcode_media');

//note
function shortcode_note($args, $content) {
	return '<div class="shortcode note"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('note', 'shortcode_note');

//notice
function shortcode_notice($args, $content) {
	return '<div class="shortcode notice"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('notice', 'shortcode_notice');

//quote
function shortcode_quote($args, $content) {
	return '<div class="shortcode quote"><div class="icon">'.do_shortcode($content).'</div></div>';
}

add_shortcode('quote', 'shortcode_quote');
?>