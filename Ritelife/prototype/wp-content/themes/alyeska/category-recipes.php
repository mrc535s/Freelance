<?php

/**

 *

 * Alyeska WordPress Theme

 * Archives

 *

 * This file displays archive pages, which

 * includes pages for displaying a particular

 * tag, category, archive date, etc.

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







<div id="content" style="width:940px;">

	

	<?php themeblvd_breadcrumbs(); ?>

	

    <?php if( $themeblvd_theme_hints == 'true' ) : ?>

        <?php echo themeblvd_theme_hints('archive'); ?>

    <?php endif; ?>

	

	<h1>

        <?php if (have_posts()) : ?>

	        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	        <?php /* If this is a category archive */ if (is_category()) { ?>

	        <?php single_cat_title(); ?>

	        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>

	        <?php _e('Tag', "themeblvd"); ?>: <?php single_tag_title(); ?>

	        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>

	        <?php _e('Archive', "themeblvd"); ?>: <?php the_time('F jS, Y'); ?>

	        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

	        <?php _e('Archive', "themeblvd"); ?>: <?php the_time('F, Y'); ?>

	        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

	        <?php _e('Archive', "themeblvd"); ?>: <?php the_time('Y'); ?>

	        <?php /* If this is an author archive */ } elseif (is_author()) { ?>

	        <?php _e('Author Archive', "themeblvd"); ?>

	        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

	        <?php _e('Blog Archives', "themeblvd"); ?>

    		<?php } ?>

    	<?php endif; ?>

    </h1>



    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	

	<div class="entry">

		

		<div class="top"><!-- --></div>

		

		<!-- Title -->

		

		<h2 style="font-size:22px;"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

		

		<!-- Meta Info 

		

		<span class="meta"><?php _e('Posted by', "themeblvd"); ?> <?php the_author(); ?> - <?php the_time( get_option('date_format') ); ?> - <?php the_category(', '); ?></span> -->

		

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

		



		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button">

			<span class="left">

				<span class="right">

					<span class="middle"><?php _e('Get Recipe', "themeblvd"); ?></span>

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



    <!-- Pagination -->

    <?php themeblvd_pagination(); ?>



    <?php else : ?>

    	<p class="warning">

    		<?php _e('There are no posts to show.', "themeblvd"); ?>

    	</p>

    <?php endif; ?>

	

</div><!-- #content (end) -->







<?php get_footer(); ?>