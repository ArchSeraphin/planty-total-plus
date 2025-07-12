=== SiteOrigin Premium ===
Requires at least: 4.7
Tested up to: 6.8
Requires PHP: 7.0.0
Stable tag: 1.72.1
Build time: 2025-06-14T15:27:50+01:00
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

A collection of powerful addons that enhance every aspect of SiteOrigin plugins and themes.

== Description ==

SiteOrigin Premium is a collection of powerful addons that enhance Page Builder, Widgets Bundle, SiteOrigin CSS, and our WordPress themes. These addons improve existing features and add entirely new functionality. You'll love all the power they offer you.

We bundle every one of our addons into this single package, which means that as we introduce more addons, you get them free of charge for as long as you have an active license.

Most importantly, we also provide you with fast email support. Our email support is 30 times faster than the free support we offer on our forums. So you'll usually get a reply in just a few short hours.

== Installation ==

The SiteOrigin Premium plugin can be downloaded via the link provided in your order confirmation email. Please, note that the link is only valid for seven days. You can also log in to the [order dashboard](https://siteorigin.com/dashboard/) and download the SiteOrigin Premium plugin at any time. Once you've downloaded the plugin ZIP file, install it from Plugins > Add New > Upload Plugin. Once activated, go to SiteOrigin > Premium License within WordPress to activate your license. Your license key is provided in your order confirmation email.

[Complete installation instructions](https://siteorigin.com/premium-documentation/install-siteorigin-premium/) are available on SiteOrigin.com.

== Documentation ==

[Documentation](https://siteorigin.com/premium-documentation/) is available on SiteOrigin.com.

== Changelog ==

= 1.72.1 - 14 June 2025 =
* Custom Status Pages: Fixed font-family property and improved font-related property handling.
* Custom Status Pages: Fixed font size settings not working as expected and corrected font families having incorrect quotes.
* Custom Status Pages: Fixed page display type not rendering and resolved .entry-content styling issues.
* Custom Status Pages: Added output_font_family method and targeted common elements in content area to prevent theme conflicts.
* Custom Status Pages: Ensured font widget and styles are always set.
* Maintenance Mode: Delayed display until wp_loaded has triggered to prevent WooCommerce notice.
* Maintenance Mode: Added Show Settings on Activate support and changed certain defaults.
* Addons Page: Fixed Show Settings on Activate feature to open correct settings rather than all settings.
* General: Removed Support Team empty link and updated case.
* General: Added pre-commit setup with Lefthook and excluded node_modules from build.
* Installer: Changed WooCommerce screenshot URL.

= 1.72.0 - 21 May 2025 =
* New Addon! Maintenance Mode: Craft your own maintenance page with text or layout tools. Personalize with custom titles and design elements for a seamless user experience.
* CPTB: Added post settings support.
* 404 Page: Removed empty link on 404 page.
* Addons Page: Added method of opening settings on load.
* General: Updated maintenance mode indicator.
* General: Updated PHPCS standards.
* General: Updated menu icon CSS.
* Parallax: Fixed background image opacity not working.
* Utility: Fixed slide out in animations.

= 1.71.0 - 04 May 2025 =
* Embed Blocker: Added HTML Class block type and improved migration handling.
* Embed Blocker: Resolved URLs warning and added event trigger after unblock.
* Mirror Widgets: Updated menu icon and hid permalink.
* Toggle Visibility: Fixed user role default state.
* WooCommerce Template Builder: Fixed data tab array changes and vertically aligned action buttons.
* Addons Page: Ensured Widgets Bundle scripts are active and prevented potential fatals with null settings form.
* Cross Domain Copy Paste: Removed browser storage method.
* Custom Row Colors: Added minimum version requirement.
* General: Updated SiteOrigin menu icon and improved inline SVG icons.

= 1.70.2 - 15 April 2025 =
* Accordion: Fixed custom sized icon not outputting with correct sizes.
* Accordion Image: Added custom size inline using CSS and support for partial custom sizes.
* Accordion Image Icon: Restored custom class when size other than thumbnail was used.
* Cards Carousel: Corrected icon location and added new icon.
* CPTB: Added custom labels, removed SO page settings support from CPTB post type, and resolved E_ERROR related to post type supports setting.
* CTA: Fixed `Desktop Button Align: Center Bottom - Image: Right of Text`.
* Mirror Widget: Prevented potential shortcode overflow and added block icon.
* WFS: Improved search icon alignment and fixed SO CSS variant drop down.
* General: Resolved admin notices text domain notice.

= 1.70.1 - 20 March 2025 =
* Blog: Improved date format implementation and prevented false positive security flags.
* Call to Action: Improved image and button alignment for all layout positions.
* Card Carousel: Allow pagination dots to wrap over multiple lines and added date format options.
* Web Font Selector: Added new filter 'siteorigin_premium_modify_fonts'.
* Addons Page: Don't load settings form outside of form context.
* Utility: Added standardized date format options for use across addons.
* General: Updated Google Fonts list to the latest version.

= 1.70.0 - 24 February 2025 =
* Cards Carousel: Clear container gap for arrows when disabled, ensuring proper layout on per-device settings.
* Contact: Updated fields description with support for description improvements and add_custom_attr for backward compatibility.
* Contact Datetime: Added prefill date picker with current date setting.
* Map Styles: Fixed user location check by adding compatibility for the new advanced marker API while maintaining backward compatibility.
* Map Styles: Added Map ID setting. A Map ID allows you to manage your map styles using the Google Cloud Console. This is only used if Map Styles are not set.
* Recent Posts: Added Blog Widget checks to address an E_ERROR caused by a missing SiteOrigin_Widget_Blog_Widget (replicable by deactivating the SiteOrigin Blog Widget and navigating to * SiteOrigin > Premium Addons).
* Related Posts: Improved widget check to ensure expected functionality.
* General: Fixed case-sensitive addon search by converting search queries to lowercase.

= 1.69.0 – 04 February 2025 =
* Author Box: Prevent a potential error if the addon settings haven't been saved yet.
* Blog: Improved infinite pagination loader using the Intersection Observer API for more reliable post loading.
* Blog: Recent Posts now includes checks to ensure the Blog Widget is activated before loading.
* Cards Carousel: Added an Adaptive Height setting to allow item heights to adjust to content.
* Cards Carousel: Fixed a PHP warning related to undefined carousel_settings.
* Contact Form: Fixed Date Picker field alignment issues.
* Contact Form: Added standard form spacing to maps to prevent elements from appearing too close.
* Contact Form: Fixed submission issues with multiple location fields and improved scroll behavior.
* Contact Form: Added a setting to prefill the Date Picker with the current date.
* Cross Domain Copy Paste: Resolved Customizer accordion sizing issues caused by Cross Domain Copy Paste.
* Map Styles: Resolved a warning related to an undefined image_fallback array key.

= 1.68.1 - 23 December 2024 =
* Cards Carousel: Fixed Ajax instance loading to ensure consistent template rendering.
* Image Shape: Resolved warning related to loading shapes.
* Mirror Widgets: Added an additional check to ensure the widget is active and removed the Widgets Bundle requirement.
* Tabs: Update to ensure Layout Builder Full Width Stretched rows are sized correctly.
* Toggle Visibility: Improved exempt role handling.
* WooCommerce Template Builder: Update to ensure Page Builder CSS is output.
* WooCommerce Template Builder: Improved cart responsiveness after removing all products.
* WooCommerce Template Builder: Added Before/After Archive Template widget area action hooks.
* WooCommerce Template Builder: Added .woocommerce wrapper to all templates.
* Metabox: Resolved potential JavaScript TypeError in console.

= 1.68.0 - 24 November 2024 =
* Carousel: Updates to ensure correct Block Editor asset loading.
* Toggle Visibility: Added visibility by user role.
* Tooltip: Update to prevent possible warning.
* Video Background: Update to ensure assets are loaded only as required.
* WooCommerce Template Builder: Resolved Cart Template output when the Cart Block is use.
* Metabox: Allowed central page metabox to be collapsible.
* Updated Google Fonts list.

= 1.67.2 - 24 March 2025 =
* Blog: Improved date format implementation and prevented false positive security flags.
* Call to Action: Improved image and button alignment for all layout positions.
* Card Carousel: Allow pagination dots to wrap over multiple lines and added date format options.
* Web Font Selector: Added new filter 'siteorigin_premium_modify_fonts'.
* Addons Page: Don't load settings form outside of form context.
* Utility: Added standardized date format options for use across addons.
* General: Updated Google Fonts list to the latest version.

= 1.67.1 - 12 November 2024 =
* Announcing the SiteOrigin Cards Carousel Widget! Display posts in a sleek carousel with modern, elevated card layouts. Features clean typography and flexible meta display options.
* Carousel: Added a check to ensure the Post Carousel Widget is activated before adding the Overlay or Card Carousels.

= 1.67.0 - 11 November 2024 =
* 404 Page: Removed duplicate padding setting.
* Anchor ID: Added Unicode encoding support to prevent formatting issues.
* Carousel: Reduced the Overlay Theme post title line height.
* Contact Form: Improved autoresponder automatic line breaks and sanitized output.
* Logo Booster: Various fixes and improvements.
* WooCommerce Template Builder: Improved handling of removed Product Archive Templates.
* Fixed potential undefined array key "types" warning.
* Added check for SiteOrigin Widgets Bundle dependency.

= 1.66.1 - 24 September 2024 =
* Logo Booster: Added `custom-logo-link` class to logo links.
* 404 Page: Removed the Design settings section is Content Type is set to Page.

= 1.66.0 - 06 September 2024 =
* Embed Blocker: Removed privacy link HTML if a link is present.
* Toggle Visibility: Added Hide When Logged In page visibility option.
* Tooltip: Improved Button support.
* Tooltip: Resolved a potential error if at least one widget type wasn't enabled.
* WooCommerce Template Builder: Resolved a potential `post_content` warning.
* Updated Google Fonts list.
* Plugin Updater: Improved multi-site caching behavior.

= 1.65.0 - 16 August 2024 =
* Social Widgets: Restored existing image icon functionality.
* WooCommerce Template Builder: Added a Single template shortcode insertion option. Insert Single template designs anywhere with ease.
* Updated warning message for addons requiring Page Builder.
* Updater: Cleared cache after an update has been processed.

= 1.64.1 - 08 August 2024 =
* Anchor ID: Fixed Anchor ID `Maximum Number of Simultaneous Open Panels` behavior.
* Anchor ID: Improved Accordion and Tab on load scroll.
* Related Posts: Optimized and improve taxonomy handling.
* WooCommerce Template Builder: Prevented a potential Cart PHP 8 error.

= 1.64.0 - 26 July 2024 =
* Anchor ID: Added repeated hash prevention to the Anything Carousel, Sliders, and Tabs Widget.* Block Animations: Resolved a potential `TypeError` and accounted for elements not setup/loaded.
* WooCommerce Template Builder: Moved After Archive output below pagination.
* WooCommerce Template Builder: Added compatibility for the `TP Product Image Flipper for WC` plugin.
* WooCommerce Template Builder: Added `so_woocommerce_templates_display_before/after_archive` filters.

= 1.63.1 - 22 June 2024 =
* Anchor ID: Improved Anything Carousel performance.
* 404 Page: Restored theme page settings for the Display > Page option.

= 1.63.0 - 17 June 2024 =
* New Addon! 404 Page: Create custom 404 error pages with personalized design and content. Guide your user's website experience even during misdirections.
* Anchor ID: Improved functionality with hash change, Accordion, Tab, and scroll fixes, better placement and loading.
* Author Box: Added `Margin Top` setting to the built-in Recent Posts Widget.
* Block Animations: Added min/max as required to prevent a possible console error.
* Toggle Visibility: Resolved Yoast Open Graph conflict with metabox content block.
* Updated Google Fonts.
* Updated SiteOrigin Installer.

= 1.62.1 - 26 May 2024 =
* Anchor ID: Update to allow for an empty Accordion and Tabs ID field. An ID is recommended.
* Block Animations: Resolved potential TypeError.
* Toggle Visibility: Added `siteorigin_premium_toggle_visibility_metabox_block_message` to adjust logged out message.
* Resolved potential blank addon settings modal.
* Prevented auto-updates if disabled.

= 1.62.0 - 19 May 2024 =
* New Addon! Enhance contact form security with the Cloudflare Turnstile Addon, a user-friendly CAPTCHA alternative that helps prevent spam while maintaining seamless user interaction.
* Anchor ID: Fixed ID detection.
* Author Box: Minor spacing and layout improvements.
* Post Carousel: Added title tag to the link overlay.
* Social Media Buttons: Added a fallback if Network Name field is empty.
* Toggle Visibility: Resolved potential PHP warning.
* WooCommerce Template Builder: Removed Shop Product Loop widget from Product Archive tab.
* Increased required PHP version to PHP 7.

[View full changelog.](/wp-content/plugins/siteorigin-premium/changelog.txt)
