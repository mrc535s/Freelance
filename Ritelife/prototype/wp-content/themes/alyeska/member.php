<?php
/*
Template Name: Dieter
*/
?>

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
<?php include ('header2.php'); ?>
<div style=""><?php echo do_shortcode( "[slideshow category='welcome-show' effect='fade' speed='7' color='#FFFFFF' width='960' height='350']" ); ?></div>
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
	<h1 style="margin:10px 0;"><?php the_title(); ?><?php if (is_user_logged_in()) {
      // user is logged in, say welcome back
      $user = wp_get_current_user();
      echo ', ' . $user->first_name ;
      } else {
      // user is not logged in
      echo '';
      } ?></h1>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
		<?php the_content(); ?>
		
		
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php include ('footer2.php'); ?>