<?php
/*
Template Name: Archives
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
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page-archives'); ?>
    <?php endif; ?>
	
	<?php the_post(); ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
		<!-- Page Content -->
        <?php rewind_posts(); ?>
        <?php the_content(); ?>
		<?php edit_post_link( __('Edit Page', 'themeblvd'), '<p>', '</p>' ); ?>
		
		
        <h2><?php _e('The Last 30 Posts', 'themeblvd') ?></h2>

        <ul>
            <?php query_posts('showposts=30'); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php $wp_query->is_home = false; ?>
                <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php the_time(get_option('date_format')); ?> - <?php echo $post->comment_count ?> <?php _e('comments', 'themeblvd') ?></li>
            <?php endwhile; endif; ?>
        </ul>

        <h2><?php _e('Categories', 'themeblvd') ?></h2>

        <ul>
            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
        </ul>

        <h2><?php _e('Monthly Archives', 'themeblvd') ?></h2>

        <ul>
            <?php wp_get_archives('type=monthly&show_post_count=1') ?>
        </ul>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>