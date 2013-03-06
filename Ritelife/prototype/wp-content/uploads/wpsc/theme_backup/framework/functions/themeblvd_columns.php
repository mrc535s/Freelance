<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Standard Columns
 *
 * This function inserts a class, which
 * will determine the width of child
 * elements based on a single integer.
 *
 * NOTE: This file is depreciated. I'm currently
 * in the process of working it out of all themes,
 * however it's still used in some.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_columns($num){
    
    //Build CSS class
    if($num == 2){
        $class = 'two-columns';
    } elseif($num == 3){
        $class = 'three-columns';
    } elseif($num == 4){
        $class = 'four-columns';
    } elseif($num == 5){
        $class = 'five-columns';
    } else {
        $class = 'full-width';
    }

    return $class;

##################################################################
} # end themeblvd_columns function
##################################################################
?>