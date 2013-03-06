<?php 
/**
 *
 * ThemeBlvd Ads Widget - Square buttons (125x125)
 *
 * This widget shows a simple display of
 * advertisements for your blog sidebar.
 *
 * @author  Jason Bobich
 *
 */

class Themeblvd_Ads_Square_Buttons extends WP_Widget {

    function Themeblvd_Ads_Square_Buttons() {

        $widget_ops = array('classname' => 'ad_square_buttons', 'description' => 'Declare up to six 125x125 advertisements to be displayed in a grid.' );
        $this->WP_Widget('square_buttons_ads', 'ThemeBlvd Ads - Square Buttons', $widget_ops);
        
    }

    //How widget shows on front end
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        //Set title
        $title = $instance['title'];

        //Build an array based on ads inserted by user
        $ads = array();

        if($instance['ad1_img']) {

            $ads[] = array (
                'img' => $instance['ad1_img'],
                'link' => $instance['ad1_link']
            );

        }

        if($instance['ad2_img']) {

            $ads[] = array (
                'img' => $instance['ad2_img'],
                'link' => $instance['ad2_link']
            );

        }

        if($instance['ad3_img']) {

            $ads[] = array (
                'img' => $instance['ad3_img'],
                'link' => $instance['ad3_link']
            );

        }

        if($instance['ad4_img']) {

            $ads[] = array (
                'img' => $instance['ad4_img'],
                'link' => $instance['ad4_link']
            );

        }

        if($instance['ad5_img']) {

            $ads[] = array (
                'img' => $instance['ad5_img'],
                'link' => $instance['ad5_link']
            );

        }

        if($instance['ad6_img']) {

            $ads[] = array (
                'img' => $instance['ad6_img'],
                'link' => $instance['ad6_link']
            );

        }

        //Set counter
        $i = 1;

        //Determine how many ads were entered
        $ad_num = count($ads);

        //Display ads
        echo $before_widget;

        if($title) {

                echo $before_title . $title . $after_title;

        }

        echo '<div class="themeblvd-ad-square-buttons">';

        foreach($ads as $ad) {

                echo '<a href="' . $ad['link'] . '" title="Advertisement">';
                echo '<img src="' . $ad['img'] .'" alt="Advertisement" width="125" height="125">';
                echo '</a>';

                if($i%2 == 0 || $i == $ad_num) {

                        echo '<div class="clear"></div>';

                }

                $i++;

        }

        echo '</div>';

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['ad1_img'] = strip_tags($new_instance['ad1_img']);
        $instance['ad1_link'] = strip_tags($new_instance['ad1_link']);

        $instance['ad2_img'] = strip_tags($new_instance['ad2_img']);
        $instance['ad2_link'] = strip_tags($new_instance['ad2_link']);

        $instance['ad3_img'] = strip_tags($new_instance['ad3_img']);
        $instance['ad3_link'] = strip_tags($new_instance['ad3_link']);

        $instance['ad4_img'] = strip_tags($new_instance['ad4_img']);
        $instance['ad4_link'] = strip_tags($new_instance['ad4_link']);

        $instance['ad5_img'] = strip_tags($new_instance['ad5_img']);
        $instance['ad5_link'] = strip_tags($new_instance['ad5_link']);

        $instance['ad6_img'] = strip_tags($new_instance['ad6_img']);
        $instance['ad6_link'] = strip_tags($new_instance['ad6_link']);

