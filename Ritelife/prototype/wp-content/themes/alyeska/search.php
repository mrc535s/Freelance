<?php
/**
 *
 * Alyeska WordPress Theme
 * Search Results
 *
 * This file displays search results.
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
        <?php echo themeblvd_theme_hints('search'); ?>
    <?php endif; ?>
	
	<h1><?php _e("Search Results for ", "themeblvd"); ?> <?php echo $s; ?></h1>
	
	<div class="page">
	
		<div class="top"><!-- --></div>
	
	    <?php if ( have_posts() ) : ?> 
	    
		    <?php while ( have_posts() ) : the_post(); ?>
		
				<div class="archive">
	                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	                <?php the_excerpt(); ?>
	            </div><!-- .achive (end) -->
			
			<?php endwhile; ?>
		
		<?php else : ?>
		
	    	<p class="warning"><?php _e('There are no posts to show.', "themeblvd"); ?></p>
	    	
	    <?php endif; ?>
	    
	    <div class="clear"></div>
    
    	<div class="bottom"><!-- --></div>
			
	</div><!-- .page (end) -->

    <!-- Pagination -->
    <?php themeblvd_pagination(); ?>
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>