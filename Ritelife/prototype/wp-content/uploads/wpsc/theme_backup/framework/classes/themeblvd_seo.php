<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Search Engine Optimization (SEO)
 *
 * This class displays all the SEO information
 * configured in the associated SEO theme options page.
 *
 * @author  Jason Bobich
 *
 */

class themeblvd_seo {

    var $options; //Default SEO options

    //Constructor
    function themeblvd_seo($options){

        $this->options = $options;

    }

    #################################################################
    # (1) Primary Display
    #################################################################

    function themeblvd_head(){

        $this->display_index();
        $this->display_title();
        $this->display_keywords();
        $this->display_description();

    }

    #################################################################
    # (2) Sub Displays
    #################################################################

    function display_index(){

        global $post;

        if($post){
            $nofollow = get_post_meta($post->ID, 'themeblvd_noindex', true);
        }
        if( isset($nofollow) && $nofollow == 'false'){
            echo "<meta name='robots' content='noindex, nofollow' />\n";
        }

    }

    function display_title(){
		
        if( is_home() ){

            //Homepage
            $finalTitle = $this->title_format_homepage();

        } elseif( get_post_type() == 'post' && !is_category() && !is_archive() ) {

            //Posts
            $finalTitle = $this->title_format_posts();

        } elseif( is_page() ) {

            //Pages
            $finalTitle = $this->title_format_pages();

        } elseif( is_category() ) {

            //Categories
            $finalTitle = $this->title_format_categories();

        } elseif( get_post_type() == 'portfolio-item' && !is_tax() ) {

            //Portfolio Items
            $finalTitle = $this->title_format_portfolio_items();

        } elseif( is_tax('portfolio') ) {

            //Portfolios
            $finalTitle = $this->title_format_portfolios();

        } elseif( is_tag() ) {

            //Tags
            $finalTitle = $this->title_format_tags();

        } elseif( is_author() ) {

            //Tags
            $finalTitle = $this->title_format_author();

        } elseif( is_search() ) {

            //Search Results
            $finalTitle = $this->title_format_search();

        } elseif( is_404() ) {

            //404
            $finalTitle = $this->title_format_404();

        } elseif( is_archive() ) {

            //Archives
            $finalTitle = $this->title_format_archives();
        
        } else {
        
        	//Default = Posts
            $finalTitle = $this->title_format_posts();
        
        }

        //Display final result with formatted HTML
        echo "<title>$finalTitle</title>\n";

    }

    function display_keywords(){

        //Retrieve user's keyword locations
        $locations = get_option('themeblvd_seo_keywords');
        $finalKeywords = '';
        
        if(!$locations) {
            $locations = $this->options['keyword_locations']['std'];
        }

        //Display keywords in enabled locations
        if( is_home() ){

            //Homepage
            $homeKeywords = get_option('themeblvd_seo_homekeywords');
            if($homeKeywords) {
                $finalKeywords = $homeKeywords;
            }

        } elseif( get_post_type() == 'post' && !is_category() && !is_archive() ) {

            //Posts
            if (in_array("post", $locations)) {

                global $post;
                $finalKeywords = get_post_meta($post->ID, 'themeblvd_keywords', true);

                if(!$finalKeywords){
                    
                    $homeKeywords = get_option('themeblvd_seo_homekeywords');
                    if($homeKeywords) {
                        $finalKeywords = $homeKeywords;
                    }

                }
            }

        } elseif( is_page() ) {

            //Pages
            if (in_array("page", $locations)) {

                global $post;
                $finalKeywords = get_post_meta($post->ID, 'themeblvd_keywords', true);

                if(!$finalKeywords){

                    $homeKeywords = get_option('themeblvd_seo_homekeywords');
                    if($homeKeywords) {
                        $finalKeywords = $homeKeywords;
                    }

                }
            }


        } elseif( is_category() ) {

            //Categories
            if (in_array("category", $locations)) {
                
                $categories = get_categories();

                //Append the names
                foreach ($categories as $category) {
                    $finalKeywords .= $category->name.', ';
                }

                //Append the slugs
                foreach ($categories as $category) {

                    if( end($categories) == $category){
                        $finalKeywords .= $category->slug;
                    } else {
                        $finalKeywords .= $category->slug.', ';
                    }
                    
                }
                
            }

        } elseif( get_post_type() == 'portfolio-item' && !is_tax() ) {

            //Portfolio Items
            if (in_array("portfolio-item", $locations)) {

                global $post;
                $finalKeywords = get_post_meta($post->ID, 'themeblvd_keywords', true);

                if(!$finalKeywords){

                    $homeKeywords = get_option('themeblvd_seo_homekeywords');
                    if($homeKeywords) {
                        $finalKeywords = $homeKeywords;
                    }

                }
               
            }


        } elseif( is_tax('portfolio') ) {

            //Portfolios
            if (in_array("portfolio", $locations)) {

                $portfolios = get_terms('portfolio');

                //Append the names
                foreach ($portfolios as $portfolio) {
                    $finalKeywords .= $portfolio->name.', ';
                }

                //Append the slugs
                foreach ($portfolios as $portfolio) {

                    if( end($portfolios) == $portfolio){
                        $finalKeywords .= $portfolio->slug;
                    } else {
                        $finalKeywords .= $portfolio->slug.', ';
                    }

                }

            }

        } elseif( is_tag() ) {
            
            //Tags
            if (in_array("tag", $locations)) {

                $finalKeywords = wp_title('', false);

            }


        } elseif( is_author() ) {

            //Author
            if (in_array("author", $locations)) {

                $finalKeywords = wp_title('', false);
                
            }


        } elseif( is_search() ) {

            //Search Results
            if (in_array("search", $locations)) {

                global $s;
                $finalKeywords = $s;

            }


        } elseif( is_404() ) {

            //404
            if (in_array("404", $locations)) {
                
                $homeKeywords = get_option('themeblvd_seo_homekeywords');
                if($homeKeywords) {
                    $finalKeywords = $homeKeywords;
                }

            }
            
        } elseif( is_archive() ) {

            //Archives
            if (in_array("archive", $locations)) {

                $homeKeywords = get_option('themeblvd_seo_homekeywords');
                if($homeKeywords) {
                    $finalKeywords = $homeKeywords;
                }

            }

        }

        //Display final result with formatted HTML
        if($finalKeywords){

            echo '<meta name="keywords" content="'.$finalKeywords.'" />'."\n";
            
        }

    }

