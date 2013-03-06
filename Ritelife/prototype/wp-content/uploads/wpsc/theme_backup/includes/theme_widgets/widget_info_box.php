<?php
/**
 *
 * ThemeBlvd Info Box Widget
 *
 * This widget displays information about
 * anyone you choose with a gravatar image,
 * description, and link.
 *
 * @infobox  Jason Bobich
 *
 */

class Themeblvd_Info_Box extends WP_Widget {

    function Themeblvd_Info_Box() {
        $widget_ops = array('classname' => 'widget_infobox', 'description' => 'Show an information box with a left-aligned icon and an optional button to a link of your choice.' );
        $this->WP_Widget('infobox_widget', 'ThemeBlvd Info Box', $widget_ops);
    }

    //How widget shows on front end
    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        //Retrieve Options
        if( isset($instance['title']) ){
            $title = $instance['title'];
        } else {
            $title = '';
        }

        if( isset($instance['icon']) ){
            $icon = $instance['icon'];
        } else {
            $icon = '';
        }
        
        if( isset($instance['custom-icon']) ){
            $custom_icon = $instance['custom-icon'];
        } else {
            $custom_icon = '';
        }

        if( isset($instance['description']) ){
            $description = $instance['description'];
        } else {
            $description = '';
        }

        if( isset($instance['button-text']) ){
            $button_text = $instance['button-text'];
        } else {
            $button_text = '';
        }

        if( isset($instance['button-url']) ){
            $button_url = $instance['button-url'];
        } else {
            $button_url = '';
        }

        echo $before_widget;

