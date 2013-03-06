<?php
/**
 *
 * Alyeska WordPress Theme
 * Homepage
 *
 * This file displays the theme's default homepage.
 *
 * @author  Jason Bobich
 *
 */
?>
<?php get_header(); ?>

<div id="homepage">
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('index'); ?>
    <?php endif; ?>
	
	<!-- HOMEPAGE SORTABLE ELEMENTS (start) -->
	
	<?php
	foreach($themeblvd_homepage_sort as $element) :
	
		switch($element) : 
			
			##############################################################
            # SLIDESHOW
            ##############################################################
			
			case "slideshow":
			
			?>
		
				<!-- HOMEPAGE SLIDESHOW (start) -->
					
				<?php if($themeblvd_homepage_slideshow_type == '3d') : ?>
					
					<?php echo alyeska_3d(); ?>
					
				<?php elseif($themeblvd_homepage_slideshow_type == 'accordion') : ?>
					
					<?php echo alyeska_accordion($themeblvd_homepage_slideshow, $themeblvd_accordion_num, $themeblvd_accordion_stretch_width, $themeblvd_accordion_overlay_color, "940", "350"); ?>
					
				<?php elseif($themeblvd_homepage_slideshow_type == 'nivo') : ?>
				
					<?php echo alyeska_nivo($themeblvd_homepage_slideshow, $themeblvd_nivo_transition, $themeblvd_nivo_speed, $themeblvd_nivo_slices, $themeblvd_nivo_overlay_color, "940", "350"); ?>
					
				<?php else : ?>
				
					<?php echo alyeska_anything($themeblvd_homepage_slideshow, $themeblvd_anything_transition, $themeblvd_anything_speed, $themeblvd_anything_overlay_color, "940", "350"); ?>
				
				<?php endif; ?>
				
				<div class="clear"></div>
				
				<!-- HOMEPAGE SLIDESHOW (end) -->
				
				<?php break; ?>
				
			<?php
			
			##############################################################
            # SLOGAN
            ##############################################################
			
			case "slogan" :
			
			?>
				
				<!-- HOMEPAGE SLOGAN (start) -->
				
				<?php if($themeblvd_homepage_slogan) : ?>
				
				<div id="home-slogan">
					
					<h1><?php echo stripslashes($themeblvd_homepage_slogan); ?></h1>
			
				</div><!-- #home-slogan (end) -->
				
				<?php else : ?>
				
				<p class="warning"><?php _e('Oops! You set your slogan to show, but you left it blank.', 'themeblvd'); ?></p>
				
				<?php endif; ?>
				
				<div class="clear"></div>
				
				<!-- HOMEPAGE SLOGAN (end) -->
				
				<?php break; ?>
				
			<?php
			
			##############################################################
            # WIDGETS
            ##############################################################
			
			case "widgets" :
			
			?>
				
				<!-- HOMEPAGE COLUMNS (start) -->
	
				<div class="widget-area">
					
					<?php themeblvd_widget_columns_display("homepage", $themeblvd_homepage_columns); ?>
					
				</div><!-- .widget-area (end) -->
				
				<div class="clear"></div>
				
				<!-- HOMEPAGE COLUMNS (end) -->
				
				<?php break; ?>
				
			<?php
			
			##############################################################
            # PAGE CONTENT
            ##############################################################
			
			case "page" :
			
			?>
				
				<!-- HOMEPAGE CONTENT (start) -->
	
				<div id="home-content">
					
					<?php if($themeblvd_homepage_page_id) : ?>
						
						<?php $page = get_page($themeblvd_homepage_page_id); ?>
						
						<?php echo apply_filters('the_content', $page->post_content); ?>
						
					<?php else : ?>
						
						<p class="warning">
			            	<?php _e("You need to select a page to pull content from for this area or hide this section all together. You can do all this in the Homepage section of your theme options page.", "themeblvd"); ?>
						</p>
					
					<?php endif; ?>
					
					<div class="clear"></div>
					
				</div><!-- #home-content (end) -->
				
				<div class="clear"></div>
				
				<!-- HOMEPAGE CONTENT (end) -->
				
				<?php break; ?>
				
			<?php
			
			##############################################################
            # PORTFOLIO
            ##############################################################
			
			case "portfolio" :
			
			?>

				<!-- HOMEPAGE PORTFOLIO (start) -->
								
				<div id="homepage-portfolio">
					
					<?php echo alyeska_portfolio($themeblvd_homepage_portfolio, $themeblvd_homepage_portfolio_num, $themeblvd_thumbnail, $themeblvd_show_title, $themeblvd_show_excerpt, $themeblvd_show_read_more, $themeblvd_media_color, $themeblvd_video_logo, $themeblvd_video_logo_width, $themeblvd_video_logo_height); ?>
					
					<!-- clear just in case portfolio items not divisable by 3 -->
					<div class="clear"></div>
					
					<!-- Link to Blog -->
				    <?php if($themeblvd_homepage_portfolio_link == 'yes') : ?>
				    <div class="nav-entries">
			            <a href="<?php echo $themeblvd_homepage_portfolio_url; ?>" title="<?php echo $themeblvd_homepage_portfolio_text; ?>">
			            	<?php echo $themeblvd_homepage_portfolio_text; ?>
			            </a>
			        </div>
					<?php endif; ?>
						
				</div><!-- #homepage-portfolio (end) -->
				
				<div class="clear"></div>
				
				<!-- HOMEPAGE PORTFOLIO (end) -->
				
				<?php break; ?>
			
			<?php
			
			##############################################################
            # BLOG + SIDEBAR
            ##############################################################
			
			case "blog" :
			
			?>
				
				<!-- HOMEPAGE BLOG (start) -->
				
				<?php if($themeblvd_sidebar == 'left') : ?>
					<?php get_sidebar(); ?>	
				<?php endif; ?>
				
				<div id="content">
					
					<?php
				    if ( get_query_var('paged') ) {
				
				        $paged = get_query_var('paged');
				
				    } elseif ( get_query_var('page') ) {
				
				        $paged = get_query_var('page');
				
				    } else {
				
				        $paged = 1;
				
				    }
				    
				    //Blog it up
			    	global $more;
			    	$more = 0;
				
				    query_posts( array( 'post_type' => 'post', 'paged' => $paged) );
				
				    if ( have_posts() ) : while ( have_posts() ) : the_post();
				    ?>
					
					<div class="entry">
						
						<div class="top"><!-- --></div>
						
						<!-- Title -->
						
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						
						<!-- Meta Info -->
						
						<span class="meta"><?php _e('Posted by', "themeblvd"); ?> <?php the_author(); ?> - <?php the_time( get_option('date_format') ); ?> - <?php the_category(', '); ?></span>
						
						<!-- Comments -->
						
						<?php if( comments_open() ): ?>
				        <div class="comment">
							<a href="<?php the_permalink(); ?>#comments-wrap" class="comments-link"><?php comments_number('0', '1', '%'); ?></a>
						</div>
				        <?php endif; ?>
						
						<!-- Featured Image -->
						
						<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
				            <?php the_post_thumbnail('blog-1', array('class' => 'frame')); ?>
					    </a>
				        <?php endif; ?>
						
						<!-- Post Content -->
						
						<?php if($themeblvd_homepage_blog_content == 'excerpt') : ?>
						
						<?php the_excerpt(); ?>
				
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button">
							<span class="left">
								<span class="right">
									<span class="middle"><?php _e('Read More', "themeblvd"); ?></span>
								</span><!-- .right (end) -->
							</span><!-- .left (end) -->
						</a><!-- .button (end) -->
						
						<?php else : ?>
						
						<?php the_content(); ?>
						
						<?php endif; ?>
						
						<div class="bottom"><!-- --></div>
								
					</div><!-- .entry (end) -->
					
					<?php endwhile; ?>
				
				    <div class="clear"></div>
				
				    <!-- Link to Blog -->
				    <?php if($themeblvd_homepage_blog_link == 'yes') : ?>
				    <div class="nav-entries">
			            <a href="<?php echo $themeblvd_homepage_blog_url; ?>" title="<?php echo $themeblvd_homepage_blog_text; ?>">
			            	<?php echo $themeblvd_homepage_blog_text; ?>
			            </a>
			        </div>
			        <?php endif; ?>
				
				    <?php else : ?>
				    	<p class="warning">
				    		<?php _e('There are no posts to show.', "themeblvd"); ?>
				    	</p>
				    <?php endif; ?>
					
				</div><!-- #content (end) -->
				
				<?php if($themeblvd_sidebar == 'right') : ?>
					<?php get_sidebar(); ?>	
				<?php endif; ?>
				
				<div class="clear"></div>
				
				<!-- HOMEPAGE BLOG (end) -->
				
				<?php break; ?>
		
		<?php 
		endswitch;
		
	endforeach;
	?>
	
	<!-- HOMEPAGE SORTABLE ELEMENTS (end) -->

</div><!-- #homepage (end) -->

<?php get_footer(); ?>