<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page-sitemap'); ?>
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

        <h2><?php _e("Pages", "themeblvd"); ?></h2>

        <ul>
            <?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>
        </ul>

        <h2><?php _e("Categories", "themeblvd"); ?></h2>

        <ul>
            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
        </ul>

        <h2><?php _e("Posts per category", "themeblvd"); ?></h2>

        <?php $cats = get_categories(); ?>
        <?php foreach ($cats as $cat) : ?>

            <?php query_posts('cat='.$cat->cat_ID); ?>

                <h3><?php echo $cat->cat_name; ?></h3>

                <ul>
                    <?php while (have_posts()) : the_post(); ?>
                    <li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments', 'woothemes') ?> (<?php echo $post->comment_count ?>)</li>
                    <?php endwhile;  ?>
                </ul>

        <?php endforeach; ?>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>