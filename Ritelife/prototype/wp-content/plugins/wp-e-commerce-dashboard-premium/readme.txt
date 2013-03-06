=== Plugin Name ===
Contributors: leewillis77
Tags: e-commerce, reporting, dashboard
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 4.9

== Frequently Asked Questions ==

= Can I remove the {XXXXXX} report from my dashboard? =

Yes. Just click on "Screen Options" on your dashboard, and unselect the report.

= The E-commerce Product Sales module only displays 5 item - where are the rest? =

Most of the modules only show 5 results by default to avoid clogging up the dashboard. If you want to change it , just click on the Configure link in the widget hearder. Alternatively, there's a WordPress filter that allows you to change it to whatever you want. So, just add something like this to your WordPress theme's functions.php file:

<code>function my-adjustment-to-product-sales($current_limit) {
	    return 999;
}
add_filter('ses_wpscd_product_sales_limit','my-adjustment-to-product-sales');</code>

There are similar filters for other modules, e.g.

"Orders to ship": ses_wpscd_orders_to_ship_limit
"Recent Orders": ses_wpscd_recent_orders_limit
"Recent Product Rating": ses_wpscd_recent_product_ratings_limit

== Changelog ==

= 4.9 = 
Fix problem with Items to Ship widget

= 4.8 =
Fix problems deleting schedules

= 4.7 =
Stock widget links to product edit page, not product on front-end
Add "Tracking ID" to the export

= 4.6 =
Custom date choice on CSV export
Allow external plugins to modify the export SQL

= 4.5 =
Allow multiple scheduled exports - each with their own config

= 4.1 =
Allow revenue and sales graph to have customised period, and granularity, and allow users to disable "pending" sales

= 4.0 = 
Major internal re-organisation.
Fix deleting of temporary cache files for scheduled exports

= 3.1 = 
Add filters to overwrite the export filename

= 3.0 =
Scheduled exports
Improvements to state handling for 3.7
Italian translation - thanks to Roberto Scano
No longer requires PHP GD/Freetype support

= 2.7 = 
Add .pot file and enable translations

= 2.6 = 
Add a total to product sales widget

= 2.5 = 
Addition of stock level widget

= 2.4.2 = 
Revised state handling - see http://code.google.com/p/wp-e-commerce/issues/detail?id=572

= 2.4.1 =
Improvements for variations in order line download

= 2.4 = 
Re-packaged

= 2.3 =
Add "Configure" link to widgets to allow control number of results shown
Make product list on CSV export allow multiple selections

= 2.2.2 =
Capability fixes for CSV export

= 2.2.1 =
Include ui.datepicker for users with capability view_store_reports as WPeC doesn't

= 2.2 =
Rename dashboard widgets
Make product names in widgets into links
Add support for personalisation field to CSV export
Display currency signs in dashboard widgets
Better support for purchase logs where products haven't been migrated
Fixes for incorrect purchase log statuses

= 2.1 = 
Tax fixes, add "billing state", and correct misnamed "Item Line Price" field

= 2.0 = 
Compatibility with WP e-Commerce 3.8
