<?php
/**
 *
 * Alyeska WordPress Theme
 * Portfolios
 *
 * This file sets up the the custom post type,
 * Portfolio Item, and associated taxonomy, Portfolio.
 *
 * @author  Jason Bobich
 *
 */

global $shortname;

##############################################################
# Register custom post type
##############################################################

$labels_portfolio_item = array(    
    'add_new_item' => __('Add New Portfolio Item', 'themeblvd'),
    'edit_item' => __('Edit Portfolio Item', 'themeblvd'),
    'new_item' => __('New Portfolio Item', 'themeblvd'),
    'view_item' => __('Preview Portfolio Item', 'themeblvd'),
    'search_items' => __('Search Portfolio Items', 'themeblvd'),
    'not_found' => __('No portfolio items found.', 'themeblvd'),
    'not_found_in_trash' => __('No portfolio items found in Trash.', 'themeblvd')
    
);

register_post_type('portfolio-item', array(
    'labels' => $labels_portfolio_item,
    'label' => __('Portfolio Items', 'themeblvd'),
    'singular_label' => __('Porfolio Item', 'themeblvd'),
    'public' => true,
    'show_ui' => true, // UI in admin panel
    '_builtin' => false, // It's a custom post type, not built in
    'rewrite' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'comments'), // Let's use custom fields for debugging purposes only
    'menu_icon' => get_template_directory_uri() . '/framework/layout/images/icon_portfolio.png'
));

##############################################################
# Register associated taxonomies
##############################################################

//Portfolios
$labels_portfolio = array(
    'name' => __('Portfolios', 'post type general name', 'themeblvd'),
    'all_items' => __('All Portfolios', 'all items', 'themeblvd'),
    'add_new_item' => __('Add New Portfolio', 'adding a new item', 'themeblvd'),
    'new_item_name' => __('New Portfolio Name', 'adding a new item', 'themeblvd'),
    'edit_item' => __("Edit Portfolio", "themeblvd")
);

$args_portfolio = array(
    'labels' => $labels_portfolio,
    'rewrite' => true,
    'hierarchical' => true
);

register_taxonomy( 'portfolio', 'portfolio-item', $args_portfolio );

//Portfolio Tags
$labels_portfolio_tags = array(
    'name' => __('Portfolio Tags', 'post type general name', 'themeblvd'),
    'all_items' => __('All Portfolio Tags', 'all items', 'themeblvd'),
    'add_new_item' => __('Add New Tag', 'adding a new item', 'themeblvd'),
    'new_item_name' => __('New Tag Name', 'adding a new item', 'themeblvd'),
);

$args_portfolio_tags = array(
        'labels' => $labels_portfolio_tags,
        'hierarchical' => false
);

register_taxonomy( 'portfolio-tags', 'portfolio-item', $args_portfolio_tags );

##############################################################
# Customize Manage Posts interface
##############################################################

function edit_columns($columns){
    
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Portfolio Item",
        "category" => "Portfolio",
        "portfolio-tags" => "Portfolio Tags",
        "thumbnail" => "Thumbnail"
    );

    return $columns;
}

function custom_columns($column){
    global $post;
    switch ($column){

        case "category" :

            $portfolio = get_the_terms(0, "portfolio");
            $portfolio_html = array();
            if($portfolio) {
                foreach ($portfolio as $portfolioshow)
                    array_push($portfolio_html, $portfolioshow->name);

                echo implode($portfolio_html, ", ");
            } else {
                _e("Not Assigned", "themeblvd");
            }
            break;

        case "portfolio-tags" :

            $portfolio = get_the_terms(0, "portfolio-tags");
            $portfolio_html = array();
            if($portfolio) {
                foreach ($portfolio as $portfolioshow)
                    array_push($portfolio_html, $portfolioshow->name);

                echo implode($portfolio_html, ", ");
            } else {
                _e("No Tags", "themeblvd");
            }
            break;

         case "thumbnail" :
             
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('portfolio-admin');
            } else {
                print __('Oops! You forgot to set a featured image.', 'themeblvd');
            }
            break;

    }
}

add_filter("manage_edit-portfolio-item_columns", "edit_columns");
add_action("manage_posts_custom_column", "custom_columns");

##############################################################
# Define metabox
##############################################################

