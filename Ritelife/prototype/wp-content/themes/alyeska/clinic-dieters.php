<?php
/**
 *
 * Alyeska WordPress Theme
 * Clinic Dieters
 *
 * This file displays each standard page.
 *
 * @author  Jason Bobich
 *
 */
?>
<?php if ( is_user_logged_in() ) : ?>
<?php include(TEMPLATEPATH."/header2.php");?>
<?php else: ?>
<?php include(TEMPLATEPATH."/header.php");?>
<?php endif; ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php the_post(); ?>

	<?php
         if ( function_exists(cda_list_of_clinic_subscribers) ){
                echo '<h3>Subscribers:</h3>';
                cda_list_of_clinic_subscribers();  
            }
        ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page'); ?>
    <?php endif; ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
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

<?php get_footer(); ?>