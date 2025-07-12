<?php

if (!defined('WPINC')) {
    die;
}

define('SYSTEM_STATUS_DIRECTORY', trailingslashit(str_replace('\\', '/', dirname(__FILE__))));
define('SYSTEM_STATUS_DIRECTORY_URI', site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', SYSTEM_STATUS_DIRECTORY)));

require SYSTEM_STATUS_DIRECTORY . 'class/class-admin-system-status.php';
require SYSTEM_STATUS_DIRECTORY . 'class/class-admin-system-status-report.php';
require SYSTEM_STATUS_DIRECTORY . 'class/class-admin-tgm-plugin.php';

function total_plus_system_report_scripts() {
    wp_enqueue_style('system-status-style', SYSTEM_STATUS_DIRECTORY_URI . 'assets/system-status.css', array(), TOTAL_PLUS_VERSION);
}

add_action('admin_enqueue_scripts', 'total_plus_system_report_scripts');

function total_plus_register_system_status_page() {
    add_submenu_page('total-plus', esc_html__('System Status', 'total-plus'), esc_html__('System Status', 'total-plus'), 'manage_options', 'total-plus-system-status', 'total_plus_system_status_callback');
}

add_action('admin_menu', 'total_plus_register_system_status_page');

/**
 * Display callback for the submenu page.
 */
function total_plus_system_status_callback() {
    require SYSTEM_STATUS_DIRECTORY . 'system-status-template.php';
}

if (!function_exists('total_plus_admin_system_status')) {

    function total_plus_admin_system_status() {
        return Total_PLus_System_Status::obtain();
    }

}


if (!function_exists('total_plus_admin_system_status_report')) {

    function total_plus_admin_system_status_report() {
        return Total_PLus_System_Status_Report::obtain();
    }

}


if (!function_exists('total_plus_admin_export_system_status_report_download')) {
    add_action('admin_menu', 'total_plus_admin_export_system_status_report_download', 20);

    function total_plus_admin_export_system_status_report_download() {
        if (isset($_POST['total-plus-system-status-report-download']) && ( true === total_plus_bool($_POST['total-plus-system-status-report-download']) )) {
            check_admin_referer('total-plus-system-status-report-download');

            // Initialize the System Status Report handler.
            $system_status_report = total_plus_admin_system_status_report();

            // Export a full report in JSON format.
            $system_status_report->export_json_report();
        }
    }

}


if (!function_exists('total_plus_bool')) {

    function total_plus_bool($value = false) {

        if (is_string($value)) {

            if ($value && ( 'false' !== strtolower($value) )) {
                return true;
            } else {
                return false;
            }
        } else {

            return ( $value ? true : false );
        }
    }

}


if (!function_exists('total_plus_uasort_plugins')) {

    function total_plus_uasort_plugins($a, $b) {
        return strcmp($a['name'], $b['name']);
    }

}