    function display_description(){

        global $finalKeywords;

        //Retrieve user's description locations
        $locations = get_option('themeblvd_seo_descriptions');
        $finalDescription = '';
        
        if(!$locations) {
            $locations = $this->options['description_locations']['std'];
        }

        //Display descriptions in enabled locations
        if( is_home() ){

            //Homepage
            $homeDescription = get_option('themeblvd_seo_homedescription');
            if($homeDescription) {
                $finalDescription = $homeDescription;
            }

        } elseif( get_post_type() == 'post' && !is_category() && !is_archive() ) {

            //Posts
            if (in_array("post", $locations)) {

                global $post;
                $finalDescription = get_post_meta($post->ID, 'themeblvd_description', true);

                if(!$finalDescription){

                    $homeDescription = get_option('themeblvd_seo_homedescription');
                    if($homeDescription) {
                        $finalDescription = $homeDescription;
                    }

                }
            }

        } elseif( is_page() ) {

            //Pages
            if (in_array("page", $locations)) {

                global $post;
                $finalDescription = get_post_meta($post->ID, 'themeblvd_description', true);

                if(!$finalDescription){

                    $homeDescription = get_option('themeblvd_seo_homedescription');
                    if($homeDescription) {
                        $finalDescription = $homeDescription;
                    }

                }
            }


        } elseif( is_category() ) {

            //Categories
            if (in_array("category", $locations)) {

                $categories = get_categories();

                //Append the names
                foreach ($categories as $category) {
                    $finalDescription .= $category->name.', ';
                }

                //Append the slugs
                foreach ($categories as $category) {

                    if( end($categories) == $category){
                        $finalDescription .= $category->slug;
                    } else {
                        $finalDescription .= $category->slug.', ';
                    }

                }

            }

        } elseif( get_post_type() == 'portfolio-item' && !is_tax() ) {

            //Portfolio Items
            if (in_array("portfolio-item", $locations)) {

                global $post;
                $finalDescription = get_post_meta($post->ID, 'themeblvd_description', true);

                if(!$finalKeywords){

                    $homeDescription = get_option('themeblvd_seo_homekeywords');
                    if($homeDescription) {
                        $finalDescription = $homeDescription;
                    }

                }

            }


        } elseif( is_tax('portfolio') ) {

            //Portfolios
            if (in_array("portfolio", $locations)) {

                $portfolios = get_terms('portfolio');

                //Append the names
                foreach ($portfolios as $portfolio) {
                    $finalDescription .= $portfolio->name.', ';
                }

                //Append the slugs
                foreach ($portfolios as $portfolio) {

                    if( end($portfolios) == $portfolio){
                        $finalDescription .= $portfolio->slug;
                    } else {
                        $finalDescription .= $portfolio->slug.', ';
                    }

                }

            }

        } elseif( is_tag() ) {

            //Tags
            if (in_array("tag", $locations)) {

                $finalDescription = wp_title('', false);

            }


        } elseif( is_author() ) {

            //Author
            if (in_array("author", $locations)) {

                global $post;
                $authorID = $post->post_author;
                $author = get_userdata($userID);
                $finalDescription = $author->description;

            }


        } elseif( is_search() ) {

            //Search Results
            if (in_array("search", $locations)) {

                $homeDescription = get_option('themeblvd_seo_homedescription');
                if($homeDescription) {
                    $finalDescription = $homeDescription;
                }

            }


        } elseif( is_404() ) {

            //404
            if (in_array("404", $locations)) {

                $homeDescription = get_option('themeblvd_seo_homedescription');
                if($homeDescription) {
                    $finalDescription = $homeDescription;
                }

            }

        } elseif( is_archive() ) {

            //Archives
            if (in_array("archive", $locations)) {

                $homeDescription = get_option('themeblvd_seo_homedescription');
                if($homeDescription) {
                    $finalDescription = $homeDescription;
                }

            }

        }

        //Display final result with formatted HTML
        if($finalDescription){

            echo '<meta name="description" content="'.$finalDescription.'" />'."\n";

        }

    }

