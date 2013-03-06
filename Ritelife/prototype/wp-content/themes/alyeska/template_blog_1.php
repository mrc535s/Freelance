<?php 
/*
Template Name: Blog Style #1
*/
?>
<?php get_header(); ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page-blog'); ?>
    <?php endif; ?>
	
	<?php the_post(); ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<div class="page-content">
		<?php the_content(); ?>
	</div><!-- .page-content (end) -->
	
	<?php
	//setup pagination to be compatible when static page is set to frontpage
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

    $categories = get_post_meta($post->ID, 'categories', true);

    query_posts( array( 'post_type' => 'post', 'paged' => $paged, 'cat' => $categories ) );

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
		
		<?php if($themeblvd_blog1_content == 'excerpt') : ?>
		
		<?php the_excerpt(); ?>

		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button">
			<span class="left">
				<span class="right">
					<span class="middle"><?php _e('Read More', "themeblvd"); ?></span>
				</span><!-- .right (end) -->
			</span><!-- .left (end) -->
		</a><!-- .button (end) -->
		
		<?php else : ?>
		
		<?php the_content('Read on...'); ?>
		
		<?php endif; ?>
		
		<div class="bottom"><!-- --></div>
				
	</div><!-- .entry (end) -->
	
	<?php endwhile; ?>

    <div class="clear"></div>

    <!-- Pagination -->
    <?php themeblvd_pagination(); ?>

    <?php else : ?>
    	<p class="warning">
    		<?php _e('There are no posts to show.', "themeblvd"); ?>
    	</p>
    <?php endif; ?>
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>