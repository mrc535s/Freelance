<?php
/**
 *
 * ThemeBlvd Theme Options
 * Search Engine Optimization (SEO)
 *
 * This file constructs the SEO options page.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Key Elements
##############################################################

$themename = "Stealth";
$shortname = "themeblvd";

##############################################################
# Options (need to remain as-is for plugin to work properly)
##############################################################

$options_seo = array (

    //General Setup
    array(  "type" => "start",
            "name" => "General Setup",
            "id" => "general-setup",
            "icon" => "search-mag"
    ),

    array(  "desc" => __("This theme includes a built-in SEO plugin, which is a part of the ThemeBlvd WordPress theme framework. These options will help you setup your site's search engine optimization by allowing you to customize your meta information and title tags. Additionally, you can edit title tags and meta information individually for pages and posts when you're working on them in their edit screens.", $shortname),
            "type" => "description"
    ),

    array(  "name" => __("Enable this theme's built-in SEO plugin?", $shortname),
            "option1" => __("Yes, enable ThemeBlvd SEO.", $shortname),
            "option2" => __("No, disable it."),
            "desc" => __("If you're using a third-party SEO plugin, you should disable built-in SEO.", $shortname),
            "id" => $shortname."_seo_plugin",
            "std" => "true",
            "type" => "true_false_radio"
    ),

    array ( "type" => "end"),
    
    //Homepage SEO
    array(  "type" => "start",
            "name" => "Homepage SEO",
            "id" => "homepage",
            "icon" => "home"
    ),

    array(  "desc" => __("These options will be used on your homepage. The keywords and descriptions will also be used on any other places within the theme that default meta information is needed, such as 404 pages, archives, etc.", $shortname),
            "type" => "description"
    ),

    "hometitle" => array(  "name" => __("Homepage Title Tag", $shortname),
            "desc" => __("Enter in the title as you'd like to be displayed. <a href='#".$shortname."_seo_hometitle' class='jaybich-open'>More Info</a>", $shortname),
            "id" => $shortname."_seo_hometitle",
            "std" => "%blog_title% | %blog_description%",
            "type" => "text",
            "more-info" => __("<p>This is your homepage title that gets inserted within the &lt;title&gt; tag of your homepage's &lt;head&gt; section. It then gets displayed at the top of most web browsers when a user visits your site. It also, in most cases, gets used on a search engine results page when displaying your page as a result. It's also very important in determining what your website is about.</p><p>So, it's important to put a couple of your most important keywords here along with your site's name in a user-friendly, NON-spammy format.</p><p>&lt;title&gt;Your title ends up here&lt;/title&gt;</p><h4>Accepted title format macros for your homepage title</h4>%blog_title% - Your site title<br />%blog_description% - Your site description", $shortname)
    ),

    "homekeywords" => array(  "name" => __("Homepage Meta Keywords", $shortname),
            "desc" => __("Enter a comma-separated list of keywords you'd like to associate with your homepage. <br /><br /> Ex: keyword1, keyword2, keyword3 <br /><br /><a href='#".$shortname."_seo_homekeywords' class='jaybich-open'>More Info</a>", $shortname),
            "id" => $shortname."_seo_homekeywords",
            "std" => "keyword1, keyword2, keyword3",
            "type" => "textarea",
            "more-info" => __("<p>Meta keywords are words or phrases that you can use to describe your page or post. They definitely do not have the same impact on SEO that they did in the past, however they can still be helpful. According to <a href='http://www.mattcutts.com/blog/' target='_blank'>Matt Cutts</a>, head of Google's Webspam team, Google does not use meta keywords to determine rankings in their organic search results. However, many other search engines still do. So, it's a never a bad idea to include them.</p><p>&lt;meta name=&quot;keywords&quot; content=&quot;keyword1, keyword2, keyword3&quot; /&gt;</p>", $shortname )
    ),

    "homedescription" => array(  "name" => __("Homepage Meta Description", $shortname),
            "desc" => __("Enter a description you'd like to associate with your homepage. In most cases this is what gets displayed on a Search Engine results page. <br /><br /><a href='#".$shortname."_seo_homedescription' class='jaybich-open'>More Info</a>", $shortname),
            "id" => $shortname."_seo_homedescription",
            "std" => "Your description goes here.",
            "type" => "textarea",
            "more-info" => __("<p>The meta description is a short paragraph that sums up what a particular page or post is about. Google and other search engines will often display this description in their search results. Without this snippet of text, generally, search engines will simply pull relevant chunks of text from your site to display.</p><p>&lt;meta name=&quot;description&quot; content=&quot;This is your SEO description of your site.&quot; /&gt;</p>", $shortname)
    ),

    array ( "type" => "end"),

    //Title Formatting
    array(  "type" => "start",
            "name" => "&lt;Title&gt; Formatting",
            "id" => "title-formatting",
            "icon" => "title"
    ),

    array(  "desc" => __("These are the titles that get inserted within the &lt;title&gt; tags in the &lt;head&gt; sections throughout your site. They then get displayed at the top of most web browsers when a user visits your site. Also, in most cases, they get used on search engine result pages when displaying your site as a result. They're also very important in how search engines determine what a particular page on your site is about. So, it's important to put a couple of your most important keywords in there along with your site's name in a user-friendly, NON-spammy format.", $shortname),
            "type" => "description"
    ),

    "post_title" => array(  "name" => __("Posts", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Posts displayed as. <br /> <a href='#".$shortname."_seo_title_posts' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_posts",
            "std" => "%post_title% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Posts</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%post_title% - The original title of the post<br />%category_title% - The (main) category of the post<br />%category_slug% - Alias for %category_title%<br />%post_author_username% - This post's author login<br />%post_author_firstname% - This post's author first name<br />%post_author_lastname% - This post's author last name", $shortname)
    ),

    "page_title" => array(  "name" => __("Pages", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Pages displayed as. <br /> <a href='#".$shortname."_seo_title_pages' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_pages",
            "std" => "%page_title% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%page_title% - The original title of the page<br />%page_author_username% - This page's author login<br />%page_author_firstname% - This page's author first name<br />%page_author_lastname% - This page's author last name", $shortname)
    ),
    
    "category_title" => array(  "name" => __("Categories", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Category pages displayed as. <br /> <a href='#".$shortname."_seo_title_categories' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_categories",
            "std" => "%category_title% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Category pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%category_title% - The original title of the category<br />%category_description% - The description of the category", $shortname)
    ),
    
    "portfolio_item_title" => array(  "name" => __("Portfolio Items", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your portfolio item pages displayed as. <br /> <a href='#".$shortname."_seo_title_portfolio_items' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_portfolio_items",
            "std" => "%item_title% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Portfolio Items</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%item_title% - The original title of the portfolio item<br />%portfolio_title% - The (main) portfolio of the portfolio item<br />%portfolio_slug% - Alias for %portfolio_title%", $shortname)
    ),
    
    "portfolio_title" => array(  "name" => __("Portfolios", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your portfolio pages displayed as. <br /> <a href='#".$shortname."_seo_title_portfolios' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_portfolios",
            "std" => "%portfolio_title% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Portfolio pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%portfolio_title% - The original title of the portfolio<br />%portfolio_description% - The description of the category<br />%portfolio_slug% - Alias for %portfolio_title%", $shortname)
    ),
    
    "archive_title" => array(  "name" => __("Archives", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Archive pages displayed as. <br /> <a href='#".$shortname."_seo_title_archives' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_archives",
            "std" => "%date% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Archive pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%date% - The original archive title given by WordPess, e.g. '2010' or '2010 September'", $shortname)
    ),
    
    "tag_title" => array(  "name" => __("Tags", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Tags pages displayed as. <br /> <a href='#".$shortname."_seo_title_tags' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_tags",
            "std" => "%tag% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Tag pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%tag% - The name of the tag", $shortname)
    ),

    "author_title" => array(  "name" => __("Tags", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Author pages displayed as. <br /> <a href='#".$shortname."_seo_title_tags' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_author",
            "std" => "%author% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Author pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%author% - The public name of the author", $shortname)
    ),
    
    "search_title" => array(  "name" => __("Search Results", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your Search Results pages displayed as. <br /> <a href='#".$shortname."_seo_title_search' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_search",
            "std" => "Search Results for %search% | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for Search Results pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description<br />%search_term% - What was searched for", $shortname)
    ),
    
    "404_title" => array(  "name" => __("404", $shortname),
            "desc" => __("Enter the format you'd like the default titles of your 404 pages displayed as. <br /> <a href='#".$shortname."_seo_title_404' class='jaybich-open'>Available Format Tags</a>", $shortname),
            "id" => $shortname."_seo_title_404",
            "std" => "Page not found | %blog_title%",
            "type" => "text",
            "more-info" => __("<h4>Accepted title format macros for 404 pages</h4>%blog_title% - Your site title<br />%blog_description% - Your site description", $shortname)
    ),

    array ( "type" => "end"),

    //Meta Keywords
    array(  "type" => "start",
            "name" => "Meta Keywords",
            "id" => "meta-keywords",
            "icon" => "key"
    ),

    "keyword_locations" => array(  "name" => __("Where would you like meta keywords to run?", $shortname),
            "desc" => __("Select the sections of the theme's front-end you'd like meta keywords to be inserted into the &lt;head&gt;. <br /><br /><a href='#".$shortname."_seo_keywords' class='jaybich-open'>More Info</a>", $shortname),
            "id" => $shortname."_seo_keywords",
            "std" => array( "homepage", "page", "post", "portfolio-item" ),
            "data" => array(
                array(
                        "name" => "Homepage",
                        "value" => "homepage"
                ),
                array(
                        "name" => "Pages",
                        "value" => "page"
                ),

                array(
                        "name" => "Posts",
                        "value" => "post"
                ),
                array(
                        "name" => "Categories",
                        "value" => "category"
                ),
                array(
                        "name" => "Portfolio Items",
                        "value" => "portfolio-item"
                ),
                array(
                        "name" => "Portfolios",
                        "value" => "portfolio"
                ),
                array(
                        "name" => "Archives",
                        "value" => "archive"
                ),
                array(
                        "name" => "Tags",
                        "value" => "tag"
                ),
                array(
                        "name" => "Authors",
                        "value" => "author"
                ),
                array(
                        "name" => "Search Results",
                        "value" => "search"
                ),
                array(
                        "name" => "404 Page",
                        "value" => "404"
                ),
            ),
            "type" => "checkbox",
            "more-info" => __("<p>Meta keywords are words or phrases that you can use to describe your page or post. They definitely do not have the same impact on SEO that they did in the past, however they can still be helpful. According to <a href='http://www.mattcutts.com/blog/' target='_blank'>Matt Cutts</a>, head of Google's Webspam team, Google does not use meta keywords to determine rankings in their organic search results. However, many other search engines still do. So, it's a never a bad idea to include them.</p><p>&lt;meta name=&quot;keywords&quot; content=&quot;keyword1, keyword2, keyword3&quot; /&gt;</p> <ul><li><strong>Homepage:</strong> Meta keywords entered in the homepage SEO section will be used on your homepage if this option is checked.</li><li><strong>Pages:</strong> Meta keywords for pages are taken from the custom option you can put in when editing a page. If this is left blank, the keywords used in your homepage keyword list will be used. Check this option to activate this.</li><li><strong>Posts:</strong> Meta keywords for posts are taken from the custom option you can put in when editing a post. If this is left blank, the keywords used in your homepage keyword list will be used. Check this option to activate this.</li><li><strong>Categories:</strong> This option applies to category pages. The associated category name(s) and slug(s) are the keywords used.</li><li><strong>Portfolio Items:</strong> Meta keywords for portfolio items are taken from the custom option you can put in when editing a portfolio item. If this is left blank, the keywords used in your homepage keyword list will be used. Check this option to activate this.</li><li><strong>Portfolios:</strong> This option applies to portfolio pages (e.g. groups of portfolio items). Keywords returned are the name(s) and slug(s) of the associated portfolio.</li><li><strong>Archives:</strong> This option applies to archive pages. Keywords are taken from your homepage keyword list if this option is enabled.</li><li><strong>Tags:</strong> This option applies to tags pages. The associated tag is used as a single keyword.</li><li><strong>Author Pages:</strong> This option applies to pages of posts filtered by an author. The author's public name will be used as a single keyword.</li><li><strong>Search Results:</strong> This option applies to search result pages. Keywords are taken from the words searched for if this option is enabled.</li><li><strong>404 Page:</strong> This option applies to 404 pages (not found pages). Keywords are taken from your homepage keyword list if this option is enabled.</li></ul>", $shortname )
    ),

    array ( "type" => "end"),

    //Meta Description
    array(  "type" => "start",
            "name" => "Meta Descriptions",
            "id" => "meta-descriptions",
            "icon" => "description"
    ),

    "description_locations" => array(  "name" => __("Where would you like meta descriptions to run?", $shortname),
            "desc" => __("Select the sections of the theme's front-end you'd like meta descriptions to be inserted into the &lt;head&gt;. <br /><br /><a href='#".$shortname."_seo_descriptions' class='jaybich-open'>More Info</a>", $shortname),
            "id" => $shortname."_seo_descriptions",
            "std" => array( "homepage", "page", "post", "portfolio-item" ),
            "data" => array(
                array(
                        "name" => "Homepage",
                        "value" => "homepage"
                ),
                array(
                        "name" => "Pages",
                        "value" => "page"
                ),

                array(
                        "name" => "Posts",
                        "value" => "post"
                ),
                array(
                        "name" => "Categories",
                        "value" => "category"
                ),
                array(
                        "name" => "Portfolio Items",
                        "value" => "portfolio-item"
                ),
                array(
                        "name" => "Portfolios",
                        "value" => "portfolio"
                ),
                array(
                        "name" => "Archives",
                        "value" => "archive"
                ),
                array(
                        "name" => "Tags",
                        "value" => "tag"
                ),
                array(
                        "name" => "Authors",
                        "value" => "author"
                ),
                array(
                        "name" => "Search Results",
                        "value" => "search"
                ),
                array(
                        "name" => "404 Page",
                        "value" => "404"
                ),
            ),
            "type" => "checkbox",
            "more-info" => __("<p>The meta description is a short paragraph that sums up what a particular page or post is about. Google and other search engines will often display this description in their search results. Without this snippet of text, generally, search engines will simply pull relevant chunks of text from your site to display.</p><p>&lt;meta name=&quot;description&quot; content=&quot;This is your SEO description of your site.&quot; /&gt;</p> <ul><li><strong>Homepage:</strong> The meta description entered in the homepage SEO section will be used on your homepage if this option is checked.</li><li><strong>Pages:</strong> The meta description for pages is taken from the custom option you can put in when editing a page. If this is left blank, the description used for your homepage description list will be used. Check this option to activate this.</li><li><strong>Posts:</strong>The meta description for posts is taken from the custom option you can put in when editing a post. If this is left blank, the description used for your homepage description will be used. Check this option to activate this.</li><li><strong>Categories:</strong> This option applies to category pages. The description is taken from the description entered when creating a category, and if it's left blank, the homepage description is used.</li><li><strong>Portfolio Items:</strong>The meta description for portfolio items is taken from the custom option you can put in when editing a portfolio item. If this is left blank, the description used for your homepage description will be used. Check this option to activate this.</li><li><strong>Portfolios:</strong> This option applies to portfolio pages (e.g. groups of portfolio items). The description is taken from the description entered when creating a portfolio, and if it's left blank, the homepage description is used.</li><li><strong>Archives:</strong> This option applies to archive pages. The description is taken from your homepage description if this option is enabled.</li><li><strong>Tags:</strong> This option applies to tags pages. The description is taken from your homepage description if this option is enabled.</li><li><strong>Author Pages:</strong> This option applies to pages of posts filtered by an author. The author's bio will be used for description and if that's blank, the homepage description will be used.</li><li><strong>Search Results:</strong> This option applies to search result pages. The description is taken from the words searched for if this option is enabled.</li><li><strong>404 Page:</strong> This option applies to 404 pages (not found pages). The description is taken from your homepage description if this option is enabled.</li></ul>", $shortname)
    ),

    array ( "type" => "end"),
    
    

);

##############################################################
# Information
##############################################################

$info = array(
    "pageTitle" => "SEO",
    "menuTitle" => "SEO",
    "pageLevel" => "child",
    "pageSlug" => "seo",
    "linkSupport" => "http://themeforest.net/user/themeblvd",
    "linkSite" => "http://themeforest.net/user/themeblvd/portfolio",
    "linkAuthor" => "http://www.jasonbobich.com",
    "linkProfile" => "http://www.themeforest.net/user/themeblvd"
);

##############################################################
# Activate Options Page
##############################################################

$themeblvd_options_seo = new themeblvd_options($info, $shortname, $themename, $options_seo);

##############################################################
# Activate SEO Plugin
##############################################################

$seo = new themeblvd_seo($options_seo);

?>