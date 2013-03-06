<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Embed Video File
 *
 * This function embeds a video file with
 * our custom video player.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_video($file, $autostart, $image, $width, $height, $color, $logo, $logo_width, $logo_height){

    //Template URL
    $template_url = get_template_directory_uri();
    
    //Unique ID
    $id = "video-".themeblvd_rand(15);

    //Auto Start
    if($autostart == 'true'){
        $autostart = 'On';
    } else {
        $autostart = 'Off';
    }

    //Flash object height
    $object_height = $height + 30;

    //JS
    $output  = '<script type="text/javascript">'."\n";
	$output .= '	var flashvars = {};'."\n";
	$output .= '	flashvars.player_width="'.$width.'";'."\n";
	$output .= '	flashvars.player_height="'.$height.'"'."\n";
	$output .= '	flashvars.player_id="'.$id.'";'."\n";
	$output .= '	flashvars.video_name="'.$file.'";'."\n";
	$output .= '	flashvars.auto_play_on_start="'.$autostart.'";'."\n";
	$output .= '	flashvars.thumb="'.$image.'";'."\n";
	$output .= '	flashvars.controls_color="0x888888";'."\n";
	$output .= '	flashvars.controls_color_over="0xffffff";'."\n";
	$output .= '	flashvars.player_color="0x'.$color.'";'."\n";
	$output .= '	flashvars.logo_name="'.$logo.'";'."\n";
	$output .= '	flashvars.logo_width="'.$logo_width.'";'."\n";
	$output .= '	flashvars.logo_height="'.$logo_height.'";'."\n";
	$output .= '	var params = { "wmode": "transparent" };'."\n";
	$output .= '	params.wmode = "transparent";'."\n";
	$output .= '	params.quality = "high";';
	$output .= '	params.allowFullScreen = "true";'."\n";
	$output .= '	params.allowScriptAccess = "always";'."\n";
	$output .= '	params.quality="high";'."\n";
	$output .= '	var attributes = {};'."\n";
	$output .= '	attributes.id = "'.$id.'";'."\n";
	$output .= '	swfobject.embedSWF("'.$template_url.'/layout/flash/video.swf", "'.$id.'", "'.$width.'", "'.$object_height.'", "9.0.0", false, flashvars, params, attributes);'."\n";
    $output .= '</script>'."\n\n";

    //HTML
    $output .= '<div id="'.$id.'">'."\n";
    $output .= '	<a href="http://www.adobe.com/go/getflashplayer">'."\n";
	$output .= '		<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />'."\n";
	$output .= '	</a>'."\n";
    $output .= '</div>';

    return $output;
    
##################################################################
} # end themeblvd_video function
##################################################################
?>