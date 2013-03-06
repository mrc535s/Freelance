<?php
/**
 *
 * Alyeska WordPress Theme
 * Slideshow (Accordion)
 *
 * This function displays the Kwicks
 * slideshow.
 *
 * @author  Jason Bobich
 *
 */

function alyeska_accordion($slideshow, $num, $width_stretch, $color, $width, $height) {
	
	//Construct WP query	
	$query_string = 'post_type=slide&order=ASC&orderby=menu_order&posts_per_page='.$num;
	
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
	
	//Set description color
	if( !isset($color) ){
	
		$color = '000000';
	
	}
	
	if($slideshow != 'all'){
		
		$query_string .= "&slideshows=$slideshow";
		
	}
	
	$slideshow_query = new WP_Query($query_string);
	
	//Create unique ID
	$id = mt_rand();
	
	//Set li width
	$slide_width = round( ( $width - ( 4*($num-1) ) ) / $num );
	
	$output = '<style type="text/css">'."\n";
	$output .= '	.accordion li { width: '.$slide_width.'px; }'."\n";
	$output .= '</style>'."\n";
	
	$output .= '<script>'."\n";
	$output .= 'jQuery.noConflict()(function($){'."\n";
	$output .= '	$(document).ready(function() {'."\n";
	$output .= '		$("#'.$id.' .accordion").kwicks({'."\n";
	$output .= '			max: '.$width_stretch.','."\n";
	$output .= '			spacing: 4'."\n";
	$output .= '		});'."\n";
	$output .= '	});'."\n";
	$output .= '});'."\n";
	$output .= '</script>'."\n";
	
	$output .= '<div id="'.$id.'" class="accordion-slideshow">'."\n";
						
	$output .= '	<div class="slideshow-top"><!-- --></div>'."\n";
	
	$output .= '	<div class="slideshow-middle">'."\n";
	
	if($slideshow_query->have_posts()) {
		
		$output .= '<ul class="slideshow accordion"'.$dimensions.'>'."\n";
		
		while ($slideshow_query->have_posts()) {
	
	    	$slideshow_query->the_post();
			
			global $post;
				
			$slide_type = get_post_meta($post->ID, 'themeblvd_slide_type', true);
	
	        if($slide_type == 'true') {
				
				$output .= '<li>'."\n";
				
	            if( get_post_meta($post->ID, 'themeblvd_slide_link', true) ){
	                $output .= '<a href="'.get_post_meta($post->ID, 'themeblvd_slide_link', true).'" title="'.get_the_title().'">'."\n";
	            }
	
	            if ( has_post_thumbnail() ) {
	            	if( isset($size) ){
	            		$output .= get_the_post_thumbnail($post->ID, $size)."\n";
	            	} else {
	            		$output .= get_the_post_thumbnail($post->ID)."\n";
	            	}
	            }
	
	            if(get_post_meta($post->ID, 'themeblvd_slide_link', true)){
	                $output .= '</a>'."\n";
	            }
	            
	            if( get_post_meta($post->ID, 'themeblvd_slide_description', true) ){
                    $output .= '<div class="description" style="width: '.$width_stretch.'px; background-color: #'.$color.';">';
                        $output .= '<div class="pad">';
                            $output .= get_post_meta($post->ID, 'themeblvd_slide_description', true);
                        $output .= '</div><!-- .pad (end) -->';
                    $output .= '</div><!-- .description (end) -->';
                }
	            
	            $output .= '</li>'."\n";
	
	        } // end slide_type
	
	
		} //End while
		
		$output .= '</ul><!-- .slideshow (end) -->'."\n";
	
	} else {
		
		$output .= '<p class="warning">'."\n";
		$output .= __("You don't have any Slides to display.", "themeblvd");
		$output .= '</p>'."\n";
		
	}
	
	$output .= '	</div><!-- .slideshow-middle (end) -->'."\n";
	
	$output .= '	<div class="slideshow-bottom"><!-- --></div>'."\n";
	
	$output .= '</div><!-- .accordion-slideshow (end) -->'."\n";
	
	//Reset post data
	wp_reset_postdata();
	
	return $output;

##################################################################
} # end alyeska_accordion function
##################################################################
?>