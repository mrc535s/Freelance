*** This readme must accompany the Plugin at all times and not to be altered or changed in any way. ***

=== Wholesale Pricing for WP e-Commerce ===

Contributors: Michael Visser
Tags: e-commerce, shop, cart, ecommerce, wholesale pricing
Requires at least: 2.9.2
Tested up to: 3.3.2
Stable tag: 1.7.5

== Description ==

Add wholesale pricing controls to your WP e-Commerce store.

For more information visit: http://www.visser.com.au/wp-ecommerce/

== Installation ==

1. Upload the folder 'wp-e-commerce-wholesale-pricing' to the '/wp-content/plugins/' directory

2. Activate the plugin through the 'Plugins' menu in WordPress

== Usage ==

Wholesale Pricing for WP e-Commerce integrates with custom User Roles in WordPress, what this means is you can create custom User Roles with specific access outside the traditional WordPress User Roles (e.g. Subscriber, Author, Moderator, etc.).

I've had alot of success integrating custom User Role pricing within WP e-Commerce using the User Role Editor Plugin (http://wordpress.org/extend/plugins/user-role-editor/) from shinephp, available for download from WordPress.org. Hope this helps!

To configure default pricing rules:

==== In WP e-Commerce 3.7 ====

1. Open Store > Wholesale Pricing

==== In WP e-Commerce 3.8 ====

1. Open Settings > Wholesale Pricing

====

2. Set default pricing levels for Products which do not have their own per-Product pricing rules. If you do want to add default pricing levels leave this as default.

==== In WP e-Commerce 3.7 ====

3. Open Store > Products

==== In WP e-Commerce 3.7 ====

3. Open Products > Add/Edit Products

====

4. Open an individual Product and under the Wholesale Pricing widget select the individual Product's pricing levels. Do note that the fixed price rule will always override the %/$-based pricing rules so set one of the other, not both.

5. Click Update to save changes

6. Have fun!

== Sidenotes ==

==== Product visibility base on User Role ====

To add the show/hide Product visibility based on User Role.

1. Open your root web directory with your favourite file explorer or FTP manager (e.g. FileZilla)

====== In WP e-Commerce 3.7 ======

Depending on whether you are using the default WP e-Commerce template files (e.g. /wp-content/plugins/wp-e-commerce/themes/%current_theme%/...) or have copied them to the 'safe' WP e-Commerce directory within Uploads (e.g. /wp-content/uploads/themes/%current_theme%/...) do as follow.

2. Open 'products_page.php' and paste '<?php if( wpsc_wp_is_product_visible() ) : ?>' on line #82

3. Open 'single_product.php' and paste '<?php if( wpsc_wp_is_product_visible() ) : ?>' on line #26

====== In WP e-Commerce 3.8 ======

Depending on whether you are using the default WP e-Commerce template files (e.g. /wp-content/plugins/wp-e-commerce/wpsc-theme/...) or have copied them to your current WordPres Theme directory (e.g. /wp-content/themes/%current_theme%/...) do as follow.

2. Open 'wpsc-products_page.php'

2.1 Copy the following snippet and paste it below "<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>" on line #66

<?php if( wpsc_wp_is_product_visible() ) : ?>

2.2 Paste the following snippet and paste it above "<?php endwhile; ?>" on line #227

<?php endif; ?>

3. Open 'wpsc-single_product.php'

3.1 Copy the following snippet and paste it below "<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>" on line #30

<?php if( wpsc_wp_is_product_visible() ) : ?>

3.2 Copy the following snippet on paste it above "<?php endwhile; ?>" on line #214

<?php endif; ?>

======

4. Save changes and upload modified files

==== Original Price ====

Display the original Price before markup/markdown within your store with the following template tag (e.g. Original Price: $20.00).

Drop the following template tag into your Products Page and/or Single Product template, then save changes and upload modified files.

Original Price: <?php echo wpsc_wp_original_price(); ?>

==== You Save ====

Display the saving between standard Product price and the current User Role's markup/markdown (e.g. You Save: $5.00 (25.00%))

Drop the following template tag into your Products Page and/or Single Product template, then save changes and upload modified files.

You Save: <?php wpsc_wp_you_save( array( 'type' => 'amount' ) ); ?> (<?php wpsc_wp_you_save(); ?>)

