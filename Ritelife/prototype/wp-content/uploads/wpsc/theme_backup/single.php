<?php
/**
 *
 * Alyeska WordPress Theme
 * Single Post
 *
 * This file displays each single blog
 * post.
 *
 * @author  Jason Bobich
 *
 */
?>
<?php get_header(); ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('single'); ?>
    <?php endif; ?>
	
	<?php the_post(); ?>
	
	<!-- Title -->
	
	<h1 class="single"><?php the_title(); ?></h1>
	
	<!-- Meta Info -->
		
	<span class="single-meta"><?php _e('Posted by', "themeblvd"); ?> <?php the_author(); ?> - <?php the_time( get_option('date_format') ); ?> - <?php the_category(', '); ?> - <a href="<?php the_permalink(); ?>#comments-wrap" class="comments-link"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></a></span>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
		
		<!-- Featured Image -->
		
		<?php if($themeblvd_single_thumb == 'show') : ?>
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumb">
				<?php the_post_thumbnail('blog-1', array('class' => 'frame')); ?>
			</div>
	        <?php endif; ?>
        <?php endif; ?>
        
        <!-- CONTENT (start) -->
		
		<?php the_content(); ?>
		
		<!-- CONTENT (end) -->
		
		<?php edit_post_link( __('Edit Page', 'themeblvd'), '<p>', '</p>' ); ?>
		
		<?php wp_link_pages() ?>

		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
	<!-- Comments -->
	<?php if( comments_open() ) : ?>
		<?php comments_template('', true); ?>
	<?php endif; ?>	

</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>