        return $instance;
        
    }

    //How widget shows in WP admin
    function form($instance) {
        $defaults = ''; //No defaults for this widget
        $instance = wp_parse_args( (array) $instance, $defaults );

?>
            <p>Fill in as many ads as you would like to use. You must have at least one. Ads should be 125x125.</p>

            <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
            </p>

            <div class="ad-box">
                    <p><strong>Ad 1</strong></p>
                    <p><label for="<?php echo $this->get_field_id('ad1_img'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('ad1_img'); ?>" name="<?php echo $this->get_field_name('ad1_img'); ?>" type="text" value="<?php if( isset($instance['ad1_img']) ) echo $instance['ad1_img']; ?>" /></label></p>
                    <p><label for="<?php echo $this->get_field_id('ad1_link'); ?>">Link URL: <input class="widefat" id="<?php echo $this->get_field_id('ad1_link'); ?>" name="<?php echo $this->get_field_name('ad1_link'); ?>" type="text" value="<?php if( isset($instance['ad1_link']) ) echo $instance['ad1_link']; ?>" /></label></p>
            </div>

            <div class="ad-box">
                    <p><strong>Ad 2</strong></p>
                    <p><label for="<?php echo $this->get_field_id('ad2_img'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('ad2_img'); ?>" name="<?php echo $this->get_field_name('ad2_img'); ?>" type="text" value="<?php if( isset($instance['ad2_img']) ) echo $instance['ad2_img']; ?>" /></label></p>
                    <p><label for="<?php echo $this->get_field_id('ad2_link'); ?>">Link URL: <input class="widefat" id="<?php echo $this->get_field_id('ad2_link'); ?>" name="<?php echo $this->get_field_name('ad2_link'); ?>" type="text" value="<?php if( isset($instance['ad2_link']) ) echo $instance['ad2_link']; ?>" /></label></p>
            </div>

            <div class="ad-box">
                    <p><strong>Ad 3</strong></p>
                    <p><label for="<?php echo $this->get_field_id('ad3_img'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('ad3_img'); ?>" name="<?php echo $this->get_field_name('ad3_img'); ?>" type="text" value="<?php if( isset($instance['ad3_img']) ) echo $instance['ad3_img']; ?>" /></label></p>
                    <p><label for="<?php echo $this->get_field_id('ad3_link'); ?>">Link URL: <input class="widefat" id="<?php echo $this->get_field_id('ad3_link'); ?>" name="<?php echo $this->get_field_name('ad3_link'); ?>" type="text" value="<?php if( isset($instance['ad3_link']) ) echo $instance['ad3_link']; ?>" /></label></p>
            </div>

            <div class="ad-box">
                    <p><strong>Ad 4</strong></p>
                    <p><label for="<?php echo $this->get_field_id('ad4_img'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('ad4_img'); ?>" name="<?php echo $this->get_field_name('ad4_img'); ?>" type="text" value="<?php if( isset($instance['ad4_img']) ) echo $instance['ad4_img']; ?>" /></label></p>
                    <p><label for="<?php echo $this->get_field_id('ad4_link'); ?>">Link URL: <input class="widefat" id="<?php echo $this->get_field_id('ad4_link'); ?>" name="<?php echo $this->get_field_name('ad4_link'); ?>" type="text" value="<?php if( isset($instance['ad4_link']) ) echo $instance['ad4_link']; ?>" /></label></p>
            </div>

            <div class="ad-box">
                    <p><strong>Ad 5</strong></p>
                    <p><label for="<?php echo $this->get_field_id('ad5_img'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('ad5_img'); ?>" name="<?php echo $this->get_field_name('ad5_img'); ?>" type="text" value="<?php if( isset($instance['ad5_img']) ) echo $instance['ad5_img']; ?>" /></label></p>
                    <p><label for="<?php echo $this->get_field_id('ad5_link'); ?>">Link URL: <input class="widefat" id="<?php echo $this->get_field_id('ad5_link'); ?>" name="<?php echo $this->get_field_name('ad5_link'); ?>" type="text" value="<?php if( isset($instance['ad5_link']) ) echo $instance['ad5_link']; ?>" /></label></p>
            </div>

            <div class="ad-box">
                    <p><strong>Ad 6</strong></p>
                    <p><label for="<?php echo $this->get_field_id('ad6_img'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('ad6_img'); ?>" name="<?php echo $this->get_field_name('ad6_img'); ?>" type="text" value="<?php if( isset($instance['ad6_img']) ) echo $instance['ad6_img']; ?>" /></label></p>
                    <p><label for="<?php echo $this->get_field_id('ad6_link'); ?>">Link URL: <input class="widefat" id="<?php echo $this->get_field_id('ad6_link'); ?>" name="<?php echo $this->get_field_name('ad6_link'); ?>" type="text" value="<?php if( isset($instance['ad6_link']) ) echo $instance['ad6_link']; ?>" /></label></p>
            </div>
<?php
    }
##################################################################
} # end Themeblvd_Ads_Square_Buttons class extend
##################################################################

register_widget('Themeblvd_Ads_Square_Buttons');

?>