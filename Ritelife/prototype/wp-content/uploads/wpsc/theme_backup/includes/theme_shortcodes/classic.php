<?php
/**
 *
 * Alyeska Shortcodes
 *
 * The classics... lovin' the classics! These shortcodes
 * are primarly here to be used in the ThemeBlvd Tabs widget.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Recent Posts
##############################################################

function shortcode_recent_posts($atts, $content = null) {

    extract(shortcode_atts(array(
        'category' => '',
        'num' => '5',
        'meta' => 'true'
    ), $atts));

    $output = '<div class="themeblvd-recent-posts">';

    global $post;

    $latest = get_posts('&cat='.$category.'&orderby=post_date&order=desc&numberposts='.$num);
    
    foreach($latest as $post) {

        setup_postdata($post);

        $output .= '<div class="tiny-entry">';

        if ( has_post_thumbnail($post->ID) ){
            $output .= get_the_post_thumbnail($post->ID, 'micro', array( "class" => "pretty" ));
        }

        $output .= '<span class="title">';
            $output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
                $output .= get_the_title($post->ID);
            $output .= '</a>';
            if($meta == 'true'){
                $output .= '<span class="meta">';
                    $output .= __('Posted on ', 'themeblvd');
                    $output .= get_the_time( get_option( 'date_format' ) );
                $output .= '</span>';
            }
        $output .= '</span>';
        $output .= '<div class="clear"></div>';
        $output .= '</div><!-- .entry (end) -->';

    }

    $output .= '</div><!-- .themeblvd-recent-posts (end) -->';

    return $output;
    
}

add_shortcode('recent_posts', 'shortcode_recent_posts');

##############################################################
# Recent Comments
##############################################################

function shortcode_recent_comments($atts, $content = null) {

    extract(shortcode_atts(array(
        'num' => '5'
    ), $atts));

    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
    comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
    comment_type,comment_author_url,
    SUBSTRING(comment_content,1,50) AS com_excerpt
    FROM $wpdb->comments
    LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
    $wpdb->posts.ID)
    WHERE comment_approved = '1' AND comment_type = '' AND
    post_password = ''
    ORDER BY comment_date_gmt DESC LIMIT ".$num;

    $comments = $wpdb->get_results($sql);

    $output = '<ul>';

    foreach ($comments as $comment) {

        $output .= '<li>';
            $output .= '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">';
                 $output .= strip_tags($comment->comment_author).' : '.strip_tags($comment->com_excerpt).'...';
            $output .= '</a>';
        $output .= '</li>';

    }

    $output .= '</ul>';

    return $output;

}

add_shortcode('recent_comments', 'shortcode_recent_comments');

##############################################################
# Tag Cloud
##############################################################

function shortcode_tags($atts, $content = null) {

    $output = '<div class="themeblvd-tags">';

    $tags = wp_tag_cloud('smallest=12&largest=20&format=array');

    foreach($tags as $tag){
        $output .= $tag.' ';
    }

    $output .= '</div><!-- .themeblvd-tags (end) -->';

    return $output;

}

add_shortcode('tags', 'shortcode_tags');

##############################################################
# Popular Posts
##############################################################

function shortcode_popular_posts($atts, $content = null) {

    extract(shortcode_atts(array(
        'num' => '5'
    ), $atts));

    $popular = get_posts('orderby=comment_count&numberposts='.$num);

    $output = '<ul>';

    foreach($popular as $post){
        
        setup_postdata($post);

        $output .= '<li>';
            $output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
                $output .= get_the_title($post->ID);
            $output .= '</a>';
        $output .= '</li>';

    }

    $output .= '</ul>';

    return $output;

}

add_shortcode('popular_posts', 'shortcode_popular_posts');


?>