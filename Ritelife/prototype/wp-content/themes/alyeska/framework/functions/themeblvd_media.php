<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Media Link Format
 *
 * This function formats the link for the
 * lightbox popup of the portfolios.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_media($input, $autostart, $color, $logo, $logo_width, $logo_height){

    //Innitial media link
    $media_link = $input;

    //Template URL
    $template_url = get_template_directory_uri();

    //Audio Formatting
    $mp3 = strpos($input, ".mp3");

    if($mp3 !== false){

        $media_link = "$template_url/layout/flash/audio.swf";
        $media_link .= "?width=292&amp;height=30";
        $media_link .= "&amp;flashvars=snd_name=".$input;
        $media_link .= '&amp;controls_color=0x888888';
		$media_link .= '&amp;controls_color_over=0xffffff';
		$media_link .= '&amp;player_color=0x'.$color;
        
        if( isset($autostart)){
            $media_link .= "&amp;auto_play_on_start=On";
        }

    }

    //Video Formatting
    $flv = strpos($input, ".flv");
    $f4v = strpos($input, ".f4v");
    $mp4 = strpos($input, ".mp4");

    if( $flv !== false || $f4v !== false || $mp4 !== false ){

        //Extract parts
        if (preg_match('/^([^?]+)\?width=(\d*)&height=(\d*)/i', $input, $matches)){
            
            $video_url = $matches[1];
            $video_width = $matches[2];
            $video_height = $matches[3];

        }
        //Height of flash object
        $object_height = $video_height + 30;

        $media_link = "$template_url/layout/flash/video.swf";
        $media_link .= "?width=$video_width&amp;height=$object_height";
        $media_link .= '&amp;flashvars=';
        $media_link .= "player_width=$video_width&amp;player_height=$video_height";
        $media_link .= "&amp;video_name=$video_url";
        $media_link .= '&amp;controls_color=0x888888';
		$media_link .= '&amp;controls_color_over=0xffffff';
		$media_link .= '&amp;player_color=0x'.$color;
        $media_link .= '&amp;logo_name='.$logo;
		$media_link .= '&amp;logo_width='.$logo_width;
		$media_link .= '&amp;logo_height='.$logo_height;
        
        if( isset($autostart)){
            $media_link .= "&amp;auto_play_on_start=On";
        }

    }
    
    return $media_link;
    
##################################################################
} # end themeblvd_media function
##################################################################
?>