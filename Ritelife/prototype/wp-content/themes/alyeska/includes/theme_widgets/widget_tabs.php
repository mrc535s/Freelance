<?php
/**
 *
 * ThemeBlvd Tabs Widget
 *
 * This widget displays a basic
 * set of jQuery tabs.
 *
 * @author  Jason Bobich
 *
 */

class Themeblvd_Tabs extends WP_Widget {

    function Themeblvd_Tabs() {
        $widget_ops = array('classname' => 'widget_tabs', 'description' => 'Show up to 4 tabs of content.' );
        $this->WP_Widget('tabs_widget', 'ThemeBlvd Tabs', $widget_ops);
    }

    //How widget shows on front end
    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        //Retrieve Options
        $title = $instance['title'];

        $tab_titles = array();

        if( isset($instance['tab1-title']) && $instance['tab1-title']  ){
            $tab_titles[] = $instance['tab1-title'];
        }

        if( isset($instance['tab2-title']) && $instance['tab2-title']  ){
            $tab_titles[] = $instance['tab2-title'];
        }

        if( isset($instance['tab3-title']) && $instance['tab3-title']  ){
            $tab_titles[] = $instance['tab3-title'];
        }

        if( isset($instance['tab4-title']) && $instance['tab4-title'] ){
            $tab_titles[] = $instance['tab4-title'];
        }

        $tab_contents = array();

        if( isset($instance['tab1-content']) && $instance['tab1-content']  ){
            $tab_contents[] = $instance['tab1-content'];
        }

        if( isset($instance['tab2-content']) && $instance['tab2-content']  ){
            $tab_contents[] = $instance['tab2-content'];
        }

        if( isset($instance['tab3-content']) && $instance['tab3-content']  ){
            $tab_contents[] = $instance['tab3-content'];
        }

        if( isset($instance['tab4-content']) && $instance['tab4-content']  ){
            $tab_contents[] = $instance['tab4-content'];
        }

        echo $before_widget;

        if($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<div class="themeblvd-tabs">';
        echo '<div class="tab-menu">';
        echo '<ul>';

        $i = 1;

        foreach($tab_titles as $tab_title){
            echo '<li><a href="#tab'.$i.'">'.$tab_title.'</a></li>';
            $i++;
        }

        echo '</ul>';
        echo '<div class="clear"></div>';
        echo '</div><!-- .tab-menu (end) -->';
        echo '<div class="tab-wrapper">';

        $i = 1;

        foreach($tab_contents as $tab_content){
            echo '<div id="tab'.$i.'" class="tab">';
                echo do_shortcode($tab_content);
            echo '</div><!-- .tab (end) -->';
            $i++;
        }

        echo '</div><!-- .tab-wrapper (end) -->';
        echo '</div><!-- .themeblvd-tabs (end) -->';

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['tab1-title'] = strip_tags($new_instance['tab1-title']);
        $instance['tab1-content'] = $new_instance['tab1-content'];
        $instance['tab2-title'] = strip_tags($new_instance['tab2-title']);
        $instance['tab2-content'] = $new_instance['tab2-content'];
        $instance['tab3-title'] = strip_tags($new_instance['tab3-title']);
        $instance['tab3-content'] = $new_instance['tab3-content'];
        $instance['tab4-title'] = strip_tags($new_instance['tab4-title']);
        $instance['tab4-content'] = $new_instance['tab4-content'];

        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {
        $defaults = array(
            'title' => '',
            'tab1-title' => 'Latest',
            'tab1-content' => '[recent_posts num="3"]',
            'tab2-title' => 'Popular',
            'tab2-content' => '[popular_posts]',
            'tab3-title' => 'Comments',
            'tab3-content' => '[recent_comments]',
            'tab4-title' => 'Tags',
            'tab4-content' => '[tags]'
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>

        <div class="ad-box">
            <p><label for="<?php echo $this->get_field_id('tab1-title'); ?>">Tab 1 Title: <input class="widefat" id="<?php echo $this->get_field_id('tab1-title'); ?>" name="<?php echo $this->get_field_name('tab1-title'); ?>" type="text" value="<?php if( isset($instance['tab1-title']) ) echo $instance['tab1-title']; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('tab1-content'); ?>">Tab 1 Content: <textarea class="widefat" id="<?php echo $this->get_field_id('tab1-content'); ?>" name="<?php echo $this->get_field_name('tab1-content'); ?>"><?php if( isset($instance['tab1-content']) ) echo $instance['tab1-content']; ?></textarea></label></p>
        </div>

        <div class="ad-box">
            <p><label for="<?php echo $this->get_field_id('tab2-title'); ?>">Tab 2 Title: <input class="widefat" id="<?php echo $this->get_field_id('tab2-title'); ?>" name="<?php echo $this->get_field_name('tab2-title'); ?>" type="text" value="<?php if( isset($instance['tab2-title']) ) echo $instance['tab2-title']; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('tab2-content'); ?>">Tab 2 Content: <textarea class="widefat" id="<?php echo $this->get_field_id('tab2-content'); ?>" name="<?php echo $this->get_field_name('tab2-content'); ?>"><?php if( isset($instance['tab2-content']) ) echo $instance['tab2-content']; ?></textarea></label></p>
        </div>

        <div class="ad-box">
            <p><label for="<?php echo $this->get_field_id('tab3-title'); ?>">Tab 3 Title: <input class="widefat" id="<?php echo $this->get_field_id('tab3-title'); ?>" name="<?php echo $this->get_field_name('tab3-title'); ?>" type="text" value="<?php if( isset($instance['tab3-title']) ) echo $instance['tab3-title']; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('tab3-content'); ?>">Tab 3 Content: <textarea class="widefat" id="<?php echo $this->get_field_id('tab3-content'); ?>" name="<?php echo $this->get_field_name('tab3-content'); ?>"><?php if( isset($instance['tab3-content']) ) echo $instance['tab3-content']; ?></textarea></label></p>
        </div>

        <div class="ad-box">
            <p><label for="<?php echo $this->get_field_id('tab4-title'); ?>">Tab 4 Title: <input class="widefat" id="<?php echo $this->get_field_id('tab4-title'); ?>" name="<?php echo $this->get_field_name('tab4-title'); ?>" type="text" value="<?php if( isset($instance['tab4-title']) ) echo $instance['tab4-title']; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('tab4-content'); ?>">Tab 4 Content: <textarea class="widefat" id="<?php echo $this->get_field_id('tab4-content'); ?>" name="<?php echo $this->get_field_name('tab4-content'); ?>"><?php if( isset($instance['tab4-content']) ) echo $instance['tab4-content']; ?></textarea></label></p>
        </div>
        
        <?php
        }
        
##################################################################
} # end Themeblvd_Tabs class extend
##################################################################

register_widget('Themeblvd_Tabs');

?>