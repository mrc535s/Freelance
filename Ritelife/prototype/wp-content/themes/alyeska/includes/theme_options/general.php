<?php
/**
 *
 * ThemeBlvd Theme Options
 * General Options
 *
 * This file constructs the general theme options page.
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

$options_general = array (
	
	//General Layout
    array(  "type" => "start",
            "name" => __("General Layout", $shortname),
            "id" => "general-layout",
            "icon" => "web-layout"
    ),
    
    array(  "desc" => __("Here you can control the general layout and colors of your site. These options allow to you change most of the features you saw on the live demo's \"Test Drive\" panel.", $shortname),
            "type" => "description"
    ),
	
	array(  "name" => __("Body Style", $shortname),
            "desc" => __("Choose the style you want to be applied to the main content area inside your website.", $shortname),
            "id" => $shortname."_layout_body_style",
            "std" => "light",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Light", $shortname),
                        "value" => "light"
                    ),

                    array(
                        "name" => __("Dark", $shortname),
                        "value" => "dark"
                    ),
              )
	),
	
	array(  "name" => __("Body Shape", $shortname),
            "desc" => __("Choose how you want the entire shape of your website to be set.", $shortname),
            "id" => $shortname."_layout_body_shape",
            "std" => "boxed",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Stretch", $shortname),
                        "value" => "stretch"
                    ),

                    array(
                        "name" => __("Boxed", $shortname),
                        "value" => "boxed"
                    ),
              )
	),
	
	array(  "name" => __("Skin Color", $shortname),
            "desc" => __("Choose the color you'd like to use for the outer parts of your website.", $shortname),
            "id" => $shortname."_layout_skin_color",
            "std" => "blue",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Black", $shortname),
                        "value" => "black"
                    ),
                    
                    array(
                        "name" => __("Blue", $shortname),
                        "value" => "blue"
                    ),
                    
                    array(
                        "name" => __("Brown", $shortname),
                        "value" => "brown"
                    ),
                    
                    array(
                        "name" => __("Dark Purple", $shortname),
                        "value" => "dark-purple"
                    ),
                    
                    array(
                        "name" => __("Dark", $shortname),
                        "value" => "dark"
                    ),
                    
                    array(
                        "name" => __("Green", $shortname),
                        "value" => "green"
                    ),
                    
                    array(
                        "name" => __("Light Blue", $shortname),
                        "value" => "light-blue"
                    ),
                    
                    array(
                        "name" => __("Light", $shortname),
                        "value" => "light"
                    ),
                    
                    array(
                        "name" => __("Navy", $shortname),
                        "value" => "navy"
                    ),
                    
                    array(
                        "name" => __("Orange", $shortname),
                        "value" => "orange"
                    ),
                    
                    array(
                        "name" => __("Pink", $shortname),
                        "value" => "pink"
                    ),
                    
                    array(
                        "name" => __("Purple", $shortname),
                        "value" => "purple"
                    ),
                    
                    array(
                        "name" => __("Red", $shortname),
                        "value" => "red"
                    ),
                    
                    array(
                        "name" => __("Slate Grey", $shortname),
                        "value" => "slate"
                    ),
                    
                    array(
                        "name" => __("Teal", $shortname),
                        "value" => "teal"
                    ),
                    
              )
	),
	
	array(  "name" => __("Skin Texture", $shortname),
            "desc" => __("Choose the texture you'd like applied with the skin color you chose in the previous option.", $shortname),
            "id" => $shortname."_layout_skin_texture",
            "std" => "glass",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Bokeh", $shortname),
                        "value" => "bokeh"
                    ),

                    array(
                        "name" => __("Cracked", $shortname),
                        "value" => "cracked"
                    ),
                    
                    array(
                        "name" => __("Diagonal Lines (Vintage)", $shortname),
                        "value" => "diag"
                    ),
                    
                    array(
                        "name" => __("Diagonal Lines (Standard)", $shortname),
                        "value" => "diag2"
                    ),
                    
                    array(
                        "name" => __("Dots", $shortname),
                        "value" => "dots"
                    ),
                    
                    array(
                        "name" => __("Glass", $shortname),
                        "value" => "glass"
                    ),
                    
                    array(
                        "name" => __("Glow", $shortname),
                        "value" => "glow"
                    ),
                    
                    array(
                        "name" => __("Grid", $shortname),
                        "value" => "grid"
                    ),
                    
                    array(
                        "name" => __("Grunge", $shortname),
                        "value" => "grunge"
                    ),
                    
                    array(
                        "name" => __("Horizontal Lines", $shortname),
                        "value" => "horz"
                    ),
                    
                    array(
                        "name" => __("Mosaic", $shortname),
                        "value" => "mosaic"
                    ),
                    
                    array(
                        "name" => __("Splatter", $shortname),
                        "value" => "splatter"
                    ),
                    
                    array(
                        "name" => __("Vertical Lines", $shortname),
                        "value" => "vert"
                    ),
                    
                    array(
                        "name" => __("Vintage Wallpaper", $shortname),
                        "value" => "vintage"
                    ),
                    
                    array(
                        "name" => __("Wood", $shortname),
                        "value" => "wood"
                    ),
              )
	),
	
	array(  "name" => __("Menu Color", $shortname),
            "desc" => __("Choose the color you'd like the main menu of your website to be.", $shortname),
            "id" => $shortname."_layout_menu_color",
            "std" => "dark",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Black", $shortname),
                        "value" => "black"
                    ),
                    
                    array(
                        "name" => __("Blue", $shortname),
                        "value" => "blue"
                    ),
                    
                    array(
                        "name" => __("Brown", $shortname),
                        "value" => "brown"
                    ),
                    
                    array(
                        "name" => __("Dark Purple", $shortname),
                        "value" => "dark-purple"
                    ),
                    
                    array(
                        "name" => __("Dark", $shortname),
                        "value" => "dark"
                    ),
                    
                    array(
                        "name" => __("Green", $shortname),
                        "value" => "green"
                    ),
                    
                    array(
                        "name" => __("Light Blue", $shortname),
                        "value" => "light-blue"
                    ),
                    
                    array(
                        "name" => __("Light", $shortname),
                        "value" => "light"
                    ),
                    
                    array(
                        "name" => __("Navy", $shortname),
                        "value" => "navy"
                    ),
                    
                    array(
                        "name" => __("Orange", $shortname),
                        "value" => "orange"
                    ),
                    
                    array(
                        "name" => __("Pink", $shortname),
                        "value" => "pink"
                    ),
                    
                    array(
                        "name" => __("Purple", $shortname),
                        "value" => "purple"
                    ),
                    
                    array(
                        "name" => __("Red", $shortname),
                        "value" => "red"
                    ),
                    
                    array(
                        "name" => __("Slate Grey", $shortname),
                        "value" => "slate"
                    ),
                    
                    array(
                        "name" => __("Teal", $shortname),
                        "value" => "teal"
                    ),
                    
              )
	),
	
	array(  "name" => __("Menu Shape", $shortname),
            "desc" => __("Choose the shape you'd like applied to the main menu of your website.", $shortname),
            "id" => $shortname."_layout_menu_shape",
            "std" => "flip",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Flip Over", $shortname),
                        "value" => "flip"
                    ),

                    array(
                        "name" => __("Classic", $shortname),
                        "value" => "classic"
                    ),
              )
	),
	
	array(  "name" => __("Menu Search Bar", $shortname),
            "desc" => __("Choose whether you'd like to show the popup search box on the main menu or not.", $shortname),
            "id" => $shortname."_layout_menu_search",
            "std" => "show",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Show", $shortname),
                        "value" => "show"
                    ),

                    array(
                        "name" => __("Hide", $shortname),
                        "value" => "hide"
                    ),
              )
	),

    
    array(  "type" => "end"),
    
    //General Options
    array(  "type" => "start",
            "name" => __("General Options", $shortname),
            "id" => "general-setup",
            "icon" => "screen-on"
    ),
	
	array(  "name" => __("Sidebar on right or left?", $shortname),
            "desc" => __("Choose which side of the page you'd like the sidebar to be positioned on when viewing 2-column pages.", $shortname),
            "id" => $shortname."_sidebar",
            "std" => "right",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Right", $shortname),
                        "value" => "right"
                    ),

                    array(
                        "name" => __("Left", $shortname),
                        "value" => "left"
                    )

                )
    ),
	
    array(  "name" => __("How many footer columns?", $shortname),
            "desc" => __("A dynamic widget area will be registered for each column. <strong>Note: If you lessen the number of widget columns, any existing widgets in additional columns will be removed.</strong>", $shortname),
            "id" => $shortname."_footer_columns",
            "std" => "4",
            "type" => "select",
            "data" => array(
					
					array(
                        "name" => __("Hide Widget Columns", $shortname),
                        "value" => "hide"
                    ),
					
                    array(
                        "name" => __("1 Column", $shortname),
                        "value" => "1"
                    ),

                    array(
                        "name" => __("2 Columns", $shortname),
                        "value" => "2"
                    ),

                    array(
                        "name" => __("3 Columns", $shortname),
                        "value" => "3"
                    ),

                    array(
                        "name" => __("4 Columns", $shortname),
                        "value" => "4"
                    ),

                )
    ),
    
    array(  "name" => __("Copyright Text", $shortname),
            "desc" => __("Enter in your copyright text. '%year%' will show the current year and '%site_title%' will show your current Site Title.", $shortname),
            "std" => "(c) %year% %site_title%. All rights reserved. Web Design by <a href=\"http://www.jasonbobich.com\">Jason Bobich</a>",
            "id" => $shortname."_copyright",
            "type" => "text"
    ),

	array(  "name" => __("Show featured images on single blog posts?", $shortname),
            "desc" => __("Featured images (i.e. Post Thumbnails) get shown on your blog pages, but here you choose if you'd like them to show on your single blog posts.". $shortname),
            "id" => $shortname."_single_thumb",
            "std" => "show",
            "type" => "radio",
            "data" => array(

                    array(
                        "name" => __("Show featured images.", $shortname),
                        "value" => "show"
                    ),

                    array(
                        "name" => __("Hide featured images.", $shortname),
                        "value" => "hide"
                    ),
                    
                )
    ),

    array(  "name" => __("Custom CSS", $shortname),
            "desc" => __("Feel free to throw in some of your own CSS code if you're feeling like you want to spruce things up a bit. You <strong>do not</strong> need &lt;style&gt; tags.", $shortname),
            "id" => $shortname."_custom_css",
            "std" => "",
            "type" => "textarea"
    ),

    array(  "type" => "end"),
    
    //Logo
    array(  "type" => "start",
            "name" => __("Logo", $shortname),
            "id" => "logo",
            "icon" => "star"
    ),
    
    array(  "desc" => __("Here you can configure your main logo that appears in the top left corner of your website.", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("What kind of logo?", $shortname),
            "desc" => __("Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your <a href='options-general.php' target='_blank'>Site Title</a> will show instead.", $shortname),
            "id" => $shortname."_logo",
            "std" => "image",
            "type" => "radio",
            "data" => array(

                array(
                    "name" => "Image Logo",
                    "value" => "image"
                ),

                array(
                    "name" => "Text Logo",
                    "value" => "text"
                )

            )
    ),

    array(  "type" => "upload",
            "name" => "Logo Image URL",
            "id" => $shortname."_logo_image",
            "desc" => "If you've selected for an image to show for your logo in the above option, enter in the full URL to your logo image.<br /><br />Ex: http://www.yoursite.com/wp-content/uploads/2010/10/image.png",
            "std" => ""
    ),
    
    array(  "type" => "end"),
	
	//Contact Buttons
    array(  "type" => "start",
            "name" => __("Contact Buttons", $shortname),
            "id" => "contact-buttons",
            "icon" => "email"
    ),
    
    array(  "desc" => __("These buttons appear in the top right corner of your website. Only fill in the buttons you'd like to use. Make sure you're inserting the full URL to where you want the each button to link.<br /><br />Here's an example of a full URL:<br />http://www.twitter.com/jasonbobich", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Button Style", $shortname),
            "desc" => __("Choose which style of buttons will work better for how you've configured your site.", $shortname),
            "id" => $shortname."_social_style",
            "std" => "dark",
            "type" => "select",
            "data" => array(

                    array(
                        "name" => __("Dark", $shortname),
                        "value" => "dark"
                    ),

                    array(
                        "name" => __("Light", $shortname),
                        "value" => "light"
                    ),
              )
	),
    
    array(  "name" => __("Delicious", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_delicious",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Deviantart", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_deviantart",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Digg", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_digg",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Dribbble", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_dribbble",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Email", $shortname),
            "desc" => __("On this one you could use \"mailto:you@youremail.com\" if you'd like, or just the URL to your contact page.", $shortname),
            "id" => $shortname."_social_email",
            "std" => "mailto:you@youremail.com",
            "type" => "text"
    ),
    
    array(  "name" => __("Facebook", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_facebook",
            "std" => "http://www.facebook.com/jasonbobich",
            "type" => "text"
    ),
    
    array(  "name" => __("Feedburner", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_feedburner",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Flickr", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_flickr",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("LinkedIn", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_linkedin",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Mixx", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_mixx",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Myspace", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_myspace",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Picassa", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_Picassa",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Reddit", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_reddit",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("RSS", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_rss",
            "std" => get_bloginfo('rss2_url'),
            "type" => "text"
    ),
    
    array(  "name" => __("Squidoo", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_squidoo",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Technorati", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_technorati",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("Twitter", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_twitter",
            "std" => "http://www.twitter.com/jasonbobich",
            "type" => "text"
    ),
    
    array(  "name" => __("Vimeo", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_vimeo",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "name" => __("YouTube", $shortname),
            "desc" => __("Put in the full URL you'd like this button to link to.", $shortname),
            "id" => $shortname."_social_youtube",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "type" => "end"),

    //Fonts
    array(  "type" => "start",
            "name" => __("Fonts", $shortname),
            "id" => "fonts",
            "icon" => "pencil"
    ),

    array(  "name" => __("General Body Font Size", $shortname),
            "desc" => __("Choose the size in pixels that you'd like your body font to be.", $shortname),
            "id" => $shortname."_font_size",
            "std" => "12px",
            "type" => "select",
            "data" => array(

                array(
                    "name" => "10px",
                    "value" => "10px"
                ),

                array(
                    "name" => "11px",
                    "value" => "11px"
                ),

                array(
                    "name" => "12px",
                    "value" => "12px"
                ),

                array(
                    "name" => "13px",
                    "value" => "13px"
                ),

                array(
                    "name" => "14px",
                    "value" => "14px"
                ),

                array(
                    "name" => "15px",
                    "value" => "15px"
                ),

            )
    ),


    array(  "name" => __("General Body Font", $shortname),
            "desc" => __("Choose which font stack you'd like to use for your general body font. <a href=\"#themeblvd_font_body\" class=\"jaybich-open\">Learn More</a>", $shortname),
            "id" => $shortname."_font_body",
            "std" => 'lucida',
            "custom" => "body_font",
            "more-info" => __("Font stacks are prioritized lists of fonts, defined in the CSS font-family attribute, that the browser will cycle through until it finds a font that is installed on the user's system. The font stacks listed here were put together by <a href='http://unitinteractive.com/blog/2008/06/26/better-css-font-stacks/'>Nathan Ford</a>.", $shortname),
            "type" => "select",
            "data" => array(

                array(
                    "name" => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
                    "value" => 'arial'
                ),

                array(
                    "name" => 'Baskerville, "Times New Roman", Times, serif',
                    "value" => 'baskerville'
                ),

                array(
                    "name" => 'Cambria, Georgia, Times, "Times New Roman", serif',
                    "value" => 'cambria'
                ),

                array(
                    "name" => '"Century Gothic", "Apple Gothic", sans-serif',
                    "value" => 'century-gothic'
                ),

                array(
                    "name" => 'Consolas, "Lucida Console", Monaco, monospace',
                    "value" => 'consolas'
                ),

                array(
                    "name" => '"Copperplate Light", "Copperplate Gothic Light", serif',
                    "value" => 'copperplate-light'
                ),

                array(
                    "name" => '"Courier New", Courier, monospace',
                    "value" => 'courier-new'
                ),

                array(
                    "name" => '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif',
                    "value" => 'franklin'
                ),

                array(
                    "name" => 'Futura, "Century Gothic", AppleGothic, sans-serif',
                    "value" => 'futura'
                ),

                array(
                    "name" => 'Garamond, "Hoefler Text", Times New Roman, Times, serif',
                    "value" => 'garamond'
                ),

                array(
                    "name" => 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif',
                    "value" => 'geneva'
                ),

                array(
                    "name" => 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif',
                    "value" => 'georgia'
                ),

                array(
                    "name" => '"Gill Sans", Calibri, "Trebuchet MS", sans-serif',
                    "value" => 'gill-sans'
                ),

                array(
                    "name" => '"Helvetica Neue", Arial, Helvetica, sans-serif',
                    "value" => 'helvetica'
                ),

                array(
                    "name" => 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif',
                    "value" => 'impact'
                ),

                array(
                    "name" => '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif',
                    "value" => 'lucida'
                ),

                array(
                    "name" => 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif',
                    "value" => 'palatino'
                ),

                array(
                    "name" => 'Tahoma, Geneva, Verdana',
                    "value" => 'tahoma'
                ),

                array(
                    "name" => 'Times, "Times New Roman", Georgia, serif',
                    "value" => 'times'
                ),

                array(
                    "name" => '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande"," Lucida Sans", Arial, sans-serif',
                    "value" => 'trebuchet'
                ),

                array(
                    "name" => 'Verdana, Geneva, Tahoma, sans-serif',
                    "value" => 'verdana'
                )
            )
    ),

    array(  "name" => __("Headers Font", $shortname),
            "desc" => __("Choose which font you'd like to use from the Google Font Directory. Select 'None' if you'd like the header font to default to the body font. <a href=\"#themeblvd_font_headers\" class=\"jaybich-open\">Learn More</a>", $shortname),
            "id" => $shortname."_font_headers",
            "std" => "Yanone+Kaffeesatz",
            "custom" => "header_font",
            "more-info" => "This theme uses the CSS3 @font-face for all of your headers (&lt;h1&gt;, &lt;h2&gt;, &lt;h3&gt;, etc.). The choices given are hosted from <a href='http://code.google.com/webfonts' target='_blank'>Google's Font Directory</a>. View the directory in order to preview all fonts listed here. This list is not a full list and doesn't include all fonts in the directory. Also note that older browsers do not support this method of font rendering. In these older browsers, the font will fall back to your general body font.",
            "type" => "select",
            "data" => array(

                array(
                    "name" => "None",
                    "value" => "none"
                ),
				
				array(
                    "name" => "Allan",
                    "value" => "Allan:bold"
                ),
                
                array(
                    "name" => "Allerta",
                    "value" => "Allerta"
                ),
                
                array(
                    "name" => "Allerta Stencil",
                    "value" => "Allerta+Stencil"
                ),
                
                array(
                    "name" => "Anonymous Pro",
                    "value" => "Anonymous+Pro"
                ),
				
                array(
                    "name" => "Arimo",
                    "value" => "Arimo"
                ),

                array(
                    "name" => "Arvo",
                    "value" => "Arvo"
                ),
                
                array(
                    "name" => "Bentham",
                    "value" => "Bentham"
                ),
                
                array(
                    "name" => "Buda",
                    "value" => "Buda:light"
                ),
                
                array(
                    "name" => "Cabin",
                    "value" => "Cabin:bold"
                ),
                
                array(
                    "name" => "Calligraffitti",
                    "value" => "Calligraffitti"
                ),

                array(
                    "name" => "Cantarell",
                    "value" => "Cantarell"
                ),

                array(
                    "name" => "Cardo",
                    "value" => "Cardo"
                ),
                
                array(
                    "name" => "Cherry Cream Soda",
                    "value" => "Cherry+Cream+Soda"
                ),
                
                array(
                    "name" => "Chewy",
                    "value" => "Chewy"
                ),
                
                array(
                    "name" => "Coda",
                    "value" => "Coda:800"
                ),
                
                array(
                    "name" => "Coming Soon",
                    "value" => "Coming+Soon"
                ),
                
                array(
                    "name" => "Copse",
                    "value" => "Copse"
                ),
                
                array(
                    "name" => "Corben",
                    "value" => "Corben:bold"
                ),

                array(
                    "name" => "Cousine",
                    "value" => "Cousine"
                ),
                
                array(
                    "name" => "Covered By Your Grace",
                    "value" => "Covered+By+Your+Grace"
                ),
                
                array(
                    "name" => "Crafty Girls",
                    "value" => "Crafty+Girls"
                ),

                array(
                    "name" => "Crimson Text",
                    "value" => "Crimson+Text"
                ),
                
                array(
                    "name" => "Crushed",
                    "value" => "Crushed"
                ),

                array(
                    "name" => "Cuprum",
                    "value" => "Cuprum"
                ),

                array(
                    "name" => "Droid Sans",
                    "value" => "Droid+Sans"
                ),

                array(
                    "name" => "Droid Sans Mono",
                    "value" => "Droid+Sans+Mono"
                ),

                array(
                    "name" => "Droid Serif",
                    "value" => "Droid+Serif"
                ),
                
                array(
                    "name" => "Fontdiner Swanky",
                    "value" => "Fontdiner+Swanky"
                ),
                
                array(
                    "name" => "Geo",
                    "value" => "Geo"
                ),
                
                array(
                    "name" => "Gruppo",
                    "value" => "Gruppo"
                ),
                
                array(
                    "name" => "Homemade Apple",
                    "value" => "Homemade+Apple"
                ),

                array(
                    "name" => "IM Fell",
                    "value" => "IM+Fell+DW+Pica"
                ),

                array(
                    "name" => "Inconsolata",
                    "value" => "Inconsolata"
                ),
                
                array(
                    "name" => "Irish Growler",
                    "value" => "Irish+Growler"
                ),

                array(
                    "name" => "Josefin Sans Std Light",
                    "value" => "Josefin+Sans:300",
                ),

                array(
                    "name" => "Josefin Slab",
                    "value" => "Josefin+Slab:100"
                ),
                
                array(
                    "name" => "Just Another Hand",
                    "value" => "Just+Another+Hand"
                ),
                
                array(
                    "name" => "Just Me Again Down Here",
                    "value" => "Just+Me+Again+Down+Here"
                ),
                
                array(
                    "name" => "Kenia",
                    "value" => "Kenia"
                ),
                
                array(
                    "name" => "Kranky",
                    "value" => "Kranky"
                ),
                
                array(
                    "name" => "Kristi",
                    "value" => "Kristi"
                ),
                
                array(
                    "name" => "Lato",
                    "value" => "Lato"
                ),
                
                array(
                    "name" => "Lekton",
                    "value" => "Lekton"
                ),

                array(
                    "name" => "Lobster",
                    "value" => "Lobster"
                ),
                
                array(
                    "name" => "Luckiest Guy",
                    "value" => "Luckiest+Guy"
                ),
                
                array(
                    "name" => "Maiden Orange",
                    "value" => "Maiden+Orange"
                ),
                
                array(
                    "name" => "Merriweather",
                    "value" => "Merriweather"
                ),

                array(
                    "name" => "Molengo",
                    "value" => "Molengo"
                ),
                
                array(
                    "name" => "Mountains of Christmas",
                    "value" => "Mountains+of+Christmas"
                ),

                array(
                    "name" => "Neucha",
                    "value" => "Neucha"
                ),

                array(
                    "name" => "Neuton",
                    "value" => "Neuton"
                ),

                array(
                    "name" => "Nobile",
                    "value" => "Nobile"
                ),

                array(
                    "name" => "OFL Sorts Mill Goudy TT",
                    "value" => "OFL+Sorts+Mill+Goudy+TT"
                ),

                array(
                    "name" => "Old Standard TT",
                    "value" => "Old+Standard+TT"
                ),
                
                array(
                    "name" => "Orbitron",
                    "value" => "Orbitron"
                ),

                array(
                    "name" => "PT Sans",
                    "value" => "PT+Sans"
                ),
                
                array(
                    "name" => "Permanent Marker",
                    "value" => "Permanent+Marker"
                ),

                array(
                    "name" => "Philosopher",
                    "value" => "Philosopher"
                ),
                
                array(
                    "name" => "Puritan",
                    "value" => "Puritan"
                ),
                
                array(
                    "name" => "Raleway",
                    "value" => "Raleway:100"
                ),

                array(
                    "name" => "Reenie Beanie",
                    "value" => "Reenie+Beanie"
                ),
				
				array(
                    "name" => "Rock Salt",
                    "value" => "Rock+Salt"
                ),
                
                array(
                    "name" => "Schoolbell",
                    "value" => "Schoolbell"
                ),
                
                array(
                    "name" => "Slackey",
                    "value" => "Slackey"
                ),
                
                array(
                    "name" => "Sniglet",
                    "value" => "Sniglet:800"
                ),
                
                array(
                    "name" => "Sunshiney",
                    "value" => "Sunshiney"
                ),
                
                array(
                    "name" => "Syncopate",
                    "value" => "Syncopate"
                ),
				
                array(
                    "name" => "Tangerine",
                    "value" => "Tangerine"
                ),
                
                array(
                    "name" => "Tinos",
                    "value" => "Tinos"
                ),
                
                array(
                    "name" => "Ubuntu",
                    "value" => "Ubuntu"
                ),
                
                array(
                    "name" => "UnifrakturCook",
                    "value" => "UnifrakturCook:bold"
                ),
                
                array(
                    "name" => "UnifrakturMaguntia",
                    "value" => "UnifrakturMaguntia"
                ),
                
                array(
                    "name" => "Unkempt",
                    "value" => "Unkempt"
                ),
                
                array(
                    "name" => "Vibur",
                    "value" => "Vibur"
                ),

                array(
                    "name" => "Vollkorn",
                    "value" => "Vollkorn"
                ),
                
                array(
                    "name" => "Walter Turncoat",
                    "value" => "Walter+Turncoat"
                ),

                array(
                    "name" => "Yanone Kaffeesatz",
                    "value" => "Yanone+Kaffeesatz"
                )

            )
	),

    array(  "type" => "end"),
	
	//Homepage Options
    array(  "type" => "start",
            "name" => __("Homepage", $shortname),
            "id" => "homepage",
            "icon" => "home"
    ),
    
    array(  "desc" => __("<h4>Layout Configuration</h4> <p>This section will help you setup which elements should be displayed on your homepage and in what order.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("How do you want to setup your homepage?", $shortname),
            "desc" => __('Drag the elements around in the order you\'d like to position them on your homepage. Any items you\'d like to not show can be placed below the divider line.<br /><br /><img src="'.get_template_directory_uri().'/includes/theme_options/images/home-diagram.jpg" />', $shortname),
            "id" => $shortname."_homepage_sort",
            "std" => array("placeholder", "slideshow", "slogan", "widgets"),
            "type" => "sortable",
            "data" => array(
				
                "slideshow" => array(
                    "name" => __('Slideshow', $shortname),
                    "value" => "slideshow"
                ),
                
                "slogan" => array(
                    "name" => __('Slogan', $shortname),
                    "value" => "slogan"
                ),
                
                "widgets" => array(
                    "name" => __('Widget Columns', $shortname),
                    "value" => "widgets"
                ),
                
                "page" => array(
                    "name" => __('Content From Page', $shortname),
                    "value" => "page"
                ),
				
				"portfolio" => array(
                    "name" => __('Portfolio Items', $shortname),
                    "value" => "portfolio"
                ),
				
                "blog" => array(
                    "name" => __('Blog + Sidebar', $shortname),
                    "value" => "blog"
                )

            ),
    ),
    
    array(  "desc" => __("<h4>Slideshow</h4> <p>With this theme you can create <a href=\"edit.php?post_type=slide\">Slides</a> and then categorize them into <a href=\"edit-tags.php?taxonomy=slideshows&post_type=slide\">Slideshows</a>. In this first section you can choose your very basic slideshow options. You'll find the options for different kinds of slideshows lower down on the page.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Type of homepage Slideshow?", $shortname),
            "desc" => __("Choose which kind of slideshow you'd like to show on your homepage. <a href=\"#themeblvd_homepage_slideshow_type\" class=\"jaybich-open\">Learn More</a>", $shortname),
            "more-info" => __("<p>I've incorporated these 4 different slideshow plugins into this theme to give you some options when setting up your website.</p><p>If you'd like to get the most features to go along with your homepage slideshow and get the most versatility when creating your individual slides, you should go with the <em>Anything Slider</em>. If you're feeling a little more experimental, feel free to go with one of the other three.</p><p>Please note that the <em>Anything Slider</em> is the only option you can choose if you plan to use \"content slides\" in your slideshow. If you've put content slides in your slideshow and you're using the 3D Slider, Accordion Slider, or Nivo Slider, they simply will not show.</p><p>The options for each individual slideshow are located below on this page.</p>", $shortname),
            "id" => $shortname."_homepage_slideshow_type",
            "std" => "anything",
            "type" => "radio",
            "data" => array(

                array(
                    "name" => __('Anything Slider (Powered by <a href="http://jquery.malsup.com/cycle">Cycle</a>)', $shortname),
                    "value" => "anything"
                ),
                
                array(
                    "name" => __('3D Slider (Powered by <a href="http://www.modularweb.net/#/en/piecemaker/piecemaker-demo">Piecemaker 2</a>)', $shortname),
                    "value" => "3d"
                ),
                
                array(
                    "name" => __('Accordion Slider (Powered by <a href="http://www.jeremymartin.name/projects.php?project=kwicks">Kwicks</a>)', $shortname),
                    "value" => "accordion"
                ),

                array(
                    "name" => __('Nivo Slider (Powered by <a href="http://nivo.dev7studios.com">Nivo</a>)', $shortname),
                    "value" => "nivo"
                )

            ),
    ),
    
    array(  "name" => __("Homepage slideshow feed from where?", $shortname),
            "desc" => __("Choose the slideshow you'd like to pull from. Slideshows are setup <a href='edit-tags.php?taxonomy=slideshows&post_type=slide'>here</a>.", $shortname),
            "id" => $shortname."_homepage_slideshow",
            "std" => "all",
            "taxo" => "slideshows",
            "type" => "taxo_dropdown"
    ),
    
    array(  "desc" => __("<h4>Slogan</h4> <p>Here you can determine what the homepage slogan says.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("What should your slogan say?", $shortname),
            "desc" => __("The slogan should be plain text only.", $shortname),
            "id" => $shortname."_homepage_slogan",
            "std" => "This your slogan. Change it or hide it.",
            "type" => "text"
    ),
	
	array(  "desc" => __("<h4>Widget Columns</h4> <p>This section allows you to configure the widget areas on your homepage.</p>", $shortname),
            "type" => "description"
    ),
	
    array(  "name" => __("How many widget columns?", $shortname),
            "desc" => __("A dynamic widget area will be registered for each column. Even if you have widget columns hidden in the Homepage Configuration options, selecting 0 widget columns will clean up Appearance > Widgets page by not having excess widget areas. <strong>Note: If you lessen the number of widget columns, any existing widgets in additional columns will be removed.</strong>", $shortname),
            "id" => $shortname."_homepage_columns",
            "std" => "3",
            "type" => "select",
            "data" => array(
					
					array(
                        "name" => __("0 Columns", $shortname),
                        "value" => "0"
                    ),
					
                    array(
                        "name" => __("1 Column", $shortname),
                        "value" => "1"
                    ),

                    array(
                        "name" => __("2 Columns", $shortname),
                        "value" => "2"
                    ),

                    array(
                        "name" => __("3 Columns", $shortname),
                        "value" => "3"
                    ),

                    array(
                        "name" => __("4 Columns", $shortname),
                        "value" => "4"
                    ),

                )
    ),
    
    array(  "desc" => __("<h4>Page Content</h4> <p>This section allows you to select a page, which will be used to populate this section of the homepage.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Use which page's content?", $shortname),
            "desc" => __("If you have the \"Content From Page\" set to show in your Layout Configuration options, here you can select which WordPress page to pull from.", $shortname),
            "id" => $shortname."_homepage_page_id",
            "std" => '',
            "type" => "page_dropdown"
    ),
    
    array(  "desc" => __("<h4>Homepage Portfolio Items</h4> <p>Here you can configure settings for <a href=\"edit.php?post_type=portfolio-item\">portfolio items</a> if you have them set to show. Additional settings for displaying portfolio items throughout your site can be found under Theme Options > Portfolios.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Portfolio Items feed from where?", $shortname),
            "desc" => __("Choose the portfolio you'd like to pull from. Portfolios are setup <a href='edit-tags.php?taxonomy=portfolio&post_type=portfolio-item'>here</a>.", $shortname),
            "id" => $shortname."_homepage_portfolio",
            "std" => "all",
            "taxo" => "portfolio",
            "type" => "taxo_dropdown"
    ),
    
    array(  "name" => __("How many portfolio items to be displayed?", $shortname),
            "desc" => __("Here you are setting a limit for the number of portfolio items. Since portfolio items are shown three to a row, your choices are limited to numbers divisable by 3.", $shortname),
            "id" => $shortname."_homepage_portfolio_num",
            "std" => "3",
            "type" => "select",
            "data" => array(
					
					array(
                        "name" => __("3 Portfolio Items", $shortname),
                        "value" => "3"
                    ),
					
                    array(
                        "name" => __("6 Portfolio Items", $shortname),
                        "value" => "6"
                    ),

                    array(
                        "name" => __("9 Portfolio Items", $shortname),
                        "value" => "9"
                    ),

                    array(
                        "name" => __("12 Portfolio Items", $shortname),
                        "value" => "12"
                    )

                )
    ),
    
    array(  "name" => __("Show link to portfolio page at the bottom of item?", $shortname),
            "desc" => __("This set of portfolio items does not have pagination, so it might be a good idea to show a link that directs to another page on your site where your full portfolio is.", $shortname),
            "id" => $shortname."_homepage_portfolio_link",
            "std" => "yes",
            "type" => "radio",
            "data" => array(

                array(
                    "name" => __("Yes, show a link.", $shortname),
                    "value" => "yes"
                ),

                array(
                    "name" => __("No, don't show a link.", $shortname),
                    "value" => "no"
                )

            )
    ),
    
    array(  "name" => __("Link Text", $shortname),
            "desc" => __("This is the text that will be displayed in the link directing to your portfolio.", $shortname),
            "id" => $shortname."_homepage_portfolio_text",
            "std" => "View our full Portfolio &raquo;",
            "type" => "text"
    ),
    
    array(  "name" => __("Link URL", $shortname),
            "desc" => __("Put in the full URL to your portfolio.<br />Ex: http://www.yoursite.com/portfolio", $shortname),
            "id" => $shortname."_homepage_portfolio_url",
            "std" => "",
            "type" => "text"
    ),
    
    array(  "desc" => __("<h4>Homepage Blog</h4> <p>Here you can settings for a blog if you have it set to show.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Show excerpts or full posts?", $shortname),
            "desc" => __("Choose whether you'd like to show the excerpt or the content for a more classic blog feel. <a href=\"#themeblvd_homepage_blog_content\" class=\"jaybich-open\">Learn More</a>", $shortname),
            "more-info" => __('
            	
            	<p>If you\'re new to WordPress, you may be wondering what the difference between showing the excerpt and showing the content is. So, here is some information on both options.</p>

				<h4>1) Show excerpts.</h4>
				
				<p>The <a href="http://codex.wordpress.org/Excerpt" target="_blank">excerpt</a> is a one paragraph summary of your post that can be up to 55 words long. You can specify the excerpt when creating your posts, and if you do not specify one, WordPress will automatically take the first 55 words of your post and use that. In an excerpt, you cannot have any HTML code; it is plain text only. Any HTML tags (links, images, etc.) that you attempt to put in the excerpt will be stripped by WordPress.</p>
				
				<p>In this particular theme, when showing the excerpt, a "Read More" button will automatically be displayed below the excerpt that links to the post.</p>
				
				<h4>2) Show full content.</h4>
				
				<p>If you\'re looking for more of a classic blog feel, you can choose to show the content on your blog page. This means that the excerpt will not be used at all. All content will be shown from your post with <em>no</em> automatic "Read More" button.</p>
				
				<p>When using this option, if you\'d like to pick a spot for the post to be cut off and insert a link to the post, this is commonly referred in WordPress as the "teaser". When you\'re writing a post, you can insert <em>&lt;!--more--&gt;</em> anywhere in the post, and it will cut off at that point and a link will be shown that leads to the post. You can also customize what the link says by adding text to that tag like this <em>&lt;!--more But wait, there\'s more!--&gt;</em>. <a href="http://codex.wordpress.org/Customizing_the_Read_More" target="_blank">Learn More</a></p>', $shortname),
            "id" => $shortname."_homepage_blog_content",
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
    
    array(  "name" => __("Show link to blog page at the bottom of posts?", $shortname),
            "desc" => __("This homepage blog does not have pagination, so it might be a good idea to show a link that directs to another page on your site where your full blog is.", $shortname),
            "id" => $shortname."_homepage_blog_link",
            "std" => "yes",
            "type" => "radio",
            "data" => array(

                array(
                    "name" => __("Yes, show a link.", $shortname),
                    "value" => "yes"
                ),

                array(
                    "name" => __("No, don't show a link.", $shortname),
                    "value" => "no"
                )

            )
    ),
    
    array(  "name" => __("Link Text", $shortname),
            "desc" => __("This is the text that will be displayed in the link directing to your blog page.", $shortname),
            "id" => $shortname."_homepage_blog_text",
            "std" => "More at the Blog &raquo;",
            "type" => "text"
    ),
    
    array(  "name" => __("Link URL", $shortname),
            "desc" => __("Put in the full URL to your blog page.<br />Ex: http://www.yoursite.com/blog", $shortname),
            "id" => $shortname."_homepage_blog_url",
            "std" => "",
            "type" => "text"
    ),
	
	array(  "desc" => __("<h4>Anything Slider</h4> <p>If you chose the \"Anything Slider\" as your homepage slideshows to type above, here is where you configure that slider's options for the homepage.</p>", $shortname),
            "type" => "description"
    ),
	
    array(  "name" => __("Slideshow transition?", $shortname),
            "desc" => __("Here you can select how you want each slide to transition to the next. The most typical options would be \"fade\" and \"scrollHorz\".", $shortname),
            "id" => $shortname."_anything_transition",
            "std" => "fade",
            "type" => "select",
            "data" => array(

                array(
                    "name" => "blindX",
                    "value" => "blindX"
                ),

                array(
                    "name" => "blindY",
                    "value" => "blindY"
                ),

                array(
                    "name" => "blindZ",
                    "value" => "blindZ"
                ),

                array(
                    "name" => "cover",
                    "value" => "cover"
                ),

                array(
                    "name" => "curtainX",
                    "value" => "curtainX"
                ),

                array(
                    "name" => "curtainY",
                    "value" => "curtainY"
                ),

                array(
                    "name" => "fade",
                    "value" => "fade"
                ),

                array(
                    "name" => "fadeZoom",
                    "value" => "fadeZoom"
                ),

                array(
                    "name" => "growX",
                    "value" => "growX"
                ),

                array(
                    "name" => "growY",
                    "value" => "growY"
                ),

                array(
                    "name" => "none",
                    "value" => "none"
                ),

                array(
                    "name" => "scrollUp",
                    "value" => "scrollUp"
                ),

                array(
                    "name" => "scrollDown",
                    "value" => "scrollDown"
                ),

                array(
                    "name" => "scrollLeft",
                    "value" => "scrollLeft"
                ),

                array(
                    "name" => "scrollRight",
                    "value" => "scrollRight"
                ),

                array(
                    "name" => "scrollHorz",
                    "value" => "scrollHorz"
                ),

                array(
                    "name" => "scrollVert",
                    "value" => "scrollVert"
                ),

                array(
                    "name" => "shuffle",
                    "value" => "shuffle"
                ),

                array(
                    "name" => "slideX",
                    "value" => "slideX"
                ),

                array(
                    "name" => "slideY",
                    "value" => "slideY"
                ),

                array(
                    "name" => "toss",
                    "value" => "toss"
                ),

                array(
                    "name" => "turnUp",
                    "value" => "turnUp"
                ),

                array(
                    "name" => "turnDown",
                    "value" => "turnDown"
                ),

                array(
                    "name" => "turnLeft",
                    "value" => "turnLeft"
                ),

                array(
                    "name" => "turnRight",
                    "value" => "turnRight"
                ),

                array(
                    "name" => "uncover",
                    "value" => "uncover"
                ),

                array(
                    "name" => "wipe",
                    "value" => "wipe"
                ),

                array(
                    "name" => "zoom",
                    "value" => "zoom"
                )
            )
    ),

    array(  "name" => __("Autoplay duration?", $shortname),
            "desc" => __("Enter the time you would like in between transitions in seconds. Enter 0 for the slideshow not to auto rotate.", $shortname),
            "id" => $shortname."_anything_speed",
            "std" => "5",
            "type" => "text"
    ),

    array(  "name" => __("Slideshow description color?", $shortname),
            "desc" => __("This is the transparent color that will appear behind descriptions if you place them on a slide in the slideshow. This only applies if your slide is an \"Image Slide.\"", $shortname),
            "id" => $shortname."_anything_overlay_color",
            "std" => "000000",
            "type" => "color_picker"
    ),
    
    array(  "desc" => __("<h4>3D Slider</h4> <p>If you chose the \"3D Slider\" as your homepage slideshows to type above, here is where you configure that slider's options for the homepage.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Autoplay duration?", $shortname),
            "desc" => __("Enter the time you would like in between transitions in seconds.", $shortname),
            "id" => $shortname."_3d_speed",
            "std" => "5",
            "type" => "text"
    ),
    
    array(  "name" => __("Number of pieces?", $shortname),
            "desc" => __("This is the amount of pieces that the images will break into upon transitioning. Keep in mind that this theme is setup to compensate for a confined area. So, the more pieces your break the images into, the farther back the slideshow will go upon rotation.", $shortname),
            "id" => $shortname."_3d_pieces",
            "std" => "15",
            "type" => "text"
    ),
    
    array(  "name" => __("Transition speed?", $shortname),
            "desc" => __("Enter the amount of time in seconds you'd like for each transition to take place. This will effect the speed at which the pieces rotate.", $shortname),
            "id" => $shortname."_3d_time",
            "std" => "2",
            "type" => "text"
    ),
    
    array(  "name" => __("Description color?", $shortname),
            "desc" => __("This is the color that will appear behind descriptions if you place them on a slide in the slideshow. With the 3D slider, these descriptions show when you hit the \"info\" button when hovering over a slide that you've given a description.", $shortname),
            "id" => $shortname."_3d_color",
            "std" => "000000",
            "type" => "color_picker"
    ),
    
    array(  "desc" => __("<h4>Accordion Slider</h4> <p>If you chose the \"Accordion Slider\" as your homepage slideshows to type above, here is where you configure that slider's options for the homepage.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Number of slides?", $shortname),
            "desc" => __("It's important that this theme knows the correct number of slides in the accordion slideshow in order for the element widths to be calculated properly. Any excess slides beyond the amount you specify here will not be shown.", $shortname),
            "id" => $shortname."_accordion_num",
            "std" => "4",
            "type" => "select",
            "data" => array(

				array(
				    "name" => "2 Slides",
				    "value" => "2"
				),
				
				array(
				    "name" => "3 Slides",
				    "value" => "3"
				),
				
				array(
				    "name" => "4 Slides",
				    "value" => "4"
				),
				
				array(
				    "name" => "5 Slides",
				    "value" => "5"
				),
				
				array(
				    "name" => "6 Slides",
				    "value" => "6"
				),
                
            )
    ),
    
    array(  "name" => __("Stretch width?", $shortname),
            "desc" => __("This is the width in pixels of the slides when they are hovered over. The homepage slideshow is 940px, so you don't want to enter a number higher than 940.", $shortname),
            "id" => $shortname."_accordion_stretch_width",
            "std" => "800",
            "type" => "text"
    ),
    
    array(  "name" => __("Description color?", $shortname),
            "desc" => __("This is the transparent color that will appear behind descriptions if you place them on a slide in the slideshow.", $shortname),
            "id" => $shortname."_accordion_overlay_color",
            "std" => "000000",
            "type" => "color_picker"
    ),
    
    array(  "desc" => __("<h4>Nivo Slider</h4> <p>If you chose the \"Nivo Slider\" as your homepage slideshows to type above, here is where you configure that slider's options for the homepage.</p>", $shortname),
            "type" => "description"
    ),
    
    array(  "name" => __("Slideshow transition?", $shortname),
            "desc" => __("Here you can select how you want each slide to transition to the next.", $shortname),
            "id" => $shortname."_nivo_transition",
            "std" => "random",
            "type" => "select",
            "data" => array(

				array(
				    "name" => "sliceDown",
				    "value" => "sliceDown"
				),
				
				array(
				    "name" => "sliceDownLeft",
				    "value" => "sliceDownLeft"
				),
				
				array(
				    "name" => "sliceUp",
				    "value" => "sliceUp"
				),
				
				array(
				    "name" => "sliceUpLeft",
				    "value" => "sliceUpLeft"
				),
				
				array(
				    "name" => "sliceUpDown",
				    "value" => "sliceUpDown"
				),
				
				array(
				    "name" => "sliceUpDownLeft",
				    "value" => "sliceUpDownLeft"
				),
				
				array(
				    "name" => "fold",
				    "value" => "fold"
				),
				
				array(
				    "name" => "fade",
				    "value" => "fade"
				),
				
				array(
				    "name" => "random",
				    "value" => "random"
				),
				
				array(
				    "name" => "slideInRight",
				    "value" => "slideInRight"
				),
				
				array(
				    "name" => "slideInLeft",
				    "value" => "slideInLeft"
				)
                
            )
    ),

    array(  "name" => __("Autoplay duration?", $shortname),
            "desc" => __("Enter the time you would like in between transitions in seconds.", $shortname),
            "id" => $shortname."_nivo_speed",
            "std" => "5",
            "type" => "text"
    ),
    
    array(  "name" => __("Number of slices?", $shortname),
            "desc" => __("This is how many slices the images get chopped into when transitioning with Nivo's effects.", $shortname),
            "id" => $shortname."_nivo_slices",
            "std" => "15",
            "type" => "text"
    ),

    array(  "name" => __("Slideshow description color?", $shortname),
            "desc" => __("This is the transparent color that will appear behind descriptions if you place them on a slide in the slideshow.", $shortname),
            "id" => $shortname."_nivo_overlay_color",
            "std" => "000000",
            "type" => "color_picker"
    ),

    
    array(  "type" => "end"),

	
    //Portfolios
    array(  "type" => "start",
            "name" => __("Portfolios", $shortname),
            "id" => "portfolio",
            "icon" => "images"
    ),

    array(  "name" => __("Show the title at the top of each portfolio page?", $shortname),
            "option1" => __("Yes, show the title on portfolio pages.", $shortname),
            "option2" => __("No, hide the title.", $shortname),
            "desc" => __("This is the title for the entire portfolio page.", $shortname),
            "id" => $shortname."_portfolio_page_title",
            "std" => "true",
            "type" => "true_false_radio"
    ),
    
    array(  "name" => __("Show the description at the top of each portfolio page?", $shortname),
            "option1" => __("Yes, show the description on portfolio pages.", $shortname),
            "option2" => __("No, hide the description.", $shortname),
            "desc" => __("This is the title for the entire portfolio page.", $shortname),
            "id" => $shortname."_portfolio_page_description",
            "std" => "true",
            "type" => "true_false_radio"
    ),

    array(  "name" => __("How many items per page?", $shortname),
            "desc" => __("It is suggested that you use a number that's divisable by 3. (3, 6, 9, 12, etc.)", $shortname),
            "id" => $shortname."_items_per_page",
            "std" => "9",
            "type" => "text"
    ),

    array(  "name" => __("Portfolio item thumbnails link where?", $shortname),
            "option1" => __("Thumbnails link lightbox popup of your media item.", $shortname),
            "option2" => __("Thumbnails link to the portfolio item post.", $shortname),
            "desc" => __("If you select for your thumbnails to link directly to your posts, the media items you entered when creating your portfolio items will be completely ignored, as they're only meant to show in the lightbox popup.", $shortname),
            "id" => $shortname."_thumbnail",
            "std" => "true",
            "type" => "true_false_radio"
    ),

    array(  "name" => __("Show title with each item?", $shortname),
            "option1" => __("Yes, show titles.", $shortname),
            "option2" => __("No, don't show titles.", $shortname),
            "desc" => __("These are the titles of the blog entries you create for specific portfolio items.", $shortname),
            "id" => $shortname."_show_title",
            "std" => "true",
            "type" => "true_false_radio"
    ),

    array(  "name" => __("Show description with each item?", $shortname),
            "option1" => __("Yes, show descriptions.", $shortname),
            "option2" => __("No, don't show descriptions.", $shortname),
            "desc" => __("These are the excerpts of the blog entries you create for specific portfolio items.", $shortname),
            "id" => $shortname."_show_excerpt",
            "std" => "true",
            "type" => "true_false_radio"
    ),

    array(  "name" => __("Show \"read more\" link with each item?", $shortname),
            "option1" => __("Yes, show \"read more\" links.", $shortname),
            "option2" => __("No, don't show \"read more\" links.", $shortname),
            "desc" => __("These are links that say \"Read More\" and link to the blog post for each portfolio item.", $shortname),
            "id" => $shortname."_show_read_more",
            "std" => "true",
            "type" => "true_false_radio"
    ),

    array(  "name" => __("Media Player Color", $shortname),
            "desc" => __("This is the color you'd like to apply to your audio and video players for self-hosted media in your portfolios.", $shortname),
            "id" => $shortname."_media_color",
            "std" => "000000",
            "type" => "color_picker"
    ),

    array(  "name" => __("Video Player Logo URL", $shortname),
            "desc" => __("Enter the URL to the logo you'd like to show in the lower right corner of your self-hosted videos. Leave blank if you don't want one to show.", $shortname),
            "id" => $shortname."_video_logo",
            "std" => "",
            "type" => "text"
    ),

    array(  "name" => __("Video Player Logo Width", $shortname),
            "desc" => __("Enter the width of your logo used in the previous option.", $shortname),
            "id" => $shortname."_video_logo_width",
            "std" => "100",
            "type" => "text"
    ),

    array(  "name" => __("Video Player Logo Height", $shortname),
            "desc" => __("Enter the height of your logo used in the previous option.", $shortname),
            "id" => $shortname."_video_logo_height",
            "std" => "40",
            "type" => "text"
    ),

    array(  "type" => "end"),
    
    //Analytics
    array(  "type" => "start",
            "name" => "Analytics",
            "id" => "analytics",
            "icon" => "chart"
    ),

    array ( "type" => "description",
            "desc" => "Here you can enter in the Analytics Code given to you by your Analytics service provider. If you do not have one, <a href='http://google.com/analytics' target='_blank'>Google Analytics</a> is a good, free option for you. Whatever code you enter below will be inserted just before the closing &lt;/body&gt; tag of your website."
    ),

    array(  "name" => __("Analytics Code", $shortname),
            "desc" => __("Enter in your Analytics code to be inserted just before the closing &lt;/body&gt; tag of your website.", $shortname),
            "id" => $shortname."_analytics",
            "type" => "textarea",
            "std" => ""
    ),

    array(  "type" => "end" )
    	
);

##############################################################
# Information
##############################################################

$info = array(
    "pageTitle" => "Theme Options",
    "menuTitle" => "Theme Options",
    "pageLevel" => "parent",
    "pageSlug" => "theme-options",
    "linkSupport" => "http://themeforest.net/user/themeblvd",
    "linkSite" => "http://themeforest.net/user/themeblvd/portfolio",
    "linkAuthor" => "http://www.jasonbobich.com",
    "linkProfile" => "http://www.themeforest.net/user/themeblvd"
);

##############################################################
# Activate Options Page
##############################################################

$themeblvd_options_general = new themeblvd_options($info, $shortname, $themename, $options_general);

?>