//General options
$portfolio_meta_box = array(

    array(  "id" => "themeblvd_portfolio_item_description",
            "type" => "description",
            "desc" => __("You are currently creating a Portfolio Item, which can then be categorized into your Portfolios. <a href=\"#themeblvd_portfolio_item_description\" class=\"jaybich-open\">Learn More</a>", "themeblvd"),
            "more-info" => __("<p>With custom post types and custom menus in WordPress 3.0, WordPress has totally changed the potential for theme making. Some concepts of how this theme manages portfolios may seem unusual at first, but once you get used to how things work, you'll see how much more efficient everything is.</p><h4 style=\"margin: 10px 0pt;\">The overall concept of creating your first portfolio.</h4><p>1. Create a new <em>Portfolio</em>. You can think of a <em>Portfolio</em> as a \"category\" if that helps you visualize it a bit better.</p><p>2. Create several <em>Portfolio Items</em> that each consist of:</p><ul><li>Title</li><li>Content</li><li>Excerpt</li><li>Media Link (Full URL to enlarged image, YouTube video, Vimeo video, .mov file, or .swf file)</li><li>Thumbnail (featured image)</li><li>Portfolio (i.e. Which portfolio is this portfolio item assigned to?)</li></ul><p>3. Add your <em>Portfolio</em> (i.e. \"category\" of portfolio items) to a menu under Appearance &gt; Menus.</p><p>4. Now that your <em>Portfolio</em> has been added to a menu, it's live on your website. When someone visit that <em>Portfolio</em>, they'll see all of that <em>Portfolios's</em> items displayed in a gallery view.</p><p><em>Note: Under Appearance &gt; Menus, if you do not see your Portfolios in the left column, it just means you have them hidden. Just click the Screen Options tab in the top right corner and then check off \"Portfolios.\"</em></p><h4 style=\"margin: 10px 0pt;\">Let's clear up one common misconception :-) </h4><p><em>\"I'm trying to add a portfolio page, but when I create a new page, there's no Portfolio page template? Why?\"</em></p><p>There's no need for that any more. Before WordPress 3.0, the only logical way to create a main menu was to list out WordPress pages. So, then the dilemma was that if you didn't want a \"blog\" for your homepage, how would you have a link to a \"blog\" from your main menu? So, theme authors started creating page templates that would list out the blog posts, and thus that \"page\" could be added to the main menu. Then, when theme authors started offering portfolios with their themes, the same thing needed to be done, as a portfolio would simply be another method of listing out \"posts.\"</p><p>With WordPress's menu builder you can add a blog's category, or in this case a \"Portfolio\", directly to your main menu. There's no need for creating a page in order to accomplish this.</p> ", "themeblvd")
    ),

    array(  "name" => __("Portfolio Item", "themeblvd"),
            "desc" => __("Place the URL to your portfolio media item here. <a href=\"#themeblvd_media_item\" class=\"jaybich-open\">Learn More</a>", "themeblvd"),
            "id" => "themeblvd_media_item",
            "std" => "",
            "type" => "textarea",
            "upload" => "true",
            "more-info" => __("<h4>Accepted Media Types</h4><h5>1. Images</h5><p>Insert the full URL to your image like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/image.jpg</p><h5>2. MP3 Files</h5><p>Insert the full URL to your audio mp3 file like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/song.mp3</p><h5>3. YouTube Videos</h5><p>Insert the full URL to the video page like this:<br>http://www.youtube.com/watch?v=qqXi8WmQ_WM</p><h5>4. Vimeo Videos</h5><p>Insert the full URL to the video page like this:<br>http://vimeo.com/7570458</p><h5>5. Flash SWF Files</h5><p>Insert the full URL to the .swf file with the width and height attached like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/flashfile.swf?width=792&amp;height=294</p><h5>6. MP4 Video Files</h5><p>Insert the full URL to the .mp4 file with the width and height attached like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/video.mp4?width=480&amp;height=204<h5>7. FLV Video Files</h5><p>Insert the full URL to the .flv file with the width and height attached like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/video.flv?width=480&amp;height=204<h5>8. F4V Video Files</h5><p>Insert the full URL to the .f4v file with the width and height attached like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/video.f4v?width=480&amp;height=204<h5>9. Quicktime MOV Files</h5><p>Insert the full URL to the .mov file with the width and height attached like this:<br>http://www.YourSite.com/wp-content/uploads/2010/06/video.mov?width=480&amp;height=204", "themeblvd")
    ),

    array(  "id" => "themeblvd_portfolio_item_thumb",
            "type" => "html-block",
            "desc" => __("<em>Don't forget to set your thumbnail image, which is controlled by this post's \"featured image.\" It can be set in the Featured Image box generally located in the right column for editing this post.</em> <a href=\"#themeblvd_portfolio_item_thumb\" class=\"jaybich-open\">Learn More</a>", "themeblvd"),
            "more-info" => __("Your thumbnail image (featured image) will be used on the Portfolio gallery style page for the user to click on. It will automatically be scaled and cropped to be 280x125. However, your resulting gallery of thumbnails will look better if you size your thumbnails before uploading them, or at least plan for them to be horizontally sized (meaning wider than they are tall).", "themeblvd")
    ),

);

$portfolio_meta_info = array(
    'id'=> 'portfolio',
    'title' => 'Portfolio Item Options',
    'page'=> array('portfolio-item'),
    'context'=>'normal', //normal or side
    'priority'=>'high', //high or low
    'callback'=>''
);

$themeblvd_portfolio = new themeblvd_meta_box($portfolio_meta_info , $portfolio_meta_box);

?>