    #################################################################
    # (3) Title Formats
    #################################################################

    function title_format_homepage(){

        $title = get_option('themeblvd_seo_hometitle');

        if(!$title) {
            $title = $this->options['hometitle']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);

        $title = stripslashes($title);
        
        return $title;

    }
    
    function title_format_posts(){

        global $post;
        $title = get_post_meta($post->ID, 'themeblvd_title', true);

        if(!$title){

            $title = get_option('themeblvd_seo_title_posts');

            if(!$title) {
                $title = $this->options['post_title']['std'];
            }

            $title = str_replace("%blog_title%", $this->blog_title(), $title);
            $title = str_replace("%blog_description%", $this->blog_description(), $title);
            $title = str_replace("%post_title%", $this->post_title(), $title);
            $title = str_replace("%post_author_username%", $this->post_author_username(), $title);
            $title = str_replace("%post_author_firstname%", $this->post_author_firstname(), $title);
            $title = str_replace("%post_author_lastname%", $this->post_author_lastname(), $title);
            $title = str_replace("%category_title%", $this->category_title(), $title);
            $title = str_replace("%category_slug%", $this->category_slug(), $title);
            
        }
        
        $title = stripslashes($title);

        return $title;

    }

    function title_format_pages(){

        global $post;
        $title = get_post_meta($post->ID, 'themeblvd_title', true);

        if(!$title){
            
            $title = get_option('themeblvd_seo_title_pages');

            if(!$title) {
                $title = $this->options['page_title']['std'];
            }

            $title = str_replace("%blog_title%", $this->blog_title(), $title);
            $title = str_replace("%blog_description%", $this->blog_description(), $title);
            $title = str_replace("%page_title%", $this->post_title(), $title);
            $title = str_replace("%page_author_username%", $this->post_author_username(), $title);
            $title = str_replace("%page_author_firstname%", $this->post_author_firstname(), $title);
            $title = str_replace("%page_author_lastname%", $this->post_author_lastname(), $title);       
        
        }

        $title = stripslashes($title);

        return $title;

    }

