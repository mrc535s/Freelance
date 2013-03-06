<?php
/**
 *
 * Alyeska WordPress Theme
 * Slideshow (Nivo)
 *
 * This function displays the Nivo
 * slideshow.
 *
 * @author  Jason Bobich
 *
 */

function alyeska_nivo($slideshow, $transition, $speed, $slices, $color, $width, $height) {
	
	//Construct WP query	
	$query_string = 'post_type=slide&order=ASC&orderby=menu_order&nopaging=true';
	
	if($slideshow != 'all'){
		
		$query_string .= "&slideshows=$slideshow";
		
	}
	
	$slideshow_query = new WP_Query($query_string);
	
	//Create unique ID
	$id = mt_rand();
	
	//Set speed
	$speed .= '000';
	
	//Set description color
	if( !isset($color) ){
	
		$color = '000000';
	
	}
	
	//Set width/height
	if(!$width && !$height){

		$dimensions = "";
	
	} else {
		
		$dimensions = ' style="';
		
		if($width){
			
			$dimensions .= 'width:'.$width.'px;';
			
		}
		
		if($height){
		
			$dimensions .= 'height:'.$height.'px;';
		
		}
		
		$dimensions .= '"';
		
	}
	
	//Set size
	if( isset($width) && $width == '560' ){
		
		$size = 'slideshow-subpage';
		
	} elseif(isset($width) && $width == '920' ){
	
		$size = 'slideshow-fullwidth';
	
	} elseif(isset($width) && $width == '940' && $height == '350' ){
	
		$size = 'slideshow-homepage';
	
	}
	
	$output = '<style type="text/css">'."\n";
	$output .= "	.nivo-caption { background-color: #$color; }"."\n";
	$output .= '</style>'."\n";
	
	$output .= '<div id="'.$id.'" class="nivo-slideshow">'."\n";
				
		$output .= '<div class="slideshow-top"><!-- --></div>'."\n";
		
		$output .= '<div class="slideshow-middle">'."\n";
		$output .= '	<div class="slideshow"'.$dimensions.'>'."\n";
			
		if($slideshow_query->have_posts()) {
		
			while ($slideshow_query->have_posts()) {

            	$slideshow_query->the_post();
        		
        		global $post;
        			
        		$slide_type = get_post_meta($post->ID, 'themeblvd_slide_type', true);

                if($slide_type == 'true') {
					
                    if( get_post_meta($post->ID, 'themeblvd_slide_link', true) ){
                        $output .= '<a href="'.get_post_meta($post->ID, 'themeblvd_slide_link', true).'" title="'.get_the_title().'">'."\n";
                    }

                    if ( has_post_thumbnail() ) {
                    	if( isset($size) ){
                    		$output .= get_the_post_thumbnail($post->ID, $size, array('title' => get_post_meta($post->ID, 'themeblvd_slide_description', true) ) )."\n";
                    	} else {
                    		$output .= get_the_post_thumbnail($post->ID, '', array('title' => get_post_meta($post->ID, 'themeblvd_slide_description', true) ) )."\n";
                    	}
                    }

                    if(get_post_meta($post->ID, 'themeblvd_slide_link', true)){
                        $output .= '</a>'."\n";
                    }

                } // end slide_type
    	
		
			} //End while
		
		} else {
		
			$output .= '<p class="warning">'."\n";
			$output .= __("You don't have any Slides to display.", "themeblvd");
			$output .= '</p>'."\n";
			
		}
			
		$output .= '	</div><!-- .slideshow (end) -->'."\n";
		$output .= '</div><!-- .slideshow-middle (end) -->'."\n";

		$output .= '<div class="slideshow-bottom"><!-- --></div>'."\n";
		
	$output .= '</div><!-- .nivo-slideshow (end) -->'."\n";
	
	$output .= '<script>'."\n";
	$output .= 'jQuery.noConflict()(function($){'."\n";
	$output .= '	$(document).ready(function() {'."\n";
	$output .= '		$("#'.$id.' .slideshow").nivoSlider({'."\n";
	$output .= '			effect: "'.$transition.'",'."\n";
	$output .= '			pauseTime: '.$speed.','."\n";
	$output .= '			slices: '.$slices.','."\n";
	$output .= '			pauseOnHover:true,'."\n"; 
	$output .= '			directionNavHide: false'."\n";
	$output .= '		});'."\n";
	$output .= '	});'."\n";
	$output .= '});'."\n";
	$output .= '</script>'."\n";
	
	//Reset post data
	wp_reset_postdata();
	
	return $output;

##################################################################
} # end alyeska_nivo function
##################################################################
?>