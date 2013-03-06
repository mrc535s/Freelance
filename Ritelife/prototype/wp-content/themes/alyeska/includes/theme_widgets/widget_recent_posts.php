<?php 
/**
 *
 * ThemeBlvd Recent Posts Widget
 *
 * This widget displays a list of recent posts.
 * More options are given than the standard
 * WordPress Recent Posts widget.
 *
 * @author  Jason Bobich
 *
 */

class themeblvd_Recent_Posts extends WP_Widget {
    
    function themeblvd_Recent_Posts() {
        $widget_ops = array('classname' => 'widget_recent_posts', 'description' => 'Lists out recent posts from a category of your choice. You can also set it to display posts from all categories. You can achieve a slightly different look than Wordpress\'s default "Recent Posts" widget.' );
        $this->WP_Widget('recent_posts_widget', 'ThemeBlvd Recent Posts', $widget_ops);
    }

    //How widget shows on front end
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        global $post;

        //Our variables from the widget settings
        $title = apply_filters('widget_title', $instance['title'] );
        $feed_num = $instance['num'];
        $meta = $instance['meta'];
        $category = '';
        
        if( $instance['category'] != 'all' ) {
            $category = '&category=' . $instance['category'];
        } else {
            $category = '';
        }

        $query_string = "numberposts=$feed_num$category";
        $news = get_posts($query_string);

        echo $before_widget;

        if($title){

                echo $before_title . $title . $after_title;

        }

        echo '<div class="themeblvd-recent-posts">';


        foreach($news as $post) {

            setup_postdata($post);
            ?>

            <div class="tiny-entry">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('micro', array( "class" => "pretty" )); ?>
                <?php endif; ?>
                <span class="title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    <?php if($meta == 'on') : ?>
                    <span class="meta">
                            <?php print __('Posted on '); the_time( get_option( 'date_format' ) ); ?>
                    </span>
                    <?php endif; ?>
                </span>
                <div class="clear"></div>
            </div>

            <?php

        }

        echo '</div><!-- .themeblvd-recent-posts (end) -->';

        echo $after_widget;

    }

    //Save admin settings for widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['num'] = strip_tags( $new_instance['num'] );
        $instance['category'] = $new_instance['category'];
        $instance['meta'] = $new_instance['meta'];
        return $instance;
    }

    //How widget shows in WP admin
    function form($instance) {
        $defaults = ''; //No defaults
        $instance = wp_parse_args( (array) $instance, $defaults );

?>			
        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label><br />
            <input class="widefat" style="width: 95%" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
        </p>

        <!-- # of Posts: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'num' ); ?>">Number of posts to show: </label>
            <input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php if( isset($instance['num']) ) echo $instance['num']; ?>" class="widefat" style="width:40px;" />
        </p>

        <!-- Blog Category -->

        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>">Blog Category: </label>
            <?php

            $entries = get_categories('title_li=&orderby=name&hide_empty=0');

            echo '<select name="' . $this->get_field_name( 'category' ) . '" id="' . $this->get_field_id( 'category' ) . '">';
            echo '<option value="all">All Categories</option>';

            foreach ($entries as $key => $entry) {

                $id = $entry->term_id;
                $title = $entry->name;


                if ( $instance['category'] == $id) {

                    $selected = "selected='selected'";

                } else {

                    $selected = "";
                }

                echo "<option $selected value='". $id."'>" . $title . "</option>";
            }

            echo '</select>';


            ?>

        </p>

        <!-- Show meta? -->
        <p>
            <label for="<?php echo $this->get_field_id( 'meta' ); ?>">Show date posted?</label>
            <input type="checkbox" id="<?php echo $this->get_field_id( 'meta' ); ?>" name="<?php echo $this->get_field_name( 'meta' ); ?>" <?php if( isset($instance['meta']) && $instance['meta'] == 'on') { echo "checked"; } ?> style="width:40px;" class="widefat" />
        </p>
					
<?php
    }

##################################################################
} # end Themeblvd_Recent_Posts class extend
##################################################################

register_widget('themeblvd_Recent_Posts');

?>