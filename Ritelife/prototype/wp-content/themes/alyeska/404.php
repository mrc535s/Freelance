<?php
/**
 *
 * Alyeska WordPress Theme
 * 404
 *
 * This file displays your 404 message
 * when the user comes across a url that
 * doesn't exist.
 *
 * @author  Jason Bobich
 *
 */
?>

<?php get_header(); ?>

<?php themeblvd_breadcrumbs(); ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<h1><?php _e("Oops!", "themeblvd"); ?></h1>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
		<?php _e("The page you are looking for does not exist.", "themeblvd"); ?>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>