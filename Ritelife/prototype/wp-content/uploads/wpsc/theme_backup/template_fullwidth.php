<?php 
/*
Template Name: Full Width Page
*/
?>
<?php get_header(); ?>

<div id="full-width-content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page-full-width'); ?>
    <?php endif; ?>
	
	<?php the_post(); ?>
	
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
	
</div><!-- #full-width-content (end) -->

<?php get_footer(); ?>