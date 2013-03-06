<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Theme Hints
 *
 * Theme hints display across the frontend
 * of the website when enabled.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_theme_hints( $id ) {

    global $theme_hints;

    $output = '<div class="theme-hints">';
    $output .= '<div class="inner">';

    $output .= $theme_hints[$id]['hint'];

    if( isset($theme_hints[$id]['admin']) ) {

        $output .= '<span>';
        $output .= __('WP Admin: ', "themelbvd");

        foreach(  $theme_hints[$id]['admin'] as $adminPage ) {

            $site_url = get_bloginfo('url');
            $last_admin_link = ( end($theme_hints[$id]['admin']) );

            if( $adminPage == $last_admin_link ) {
				
				//Show link without comma
                $output .= '<a href="'.$site_url.'/wp-admin/'.$adminPage['link'].'">';
                $output .= $adminPage['name'];
                $output .= '</a>';

            } else {
				
				//Show link with comma
                $output .= '<a href="'.$site_url.'/wp-admin/'.$adminPage['link'].'">';
                $output .= $adminPage['name'];
                $output .= '</a>, ';

            }

        }

        $output .= '</span>';

    }

    $output .= '</div><!-- .inner (end) -->';
    $output .= '</div><!-- .theme-hints (end) -->';

    return $output;
	
##################################################################
} # end themeblvd_theme_hints function
##################################################################
?>