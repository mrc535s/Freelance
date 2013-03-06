<?php
/**
 *
 * Alyeska WordPress Theme
 * Portfolio
 *
 * This function displays a set of portfolio items.
 * In this theme, this function is primarily meant
 * for the homepage. It's not meant to be used at
 * all with taxonomy.php, although it has similar
 * functionality.
 *
 * @author  Jason Bobich
 *
 */

function alyeska_portfolio($portfolio, $num, $thumbnail, $title, $excerpt, $more, $color, $logo, $logo_width, $logo_height) {
	
	//Construct WP query	
	$query_string = "post_type=portfolio-item&order=ASC&orderby=menu_order&posts_per_page=$num";
	
	if($portfolio != 'all'){
		
		$query_string .= "&portfolio=$portfolio";
		
	}
	
	//Innitiate output
	$output = "";
	
	//Set Post Count
	$post_num = 1;
	
	$portfolio_query = new WP_Query($query_string);
			
		if($portfolio_query->have_posts()) {
		
			while ($portfolio_query->have_posts()) {

            	$portfolio_query->the_post();
        		
        		global $post;
				
				//Items to pass into themeblvd_media()
		        $input = get_post_meta($post->ID, 'themeblvd_media_item', true);
		        $autostart = 1;
		
		        $media_link = themeblvd_media($input, $autostart, $color, $logo, $logo_width, $logo_height);
				
				//Set last CSS class
				if($post_num % 3 == 0){ 
					$last = ' last';
				} else {
					$last = "";
				}
				
				$output .= '<div class="one-third portfolio-box'.$last.'">'."\n";
			        
			        //Item Thumbnail
			        if($thumbnail == 'false'){
		            	$output .= '<a href="'.get_permalink().'" title="'.get_the_title().'" class="thumb thumb-media loader">'."\n";
		            } else {
		            	$output .= '<a href="'.$media_link.'" title="'.get_the_title().'" class="thumb thumb-media loader" rel="lightbox[gallery]">'."\n";
		            }
	                $output .= '<span class="enlarge">'."\n";
	                if ( has_post_thumbnail() ){
	                    $output .= get_the_post_thumbnail( $post->ID, 'portfolio', array("class" => "pretty") );
	                } else {
	                    $output .= __('<p>Oops! You forgot set a featured image.</p>', 'themeblvd');
	                }
					$output .= '</span>'."\n";
		            $output .= '</a>'."\n";
					
					//Item Thumbnail
			        $output .= '<!-- Item Title -->'."\n";     
			        if($title == 'true'){
		            	$output .= '<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>'."\n";
		            }
			        
			        //Item Excerpt
			        $output .= '<!-- Item Excerpt -->'."\n";
		            if($excerpt == 'true'){
		                $output .= '<p>'.get_the_excerpt().'</p>'."\n";
		            }
					
					//Item Read More Link
					$output .= '<!-- Item Read More Link -->'."\n";
					if($more == 'true'){
						$output .= '<p class="readmore">'."\n";
							$output .= '<a href="'.get_permalink().'" title="'.get_the_title().'" class="button">'."\n";
								$output .= '<span class="left">'."\n";
									$output .= '<span class="right">'."\n";
										$output .= '<span class="middle">'.__("Read More", "themeblvd").'</span>'."\n";
									$output .= '</span><!-- .right (end) -->'."\n";
								$output .= '</span><!-- .left (end) -->'."\n";
							$output .= '</a><!-- .button (end) -->'."\n";
						$output .= '</p>'."\n";
					}
					
			    $output .= '</div><!-- .portfolio-box (end) -->'."\n";
				
				//Clear floats every 3 divs
				if($post_num % 3 == 0){
		        	$output .= '<div class="clear"></div>'."\n";
		        }
		
				$post_num++;
		
			} //End while
		
		} else {
		
			$output .= '<p class="warning">'."\n";
			$output .= __("You don't have any Portfolio Items to display.", "themeblvd");
			$output .= '</p>'."\n";
			
		}
		
	return $output;

##################################################################
} # end alyeska_portfolio function
##################################################################
?>