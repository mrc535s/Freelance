<?php
/**
 *
 * ThemeBlvd Feedback Widget
 *
 * Displays a single quote form a client
 * or whatever with a name and tagline beneath.
 *
 * @feedback  Jason Bobich
 *
 */

class Themeblvd_Feedback extends WP_Widget {

    function Themeblvd_Feedback() {
        $widget_ops = array('classname' => 'widget_feedback', 'description' => 'Display a quote form a client.' );
        $this->WP_Widget('feedback_widget', 'ThemeBlvd Feedback', $widget_ops);
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

        if( isset($instance['quote']) ){
            $quote = $instance['quote'];
        } else {
            $quote = '';
        }

        if( isset($instance['name']) ){
            $name = $instance['name'];
        } else {
            $name = '';
        }

        if( isset($instance['tagline']) ){
            $tagline = $instance['tagline'];
        } else {
            $tagline = '';
        }

        echo $before_widget;

        if($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<div class="themeblvd-feedback">';

            echo '<div class="feedback-top"><!-- --></div>';
            echo '<div class="feedback-middle">';
                echo '<p>'.$quote.'</p>';
            echo '</div><!-- .feedback-middle (end) -->';
            echo '<div class="feedback-bottom"><!-- --></div>';

            echo '<div class="feedback-meta">';
                echo '<span class="name">';
                    echo $name;
                echo '</span>';
                echo '<span class="tagline">';
                    echo '<em>'.$tagline.'</em>';
                echo '</span>';
            echo '</div><!-- .feedback-client (end) -->';

        echo '</div><!-- .themeblvd-feedback (end) -->';

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['quote'] = strip_tags($new_instance['quote']);
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['tagline'] = $new_instance['tagline'];


        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {
        
        $defaults = array( 'title' => '', 'quote' => '', 'name' => '', 'tagline' => '');
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('quote'); ?>">Quote <textarea class="widefat" id="<?php echo $this->get_field_id('quote'); ?>" name="<?php echo $this->get_field_name('quote'); ?>"><?php if( isset($instance['quote']) ) echo $instance['quote']; ?></textarea></label></p>

        <p><label for="<?php echo $this->get_field_id('name'); ?>">Name <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php if( isset($instance['name']) ) echo $instance['name']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('tagline'); ?>">Tagline <input class="widefat" id="<?php echo $this->get_field_id('tagline'); ?>" name="<?php echo $this->get_field_name('tagline'); ?>" type="text" value="<?php if( isset($instance['tagline']) ) echo $instance['tagline']; ?>" /></label></p>

        <?php
        }

##################################################################
} # end Themeblvd_Feedback class extend
##################################################################

register_widget('Themeblvd_Feedback');

?>