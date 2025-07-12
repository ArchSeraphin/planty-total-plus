<?php

/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */
// Includes the files needed for the theme updater
if (!class_exists('EDD_Theme_Updater_Admin')) {
    include dirname(__FILE__) . '/theme-updater-admin.php';
}

$theme = wp_get_theme('total-plus');
// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(
        // Config settings
        array(
    'remote_api_url' => 'https://hashthemes.com', // Site where EDD is hosted
    'item_name' => 'Total Plus', // Name of theme
    'theme_slug' => 'total-plus', // Theme slug
    'version' => $theme->get('Version'), // The current version of this theme
    'author' => 'HashThemes', // The author of this theme
    'download_id' => '', // Optional, used for generating a license renewal link
    'renew_url' => '', // Optional, allows for a custom license renewal link
    'beta' => false, // Optional, set to true to opt into beta versions
    'item_id' => '',
        ),
        // Strings
        array(
    'theme-license' => __('Total Plus License'),
    'description' => __('Enter your theme license key to get automatic updates of the theme. Check this <a href="https://hashthemes.com/articles/adding-license-key-and-updating-a-premium-theme/" target="_blank">Instruction</a>.'),
    'enter-key' => __('Enter your theme license key.'),
    'license-key' => __('License Key'),
    'license-action' => __('License Action'),
    'deactivate-license' => __('Deactivate License'),
    'activate-license' => __('Activate License'),
    'status-unknown' => __('License status is unknown.'),
    'renew' => __('Renew?'),
    'unlimited' => __('unlimited'),
    'license-key-is-active' => __('License key is active.'),
    /* translators: the license expiration date */
    'expires%s' => __('Expires %s.'),
    'expires-never' => __('Lifetime License.'),
    /* translators: 1. the number of sites activated 2. the total number of activations allowed. */
    '%1$s/%2$-sites' => __('You have %1$s / %2$s sites activated.'),
    'activation-limit' => __('Your license key has reached its activation limit.'),
    /* translators: the license expiration date */
    'license-key-expired-%s' => __('License key expired %s.'),
    'license-key-expired' => __('License key has expired.'),
    /* translators: the license expiration date */
    'license-expired-on' => __('Your license key expired on %s.'),
    'license-keys-do-not-match' => __('License keys do not match.'),
    'license-is-inactive' => __('License is inactive.'),
    'license-key-is-disabled' => __('License key is disabled.'),
    'license-key-invalid' => __('Invalid license.'),
    'site-is-inactive' => __('Site is inactive.'),
    /* translators: the theme name */
    'item-mismatch' => __('This appears to be an invalid license key for %s.'),
    'license-status-unknown' => __('License status is unknown.'),
    'update-notice' => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update."),
    'error-generic' => __('An error occurred, please try again.'),
        )
);
