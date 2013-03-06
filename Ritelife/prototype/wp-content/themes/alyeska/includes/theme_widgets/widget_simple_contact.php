<?php
/**
 *
 * ThemeBlvd Simple Contact Widget
 *
 * This widget displays basic contact information.
 *
 * @author  Jason Bobich
 *
 */

class themeblvd_Simple_Contact extends WP_Widget {

	function themeblvd_Simple_Contact() {
            $widget_ops = array('classname' => 'widget_contact', 'description' => 'Display some basic contact information.' );
            $this->WP_Widget('contact_widget', 'ThemeBlvd Simple Contact', $widget_ops);
	}
	
	//How widget shows on front end 
	function widget($args, $instance){
            extract($args, EXTR_SKIP);

            //Retrieve Options
            if( isset($instance['title']) ){
                $title = $instance['title'];
            } else {
                $title = "";
            }
            if( isset($instance['phone']) ){
                $phone = $instance['phone'];
            } else {
                $phone = "";
            }
            if( isset($instance['email']) ){
                $email = $instance['email'];
            } else {
                $email = "";
            }
            if( isset($instance['contact_form']) ){
                $contact_form = $instance['contact_form'];
            } else {
                $contact_form = "";
            }
            if( isset($instance['skype']) ){
                $skype = $instance['skype'];
            } else {
                $skype = "";
            }
            if( isset($instance['rss']) ){
                $rss = $instance['rss'];
            } else {
                $rss = "";
            }
            if( isset($instance['twitter']) ){
                $twitter = $instance['twitter'];
            } else {
                $twitter = "";
            }
            if( isset($instance['facebook']) ){
                $facebook = $instance['facebook'];
            } else {
                $facebook = "";
            }
            if( isset($instance['myspace']) ){
                $myspace = $instance['myspace'];
            } else {
                $myspace = "";
            }
            if( isset($instance['flickr']) ){
                $flickr = $instance['flickr'];
            } else {
                $flickr = "";
            }
            if( isset($instance['linkedin']) ){
                $linkedin = $instance['linkedin'];
            } else {
                $linkedin = "";
            }

            echo $before_widget;

            if($title) {

                echo $before_title . $title . $after_title;

            }

?>

            <ul class="themeblvd-simple-contact">
                    <?php if( $phone ) : ?>
                    <li class="phone ie6"><?php echo $phone; ?></li>
                    <?php endif; ?>

                    <?php if( $email ) : ?>
                    <li class="email ie6"><a href="mailto:<?php echo $email; ?>" title="Email Us"><?php echo $email; ?></a></li>
                    <?php endif; ?>

                    <?php if( $contact_form ) : ?>
                    <li class="contact-form ie6"><a href="<?php echo $contact_form; ?>" title="Contact Form">Contact Form</a></li>
                    <?php endif; ?>

                    <?php if( $skype ) : ?>
                    <li class="skype ie6"><?php echo $skype; ?></li>
                    <?php endif; ?>

                    <?php if( $rss || $twitter || $facebook || $myspace || $flickr || $linkedin ) : ?>
                    <li class="links ie6">
                        <ul class="social-links">

                            <?php if( $rss ) : ?>
                            <li><a href="<?php echo $rss; ?>" title="RSS" class="rss ie6 image-button">RSS</a></li>
                            <?php endif; ?>

                            <?php if( $twitter ) : ?>
                            <li><a href="<?php echo $twitter; ?>" title="Twitter" class="twitter ie6 image-button">Twitter</a></li>
                            <?php endif; ?>

                            <?php if( $facebook ) : ?>
                            <li><a href="<?php echo $facebook; ?>" title="Facebook" class="facebook ie6 image-button">Facebook</a></li>
                            <?php endif; ?>

                            <?php if( $myspace ) : ?>
                            <li><a href="<?php echo $myspace; ?>" title="Myspace" class="myspace ie6 image-button">Myspace</a></li>
                            <?php endif; ?>

                            <?php if( $flickr ) : ?>
                            <li><a href="<?php echo $flickr; ?>" title="Flickr" class="flickr ie6 image-button">Flickr</a></li>
                            <?php endif; ?>

                            <?php if( $linkedin ) : ?>
                            <li><a href="<?php echo $linkedin; ?>" title="LinkedIn" class="linkedin ie6 image-button">LinkedIn</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                    <?php endif; ?>
            </ul>

            <?php echo $after_widget; ?>

<?php

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['contact_form'] = strip_tags($new_instance['contact_form']);
        $instance['skype'] = strip_tags($new_instance['skype']);
        $instance['rss'] = strip_tags($new_instance['rss']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['myspace'] = strip_tags($new_instance['myspace']);
        $instance['flickr'] = strip_tags($new_instance['flickr']);
        $instance['linkedin'] = strip_tags($new_instance['linkedin']);

        return $instance;
        
    }

    //How widget shows in WP admin
    function form($instance) {
        
        $defaults = array( 'title' => __('Get in Touch') );
        $instance = wp_parse_args( (array) $instance, $defaults );

?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('phone'); ?>">Phone: <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php if( isset($instance['phone']) ) echo $instance['phone']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('email'); ?>">Email: <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php if( isset($instance['email']) ) echo $instance['email']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('contact_form'); ?>">Contact Page URL: <input class="widefat" id="<?php echo $this->get_field_id('contact_form'); ?>" name="<?php echo $this->get_field_name('contact_form'); ?>" type="text" value="<?php if( isset($instance['contact_form']) ) echo $instance['contact_form']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('skype'); ?>">Skype Username: <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php if( isset($instance['skype']) ) echo $instance['skype']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('rss'); ?>">RSS URL: <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php if( isset($instance['rss']) ) echo $instance['rss']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter URL: <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php if( isset($instance['twitter']) ) echo $instance['twitter']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook URL: <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php if( isset($instance['facebook']) ) echo $instance['facebook']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('myspace'); ?>">MySpace URL: <input class="widefat" id="<?php echo $this->get_field_id('myspace'); ?>" name="<?php echo $this->get_field_name('myspace'); ?>" type="text" value="<?php if( isset($instance['myspace']) ) echo $instance['myspace']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('flickr'); ?>">Flickr URL: <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php if( isset($instance['flickr']) ) echo $instance['flickr']; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('linkedin'); ?>">LinkedIn URL: <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php if( isset($instance['linkedin']) ) echo $instance['linkedin']; ?>" /></label></p>

<?php

            }
            
##################################################################
} # end Themeblvd_Simple_Contact class extend
##################################################################

register_widget('themeblvd_Simple_Contact');

?>