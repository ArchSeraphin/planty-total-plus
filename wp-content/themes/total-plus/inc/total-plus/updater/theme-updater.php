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
    'theme-license' => __('Total Plus License', 'total-plus'),
    'description' => __('Enter your theme license key to get automatic updates of the theme. Check this <a href="https://hashthemes.com/articles/adding-license-key-and-updating-a-premium-theme/" target="_blank">Instruction</a>.', 'total-plus'),
    'enter-key' => __('Enter your theme license key.', 'total-plus'),
    'license-key' => __('License Key', 'total-plus'),
    'license-action' => __('License Action', 'total-plus'),
    'deactivate-license' => __('Deactivate License', 'total-plus'),
    'activate-license' => __('Activate License', 'total-plus'),
    'status-unknown' => __('License status is unknown.', 'total-plus'),
    'renew' => __('Renew?', 'total-plus'),
    'unlimited' => __('unlimited', 'total-plus'),
    'license-key-is-active' => __('License key is active.', 'total-plus'),
    /* translators: the license expiration date */
    'expires%s' => __('Expires %s.', 'total-plus'),
    'expires-never' => __('Lifetime License.', 'total-plus'),
    /* translators: 1. the number of sites activated 2. the total number of activations allowed. */
    '%1$s/%2$-sites' => __('You have %1$s / %2$s sites activated.', 'total-plus'),
    'activation-limit' => __('Your license key has reached its activation limit.', 'total-plus'),
    /* translators: the license expiration date */
    'license-key-expired-%s' => __('License key expired %s.', 'total-plus'),
    'license-key-expired' => __('License key has expired.', 'total-plus'),
    /* translators: the license expiration date */
    'license-expired-on' => __('Your license key expired on %s.', 'total-plus'),
    'license-keys-do-not-match' => __('License keys do not match.', 'total-plus'),
    'license-is-inactive' => __('License is inactive.', 'total-plus'),
    'license-key-is-disabled' => __('License key is disabled.', 'total-plus'),
    'license-key-invalid' => __('Invalid license.', 'total-plus'),
    'site-is-inactive' => __('Site is inactive.', 'total-plus'),
    /* translators: the theme name */
    'item-mismatch' => __('This appears to be an invalid license key for %s.', 'total-plus'),
    'license-status-unknown' => __('License status is unknown.', 'total-plus'),
    'update-notice' => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'total-plus'),
    'error-generic' => __('An error occurred, please try again.', 'total-plus'),
        )
);
