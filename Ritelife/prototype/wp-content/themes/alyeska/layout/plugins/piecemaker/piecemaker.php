<?php
//Setup URL to WordPres
$absolute_path = __FILE__;
$path_to_wp = explode( 'wp-content', $absolute_path );
$wp_url = $path_to_wp[0];

//Access WordPress
require_once( $wp_url.'/wp-load.php' );

//Custom Settings
$autoplay = $themeblvd_3d_speed;
$pieces = $themeblvd_3d_pieces;
$time = $themeblvd_3d_time;
$depth = $pieces*20;
$color = $themeblvd_3d_color;

//Construct WP query	
$query_string = 'post_type=slide&order=ASC&orderby=menu_order&nopaging=true';

if($themeblvd_homepage_slideshow != 'all'){
	
	$query_string .= "&slideshows=$themeblvd_homepage_slideshow";
	
}

$slideshow_query = new WP_Query($query_string);

$output = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>

XML;

//Content
if($slideshow_query->have_posts()) {
	
	$output .= '	<Contents>'."\n";
	
	while ($slideshow_query->have_posts()) {

    	$slideshow_query->the_post();
		
		global $post;
			
		$slide_type = get_post_meta($post->ID, 'themeblvd_slide_type', true);

        if($slide_type == 'true') {
			
            //Image URL
            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "slideshow-homepage" );
			
			//Display image slide
            $output .= '		<Image Source="'.$image_url[0].'">'."\n";   
      		
      		
      		//Display description
      		if( get_post_meta($post->ID, 'themeblvd_slide_description', true) ){
                
                $output .= "			<Text>".apply_filters('the_content', get_post_meta($post->ID, 'themeblvd_slide_description', true))."</Text> \n";
                
            }
            
            //Display link
            if( get_post_meta($post->ID, 'themeblvd_slide_link', true) ){
                
                $output .= '			<Hyperlink URL="'.get_post_meta($post->ID, 'themeblvd_slide_link', true).'" />'."\n";
                
            }
			
			$output .= '		</Image>'."\n";
			
        }

	}

	$output .= '	</Contents>'."\n";
	
}

//Settings
$output .= '<Settings ImageWidth="940" ImageHeight="350" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.7" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x999999" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="100" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0x'.$color.'" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="'.$autoplay.'" FieldOfView="45"></Settings>';

//End
$output .= <<<XML
	<Transitions>
		<Transition Pieces="$pieces" Time="$time" Transition="easeInOutElastic" Delay="0.03" DepthOffset="$depth" CubeDistance="10"></Transition>
	</Transitions>
	
</Piecemaker>
XML;

echo $output;

?>