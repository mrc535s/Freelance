<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Widget Area Columns
 *
 * These functions register and display a certain
 * amount of widget areas depending on specifed
 * column number on theme options page.
 *
 * @author  Jason Bobich
 *
 */

function themeblvd_widget_columns($name, $id, $num){

    $i = 1;
    while($i <= $num) {

        $final_id = $id.'-'.$i;

        $info = array (
            'name' => $name.' #'.$i,
            'description' => __('This is a dynamically generated widget column. Widgets will be stacked in this column.', "themeblvd"),
            'id' => $final_id,
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        );

        register_sidebar($info);

        $i++;

    }
    
}

function themeblvd_widget_columns_display($id, $num){
    
    //Build CSS class
    $class = '';
    if($num == 2){
        $class = ' one-half';
    } elseif($num == 3){
        $class = ' one-third';
    } elseif($num == 4){
        $class = ' one-fourth';
    }

    //Display widget areas
    $i = 1;
    while($i <= $num) {

        $final_id = $id.'-'.$i;

        echo '<div class="column'.$class.'">';

        if( is_sidebar_active($final_id) ){
            dynamic_sidebar($final_id);
        }

        echo '</div><!-- .column(end) -->';

        $i++;
    }

##################################################################
} # end themeblvd_widget_columns function
##################################################################
?>