=== User Role Price ===

Display the Price for a given User Role using the following template tag (e.g. Member's Price: $5.95).

Drop the following template tag into your Products Page and/or Single Product template, then save changes and upload modified files.

Member's Price: <?php wpsc_wp_role_price( 'subscriber' ); ?>

Replace 'subscriber' with the User Role 'slug', here's the default User Role slugs in WordPress.

- administrator
- editor
- author
- contributor
- subscriber
- guest

== Support ==

If you have any problems, questions or suggestions please join the members discussion on my WP e-Commerce dedicated forum.

http://www.visser.com.au/wp-ecommerce/forums/

== Changelog ==

= 1.7.5 =
* Fixed: Wholesale Pricing meta box not showing on New Product
* Added: Product Importer Deluxe integration

= 1.7.4 =
* Fixed: Unneccesary WP_DEBUG errors within WordPress Administration
* Added: wpsc_wp_user_role_price() for displaying Price for that User Role
* Fixed: Checkbox not displaying in Add/Edit Products
* Fixed: Special price wrong under WP e-Commerce 3.7
* Fixed: Settings not saving under Settings

= 1.7.3 =
* Changed: Using checked() and selected()
* Fixed: $0.00 price caused template error

= 1.7.2 =
* Added: Original Price and You Save template tags

= 1.7.1 =
* Fixed: WP e-Commerce Plugins widget markup

= 1.7 =
* Fixed: Styling issue within Plugins Dashboard widget

= 1.6.9 =
* Added: Alt. switch to wpsc_get_action()

= 1.6.8 =
* Fixed: Issue introduced with wpsc_get_action()

= 1.6.7 =
* Added: Automatic Plugin updates
* Fixed: First time activation not firing
* Fixed: Performance improvements for WP e-Commerce Plugins widget
* Fixed: No errors showing under WP_DEBUG
* Fixed: Performance improvements for WP e-Commerce Plugins widget

= 1.6.6 =
* Fixed: Updated readme to reflect 3.8.6; patch included in WP e-Commerce 3.8.7
* Changed: check if wpsc_wp_is_empty_fixed_price() is false

= 1.6.5 =
* Fixed: Issue affecting blank fixed prices overriding default pricing rules
* Added: Integrated Version Monitor into Plugin
* Fixed: Fixed price and visibility not saving under WP e-Commerce 3.7

= 1.6.4 =
* Added: Support for fixed price
* Changed: Line number references for changes to critical WP e-Commerce files

= 1.6.3 =
* Migrated Plugin prefix from 'vl_wpscwp' to 'wpsc_wp'

= 1.6.2 =
* Added: Mention of User Role Editor in the readme to assist store owners setting up custom User Roles in WordPress
* Added: Support for Product variations under WP e-Commerce 3.8 (3.7 support coming soon)
* Changed: Hide Wholesale Pricing widget from Add/Edit Products when viewing/editing a Product variation under WP e-Commerce 3.8
* Added: Wholesale Pricing support for 'Old price/special price' under WP e-Commerce 3.8
* Added: Wholesale Pricing support for 'You Save' under WP e-Commerce 3.8

= 1.6.1 =
* Added: Missing instructions for showing/hiding Products based on User Roles

= 1.6 =
* Added: Support for showing/hiding Products based on User Roles

= 1.5.1 =
* Fixed: Issue affecting WP e-Commerce 3.8.2 and above

= 1.5 =
* Added: Support for per-Product pricing overrides

= 1.4 =
* Added: Support for WP e-Commerce 3.8 Official

= 1.3.1 =
* Added: Urgent support for WP e-Commerce 3.8+

= 1.3 =
* Added: Support for percentage(%)/dollar-based($) markup/discount per User Role
* Added: Site Visitor (guest) User Role for increasing/decreasing site visitor pricing

= 1.2 =
* Added: Positive/negative markup controls for pricing per User Role

= 1.1 =
* Changed: Solution to WordPress Plugin with compatibility for WP e-Commerce 3.7

= 1.0 =
* Added: First working release of the modification

== Disclaimer ==

This Plugin does not claim to be a PCI-compliant solution. It is not responsible for any harm or wrong doing this Plugin may cause. Users are fully responsible for their own use. This Plugin is to be used WITHOUT warranty.