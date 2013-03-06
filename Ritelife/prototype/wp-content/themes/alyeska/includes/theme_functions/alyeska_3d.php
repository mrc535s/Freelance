<?php
/**
 *
 * Alyeska WordPress Theme
 * Slideshow (3D)
 *
 * This function displays the Piecemaker
 * slideshow.
 *
 * @author  Jason Bobich
 *
 */

function alyeska_3d() {
	
	$output = '<script type="text/javascript">'."\n";
    
    $output .= '  var flashvars = {};'."\n";
    $output .= '  flashvars.cssSource = "'.get_template_directory_uri().'/layout/plugins/piecemaker/piecemaker.css";'."\n";
    $output .= '  flashvars.xmlSource = "'.get_template_directory_uri().'/layout/plugins/piecemaker/piecemaker.php";'."\n";
		
    $output .= '  var params = {};'."\n";
    $output .= '  params.play = "true";'."\n";
    $output .= '  params.menu = "false";'."\n";
    $output .= '  params.scale = "showall";'."\n";
    $output .= '  params.wmode = "transparent";'."\n";
    $output .= '  params.allowfullscreen = "true";'."\n";
    $output .= '  params.allowscriptaccess = "always";'."\n";
    $output .= '  params.allownetworking = "all";'."\n";
	  
    $output .= "  swfobject.embedSWF('".get_template_directory_uri()."/layout/plugins/piecemaker/piecemaker.swf', 'piecemaker', '100%', '425', '10', null, flashvars, params, null);"."\n";
    
    $output .= '</script>'."\n";
	
	$output .= '<div class="flash-slider-wrapper">'."\n";
	$output .= '	<div id="piecemaker">'."\n";
	$output .= '		<a href="http://www.adobe.com/go/getflashplayer">'."\n";
	$output .= '			<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />'."\n";
	$output .= '		</a>'."\n";
	$output .= '	</div>'."\n";
	$output .= '</div><!-- .3d-slider-wrapper (end) -->'."\n";
		
	return $output;

##################################################################
} # end alyeska_3d function
##################################################################
?>