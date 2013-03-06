<?php
/**
 *
 * Alyeska Shortcodes
 *
 * Media shorcodes (audio, video, etc.)
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Audio Player
##############################################################

function shortcode_audio($atts, $content = null) {

    extract(shortcode_atts(array(
        'file' => '',
        'width' => '290',
        'autostart' => 'false',
        'color' => '000000'
    ), $atts));
    
    $template_url = get_template_directory_uri();
    $id = mt_rand();
    $mp3 = strpos($file, ".mp3");

    $output  = '<div class="themeblvd-audio">';

    if($mp3 !== false){
        
        $output .= themeblvd_audio($file, $autostart, $color, $width);

    } else {

        _e("The URL you entered is not a .mp3 file.", "themeblvd");

    }

    $output  .= '</div>';

    return $output;

}

add_shortcode('audio', 'shortcode_audio');

##############################################################
# Video Player
##############################################################

function shortcode_video($atts, $content = null) {

    extract(shortcode_atts(array(
        'file' => '',
        'autostart' => 'false',
        'image' => '',
        'width' => '480',
        'height' => '360',
        'color' => '000000',
        'logo' => '',
        'logo_width' => '100',
        'logo_height' => '40'
    ), $atts));

    $template_url = get_bloginfo('template_url');

    $video_url = $file;

    //Check for video format
    $vimeo = strpos($video_url, "vimeo");
    $youtube = strpos($video_url, "youtube");
    $mp4 = strpos($video_url, ".mp4");
    $flv = strpos($video_url, ".flv");
    $f4v = strpos($video_url, ".f4v");

    $output = '<div class="themeblvd-video">';

    //Display video
    if($vimeo !== false){

        //Get ID from video url
        $video_id = str_replace( 'http://vimeo.com/', '', $video_url );
        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

        //Display Vimeo video
        $output .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';

    } elseif($youtube !== false){

        //Get ID from video url
        $video_id = str_replace( 'http://youtube.com/watch?v=', '', $video_url );
        $video_id = str_replace( 'http://www.youtube.com/watch?v=', '', $video_id );
        $video_id = str_replace( '&feature=channel', '', $video_id );
        $video_id = str_replace( '&feature=channel', '', $video_id );

        $output .= '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0"></iframe>';

    } elseif($mp4 !== false || $flv !== false || $f4v !== false ){

        $output .= themeblvd_video($video_url, $autostart, $image, $width, $height, $color, $logo, $logo_width, $logo_height);

    } else {

        _e("You entered a video URL that isn't compatible with this shortcode.", "themeblvd");

    }

    $output .= '</div><!-- .themeblvd-video (end) -->';

    return $output;

}

add_shortcode('video', 'shortcode_video');


?>