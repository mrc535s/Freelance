<?php
/**
 *
 * Alyeska WordPress Theme
 * Slideshow (Cycle)
 *
 * This function displays the cycle
 * slideshow, which is also referred
 * to as the "Anything" slider through
 * out the theme's option panels.
 *
 * @author  Jason Bobich
 *
 */

function alyeska_anything($slideshow, $transition, $speed, $color, $width, $height) {
	
	//Construct WP query	
	$query_string = 'post_type=slide&order=ASC&orderby=menu_order&nopaging=true';
	
	if($slideshow != 'all'){
		
		$query_string .= "&slideshows=$slideshow";
		
	}
	
	$slideshow_query = new WP_Query($query_string);
	
	//Create unique ID
	$id = mt_rand();
	
	//Set autoplay duration
	if($speed != '0'){
		$speed .= '000';
	}
	
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
	
	$output = '<div id="'.$id.'" class="slideshow-wrapper">'."\n";
		
		$output .= '<script>'."\n";
		$output .= '	jQuery.noConflict()(function($){'."\n";
		$output .= '		$(document).ready(function() {'."\n";
		$output .= '			$("#'.$id.' .slideshow").cycle({'."\n";
		$output .= '				fx: "'.$transition.'",'."\n";
		$output .= '				timeout: '.$speed.','."\n";
		$output .= '				pager: "#'.$id.' .slideshow-dots",'."\n";
		$output .= '				pagerAnchorBuilder: paginate,'."\n";
		$output .= '				next: "#'.$id.' .next",'."\n";
		$output .= '				prev: "#'.$id.' .prev",'."\n";
		$output .= '				speed: "2000",'."\n";
		$output .= '				pause: 1,'."\n";
		$output .= '				easing: "easeInOutQuint"'."\n";
		$output .= '			});'."\n";
		$output .= '		});'."\n";
		$output .= '	});'."\n";
		$output .= '</script>'."\n";
		
		$output .= '<div class="slideshow-top"><!-- --></div>'."\n";
		
		$output .= '<div class="slideshow-middle">'."\n";
		$output .= '	<div class="slideshow"'.$dimensions.'>'."\n";
			
		if($slideshow_query->have_posts()) {
		
			while ($slideshow_query->have_posts()) {

            	$slideshow_query->the_post();
        		
        		global $post;
        		
        		$output .= '<div class="slide">'."\n";
        			
        		$slide_type = get_post_meta($post->ID, 'themeblvd_slide_type', true);

                if($slide_type == 'true') {

                    if( get_post_meta($post->ID, 'themeblvd_slide_link', true) ){
                        $output .= '<a href="'.get_post_meta($post->ID, 'themeblvd_slide_link', true).'" title="'.get_the_title().'">';
                    }

                    if ( has_post_thumbnail() ) {
                    	if( isset($size) ){
                    		$output .= get_the_post_thumbnail($post->ID, $size);
                    	} else {
                    		$output .= get_the_post_thumbnail($post->ID);
                    	}
                    }

                    if( get_post_meta($post->ID, 'themeblvd_slide_description', true) ){
                        $output .= '<div class="description" style="background-color: #'.$color.';">';
                            $output .= '<div class="pad">';
                                $output .= get_post_meta($post->ID, 'themeblvd_slide_description', true);
                            $output .= '</div><!-- .pad (end) -->';
                        $output .= '</div><!-- .description (end) -->';
                    }

                    if(get_post_meta($post->ID, 'themeblvd_slide_link', true)){
                        $output .= '</a>';
                    }

                } else {

                    $output .= apply_filters( 'the_content', get_the_content() );

                } // end slide_type
        			
        		$output .= '</div><!-- .slide (end) -->'."\n";    	
		
			} //End while
		
		} else {
		
			$output .= '<p class="warning">'."\n";
			$output .= __("You don't have any Slides to display.", "themeblvd");
			$output .= '</p>'."\n";
			
		}
			
			
		$output .= '	</div><!-- .slideshow (end) -->'."\n";
		$output .= '</div><!-- .slideshow-middle (end) -->'."\n";

		$output .= '<div class="slideshow-bottom">'."\n";
			
		$output .= '	<ul class="slideshow-arrows">'."\n";
		$output .= '		<li><a href="#" title="Previous" class="prev">&laquo;</a></li>'."\n";
		$output .= '		<li><a href="#" title="Next" class="next">&raquo;</a></li>'."\n";
		$output .= '	</ul>'."\n";
		
		$output .= '	<ul class="slideshow-dots">'."\n";
		$output .= '		<!-- slideshow nav rended here. -->'."\n";
		$output .= '	</ul>'."\n";
		
		$output .= '</div><!-- .slideshow-bottom (end) -->'."\n";
		
	$output .= '</div><!-- .slideshow-wrapper (end) -->'."\n";
	
	//Reset post data
	wp_reset_postdata();
	
	return $output;

##################################################################
} # end alyeska_anything function
##################################################################
?>