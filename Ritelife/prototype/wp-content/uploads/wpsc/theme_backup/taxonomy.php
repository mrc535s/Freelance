<?php 
/**
 *
 * Alyeska WordPress Theme
 * Portfolio Taxonomy
 *
 * This file displays the portfolios and portfolio
 * tag pages. It is named simply taxonomy.php because
 * we have no other taxonmies with this theme that
 * need displaying other than for Portfolios.
 *
 * @author  Jason Bobich
 *
 */
 
//Display Header
get_header();

//Get Term Info and construct page title
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_name = $term->name;
$term_slug = $term->slug;
$term_type = $term->taxonomy;

if($term_type == 'portfolio-tag'){

    //Title for portfolio tag pages
    $page_title = 'Tag: '.$term->name;

} else {

    //Title for standard portfolio pages
    $page_title = $term->name;

}

//Set Post Count
$post_num = 1;
?>

<div id="full-width-content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('portfolio'); ?>
    <?php endif; ?>
	
	<?php if($themeblvd_portfolio_page_title != 'false') : ?>
	<h1><?php echo $term_name; ?></h1>
	<?php endif; ?>
	
	<?php if($themeblvd_portfolio_page_description != 'false') : ?>
	<div class="page-content">
		<?php echo category_description(); ?>
	</div><!-- .page-content (end) -->
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
		
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
        <?php query_posts("paged=$paged&portfolio=$term_slug&posts_per_page=$themeblvd_items_per_page"); ?>
        <!-- Start the Loop -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <?php
        //Items to pass into themeblvd_media()
        $input = get_post_meta($post->ID, 'themeblvd_media_item', true);
        $autostart = 1;
        $color = $themeblvd_media_color;
        $logo = $themeblvd_video_logo;
        $logo_width = $themeblvd_video_logo_width;
        $logo_height = $themeblvd_video_logo_height;

        $media_link = themeblvd_media($input, $autostart, $color, $logo, $logo_width, $logo_height);
        ?>
        
        <div class="one-third portfolio-box<?php if($post_num % 3 == 0) { echo " last"; } ?>">
        	
        	<!-- Item Thumbnail -->
	        <?php if($themeblvd_thumbnail == 'false') : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumb thumb-media loader">
            <?php else : ?>
            <a href="<?php echo $media_link; ?>" title="<?php the_title(); ?>" class="thumb thumb-media loader" rel="lightbox[gallery]">
            <?php endif; ?>
                <span class="enlarge">
	                <?php if ( has_post_thumbnail() ) : ?>
	                    <?php the_post_thumbnail('portfolio', array("class" => "pretty")); ?>
	                <?php else : ?>
	                    <p><?php _e('Oops! You forgot set a featured image.', 'themeblvd'); ?></p>
	                <?php endif; ?>
				</span>
            </a>

	        <!-- Item Title -->	        
	        <?php if($themeblvd_show_title == 'true') : ?>
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <?php endif; ?>
	        
	        <!-- Item Excerpt -->
            <?php if($themeblvd_show_excerpt == 'true') : ?>
                <?php the_excerpt(); ?>
            <?php endif; ?>
			
			<!-- Item Read More Link -->
			<?php if($themeblvd_show_read_more == 'true') : ?>
			<p>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button">
					<span class="left">
						<span class="right">
							<span class="middle"><?php _e("Read More", "themeblvd"); ?></span>
						</span><!-- .right (end) -->
					</span><!-- .left (end) -->
				</a><!-- .button (end) -->
			</p>
			<?php endif; ?>
			
	    </div><!-- .portfolio-box (end) -->
		
		<?php if($post_num % 3 == 0) : ?>
        <!-- Clear floats every 3 divs -->
        <div class="clear"></div>
        <?php endif; ?>

        <?php $post_num++; ?>

        <?php endwhile; ?>

        <div class="clear"></div>

        <!-- Pagination -->
        <?php themeblvd_pagination(); ?>

        <?php else: ?>

        <p><?php _e("Sorry, no posts matched your criteria.", "themeblvd"); ?></p>

        <?php endif; ?>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #full-width-content (end) -->

<?php get_footer(); ?>