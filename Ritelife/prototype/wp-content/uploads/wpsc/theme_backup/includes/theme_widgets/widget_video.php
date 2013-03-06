<?php
/**
 *
 * ThemeBlvd Video Widget
 *
 * This widget displays a video file
 * in the custom flash video player,
 * from vimeo, or from youtube.
 *
 * @author  Jason Bobich
 *
 */

class Themeblvd_Video extends WP_Widget {

    function Themeblvd_Video() {
        $widget_ops = array('classname' => 'widget_video', 'description' => 'Quickly embed a video. It can be from YouTube or Vimeo. It can also be a self-hosted mp4, flv, or f4v file which will play in a non-branded video player.' );
        $this->WP_Widget('video_widget', 'ThemeBlvd Video', $widget_ops);
    }

    //How widget shows on front end
    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        echo $before_widget;

        //Template URL
        $template_url = get_template_directory_uri();

        if(isset( $instance['title']) ) {
            echo $before_title . $instance['title'] . $after_title;
        }

        //Video url
        if( isset($instance['url']) ){
            $video_url = $instance['url'];
        } else {
            _e("You forgot to enter a video URL.", "themeblvd");
        }

        //Start Image
        if(isset($instance['image']) ) {
            $image = $instance['image'];
        } else {
            $image = '';
        }

        //Video width
        if( isset($instance['width']) ){
            $video_width = $instance['width'];
        } else {
            $video_width = "290";
        }

        //Video height
        if( isset($instance['height']) ){
            $video_height = $instance['height'];
        } else {
            $video_height = "215";
        }

        //Color
        if( isset($instance['color']) ){
            $color = $instance['color'];
        } else {
            $color = "000000";
        }

        //Logo
        if( isset($instance['logo']) ){
            $logo = $instance['logo'];
        } else {
            $logo = "";
        }

        //Color
        if( isset($instance['logo_width']) ){
            $logo_width = $instance['logo_width'];
        } else {
            $logo_width = "100";
        }

        //Color
        if( isset($instance['logo_height']) ){
            $logo_height = $instance['logo_height'];
        } else {
            $logo_height = "40";
        }


        //Check for video format
        $vimeo = strpos($video_url, "vimeo");
        $youtube = strpos($video_url, "youtube");
        $mp4 = strpos($video_url, ".mp4");
        $flv = strpos($video_url, ".flv");
        $f4v = strpos($video_url, ".f4v");

        echo '<div class="frame themeblvd-video">';

        //Display video
        if($vimeo !== false){

            //Get ID from video url
            $video_id = str_replace( 'http://vimeo.com/', '', $video_url );
            $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

            //Display Vimeo video
            echo '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$video_width.'" height="'.$video_height.'" frameborder="0"></iframe>';

        } elseif($youtube !== false){

            //Get ID from video url
            $video_id = str_replace( 'http://youtube.com/watch?v=', '', $video_url );
            $video_id = str_replace( 'http://www.youtube.com/watch?v=', '', $video_id );
            $video_id = str_replace( '&feature=channel', '', $video_id );
            $video_id = str_replace( '&feature=channel', '', $video_id );

            echo '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$video_width.'" height="'.$video_height.'" src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0"></iframe>';

        } elseif($mp4 !== false || $flv !== false || $f4v !== false ){

            echo themeblvd_video($video_url, 'false', $image, $video_width, $video_height, $color, $logo, $logo_width, $logo_height);
            
        } else {

            _e("You entered a video URL that isn't compatible with this widget.", "themeblvd");

        }

        echo '</div><!-- .themeblvd-video (end) -->';

        if( isset($instance['content']) ){
            echo do_shortcode( $instance['content'] );
        }

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['url'] = strip_tags($new_instance['url']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
        $instance['content'] = $new_instance['content'];
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['color'] = strip_tags($new_instance['color']);
        $instance['logo'] = strip_tags($new_instance['logo']);
        $instance['logo_width'] = strip_tags($new_instance['logo_width']);
        $instance['logo_height'] = strip_tags($new_instance['logo_height']);

        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {

        $defaults = array(
            'title' => '',
            'url' => '',
            'image' => '',
            'width' => '290',
            'height' => '215',
            'content' => '',
            'color' => '000000',
            'logo' => '',
            'logo_width' => '100',
            'logo_height' => '40'
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>

        <h3><?php _e("General Options", "themeblvd"); ?></h3>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e("Video URL", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php if( isset($instance['url']) ) echo $instance['url']; ?>" /></label></p>
        <p style="font-size:9px">Accepted URL Formats:<br />
        http://vimeo.com/16681463<br />
        http://youtube.com/watch?v=CnWuP03i83Y<br />
        http://yoursite.com/uploads/video.flv<br />
        http://yoursite.com/uploads/video.f4v<br />
        http://yoursite.com/uploads/video.mp4</p>

        <p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e("Custom Width", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php if( isset($instance['width']) ) echo $instance['width']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e("Custom Height", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php if( isset($instance['height']) ) echo $instance['height']; ?>" /></label></p>
		
		<p style="font-size:9px"><?php _e("Embed dimensions will be different from theme to theme depending on the size of your current theme's sidebar or widget area you're placing the video in. So, you may need to play around with the dimensions a bit.", "themeblvd"); ?></p>
		
        <p><label for="<?php echo $this->get_field_id('content'); ?>"><?php _e("Content Below Video", "themeblvd"); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php if( isset($instance['content']) ) echo $instance['content']; ?></textarea></label></p>

        <h3><?php _e("Self-Hosted Options", "themeblvd"); ?></h3>

        <p style="font-size:9px"><?php _e("These options only apply if you're entering in a URL for a self-hosted video file.", "themeblvd"); ?></p>

        <p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e("Start Image", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php if( isset($instance['image']) ) echo $instance['image']; ?>" /></label></p>
        <p style="font-size:9px">Accepted URL Formats:<br />
        http://yoursite.com/uploads/image.jpg<br />
        http://yoursite.com/uploads/image.png<br />
        http://yoursite.com/uploads/image.gif</p>

        <p><label for="<?php echo $this->get_field_id('color'); ?>"><?php _e("Player Color", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php if( isset($instance['color']) ) echo $instance['color']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('logo'); ?>"><?php _e("Logo Watermark URL (optional)", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('logo'); ?>" name="<?php echo $this->get_field_name('logo'); ?>" type="text" value="<?php if( isset($instance['logo']) ) echo $instance['logo']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('logo_width'); ?>"><?php _e("Logo Width", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('logo_width'); ?>" name="<?php echo $this->get_field_name('logo_width'); ?>" type="text" value="<?php if( isset($instance['logo_width']) ) echo $instance['logo_width']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('logo_height'); ?>"><?php _e("Logo Height", "themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('logo_height'); ?>" name="<?php echo $this->get_field_name('logo_height'); ?>" type="text" value="<?php if( isset($instance['logo_height']) ) echo $instance['logo_height']; ?>" /></label></p>

        <?php
    }
    
##################################################################
} # end Themeblvd_Video class extend
##################################################################

register_widget('Themeblvd_Video');

?>