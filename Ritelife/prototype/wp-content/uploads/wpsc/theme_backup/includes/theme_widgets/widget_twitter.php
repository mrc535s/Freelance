<?php
/**
 *
 * ThemeBlvd Twitter Widget
 *
 * This widgets displays recent items form
 * your Twitter account.
 * 
 * @author  Jason Bobich
 *
 */

class Themeblvd_Twitter_Feed extends WP_Widget {

    function Themeblvd_Twitter_Feed() {
        $widget_ops = array('classname' => 'widget_twitter', 'description' => 'Show a list of your most recent tweets.' );
        $this->WP_Widget('twitter_widget', 'ThemeBlvd Twitter Feed', $widget_ops);
    }

    //How widget shows on front end
    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        //Retrieve Options
        $account = $instance['account'];  // Your Twitter account name
        $title = $instance['title'];  // Title in sidebar for widget
        $show = $instance['show'];  // # of Updates to show
        $link = $instance['link'];  // Text for follow link

        echo '<script type="text/javascript">
            jQuery.noConflict()(function($){
                $(document).ready(function() {
                    $(".twitter_div").getTwitter({
                        userName: "'.$account.'",
                        numTweets: '.$show.',
                        loaderText: "Loading tweets...",
                        slideIn: true,
                        slideDuration: 750,
                        showHeading: false,
                        showProfileLink: false,
                        showTimestamp: true
                    });
                });
            });
        </script>';

        echo $before_widget;

        if($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<div class="twitter_div"></div>';

        if($link) {
            echo '<a href="http://www.twitter.com/' . $account . '" title="' . $link . '" class="twitter-follow">' . $link . '</a>';
        }

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['account'] = strip_tags($new_instance['account']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['show'] = strip_tags($new_instance['show']);
        $instance['link'] = strip_tags($new_instance['link']);

        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {
        $defaults = array( 'title' => __('Latest Tweets'), 'account' => __('jasonbobich'), 'show' => __('5'), 'link' => __('Follow Us!'));
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('account'); ?>">Account: <input class="widefat" id="<?php echo $this->get_field_id('account'); ?>" name="<?php echo $this->get_field_name('account'); ?>" type="text" value="<?php if( isset($instance['account']) ) echo $instance['account']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('show'); ?>">Number of Tweets: <input class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>" type="text" value="<?php if( isset($instance['show']) ) echo $instance['show']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('link'); ?>">Follow Text: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php if( isset($instance['link']) ) echo $instance['link']; ?>" /></label></p>

        <?php
        }
        
##################################################################
} # end Themeblvd_Twitter_Feed class extend
##################################################################

register_widget('Themeblvd_Twitter_Feed');

?>