<?php
/**
 *
 * ThemeBlvd Author Widget
 *
 * This widget displays information about
 * anyone you choose with a gravatar image,
 * description, and link.
 *
 * @author  Jason Bobich
 *
 */

class Themeblvd_Author extends WP_Widget {

    function Themeblvd_Author() {
        $widget_ops = array('classname' => 'widget_author', 'description' => 'Show a gravatar, description, and link for someone.' );
        $this->WP_Widget('author_widget', 'ThemeBlvd Author Box', $widget_ops);
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

        if( isset($instance['email']) ){
            $email = $instance['email'];
        } else {
            $email = '';
        }

        if( isset($instance['size']) ){
            $size = $instance['size'];
        } else {
            $size = '';
        }

        if( isset($instance['description']) ){
            $description = $instance['description'];
        } else {
            $description = '';
        }

        if( isset($instance['link-text']) ){
            $link_text = $instance['link-text'];
        } else {
            $link_text = '';
        }

        if( isset($instance['link-url']) ){
            $link_url= $instance['link-url'];
        } else {
            $link_url = '';
        }

        echo $before_widget;

        if($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<div class="themeblvd-author">';

        if($email){
            echo '<div class="frame alignleft">';
                echo get_avatar( $email, $size );
            echo '</div>';
        }

        if($description){
            echo '<p>'.$description.'<p>';
        }

        if(isset($link_text)) {
            echo '<a href="'.$link_url.'" title="'.$link_text.'">'.$link_text.'</a>';
        }

        echo '</div><!-- .themeblvd-author (end) -->';

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['size'] = strip_tags($new_instance['size']);
        $instance['description'] = $new_instance['description'];
        $instance['link-text'] = strip_tags($new_instance['link-text']);
        $instance['link-url'] = strip_tags($new_instance['link-url']);


        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {
        
        $defaults = array( 'title' => 'John Smith', 'email' => 'author@authoremail.com', 'size' => '60', 'description' => '', 'link-text' => 'Learn More', 'link-url' => 'http://www.authorsite.com');
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('email'); ?>">Gravatar Email Address <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php if( isset($instance['email']) ) echo $instance['email']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('size'); ?>">Gravatar Size <input class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" value="<?php if( isset($instance['size']) ) echo $instance['size']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('description'); ?>">Description <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php if( isset($instance['description']) ) echo $instance['description']; ?></textarea></label></p>

        <p><label for="<?php echo $this->get_field_id('link-text'); ?>">Link Text <input class="widefat" id="<?php echo $this->get_field_id('link-text'); ?>" name="<?php echo $this->get_field_name('link-text'); ?>" type="text" value="<?php if( isset($instance['link-text']) ) echo $instance['link-text']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('link-url'); ?>">Link URL <input class="widefat" id="<?php echo $this->get_field_id('link-url'); ?>" name="<?php echo $this->get_field_name('link-url'); ?>" type="text" value="<?php if( isset($instance['link-url']) ) echo $instance['link-url']; ?>" /></label></p>
    

        <?php
        }

##################################################################
} # end Themeblvd_Author class extend
##################################################################

register_widget('Themeblvd_Author');

?>