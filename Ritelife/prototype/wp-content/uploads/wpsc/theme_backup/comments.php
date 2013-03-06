<?php
/**
 *
 * Alyeska WordPress Theme
 * Comments
 *
 * This file displays the comments and
 * comment form for each single blog post.
 *
 * @author  Jason Bobich
 *
 */
?>

<div id="comments">
	
	<!-- Prevents loading the file directly -->
	<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	    <?php die('Please do not load this page directly or we will hunt you down. Thanks and have a great day!'); ?>
	<?php endif; ?>
	
	<!-- Password Required -->
	<?php if(!empty($post->post_password)) : ?>
	    <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	    <?php endif; ?>
	<?php endif; ?>
		
	
	<!-- COMMENTS (start) -->
            
	<div id="comments-wrap">
		
		<h3><?php comments_number( __('No comments', "themeblvd"), __('One comment', "themeblvd"), __('% comments', "themeblvd") ); ?></h3>
		
		<?php global $themeblvd_theme_hints; ?>
		<?php if( $themeblvd_theme_hints == 'true' ) : ?>
	        <?php echo themeblvd_theme_hints('comments'); ?>
	    <?php endif; ?>
		
		<?php if($comments) : ?>
		
		<ul>
	    	<?php wp_list_comments( array( 'style' => 'ul', 'max_depth' => 2, 'avatar_size' => 48 ) ); ?>
	    </ul>
	    
	    <?php endif; ?>
	    
	</div><!-- #comments-wrap (end) -->

	<!-- COMMENTS (end) -->
		

	<!-- COMMENT FORM (start) -->
	
	<div class="page">
		
		<div class="top"><!-- --></div>
	
			<?php comment_form(); ?>
	
		<div class="bottom"><!-- --></div>
	
	</div><!-- .page (end) -->
	
	<!-- COMMENT FORM (end) -->
	
</div><!--#comments-->