        if($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<div class="themeblvd-infobox">';
		
		if($custom_icon) {
			
			echo '<img src="'.$custom_icon.'" class="alignleft">';
			
        } elseif($icon && $icon != 'none'){
        
            echo '<img src="'.get_template_directory_uri().'/layout/images/icons/'.$icon.'_48.png" class="alignleft">';
            
        }

        if($description){
            echo '<p>'.$description.'<p>';
        }

        if($button_text) {
                   
             echo '<p>';
				 echo '<a href="'.$button_url.'" title="'.$button_text.'" class="button">';
					 echo '<span class="left">';
						 echo '<span class="right">';
							 echo '<span class="middle">'.$button_text.'</span>';
						 echo '</span><!-- .right (end) -->';
					 echo '</span><!-- .left (end) -->';
				 echo '</a><!-- .button (end) -->';
			 echo '</p>';
			 
        }

        echo '</div><!-- .themeblvd-infobox (end) -->';

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);
        $instance['custom-icon'] = strip_tags($new_instance['custom-icon']);
        $instance['description'] = $new_instance['description'];
        $instance['button-text'] = strip_tags($new_instance['button-text']);
        $instance['button-url'] = strip_tags($new_instance['button-url']);


        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {
        
        //Pre-set Icons
        $icons = array(
        	'none',
			'accepted',
			'add',
			'app',
			'arrow_down',
			'arrow_down_green',
			'arrow_left',
			'arrow_left_green',
			'arrow_right',
			'arrow_right_green',
			'arrow_up',
			'arrow_up_green',
			'beer',
			'blinklist',
			'blue_speech_bubble',
			'book',
			'box',
			'box_download',
			'box_upload',
			'camera',
			'camera_add',
			'camera_delete',
			'camera_noflash',
			'camera_noflash_add',
			'camera_noflash_delete',
			'camera_noflash_warning',
			'camera_warning',
			'cancel',
			'cd',
			'circle_blue',
			'circle_green',
			'circle_orange',
			'circle_red',
			'clock',
			'coffee',
			'coffee_mug',
			'comment',
			'comment_add',
			'comment_remove',
			'comment_warning',
			'computer',
			'creditcard_american_express',
			'creditcard_cirrus',
			'creditcard_mastercard',
			'creditcard_paypal',
			'creditcard_solo',
			'creditcard_switch',
			'creditcard_visa',
			'cross',
			'database',
			'database_add',
			'database_remove',
			'database_warning',
			'delicious',
			'designfloat',
			'digg',
			'feedburner',
			'flickr',
			'floppy_disk',
			'folder',
			'folder_add',
			'folder_delete',
			'folder_warning',
			'furl',
			'globe',
			'google',
			'heart',
			'home',
			'image',
			'image_add',
			'image_delete',
			'image_warning',
			'lightbulb',
			'lock',
			'lock_open',
			'mail',
			'mail_add',
			'mail_delete',
			'mail_forward',
			'mail_reply',
			'mail_spam',
			'mail_write',
			'mixx',
			'mouse',
			'navigate',
			'newspaper',
			'paper',
			'paper_content',
			'paper_content_chart',
			'paper_content_pencil',
			'paper_and_pencil',
			'pencil',
			'pie_chart',
			'printer',
			'questionmark',
			'reddit',
			'refresh',
			'rss',
			'search',
			'smile_grin',
			'smile_sad',
			'spanner',
			'speech_bubble',
			'star',
			'star_half',
			'star_off',
			'sumbleupon',
			'table',
			'table_green',
			'tabs',
			'technorati',
			'thumbs_down',
			'thumbs_up',
			'twitter',
			'twitter_boxed',
			'usb',
			'user',
			'user_add',
			'user_delete',
			'user_two_delete',
			'user_warning',
			'users_two',
			'users_two_add',
			'users_two_warning',
			'warning',
			'yahoo',
        );
        
        //Widget Defaults
        $defaults = array( 'title' => '', 'icon' => '', 'custom-icon' => '', 'description' => '', 'button-text' => 'Learn More', 'button-url' => 'http://www.google.com');
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title" ,"themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>
		
        <p><label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e("Preset Icon" ,"themeblvd"); ?>
        <select name="<?php echo $this->get_field_name('icon'); ?>">
        	
        	<?php
        	foreach($icons as $icon) {

                if( isset($instance['icon']) && $instance['icon'] == $icon ) {
                    $selected = " selected='selected'";
                } else {
                    $selected = "";
                }

                echo "<option$selected value='".$icon."'>".$icon."</option>";

            }
        	?>
        	
        </select>
        </p>
                
        <p><label for="<?php echo $this->get_field_id('custom-icon'); ?>"><?php _e("Custom Icon URL" ,"themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('custom-icon'); ?>" name="<?php echo $this->get_field_name('custom-icon'); ?>" type="text" value="<?php if( isset($instance['custom-icon']) ) echo $instance['custom-icon']; ?>" /></label></p>
        
        <p style="font-size:9px"><?php _e("Accepted URL Formats:", "themeblvd"); ?><br />
        http://yoursite.com/uploads/image.jpg<br />
        http://yoursite.com/uploads/image.png<br />
        http://yoursite.com/uploads/image.gif</p>
        
        <p style="font-size:9px"><?php _e("Note: Entering a custom icon URL will overwrite preset selected icon above.", "themeblvd"); ?></p>


        <p><label for="<?php echo $this->get_field_id('description'); ?>"><?php _e("Description" ,"themeblvd"); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php if( isset($instance['description']) ) echo $instance['description']; ?></textarea></label></p>

        <p><label for="<?php echo $this->get_field_id('button-text'); ?>"><?php _e("Button Text" ,"themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('button-text'); ?>" name="<?php echo $this->get_field_name('button-text'); ?>" type="text" value="<?php if( isset($instance['button-text']) ) echo $instance['button-text']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('button-url'); ?>"><?php _e("Button URL" ,"themeblvd"); ?> <input class="widefat" id="<?php echo $this->get_field_id('button-url'); ?>" name="<?php echo $this->get_field_name('button-url'); ?>" type="text" value="<?php if( isset($instance['button-url']) ) echo $instance['button-url']; ?>" /></label></p>
    

        <?php
        }
##################################################################
} # end Themeblvd_Info_Box class extend
##################################################################

register_widget('Themeblvd_Info_Box');

?>