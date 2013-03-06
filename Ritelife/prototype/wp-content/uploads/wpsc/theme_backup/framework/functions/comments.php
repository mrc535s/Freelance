<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Breadcrumbs
 *
 * This file helps display single post
 * comments.
 *
 * NOTE: This file is depreciated. I'm currently
 * in the process of working it out of all themes,
 * however it's still used in some.
 *
 * @author  Jason Bobich
 *
 */
 
function time_ago( $type = 'post' ) {

    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
        $commenter = get_comment_author_link();
        if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
                $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
        } else {
                $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
        }
        $avatar_email = get_comment_author_email();
        $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
        echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
  ?>
        <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        
        		<div class="comment-left">
                            
                    <?php echo get_avatar(get_comment_author_email(), 48); ?>
    
                </div><!-- .comment-left (end) -->
				<div class="comment-right">
					<div class="comment-right-inner">
                    
                    	<p style="margin-top: 0;">
                        	<span class="name"><?php comment_author_link(); ?></span><br />
	                        <span class="smaller date"><?php echo time_ago('comment'); ?></span>
						</p>
						
						<?php comment_text(); ?>
						
						<p style="margin-bottom: 0;">
                        	
                        	<?php // echo the comment reply link
			                if($args['type'] == 'all' || get_comment_type() == 'comment') :
			                        comment_reply_link(array_merge($args, array(
			                                'reply_text' => __('Reply','themeblvd'),
			                                'login_text' => __('Log in to reply.','themeblvd'),
			                                'depth' => $depth,
			                                'before' => '<span class="reply-link ie6">', 
			                                'after' => '</span>'
			                        )));
			                endif;
			                ?>
                        	
                        	</span>
                        </p>
                    
                    </div><!-- .comment-right-inner (end) -->
                </div><!-- .comment-right (end) -->
				
                <div class="clear"></div>
<?php } // end custom_comments


// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
                <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                        <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'flipblog'),
                                        get_comment_author_link(),
                                        get_comment_date(),
                                        get_comment_time() );
                                        edit_comment_link(__('Edit', 'flipblog'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            <div class="comment-content">
                        <?php comment_text() ?>
                        </div>
<?php } // end custom_pings
?>