<?php
/*
Template Name: Clinc Welcome
*/
?>

<?php include ('header2.php'); ?>
<a href="http://rite4life.com.au/prototype/wp-content/uploads/2012/06/Certification-of-Affiliation.pdf" target="_blank"><img src ="http://rite4life.com.au/prototype/wp-content/uploads/2012/07/homepageclinic2.jpg" style="margin-left:10px;" /></a>
<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php the_post(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page'); ?>
    <?php endif; ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1 style="margin:10px 0; max-width:430px; display:inline;">Welcome to your Ideal Protein<?php if (is_user_logged_in()) {
      // user is logged in, say welcome back
      $user = wp_get_current_user();
      echo ', ' . $user->first_name ;
      } else {
      // user is not logged in
      echo '';
      } ?></h1><div style="float:right; margin-top:20px;"><a href="http://ritelifedev.com/dieter-records/currently-enrolled-dieters/">Active Clients: <?php echo cda_count_dieters(); ?></a></div>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
		<h2>Clinic Announcements</h2>	
		 <?php the_content(); ?> 
			
		
		
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php include ('footer2.php'); ?>