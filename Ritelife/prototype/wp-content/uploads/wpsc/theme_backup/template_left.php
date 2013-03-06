<?php 
/*
Template Name: Sidebar Left
*/
?>
<?php get_header(); ?>

<?php get_sidebar(); ?>	

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

<?php get_footer(); ?>