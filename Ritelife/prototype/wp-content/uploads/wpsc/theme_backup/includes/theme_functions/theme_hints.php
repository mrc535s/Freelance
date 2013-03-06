<?php
/**
 *
 * Alyeska WordPress Theme
 * Theme Hints
 *
 * Declare theme hints to be used by
 * framework function themeblvd_theme_hints().
 *
 * @author  Jason Bobich
 *
 */

$theme_hints = array(

    //Main Blog Sidebar (widget area)
    'blog-sidebar' => array(

        'hint' => __('This is a dynamic widget area named "Blog Sidebar." You can add and edit widgets in this area from your WP admin panel. This sidebar appears on all blog-related pages. Also, from your Theme Options page, you can select whether you want this sidebar to appear on the left or right side of the page.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'widgets.php',
                'name' => 'Widgets'
            ),
            array(
                'link' => 'admin.php?page=themeblvd',
                'name' => 'Theme Options'
            )

        )

    ),

    //Main Page Sidebar (widget area)
    'page-sidebar' => array(

        'hint' => __('This is a dynamic widget area named "Pages Sidebar." You can add and edit widgets in this area from your WP admin panel. This sidebar appears on all "Pages" that aren\'t blog-related. Also, from your Theme Options page, you can select whether you want this sidebar to appear on the left or right side of the page.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'widgets.php',
                'name' => 'Widgets'
            ),
            array(
                'link' => 'admin.php?page=themeblvd',
                'name' => 'Theme Options'
            )

        )

    ),

    //Archive.php
    'archive' => array(

        'hint' => __('This is a standard WordPress archive template. It\'s used to display posts filtered by category, tag, date, etc. It\'s controlled by archive.php.', 'themeblvd'),

    ),

    //Comments.php
    'comments' => array(

        'hint' => __('This is the template for displaying comments. It\'s controlled with comments.php. Also, you can adjust your comment settings from your WordPress admin panel.', 'themeblvd'),
        
        'admin' => array(
            
            array(
                'link' => 'options-discussion.php',
                'name' => 'Comment Settings'
            )

        )

    ),

    //Global Header
    'header' => array(

        'hint' => __('This is your global header, which is controlled by header.php. Your logo and the contact buttons can be configured from your Theme Options page. Also, below is your main menu that you need to dynamically build from your WordPress Menu Builder. You then assign it to the "Primary Navigation" menu location in order for it to show in the position of your main menu in this theme.', 'themeblvd'),
        'admin' => array(
            
            array(
                'link' => 'admin.php?page=themeblvd',
                'name' => 'Theme Options'
            ),
            array(
                'link' => 'nav-menus.php',
                'name' => 'Menu Builder'
            )

        )

    ),

    //Global Footer
    'footer' => array(

        'hint' => __('This is your global footer. It\'s controlled with footer.php. This area has a different widget area for each column. Depending on how many columns you have selected to show on your Theme Options page, will determine how many "Footer Column" widget areas show on your Widgets page. Your copyright message can be dynamically set by going to your theme options page and going to "General Options." You can insert a menu in the lower right corner by going to your Menu Builder, creating a new menu, and assigning it to the "Footer Navigation" menu location.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'widgets.php',
                'name' => 'Widgets'
            ),
            array(
                'link' => 'admin.php?page=themeblvd',
                'name' => 'Theme Options'
            ),
            array(
                'link' => 'nav-menus.php',
                'name' => 'Menu Builder'
            )

        )

    ),

    //Default Homepage
    'index' => array(

        'hint' => __('
        
        <p>This is your default homepage, which is controlled by index.php. There are many options you can set for your homepage from your theme options page. So, make sure and explore those and customize this page to look the way you want.</p>
        
        <p>The homepage consists of 6 available items that you can move around, show, and hide. These items include:</p>

		<ol>
			<li><strong>Slideshow</strong>
				<p>Slides are a custom post type that you can then group respecitvely into Slideshows. You can choose between four different slideshow plugins with this theme.</p>
			</li>
			<li><strong>Slogan</strong>
				<p>The slogan is a string of text that gets displayed with a shadow beneath.</p>
			</li>
			<li><strong>Widget Columns</strong><br />
				<p>The widget colums consist of a separate widgetized area for each for each column. You can select 0-4 columns to be displayed.</p>
			</li>
			<li><strong>Page Content</strong><br />
				<p>This section will pull whatever content from a page that you like. This does not include any page templates or sidebars, but just the content from the page itself.</p>
			</li>
			<li><strong>Portfolio Items</strong><br />
				<p>Portfolio Items are a custom post type that you can then group respecitvely into Portfolios. You can show however many portfolio items as you want here.</p>
			</li>
			<li><strong>Blog + Sidebar</strong><br />
				<p>The homepage blog takes on a similar style as the Blog Style #1 page template.</p>
			</li>
		</ol>', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'admin.php?page=themeblvd',
                'name' => 'Theme Options'
            ),
            array(
                'link' => 'edit.php?post_type=slide',
                'name' => 'Manage Slides'
            ),
            array(
                'link' => 'post-new.php?post_type=slide',
                'name' => 'Add Slide'
            ),
            array(
                'link' => 'edit-tags.php?taxonomy=slideshows&post_type=slide',
                'name' => 'Categorize into Slideshows'
            ),
            array(
                'link' => 'edit.php?post_type=portfolio-item',
                'name' => 'Manage Portfolio Items'
            ),
            array(
                'link' => 'post-new.php?post_type=portfolio-item',
                'name' => 'Add Portfolio Item'
            ),
            array(
                'link' => 'edit-tags.php?taxonomy=portfolio&post_type=portfolio-item',
                'name' => 'Categorize into Portfolios'
            )
            
        )

    ),

    //Pages
    'page' => array(

        'hint' => __('This is a standard WordPress page that\'s using the default page template. You can edit its format in page.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            )

        )

    ),

    //Pages - Archives
    'page-archives' => array(

        'hint' => __('This is a standard WordPress page using the page template "Archives." It simply displays links to all of your archived content. This is a good page template to use for SEO reasons. It\'s format is controlled with template_archives.php', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            )

        )

    ),

    //Pages - Blog
    'page-blog' => array(

        'hint' => __('This is a standard WordPress page using the page template "Blog Style #1" and the format of this page template is controlled with template_blog_1.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            ),
            array(
                'link' => 'admin.php?page=themeblvd-templates',
                'name' => 'Page Templates Settings'
            )

        )

    ),
    
    //Pages - Blog
    'page-blog2' => array(

        'hint' => __('This is a standard WordPress page using the page template "Blog Style #2" and the format of this page template is controlled with template_blog_1.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            ),
            array(
                'link' => 'admin.php?page=themeblvd-templates',
                'name' => 'Page Templates Settings'
            )

        )

    ),

    //Pages - Contact
    'page-contact' => array(

        'hint' => __('This is the Contact page template. You can add fields to it from your template settings page, or you can manually edit the HTML in template_contact.php. The contact form uses sendmail.php to send the email. However, you shouldn\'t need to edit this file. Any manually edited fields added to template_contact.php will be picked up by sendmail.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            ),
            array(
                'link' => 'admin.php?page=themeblvd-templates',
                'name' => 'Page Templates Settings'
            )

        )

    ),

    //Pages - Full Width
    'page-full-width' => array(

        'hint' => __('This is a page using the page template "Full Width Page." You can edit its format in template_fullwidth.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            )

        )

    ),

    //Pages - Archives
    'page-sitemap' => array(

        'hint' => __('This is a standard WordPress page using the page template "Sitemap." It simply displays links to important areas of your site. This is a good page template to use for SEO reasons. It\'s format is controlled with template_sitemap.php', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=page',
                'name' => 'Edit Pages'
            ),
            array(
                'link' => 'post-new.php?post_type=page',
                'name' => 'Add Page'
            )

        )

    ),

    //Single Blog Posts
    'single' => array(

        'hint' => __('This is a standard WordPress post. You can edit its format in single.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=post',
                'name' => 'Edit Posts'
            ),
            array(
                'link' => 'post-new.php?post_type=post',
                'name' => 'Add Post'
            )

        )

    ),

    //Search Results
    'search' => array(

        'hint' => __('This is a standard WordPress search results page. You can edit its format in search.php.', 'themeblvd'),
        
    ),

    //Slideshow
    'slideshow' => array(

        'hint' => __('This is a slideshow using the jQuery plugin, Cycle. In this theme, the individual images or chunks of content are referred to as "Slides" and if you\'re using multiple slideshows throughout your website, you can categorize "Slides" into "Slideshows" -- If you do this, you can select which "Slideshow" will actually show in different areas of your website from your theme option pages.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=slide',
                'name' => 'Manage Slides'
            ),
            array(
                'link' => 'post-new.php?post_type=slide',
                'name' => 'Add Slide'
            ),
            array(
                'link' => 'edit-tags.php?taxonomy=slideshows&post_type=slide',
                'name' => 'Categorize into Slideshows'
            ),
            array(
                'link' => 'admin.php?page=themeblvd',
                'name' => 'Theme Options'
            ),
            array(
                'link' => 'admin.php?page=themeblvd-templates',
                'name' => 'Page Templates Settings'
            )

        )

    ),

    //Portfolio (taxonomy)
    'portfolio' => array(

        'hint' => __('This is the display of a group of "Portfolio Items" and you can edit its format in taxonomy.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=portfolio-item',
                'name' => 'Edit Portfolio Items'
            ),
            array(
                'link' => 'post-new.php?post_type=portfolio-item',
                'name' => 'Add Portfolio Item'
            ),
            array(
                'link' => 'edit-tags.php?taxonomy=portfolio&post_type=portfolio-item',
                'name' => 'Manage Portfolios'
            )

        )

    ),

	//Portfolio (single)
    'portfolio-single' => array(

        'hint' => __('This is the display of single "Portfolio Item" and you can edit its format in single-portfolio-item.php.', 'themeblvd'),
        'admin' => array(

            array(
                'link' => 'edit.php?post_type=portfolio-item',
                'name' => 'Edit Portfolio Items'
            ),
            array(
                'link' => 'post-new.php?post_type=portfolio-item',
                'name' => 'Add Portfolio Item'
            ),
            array(
                'link' => 'edit-tags.php?taxonomy=portfolio&post_type=portfolio-item',
                'name' => 'Manage Portfolios'
            )

        )

    ),

);
?>