<?php
/**
 *
 * ThemeBlvd Theme Options
 * Page Templates
 *
 * This file constructs the SEO options page.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Key Elements
##############################################################

$themename = "Alyeska";
$shortname = "themeblvd";

##############################################################
# Options
##############################################################

$options_templates = array (
	
	
	//Blog Style #1
	array(  "type" => "start",
            "name" => "Blog Style #1",
            "id" => "blog-1",
            "icon" => "page-text"
    ),
    
    array(  "name" => __("Show excerpts or full posts?", $shortname),
            "desc" => __("Choose whether you'd like to show the excerpt or the content for a more classic blog feel. <a href=\"#themeblvd_blog1_content\" class=\"jaybich-open\">Learn More</a>", $shortname),
            "more-info" => __('
            	
            	<p>If you\'re new to WordPress, you may be wondering what the difference between showing the excerpt and showing the content is. So, here is some information on both options.</p>

				<h4>1) Show excerpts.</h4>
				
				<p>The <a href="http://codex.wordpress.org/Excerpt" target="_blank">excerpt</a> is a one paragraph summary of your post that can be up to 55 words long. You can specify the excerpt when creating your posts, and if you do not specify one, WordPress will automatically take the first 55 words of your post and use that. In an excerpt, you cannot have any HTML code; it is plain text only. Any HTML tags (links, images, etc.) that you attempt to put in the excerpt will be stripped by WordPress.</p>
				
				<p>In this particular theme, when showing the excerpt, a "Read More" button will automatically be displayed below the excerpt that links to the post.</p>
				
				<h4>2) Show full content.</h4>
				
				<p>If you\'re looking for more of a classic blog feel, you can choose to show the content on your blog page. This means that the excerpt will not be used at all. All content will be shown from your post with <em>no</em> automatic "Read More" button.</p>
				
				<p>When using this option, if you\'d like to pick a spot for the post to be cut off and insert a link to the post, this is commonly referred in WordPress as the "teaser". When you\'re writing a post, you can insert <em>&lt;!--more--&gt;</em> anywhere in the post, and it will cut off at that point and a link will be shown that leads to the post. You can also customize what the link says by adding text to that tag like this <em>&lt;!--more But wait, there\'s more!--&gt;</em>. <a href="http://codex.wordpress.org/Customizing_the_Read_More" target="_blank">Learn More</a></p>', $shortname),
            "id" => $shortname."_blog1_content",
            "std" => "excerpt",
            "type" => "radio",
            "data" => array(

                array(
                    "name" => __("Show excerpts.", $shortname),
                    "value" => "excerpt"
                ),

                array(
                    "name" => __("Show full posts.", $shortname),
                    "value" => "content"
                )

            )
    ),
	
	
	array(  "type" => "end"),
	
	//Blog Style #2
	array(  "type" => "start",
            "name" => "Blog Style #2",
            "id" => "blog-2",
            "icon" => "page-text"
    ),
    
    array(  "name" => __("Show excerpts or full posts?", $shortname),
            "desc" => __("Choose whether you'd like to show the excerpt or the content for a more classic blog feel. <a href=\"#themeblvd_blog1_content\" class=\"jaybich-open\">Learn More</a>", $shortname),
            "more-info" => __('
            	
            	<p>If you\'re new to WordPress, you may be wondering what the difference between showing the excerpt and showing the content is. So, here is some information on both options.</p>

				<h4>1) Show excerpts.</h4>
				
				<p>The <a href="http://codex.wordpress.org/Excerpt" target="_blank">excerpt</a> is a one paragraph summary of your post that can be up to 55 words long. You can specify the excerpt when creating your posts, and if you do not specify one, WordPress will automatically take the first 55 words of your post and use that. In an excerpt, you cannot have any HTML code; it is plain text only. Any HTML tags (links, images, etc.) that you attempt to put in the excerpt will be stripped by WordPress.</p>
				
				<p>In this particular theme, when showing the excerpt, a "Read More" button will automatically be displayed below the excerpt that links to the post.</p>
				
				<h4>2) Show full content.</h4>
				
				<p>If you\'re looking for more of a classic blog feel, you can choose to show the content on your blog page. This means that the excerpt will not be used at all. All content will be shown from your post with <em>no</em> automatic "Read More" button.</p>
				
				<p>When using this option, if you\'d like to pick a spot for the post to be cut off and insert a link to the post, this is commonly referred in WordPress as the "teaser". When you\'re writing a post, you can insert <em>&lt;!--more--&gt;</em> anywhere in the post, and it will cut off at that point and a link will be shown that leads to the post. You can also customize what the link says by adding text to that tag like this <em>&lt;!--more But wait, there\'s more!--&gt;</em>. <a href="http://codex.wordpress.org/Customizing_the_Read_More" target="_blank">Learn More</a></p>', $shortname),
            "id" => $shortname."_blog2_content",
            "std" => "excerpt",
            "type" => "radio",
            "data" => array(

                array(
                    "name" => __("Show excerpts.", $shortname),
                    "value" => "excerpt"
                ),

                array(
                    "name" => __("Show full posts.", $shortname),
                    "value" => "content"
                )

            )
    ),
	
	
	array(  "type" => "end"),

    //Contact Page
    array(  "type" => "start",
            "name" => "Contact Page",
            "id" => "contact",
            "icon" => "email"
    ),

    //Admin Email
    array(  "id" => $shortname."_email_address",
            "name" => "E-mail address",
            "std" => get_option('admin_email'),
            "desc" => __("Enter the e-mail address where you would like to receive messages from this contact form.", $shortname),
            "type" => "text"),

    //Table Title
    array(  "id" => "form-builder-title",
            "name" => "Form builder",
            "type" => "table-title"),

    //Start Table
    array(  "type" => "start-table"),

            //Row #1
    array(  "type" => "start-row"),

    array(  "id" => $shortname."_field_name_1",
    		"std" => '',
            "type" => "field-name"),

    array(  "id" => $shortname."_field_input_1",
            "std" => "text-input",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "Text Input",
                        "value" => "text-input"
                ),

                array(
                        "name" => "Text Area",
                        "value" => "textarea"
                )

            )
    ),

    array(  "id" => $shortname."_field_required_1",
            "std" => "required",
            "type" => "dropdown",
            "data" => array(

                    array(
                            "name" => "Required",
                            "value" => "yes"
                    ),

                    array(
                            "name" => "Not Required",
                            "value" => "no"
                    )

                )
            ),

    array(  "id" => $shortname."_field_validation_1",
            "std" => "none",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "None",
                        "value" => "none"
                ),

                array(
                        "name" => "E-mail",
                        "value" => "email"
                ),

                array(
                        "name" => "Website URL",
                        "value" => "url"
                ),

                array(
                        "name" => "Digits",
                        "value" => "digits"
                ),

            )
    ),


    array(  "type" => "end-row"),

            //Row #2
    array(  "type" => "start-row"),

    array(  "id" => $shortname."_field_name_2",
            "std" => '',
            "type" => "field-name"),

    array(  "id" => $shortname."_field_input_2",
            "std" => "text-input",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "Text Input",
                        "value" => "text-input"
                ),

                array(
                        "name" => "Text Area",
                        "value" => "textarea"
                ),

            )
    ),

    array(  "id" => $shortname."_field_required_2",
            "std" => "required",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "Required",
                        "value" => "yes"
                ),

                array(
                        "name" => "Not Required",
                        "value" => "no"
                ),

            )
    ),

    array(  "id" => $shortname."_field_validation_2",
            "std" => "none",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "None",
                        "value" => "none"
                ),

                array(
                        "name" => "E-mail",
                        "value" => "email"
                ),

                array(
                        "name" => "Website URL",
                        "value" => "url"
                ),

                array(
                        "name" => "Digits",
                        "value" => "digits"
                )

            )
    ),


    array(  "type" => "end-row"),

            //Row #3
    array(  "type" => "start-row"),

    array(  "id" => $shortname."_field_name_3",
            "std" => '',
            "type" => "field-name"),

    array(  "id" => $shortname."_field_input_3",
            "std" => "text-input",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "Text Input",
                        "value" => "text-input"
                ),

                array(
                        "name" => "Text Area",
                        "value" => "textarea"
                )

            )
    ),

    array(  "id" => $shortname."_field_required_3",
            "std" => "required",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "Required",
                        "value" => "yes"
                ),

                array(
                        "name" => "Not Required",
                        "value" => "no"
                )

            )
    ),

    array(  "id" => $shortname."_field_validation_3",
            "std" => "none",
            "type" => "dropdown",
            "data" => array(

                array(
                        "name" => "None",
                        "value" => "none"
                ),

                array(
                        "name" => "E-mail",
                        "value" => "email"
                ),

                array(
                        "name" => "Website URL",
                        "value" => "url"
                ),

                array(
                        "name" => "Digits",
                        "value" => "digits"
                )

            )
    ),


	array(  "type" => "end-row"),

    //End Table
    array(  "type" => "end-table"),

    array ( "type" => "end"),
	
);

##############################################################
# Information
##############################################################

$info = array(
    "pageTitle" => "Page Templates",
    "menuTitle" => "Page Templates",
    "pageLevel" => "child",
    "pageSlug" => "page-templates",
    "linkSupport" => "http://themeforest.net/user/themeblvd",
    "linkSite" => "http://themeforest.net/user/themeblvd/portfolio",
    "linkAuthor" => "http://www.jasonbobich.com",
    "linkProfile" => "http://www.themeforest.net/user/themeblvd"
);

##############################################################
# Activate Options Page
##############################################################

$themeblvd_options_templates = new themeblvd_options($info, $shortname, $themename, $options_templates);

?>