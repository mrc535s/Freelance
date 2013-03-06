=== Advanced Access Manager ===
Contributors: vasyl_m, haeckdesign
Donate link: http://whimba.org/donation
Tags: access manager, access control, comments, capability, dashboard widget, expire, expire link, filter menu, page, post, metabox, role manager, user access, user control, user role, access configuration
Requires at least: 3.2
Tested up to: 3.4.1
Stable tag: 1.6.8

Graphic interface to manage User Access to your Front-end and Back-end

== Description ==

Advanced Access Manager is very powerful and flexible Access Control tool for
your WordPress website. It supports Single WordPress installation and Multisite
setup.
This is the basic list of features you can perform this AAM:

* Filter Admin Menu
* Filter Admin Panel
* Filter Dashboard Widgets
* Filter Metaboxes
* Manage Comments
* Manage Capabilities (Create, Delete)
* Manage User Roles (Create, Edit, Delete)
* Manage Access to your Posts, Pages or even Custom Post Types
* Give possibility to promote Users
* Manage Admin Menu Order
* Manage other Administrators
* Exclude Front-end Pages from Navigation

And many-many other features.

[youtube http://www.youtube.com/watch?v=zkyxply_JHs]

If you have any problems with current plugin, please send me an email or leave a
message on Forums Posts.


== Installation ==

1. Upload `advanced-access-manager` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Find Access Manager under AWM Group Menu

== Frequently Asked Questions ==

= How can I give access for other Administrators to Advanced Access Manager? =

If you are Super Admin, you can manage the Administrator's Role as other User
Roles. To give an access to Access Manager's Option Page, just create a new
capability <b>AAM Manage</b> and check it for Administrator's User Role.

= My users are not able to edit permalink. What should I do? =

Release 1.6.5 introduced a custom Capability "Edit Permalink". Make sure that
User or User Role has this Capability checked under Capabilities Tab.

= What is "Initiate URL" button, under "Metaboxes & Widgets" Tab? =

Sometimes list of additional metaboxes is conditional on edit post page. Like e.g.
display custom metabox "Photos" only if Post Status is Published. Access Manager
initiates the list of metaboxes for each post in default status ("auto-draft").
That is why you have to manually initialize the URL to the edit post page where
the list of additional metaboxes can be picked by AAM.

= How can I delete created Capability? =

You have to configure Advanced Access Manager behavior with ConfigPress. For more
information please follow the <a href="http://whimba.org/forum/viewtopic.php?f=4&t=2#p2">link</a>

= I unchecked some Menus on "Main Menu" Tab but they are still not shown. Why? =

The reason is that "Main Menu" Tab is not directly related to list of Capabilities.
It means, if you selected/deselected some Menu or Submenu it will not add or delete
correct capabilities for current User Role. In such way if you want to give somebody
access to backend I recommend to use predefined set of options "Editor" and then
just filter Main Menu.


== Screenshots ==

1. General view of Access Manager
2. List of Metaboxes to Manage
3. List of Capabilities
4. Post/Page Tree View
5. ConfigPress

== Changelog ==

= 1.6.8 =
* Extended ConfigPress
* New view
* Updated ConfigPress Reference Guide

= 1.6.7.5 =
* Implemented alternative way of Premium Upgrade
* Extended ConfigPress

= 1.6.7 =
* New design

= 1.6.6 =
* Bug fixing
* Maintenance work
* Added Multisite importing feature

= 1.6.5.2 =
* Updated jQuery UI lib to 1.8.20
* Minimized JavaScript
* Implemented Web Service for AWM Group page
* Implemented Web Service for Premium Version
* Fixed bug with User Restrictions
* Fixed bug with Edit Permalink
* Fixed bug with Upgrade Hook
* Reorganized Label Module (Preparing for Russian and Polish transactions)

= 1.6.5.1 (Beta) =
* Bug fixing
* Removed custom error handler

= 1.6.5 =
* Turn off error reporting by default
* More advanced Post/Taxonomy access control
* Added Refresh feature for Post/Taxonomy Tree
* Added Custom Capability Edit Permalink
* Filtering Post's Quick Menu
* Refactored JavaScript

= 1.6.3 =
* Added more advanced possibility to manage comments
* Change Capabilities view
* Added additional checking for plugin's reliability

= 1.6.2 =
* Few GUI changes
* Added ConfigPress reference guide
* Introduced Extended version
* Fixed bug with UI menu ordering
* Fixed bug with ConfigPress caching
* Fixed bugs in filtermetabox class
* Fixed bug with confirmation message in Multisite Setup

= 1.6.1.3 =
* Fixed issue with menu

= 1.6.1.2 =
* Resolved issue with chmod
* Fixed issue with clearing config.ini during upgrade

= 1.6.1.1 =
* Fixed 2 bugs reported by jimaek

= 1.6.1 =
* Silenced few warnings in Access Control Class
* Extended description to Manually Metabox Init feature
* Added possibility to filter Frontend Widgets
* Refactored the Option Page manager
* Added About page

= 1.6 =
* Fixed bug for post__not_in
* Fixed bug with Admin Panel filtering
* Added Restore Default button
* Added Social and Support links
* Modified Error Handling feature
* Modified Config Press Handling

= 1.5.8 =
* Fixed bug with categories
* Addedd delete_capabilities parameter to Config Press

= 1.5.7 =
* Bug fixing
* Introduced error handling
* Added internal .htaccess

= 1.5.6 =
* Introduced _Visitor User Role
* Fixed few core bugs
* Implemented caching system
* Improved API

= 1.5.5 =
* Performed code refactoring
* Added Access Config
* Added User Managing feature
* Fixed bugs related to WP 3.3.x releases

= 1.4.3 =
* Emergency bug fixing

= 1.4.2 =
* Fixed cURL bug

= 1.4.1 =
* Fixed some bugs with checking algorithm
* Maintained the code

= 1.4 =
* Added Multi-Site Support
* Added Multi-Language Support
* Improved checking algorithm
* Improved Super Admin functionality

= 1.3.1 =
* Improved Super Admin functionality
* Optimized main class
* Improved Checking algorithm
* Added ability to change User Role's Label
* Added ability to Exclude Pages from Navigation
* Added ability to spread Post/Category Restriction Options to all User Roles
* Sorted List of Capabilities Alphabetically

= 1.3 =
* Change some interface button to WordPress default
* Deleted General Info metabox
* Improved check Access algorithm for compatibility with non standard links
* Split restriction on Front-end and Back-end
* Added Page Menu Filtering
* Added Admin Top Menu Filtering
* Added Import/Export Configuration functionality

= 1.2.1 =
* Fixed issue with propAttr jQuery IU incompatibility
* Added filters for checkAccess and compareMenu results

= 1.2 =
* Fixed some notice messages reported by llucax
* Added ability to sort Admin Menu
* Added ability to filter Posts, Categories and Pages

= 1.0 =
* Fixed issue with comment editing
* Implemented JavaScript error catching

= 0.9.8 =
* Added ability to add or remove Capabilities
* Fixed bug with network admin dashboard
* Fixed bug with Metabox initialization
* Fixed bug with whole branch checkbox if menu name has incompatible symbols for element's attribute ID
* Changed metabox list view
* Auto hide/show "Restore Default" link according to current User Role
* Optimized JavaScript and CSS
* Deleted Empty submenu holder. For example - Comments
* Changed bothering tooltip behavior
* Fixed bug with General metabox on Access Manager Option page
* Changed some labels
* Added auto-hide for message Options Updated after 10 sec

= 0.9.7 =
* Added Dashboard Widget Filtering functionality

= 0.9.6 =
* Fixed bug with Metabox initialization if installed plugin executes wp_remove_metabox function

= 0.9.5 =
* Added pre-defined set of capabilities - Administrator, Editor, Author, Contributor, Subscriber and Clear All
* Fixed bug with submenu rendered as custom WP page, for example themes.php?page=theme_options
* Fixed bug with Add New Post submenu. If it was selected then no edit.php page was accessible.

= 0.9.0 =
* Added Restore Default Settings functionality
* Fixed bug with Whole Branch checkbox
* Put tooltip on the center right position instead of center top
* Added activation and deactivation hooks
* Changed Tab Order on Role Manager Section
* Implemented on unsaved page leaving notification

= 0.8.1 =
* Fixed issue with edit.php
* Added to support box my twitter account

= 0.8 =
* First version