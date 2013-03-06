<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Copyright
 *
 * This function gets used to display the
 * copyright message inputed by the user
 * from the WordPress theme options page.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_copyright($message){

    $site_title = get_bloginfo('name');
    $year = date('Y');

    $message = str_replace('%site_title%', $site_title, $message);
    $message = str_replace('%year%', $year, $message);

    return $message;
  
##################################################################
} # end themeblvd_copyright function
##################################################################
?>