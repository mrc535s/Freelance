<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Generate Random ID
 *
 * This function generates a random string of
 * characters in order to be used as an ID for
 * using swfobject JS for embedding Flash items.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_rand($length){

	srand((double)microtime()*1000000 );
	
	$random_id = "";
	
	$char_list = "abcdefghijklmnopqrstuvwxyz";
	
	for($i = 0; $i < $length; $i++) {
		$random_id .= substr($char_list,(rand()%(strlen($char_list))), 1);
	}
	
	return $random_id;
	
##################################################################
} # end themeblvd_rand function
##################################################################
?>