    function title_format_categories(){

        $title = get_option('themeblvd_seo_title_categories');

        if(!$title) {
            $title = $this->options['category_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%category_title%", $this->category_title(), $title);
        $title = str_replace("%category_description%", $this->category_description(), $title);

        $title = stripslashes($title);

        return $title;

    }

    function title_format_portfolio_items(){

        $title = get_option('themeblvd_seo_title_portfolio_items');

        if(!$title) {
            $title = $this->options['portfolio_item_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%item_title%", $this->post_title(), $title);
        $title = str_replace("%portfolio_title%", $this->portfolio_title(), $title);
        $title = str_replace("%portfolio_description%", $this->portfolio_description(), $title);
        $title = str_replace("%portfolio_slug%", $this->portfolio_slug(), $title);
        
        $title = stripslashes($title);

        return $title;

    }

    function title_format_portfolios(){

        $title = get_option('themeblvd_seo_title_portfolios');

        if(!$title) {
            $title = $this->options['portfolio_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%portfolio_title%", $this->portfolio_title(), $title);
        $title = str_replace("%portfolio_description%", $this->portfolio_description(), $title);
        $title = str_replace("%portfolio_slug%", $this->portfolio_slug(), $title);

        $title = stripslashes($title);

        return $title;

    }

    function title_format_archives(){

        $title = get_option('themeblvd_seo_title_archives');

        if(!$title) {
            $title = $this->options['archive_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%date%", wp_title('', false), $title);

        $title = stripslashes($title);

        return $title;

    }

    function title_format_tags(){

        $title = get_option('themeblvd_seo_title_tags');

        if(!$title) {
            $title = $this->options['tag_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%tag%", wp_title('', false), $title);

        $title = stripslashes($title);

        return $title;

    }

    function title_format_author(){

        $title = get_option('themeblvd_seo_title_author');

        if(!$title) {
            $title = $this->options['author_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%author%", wp_title('', false), $title);

        $title = stripslashes($title);

        return $title;

    }

    function title_format_search(){

        global $s;
        $title = get_option('themeblvd_seo_title_search');

        if(!$title) {
            $title = $this->options['search_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);
        $title = str_replace("%search%", $s, $title);

        $title = stripslashes($title);

        return $title;

    }

    function title_format_404(){

        $title = get_option('themeblvd_seo_title_404');

        if(!$title) {
            $title = $this->options['404_title']['std'];
        }

        $title = str_replace("%blog_title%", $this->blog_title(), $title);
        $title = str_replace("%blog_description%", $this->blog_description(), $title);

        $title = stripslashes($title);
        
        return $title;

    }

    #################################################################
    # (4) Macros
    #################################################################

    function blog_title(){

        $macro = get_bloginfo('name');
        return $macro;
        
    }

    function blog_description(){
        
        $macro = get_bloginfo('description');
        return $macro;

    }

    function post_title(){

        global $post;
        $macro = $post->post_title;
        return $macro;

    }

    function post_author_username(){

        global $post;
        $userID = $post->post_author;
        $author = get_userdata($userID);
        $macro = $author->user_login;
        return $macro;

    }

    function post_author_firstname(){

        global $post;
        $userID = $post->post_author;
        $author = get_userdata($userID);
        $macro = $author->first_name;
        return $macro;

    }

    function post_author_lastname(){

        global $post;
        $userID = $post->post_author;
        $author = get_userdata($userID);
        $macro = $author->last_name;
        return $macro;

    }

    function category_title(){

        $categories = get_categories();
        $macro = '';

        foreach ($categories as $category) {
            
            if( end($categories) == $category){
                $macro .= $category->name;
            } else {
                $macro .= $category->name.', ';
            }
        }

        return $macro;

    }

    function category_slug(){

        $categories = get_categories();
        $macro = '';
        
        foreach ($categories as $category) {

            if( end($categories) == $category){
                $macro .= $category->slug;
            } else {
                $macro .= $category->slug.', ';
            }
        }

        return $macro;

    }

    function category_description(){

        $categories = get_categories();
        $macro = '';
        
        foreach ($categories as $category) {

            if( end($categories) == $category){
                $macro .= $category->description;
            } else {
                $macro .= $category->description.', ';
            }
        }

        return $macro;

    }

    function portfolio_title(){
        
        global $post;
        $term_name = '';
        
        if( is_tax() ){
        	
        	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        	$term_name = $term->name;
        	
        } else {
        
        	$terms = get_the_terms( $post->ID, 'portfolio' );
        	
        	foreach ($terms as $term) {

	            if( end($terms) == $term){
	                $term_name .= $term->name;
	            } else {
	                $term_name .= $term->name.', ';
	            }
	        }

        }
        
        $macro = $term_name;
        
        return $macro;

    }

    function portfolio_slug(){

        global $post;
        $term_slug = '';
        
        if( is_tax() ){
        	
        	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        	$term_slug = $term->slug;
        	
        } else {
        
        	$terms = get_the_terms( $post->ID, 'portfolio' );
        	
        	foreach ($terms as $term) {

	            if( end($terms) == $term){
	                $term_slug .= $term->slug;
	            } else {
	                $term_slug .= $term->slug.', ';
	            }
	        }

        }
        
        $macro = $term_slug;
        
        return $macro;

    }
    
    function portfolio_description(){

        global $post;
        $term_description = '';
        
        if( is_tax() ){
        	
        	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        	$term_description = $term->description;
        	
        } else {
        
        	$terms = get_the_terms( $post->ID, 'portfolio' );
        	
        	foreach ($terms as $term) {

	            if( end($terms) == $term){
	                $term_description .= $term->description;
	            } else {
	                $term_description .= $term->description.', ';
	            }
	        }

        }
        
        $macro = $term_description;
        
        return $macro;

    }

##################################################################
} # end themeblvd_seo class
##################################################################
