<?php
/**
 *
 * ThemeBlvd Theme Meta Box
 * SEO Meta Box
 *
 * This meta box gets displays on all posts, portfolio items,
 * and pages. It gives the user options for configuring SEO
 * for that post or page they're working on. This meta box
 * will only show if ThemeBlvd SEO is enabled.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Key Elements
##############################################################

$shortname = "themeblvd";

##############################################################
# Options
##############################################################

$options = array(

    array(  "name" => __("Title Tag", $shortname),
            "desc" => __("Enter in the title as you'd like to be displayed.  <a href='#".$shortname."_title' class='jaybich-open'>Learn More</a>", $shortname),
            "id" => $shortname."_title",
            "std" => "",
            "type" => "text",
            "more-info" => __("<p>This is the title that gets inserted within the &lt;title&gt; tag of this page's &lt;head&gt; section. It then gets displayed at the top of most web browsers when a user visits your site. It also, in most cases, gets used on a search engine results page when displaying your page as a result. It's also very important in how search engines determine what this page is about. So, it's important to put a couple of your most important keywords here along with your site's name in a user-friendly, NON-spammy format.</p><p>Here's what the final result will look like in your source code:</p><p>&lt;title&gt;Your title ends up here&lt;/title&gt;</p>", $shortname)
   ),

    array(  "name" => __("Meta Keywords", $shortname),
            "desc" => __("Enter a comma-separated list of keywords you'd like to associate with this page.  <a href='#".$shortname."_keywords' class='jaybich-open'>Learn More</a>", $shortname),
            "id" => $shortname."_keywords",
            "std" => "",
            "type" => "textarea",
            "more-info" => __('<p>Meta keywords are words or phrases that you can use to describe your page or post. They definitely do not have the same impact on SEO that they did in the past, however they can still be helpful. According to <a href="http://www.mattcutts.com/blog/" target="_blank">Matt Cutts</a>, head of Google\'s Webspam team, Google does not use meta keywords to determine rankings in their organic search results. However, many other search engines still do. So, it\'s a never a bad idea to include them.</p><p>Here\'s what the final result will look like in your source code:</p><p>&lt;meta name="keywords" content="keyword1, keyword2, keyword3" /&gt;</p>', $shortname)
    ),
    
    array(  "name" => __("Meta Description", $shortname),
            "desc" => __("Enter a description you'd like to associate with this page. <a href='#".$shortname."_description' class='jaybich-open'>Learn More</a>", $shortname),
            "id" => $shortname."_description",
            "std" => "",
            "type" => "textarea",
            "more-info" => __('<p>The meta description is a short paragraph that sums up what a particular page or post is about. Google and other search engines will often display this description in their search results. Without this snippet of text, generally, search engines will simply pull relevant chunks of text from your site to display.</p><p>Here\'s what the final result will look like in your source code:</p><p>&lt;meta name="description" content="This is your SEO description of your site." /&gt;</p>', $shortname)
    ),

    array(  "name" => __("Do you want this page to be indexed by search engines?", $shortname),
            "option1" => __("Yes, I want search engines to find this page.", $shortname),
            "option2" => __("No, hide this page form search engines."),
            "desc" => __("If you choose to hide this page from search engines, nofollow and noindex tags will be added to this page so search engines will not index it.", $shortname),
            "id" => $shortname."_noindex",
            "std" => "true",
            "type" => "true_false_radio"
    )

);

##############################################################
# Information
##############################################################

$info = array(
    'id'=>'seo',
    'title' => 'Search Engine Optimization (SEO)',
    'page'=> array('post','page', 'portfolio-item'),
    'context'=>'normal', //normal or side
    'priority'=>'high', //high or low
    'callback'=>''
);

##############################################################
# Activate Meta Box if site is public and SEO is enabled
##############################################################

//Is site set to public? And is ThemeBlvd SEO enabled?
if ( get_option('blog_public') == 1 && get_option('themeblvd_seo_plugin') != 'false' ) {

	$themeblvd_seo = new themeblvd_meta_box($info, $options);

}