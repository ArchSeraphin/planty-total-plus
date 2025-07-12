<?php
/**
 *
 * Save the widget area id options table
 */
add_action('load-widgets.php', 'total_plus_save_widgets');

function total_plus_save_widgets() {

    if (!isset($_POST['ht-add-widget-input']) || !isset($_POST['ht-sidebar-nonce']) || !wp_verify_nonce($_POST['ht-sidebar-nonce'], 'total_plus_create_widget_area-nonce')) {
        return;
    }

    $widget = trim($_POST['ht-add-widget-input']);
    if (empty($widget)) {
        return;
    }

    $new_widget = isset($_POST['ht-add-widget-input']) ? wp_strip_all_tags($_POST['ht-add-widget-input']) : '';

    if (get_theme_mod('total_plus_widget_areas')) {
        $allwidgets = get_theme_mod('total_plus_widget_areas');
    } else {
        $allwidgets = array();
    }

    $allwidgets[sanitize_text_field($new_widget)] = sanitize_key($new_widget);

    array_unique(array_filter($allwidgets));

    set_theme_mod('total_plus_widget_areas', $allwidgets);
    wp_redirect(admin_url('widgets.php'));
    die();
}

/**
 *
 * Add Widget Related Scripts
 * 
 * */
add_action('load-widgets.php', 'total_plus_widget_scripts');

function total_plus_widget_scripts() {
    wp_enqueue_script('total-plus-widget-areas', get_template_directory_uri() . '/inc/widgets/js/add-widget-script.js', array('jquery'), TOTAL_PLUS_VERSION, true);

    // Localize script
    wp_localize_script(
            'total-plus-widget-areas', 'total_widget_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'widgeturl' => admin_url('widgets.php'),
            )
    );
}

/**
 *
 * Add Widget Related Styles
 * 
 * */
add_action('admin_print_styles-widgets.php', 'total_plus_widget_inline_styles');

function total_plus_widget_inline_styles() {
    ?>
    <style type="text/css">
        .ht-widgets-holder{ width: 40%; }
        .ht-widgets-holder .add-custom-widgets{padding: 0;}
        .ht-widgets-holder .add-custom-widgets h3{background: #f9f9f9; border-bottom: 1px solid #e2e2e2; padding-left: 33px;padding: 14px 30px;margin: 0;}
        .ht-widgets-holder .add-custom-widgets form{padding: 30px;}
        .ht-widgets-holder .add-custom-widgets .widget-control-actions{margin-top: 12px;}
        .ht-widgets-holder .ht-widget-toggle{ background: #f9f9f9; border-top: 1px solid #e2e2e2; border-bottom: 1px solid #e2e2e2; padding-left: 33px;padding: 14px 30px; margin: 0;}
        .ht-widgets-holder .ht-custom-widgets { padding: 30px; margin: 0; list-style: decimal inside;}
        .ht-custom-widgets li{ padding: 10px; margin: 0; font-size: 14px;}
        .ht-custom-widgets li:nth-child(even){ background: #FAFAFA}
        .ht-custom-widgets li:nth-child(odd){ background: #F0F0F0}
        .ht-custom-widgets a.ht-remove-widget { text-decoration: none; float: right; color: #FF0000; padding: 0 5px; font-size: 18px;}
    </style>
    <?php
}

/**
 *
 * Adding Widget Form Interface in widget page
 * 
 * */
add_action('sidebar_admin_page', 'total_plus_add_widget_box');

function total_plus_add_widget_box() {
    /**
     *
     * Creates a area accepting widget ID
     */
    $nonce = wp_create_nonce('total_plus_create_widget_area-nonce');

    $all_widgets = get_theme_mods();
    ?>
    <div id="ht-add-widget" class="widgets-holder-wrap ht-widgets-holder">

        <div class="add-custom-widgets">
            <h3><?php esc_html_e('Create Widget Area', 'total-plus'); ?></h3>
            <form id="addWidgetAreaForm" action="" method="post">
                <input type="hidden" name="ht-sidebar-nonce" value="<?php echo esc_attr($nonce); ?>" />
                <div class="widget-content">
                    <input id="ht-add-widget-input" name="ht-add-widget-input" type="text" class="regular-text" placeholder="<?php esc_attr_e('Name of Widget', 'total-plus'); ?>" />
                </div>
                <div class="widget-control-actions">
                    <input class="button-primary" type="submit" value="<?php esc_attr_e('Create Widget Area', 'total-plus'); ?>" />
                </div>
            </form>
        </div>

        <div class="remove-custom-widgets">
            <?php
            /** Registering Dynamic Sidebars * */
            $total_plus_widgets = get_theme_mod('total_plus_widget_areas');

            if (!empty($total_plus_widgets)) {
                $total_plus_widgets = array_filter($total_plus_widgets);
                ?>
                <h3 class="ht-widget-toggle"><?php esc_attr_e('Remove Custom Widgets', 'total-plus'); ?></h3>
                <ol class="ht-custom-widgets" style="">
                    <?php
                    foreach ($total_plus_widgets as $title => $id) {
                        ?>
                        <li>
                            <span><?php echo esc_html($title); ?></span>
                            <a class="ht-remove-widget" href="#" data-widget="<?php echo esc_attr($title); ?>"><i class="icofont-trash"></i></a>
                        </li>
                        <?php
                    }
                    ?>
                </ol>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 *
 * Delete Custom Widget Areas
 *
 * */
add_action('wp_ajax_total_plus_remove_widget_area', 'total_plus_remove_widget_area');

function total_plus_remove_widget_area() {

    $total_plus_widgets = get_theme_mod('total_plus_widget_areas');

    $widget = isset($_REQUEST['widget']) ? $_REQUEST['widget'] : '';
    unset($total_plus_widgets[$widget]);

    set_theme_mod('total_plus_widget_areas', $total_plus_widgets);

    die();
}

/**
 *
 * Registering Dynamic Sidebars
 *
 * */
add_action('widgets_init', 'total_plus_register_dynamic_sidebars');

function total_plus_register_dynamic_sidebars() {
    $total_plus_widgets = get_theme_mod('total_plus_widget_areas');

    if (!empty($total_plus_widgets)) {
        $total_plus_widgets = array_filter($total_plus_widgets);
        foreach ($total_plus_widgets as $title => $id) {
            register_sidebar(array(
                'name' => $title,
                'id' => $id,
                'description' => esc_html__('Add widgets here.', 'total-plus'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ));
        }
    }
}

/**
 *
 * Adding Button
 *
 * */
function total_plus_add_widgets_screen_link() {

    // Build link with same style as 'Manage with Live Preview'.
    $link_html = sprintf(
            wp_kses(
                    ' <a href="%1$s" class="page-title-action">%2$s</a>', array(
        // Link tag only.
        'a' => array(
            'href' => array(),
            'class' => array(),
        ),
                    )
            ), esc_url(admin_url('widgets.php#ht-add-widget')), esc_html__('Add New Widget Area', 'total-plus')
    );

    // Output JavaScript to insert link after 'Manage with Live Preview'.
    ?>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {

            // Encode string for security
            var link_html = <?php echo wp_json_encode($link_html); ?>;

            // Insert after last button by title
            $('.page-title-action').last().after(link_html);

        });

    </script>
    <?php
}

// WP 4.6+.
add_action('admin_print_footer_scripts-widgets.php', 'total_plus_add_widgets_screen_link');
