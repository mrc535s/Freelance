<?php
/**
 *
 * Alyeska WordPress Theme
 * Social Buttons
 *
 * This function displays the social networking
 * and contact buttons in the top right corner
 * of the site.
 *
 * @author  Jason Bobich
 *
 */

function alyeska_social() {
	
	//Innitiate output
	$output = "";
	
	//Style Option
	global $themeblvd_social_style;
	
	//Button URL's
	global $themeblvd_social_delicious;
	global $themeblvd_social_deviantart;
	global $themeblvd_social_digg;
	global $themeblvd_social_dribbble;
	global $themeblvd_social_email;
	global $themeblvd_social_facebook;
	global $themeblvd_social_feedburner;
	global $themeblvd_social_flickr;
	global $themeblvd_social_linkedin;
	global $themeblvd_social_mixx;
	global $themeblvd_social_myspace;
	global $themeblvd_social_picassa;
	global $themeblvd_social_reddit;
	global $themeblvd_social_rss;
	global $themeblvd_social_squidoo;
	global $themeblvd_social_technorati;
	global $themeblvd_social_twitter;
	global $themeblvd_social_vimeo;
	global $themeblvd_social_youtube;
	
	//Assemble array of chosen buttons
	$themeblvd_buttons = array();
	
	if($themeblvd_social_delicious){
		$themeblvd_buttons[] = array(
			"name" => "Delicious",
			"class" => "delicious",
			"value" => $themeblvd_social_delicious
		);
	}
	
	if($themeblvd_social_deviantart){
		$themeblvd_buttons[] = array(
			"name" => "Deviantart",
			"class" => "deviantart",
			"value" => $themeblvd_social_deviantart
		);
	}
	
	if($themeblvd_social_digg){
		$themeblvd_buttons[] = array(
			"name" => "Digg",
			"class" => "digg",
			"value" => $themeblvd_social_digg
		);
	}
	
	if($themeblvd_social_dribbble){
		$themeblvd_buttons[] = array(
			"name" => "Dribbble",
			"class" => "dribbble",
			"value" => $themeblvd_social_dribbble
		);
	}
		
	if($themeblvd_social_facebook){
		$themeblvd_buttons[] = array(
			"name" => "Facebook",
			"class" => "facebook",
			"value" => $themeblvd_social_facebook
		);
	}
	
	if($themeblvd_social_feedburner){
		$themeblvd_buttons[] = array(
			"name" => "Feedburner",
			"class" => "feedburner",
			"value" => $themeblvd_social_feedburner
		);
	}
	
	if($themeblvd_social_flickr){
		$themeblvd_buttons[] = array(
			"name" => "Flickr",
			"class" => "flickr",
			"value" => $themeblvd_social_flickr
		);
	}
	
	if($themeblvd_social_linkedin){
		$themeblvd_buttons[] = array(
			"name" => "Linkedin",
			"class" => "linkedin",
			"value" => $themeblvd_social_linkedin
		);
	}
	
	if($themeblvd_social_mixx){
		$themeblvd_buttons[] = array(
			"name" => "Mixx",
			"class" => "mixx",
			"value" => $themeblvd_social_mixx
		);
	}
	
	if($themeblvd_social_myspace){
		$themeblvd_buttons[] = array(
			"name" => "Myspace",
			"class" => "myspace",
			"value" => $themeblvd_social_myspace
		);
	}
	
	if($themeblvd_social_picassa){
		$themeblvd_buttons[] = array(
			"name" => "Picassa",
			"class" => "picassa",
			"value" => $themeblvd_social_picassa
		);
	}
	
	if($themeblvd_social_reddit){
		$themeblvd_buttons[] = array(
			"name" => "Reddit",
			"class" => "reddit",
			"value" => $themeblvd_social_reddit
		);
	}
	
	if($themeblvd_social_squidoo){
		$themeblvd_buttons[] = array(
			"name" => "Squidoo",
			"class" => "squidoo",
			"value" => $themeblvd_social_squidoo
		);
	}
	
	if($themeblvd_social_technorati){
		$themeblvd_buttons[] = array(
			"name" => "Technorati",
			"class" => "technorati",
			"value" => $themeblvd_social_technorati
		);
	}
	
	if($themeblvd_social_twitter){
		$themeblvd_buttons[] = array(
			"name" => "Twitter",
			"class" => "twitter",
			"value" => $themeblvd_social_twitter
		);
	}
	
	if($themeblvd_social_vimeo){
		$themeblvd_buttons[] = array(
			"name" => "Vimeo",
			"class" => "vimeo",
			"value" => $themeblvd_social_vimeo
		);
	}
	
	if($themeblvd_social_youtube){
		$themeblvd_buttons[] = array(
			"name" => "YouTube",
			"class" => "youtube",
			"value" => $themeblvd_social_youtube
		);
	}
	
	if($themeblvd_social_email){
		$themeblvd_buttons[] = array(
			"name" => "Email",
			"class" => "email",
			"value" => $themeblvd_social_email
		);
	}
	
	if($themeblvd_social_rss){
		$themeblvd_buttons[] = array(
			"name" => "RSS",
			"class" => "rss",
			"value" => $themeblvd_social_rss
		);
	}
	
	//Display buttons
	if($themeblvd_buttons){
		
		$output .= '<div class="social-icons">'."\n";
		$output .= '<ul>'."\n";
		
		foreach($themeblvd_buttons as $button){
		
			$output .= '<li><a href="'.$button['value'].'" title="'.$button['name'].'" class="'.$button['class'].'-'.$themeblvd_social_style.'">'.$button['name'].'</a></li>'."\n";	
		
		}
		
		$output .= '</ul>'."\n";
		$output .= '</div><!-- .social-icons (end) -->'."\n";
	
	}
	
	return $output;


##################################################################
} # end alyeska_social function
##################################################################
?>