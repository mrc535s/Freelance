<?php
/**
 *
 * Alyeska WordPress Theme
 * Standard Page
 *
 * This file displays each standard page.
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
	
	<?php the_post(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page'); ?>
    <?php endif; ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
		<?php the_content(); ?>
		
		<?php edit_post_link( __('Edit Page', 'themeblvd'), '<p>', '</p>' ); ?>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>