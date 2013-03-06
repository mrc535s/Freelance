<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Pagination
 *
 * This function checks to see if WP-PageNavi
 * plugin exists and if not shows classic
 * next/previous links for posts.
 *
 * @author  Jason Bobich
 *
 */
function themeblvd_pagination() {

    if (function_exists('wp_pagenavi') ) {

        wp_pagenavi();

    } else {

        if ( get_next_posts_link() || get_previous_posts_link() ) {
        ?>

        <div class="nav-entries">
            <div class="nav-prev fl"><?php previous_posts_link(__('&laquo; Newer Entries ', 'themeblvd')) ?></div>
            <div class="nav-next fr"><?php next_posts_link(__(' Older Entries &raquo;', 'themeblvd')) ?></div>
            <div class="clear"></div>
        </div>

        <?php
        }

	}
##################################################################
} # end themeblvd_pagination function
##################################################################
?>