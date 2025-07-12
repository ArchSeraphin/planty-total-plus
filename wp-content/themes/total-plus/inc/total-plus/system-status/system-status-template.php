<?php
/*
 * Credit: NiceThemes<http://nicethemes.com/>
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtain the system status handler.
 */
$system_status = total_plus_admin_system_status();
?>

<div class="wrap system-status-wrap">

    <h1><?php _e('System Status', 'total-plus'); ?></h1>
    <div class="notice-warning notice total-plus-system-status-notice">
        <p><?php _e('This page shows the full system status report of your WordPress and Server. Please make sure that there is no <span style="color:#F00">red text</span> inorder for the demo import to work properly. If there is any <span style="color:#F00">red indication</span> then please contact your hosting provider and ask them to increase the red indicated parameters to their recommended values.', 'total-plus'); ?></p>
        <p><?php _e('NOTE: The recommended values are required only for the <strong>demo import</strong> to work properly. The website may run properly despite not having the recommended values.', 'total-plus'); ?></p>
    </div>

    <div class="total-plus-system-status-report">
        <p><?php esc_html_e('Click the button to generate and download a full report. Attach the file when ever you contact us for support.', 'total-plus'); ?></p>

        <form method="post" action="">
            <?php wp_nonce_field('total-plus-system-status-report-download'); ?>
            <input type="hidden" name="total-plus-system-status-report-download" value="1" />
            <input type="submit" class="button-primary" value="<?php esc_attr_e('Get System Status Report', 'total-plus'); ?>" />
        </form>
    </div>


    <div class="total-plus-system-status">

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('WordPress', 'total-plus'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Home URL:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__("The URL of the site's homepage.", 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_url($system_status->get_home_url()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Site URL:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The root URL of the site.', 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_url($system_status->get_site_url()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i></a><span><?php echo esc_attr__('The version of WordPress installed on the site.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_wp_version() < $system_status->get_required_wp_version() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_wp_version()); ?>
                        <?php if ($system_status->get_wp_version() < $system_status->get_recommended_wp_version()) : ?>
                            <br /><?php printf(esc_html__('Recommended version: %s or higher.', 'total-plus'), esc_attr($system_status->get_recommended_wp_version())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Multisite:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether or not is WordPress Multisite enabled.', 'total-plus'); ?></span></td>
                    <td class="description"><span class="choice"><?php echo $system_status->is_wp_multisite() ? '&#x2713;' : '&#x2717;'; ?></span></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Memory Limit:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The maximum amount of memory (RAM) that the site can use at one time.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_wp_memory_limit() < $system_status->get_recommended_wp_memory_limit() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_formatted_wp_memory_limit()); ?>
                        <?php if ($system_status->get_wp_memory_limit() < $system_status->get_recommended_wp_memory_limit()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'total-plus'), esc_attr($system_status->get_formatted_recommended_wp_memory_limit())); ?> <a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank"><?php esc_html_e('Please increase it', 'total-plus'); ?></a>.
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Maximum Upload File Size:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The largest file size that can be uploaded to this WordPress installation.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_wp_max_upload_size() < $system_status->get_recommended_wp_max_upload_size() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_formatted_wp_max_upload_size()); ?>
                        <?php if ($system_status->get_wp_max_upload_size() < $system_status->get_recommended_wp_max_upload_size()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'total-plus'), esc_attr($system_status->get_formatted_recommended_wp_max_upload_size())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Allowed File Extensions:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The file extensions the current user can upload to this WordPress installation.', 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_html(implode(', ', $system_status->get_wp_file_extensions())); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Language:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The language currently used by WordPress.', 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_wp_locale()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Upload Directory:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether or not your upload directory is writable.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->is_wp_uploads_dir_writable() ? 'right' : 'wrong' ); ?>"><?php echo $system_status->is_wp_uploads_dir_writable() ? esc_html__('Writable', 'total-plus') : esc_html__('Not writable', 'total-plus'); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Debug Mode:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether or not is WordPress in debug mode.', 'total-plus'); ?></span></td>
                    <td class="description"><span class="choice"><?php echo $system_status->is_wp_debug_mode() ? '&#x2713;' : '&#x2717;'; ?></span></td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('Server', 'total-plus'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Server Information:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Information about the web server that is currently hosting the site.', 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_server_info()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Server Timezone:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The default timezone for the server. It should be UTC.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo (!$system_status->is_server_timezone_utc() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_server_timezone()); ?>
                        <?php if (!$system_status->is_server_timezone_utc()) : ?>
                            <br /><?php esc_html_e('The default timezone should be UTC.', 'total-plus'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Remote GET method:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether or not can the GET method be used to communicate with different APIs.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo (!$system_status->is_wp_remote_get() ) ? 'wrong' : 'right'; ?>">
                        <span class="choice"><?php echo $system_status->is_wp_remote_get() ? '&#x2713;' : '&#x2717;'; ?></span>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Remote POST method:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether or not can the POST method be used to communicate with different APIs.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo (!$system_status->is_wp_remote_post() ) ? 'wrong' : 'right'; ?>">
                        <span class="choice"><?php echo $system_status->is_wp_remote_post() ? '&#x2713;' : '&#x2717;'; ?></span>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('mod_security:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether the mod_security extension is enabled. This extension may cause issues with file uploads.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->mod_security_enabled() ) ? 'wrong' : 'right'; ?>">
                        <?php if ($system_status->xdebug_enabled()) : ?>
                            <?php esc_html_e('Enabled', 'total-plus'); ?>
                        <?php else : ?>
                            <?php esc_html_e('Disabled', 'total-plus'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('PHP', 'total-plus'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The version of PHP installed on your server.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo $system_status->php_version_ok() ? 'right' : 'wrong'; ?>">
                        <?php if ($system_status->get_php_version()) : ?>
                            <?php echo esc_html($system_status->get_php_version()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'total-plus'), '<code>phpversion()</code>'); ?>
                        <?php endif; ?>
                        <?php if (!$system_status->php_version_ok()) : ?>
                            <br />
                            <?php printf(esc_html__('Recommended version: %s or higher.', 'total-plus'), esc_html($system_status->get_recommended_php_version())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Maximum Input Variables:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The maximum number of variables the server can use for a single function to avoid overloads.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_php_max_input_vars() < $system_status->get_recommended_php_max_input_vars() ) ? 'wrong' : 'right'; ?>">
                        <?php if (!is_null($system_status->get_php_max_input_vars())) : ?>
                            <?php echo esc_html($system_status->get_php_max_input_vars()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'total-plus'), '<code>ini_get()</code>'); ?>
                        <?php endif; ?>
                        <?php if ($system_status->get_php_max_input_vars() < $system_status->get_recommended_php_max_input_vars()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'total-plus'), esc_html($system_status->get_recommended_php_max_input_vars())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('POST Maximum Size:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The largest file size that can be contained in one POST request.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_php_post_max_size() < $system_status->get_recommended_php_post_max_size() ) ? 'wrong' : 'right'; ?>">
                        <?php if (!is_null($system_status->get_php_post_max_size())) : ?>
                            <?php echo esc_html($system_status->get_formatted_php_post_max_size()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'total-plus'), '<code>ini_get()</code>'); ?>
                        <?php endif; ?>
                        <?php if ($system_status->get_php_post_max_size() < $system_status->get_recommended_php_post_max_size()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'total-plus'), esc_html($system_status->get_formatted_recommended_php_post_max_size())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Time Limit:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The amount of time (in seconds) that the site will spend on a single operation before timing out (to avoid server lockups).', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_php_time_limit() < $system_status->get_recommended_php_time_limit() ) ? 'wrong' : 'right'; ?>">
                        <?php if (!is_null($system_status->get_php_time_limit())) : ?>
                            <?php echo esc_html($system_status->get_php_time_limit()); ?>
                        <?php else : ?>
                            <?php printf(esc_html__("%s isn't available.", 'total-plus'), '<code>ini_get()</code>'); ?>
                        <?php endif; ?>
                        <?php if ($system_status->get_php_time_limit() < $system_status->get_recommended_php_time_limit()) : ?>
                            <br /><?php printf(esc_html__('Recommended value: %s.', 'total-plus'), esc_html($system_status->get_recommended_php_time_limit())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Xdebug:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether the Xdebug extension is enabled. This value should always be disabled in live sites.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->xdebug_enabled() ) ? 'wrong' : 'right'; ?>">
                        <?php if ($system_status->xdebug_enabled()) : ?>
                            <?php esc_html_e('Xdebug is enabled. Please disable it if this is a live site.', 'total-plus'); ?>
                        <?php else : ?>
                            <?php esc_html_e('Disabled', 'total-plus'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('MySQL', 'total-plus'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The version of MySQL installed on your server.', 'total-plus'); ?></span></td>
                    <td class="description <?php echo ( $system_status->get_mysql_version() < $system_status->get_required_mysql_version() ) ? 'wrong' : 'right'; ?>">
                        <?php echo esc_html($system_status->get_mysql_version()); ?>
                        <?php if ($system_status->get_mysql_version() < $system_status->get_recommended_mysql_version()) : ?>
                            <br /><?php printf(esc_html__('Recommended version: %s or higher.', 'total-plus'), esc_html($system_status->get_recommended_mysql_version())); ?>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('Active Theme', 'total-plus'); ?></th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="title"><?php esc_html_e('Name:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The name of the currently active theme.', 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_theme_name()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Version:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The installed version of the currently active theme.', 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_theme_version()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e("Author's URL:", 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__("The currently active theme developer's URL.", 'total-plus'); ?></span></td>
                    <td class="description"><?php echo esc_html($system_status->get_theme_author_url()); ?></td>
                </tr>

                <tr>
                    <td class="title"><?php esc_html_e('Child Theme:', 'total-plus'); ?></td>
                    <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('Whether or not is the currently active theme a child theme.', 'total-plus'); ?></span></td>
                    <td class="description">
                        <span class="choice"><?php echo $system_status->is_child_theme() ? '&#x2713;' : '&#x2717;'; ?></span>
                        <?php if (!$system_status->is_child_theme()) : ?>
                            <br /><?php printf(esc_html__("If you're modifying %s, we recommend using a child theme.", 'total-plus'), esc_attr($system_status->get_total_plus_name())); ?> <a href="http://codex.wordpress.org/Child_Themes" target="_blank"><?php esc_html_e('Learn about them', 'total-plus'); ?></a>.
                        <?php endif; ?>
                    </td>
                </tr>

                <?php if ($system_status->is_child_theme()) : ?>

                    <tr>
                        <td class="title"><?php esc_html_e('Parent Theme Name:', 'total-plus'); ?></td>
                        <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The name of the parent theme.', 'total-plus'); ?></span></td>
                        <td class="description"><?php echo esc_html($system_status->get_parent_theme_name()); ?></td>
                    </tr>

                    <tr>
                        <td class="title"><?php esc_html_e('Parent Theme Version:', 'total-plus'); ?></td>
                        <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__('The installed version of the parent theme.', 'total-plus'); ?></span></td>
                        <td class="description"><?php echo esc_html($system_status->get_parent_theme_version()); ?></td>
                    </tr>

                    <tr>
                        <td class="title"><?php esc_html_e("Parent Theme Author's URL:", 'total-plus'); ?></td>
                        <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr__("The parent theme developer's URL.", 'total-plus'); ?></span></td>
                        <td class="description"><?php echo esc_html($system_status->get_parent_theme_author_url()); ?></td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3"><?php esc_html_e('Active Plugins', 'total-plus'); ?></th>
                </tr>
            </thead>

            <tbody>

                <?php $active_plugins = $system_status->get_active_plugins(); ?>
                <?php if (!empty($active_plugins)) : ?>

                    <?php foreach ($active_plugins as $plugin) : ?>

                        <?php
                        $plugin_info = array();
                        if ($plugin['required']) {
                            $plugin_info[] = esc_html__('Required', 'total-plus');
                        } elseif ($plugin['recommended']) {
                            $plugin_info[] = esc_html__('Recommended', 'total-plus');
                        }

                        if ($plugin['must_use']) {
                            $plugin_info[] = esc_html__('Must Use', 'total-plus');
                        } elseif ($plugin['network_active']) {
                            $plugin_info[] = esc_html__('Network', 'total-plus');
                        }
                        ?>

                        <tr>
                            <td class="title">
                                <?php if ($plugin['url']) : ?>
                                    <a href="<?php echo esc_url($plugin['url']); ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php echo esc_html($plugin['name']); ?>
                                    <?php if ($plugin['url']) : ?>
                                    </a>
                                <?php endif; ?>
                                <?php echo esc_html($plugin['version']); ?>
                                <?php if ($plugin['new_version']) : ?>
                                    <br />
                                    <em><?php printf(esc_html__('Update Available: %s', 'total-plus'), esc_attr($plugin['new_version'])); ?></em>
                                <?php endif; ?>
                                <?php if (!empty($plugin_info)) : ?>
                                    <br />
                                    (<?php echo esc_html(implode(', ', $plugin_info)); ?>)
                                <?php endif; ?>
                            </td>
                            <td class="help"><i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr($plugin['description']); ?></span></td>
                            <td class="description">
                                <?php if ($plugin['author_url']) : ?>
                                    <a href="<?php echo esc_url($plugin['author_url']); ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php echo esc_html($plugin['author_name']); ?>
                                    <?php if ($plugin['author_url']) : ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>
                        <td colspan="3"><?php esc_html_e('Currently, no plugins are active.', 'total-plus'); ?></td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3">
                        <?php esc_html_e('Required &amp; Recommended Plugins', 'total-plus'); ?><br />
                        <em><?php esc_html__('which you should install, activate and keep updated', 'total-plus'); ?></em>
                    </th>
                </tr>
            </thead>

            <tbody>

                <?php ob_start(); ?>

                <?php $required_plugins = $system_status->get_required_plugins();
                ?>

                <?php if (!empty($required_plugins)) : ?>

                    <?php foreach ($required_plugins as $plugin_data) : ?>

                        <?php
                        $plugin = Total_Plus_TGM_Plugin::obtain($plugin_data['slug']);

                        if (!( $plugin instanceof Total_Plus_TGM_Plugin )) {
                            continue;
                        }

                        $plugin_info = array();

                        if (!$plugin->is_installed()) {
                            $plugin_info[] = __('Not Installed', 'total-plus');
                        } else {
                            if ($plugin->is_inactive()) {
                                $plugin_info[] = __('Inactive', 'total-plus');
                            }

                            if (version_compare($plugin->get_version(), $plugin->get_theme_required_version(), '<')) {
                                $plugin_info[] = __('Needs Update', 'total-plus');
                            }
                        }

                        if (empty($plugin_info)) {
                            continue;
                        }

                        if ($plugin->is_required()) {
                            array_unshift($plugin_info, esc_html__('Required', 'total-plus'));
                        }
                        ?>

                        <tr>
                            <td class="title">
                                <?php if ($plugin->get_url()) : ?>
                                    <a href="<?php echo esc_url($plugin->get_url()); ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php echo esc_html($plugin->get_name()); ?>
                                    <?php if ($plugin->get_url()) : ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($plugin->get_theme_required_version()) : ?>
                                    <?php echo esc_html($plugin->get_theme_required_version()); ?>
                                <?php endif; ?>
                                <?php if ($plugin->has_update()) : ?>
                                    <br />
                                    <em><?php printf(esc_html__('Update Available: %s', 'total-plus'), esc_attr($plugin->get_new_version())); ?></em>
                                <?php endif; ?>
                                <?php if (!empty($plugin_info)) : ?>
                                    <br />
                                    <span class="wrong">(<?php echo implode(', ', $plugin_info); ?>)</span>
                                <?php endif; ?>
                            </td>
                            <td class="help">
                                <?php if ($plugin->get_description()) : ?>
                                    <i class="dashicons dashicons-editor-help"></i><span><?php echo esc_attr($plugin->get_description()); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="description">
                                <?php if ($plugin->get_author_name()) : ?>
                                    <?php if ($plugin->get_author_url()) : ?>
                                        <a href="<?php echo esc_url($plugin->get_author_url()); ?>" target="_blank">
                                        <?php endif; ?>
                                        <?php echo esc_html($plugin->get_author_name()); ?>
                                        <?php if ($plugin->get_author_url()) : ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                <?php
                $required_plugins_output = trim(ob_get_contents());
                ob_end_clean();
                ?>

                <?php if (!empty($required_plugins_output)) : ?>
                    <?php echo $required_plugins_output; // WPCS: XSS Ok. ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3"><?php esc_html_e('Currently, no required or recommended plugins are missing, inactive or outdated.', 'total-plus'); ?></td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>

    </div>
</div>
