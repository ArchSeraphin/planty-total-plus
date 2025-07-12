<?php
/**
 * Initial functions.
 *
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class to manipulate menus.
 *
 */
class Total_Plus_Nav_Walker {

    /**
     * Constructor.
     *
     * @access public
     */
    public function __construct() {

        // Edit menu walker
        add_filter('wp_edit_nav_menu_walker', array($this, 'edit_walker'), 100);

        // Add custom fields to menu
        add_filter('wp_setup_nav_menu_item', array($this, 'add_custom_fields_meta'));
        add_action('wp_nav_menu_item_custom_fields', array($this, 'add_custom_fields'), 10, 4);

        // Save menu custom fields
        add_action('wp_update_nav_menu_item', array($this, 'update_custom_nav_fields'), 10, 3);

        add_action('admin_enqueue_scripts', array($this, 'enqueue_script'));
    }

    /**
     * Add custom menu style fields data to the menu.
     *
     * @access public
     * @param object $menu_item A single menu item.
     * @return object The menu item.
     */
    public function add_custom_fields_meta($menu_item) {
        $menu_item->megamenu = get_post_meta($menu_item->ID, '_menu_item_megamenu', true);
        $menu_item->megamenu_col = get_post_meta($menu_item->ID, '_menu_item_megamenu_col', true);
        $menu_item->megamenu_heading = get_post_meta($menu_item->ID, '_menu_item_megamenu_heading', true);
        $menu_item->megamenu_template = get_post_meta($menu_item->ID, '_menu_item_megamenu_template', true);
        $menu_item->megamenu_widgetarea = get_post_meta($menu_item->ID, '_menu_item_megamenu_widgetarea', true);
        $menu_item->category_post = get_post_meta($menu_item->ID, '_menu_item_category_post', true);
        $menu_item->icon = get_post_meta($menu_item->ID, '_menu_item_icon', true);

        return $menu_item;
    }

    /**
     * Add custom megamenu fields data to the menu.
     *
     * @access public
     * @param object $menu_item A single menu item.
     * @return object The menu item.
     */
    public function add_custom_fields($id, $item, $depth, $args) {
        ?>
        <?php if ($item->object == 'category') { ?>
            <p class="field-category-post description description-wide">
                <label for="edit-menu-item-category-post-<?php echo esc_attr($item->ID); ?>">
                    <input type="checkbox" id="edit-menu-item-category-post-<?php echo esc_attr($item->ID); ?>" class="edit-menu-item-category-post" value="category_post" name="menu-item-category_post[<?php echo esc_attr($item->ID); ?>]"<?php checked($item->category_post, 'category_post'); ?> />
                    <?php esc_html_e('Display Latest Posts', 'total-plus'); ?>
                </label>
            </p>
        <?php } ?>

        <p class="field-megamenu description description-wide">
            <label for="edit-menu-item-megamenu-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu', 'total-plus'); ?><br/>
                <select id="edit-menu-item-megamenu-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-megamenu" name="menu-item-megamenu[<?php echo esc_attr($item->ID); ?>]"<?php checked($item->megamenu, 'total-plus'); ?>>
                    <option value="normal" <?php selected($item->megamenu, 'normal') ?>><?php esc_html_e('Disable', 'total-plus'); ?></option>
                    <option value="megamenu_full_width" <?php selected($item->megamenu, 'megamenu_full_width') ?>><?php esc_html_e('Megamenu - Full Width', 'total-plus'); ?></option>
                    <option value="megamenu_auto_width" <?php selected($item->megamenu, 'megamenu_auto_width') ?>><?php esc_html_e('Megamenu - Auto Width', 'total-plus'); ?></option>
                </select>
            </label>
        </p>

        <p class="field-megamenu-columns description description-wide">
            <label for="edit-menu-item-megamenu-col-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu Columns (from 1 to 6)', 'total-plus'); ?><br />
                <select id="edit-menu-item-megamenu-col-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_col[<?php echo esc_attr($item->ID); ?>]">
                    <option value="1" <?php selected($item->megamenu_col, 1) ?>><?php esc_html_e('1', 'total-plus'); ?></option>
                    <option value="2" <?php selected($item->megamenu_col, 2) ?>><?php esc_html_e('2', 'total-plus'); ?></option>
                    <option value="3" <?php selected($item->megamenu_col, 3) ?>><?php esc_html_e('3', 'total-plus'); ?></option>
                    <option value="4" <?php selected($item->megamenu_col, 4) ?>><?php esc_html_e('4', 'total-plus'); ?></option>
                    <option value="5" <?php selected($item->megamenu_col, 5) ?>><?php esc_html_e('5', 'total-plus'); ?></option>
                    <option value="6" <?php selected($item->megamenu_col, 6) ?>><?php esc_html_e('6', 'total-plus'); ?></option>
                </select>
            </label>
        </p>      

        <p class="field-megamenu-heading description description-wide">
            <label for="edit-menu-item-megamenu-heading-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Is Heading?', 'total-plus'); ?>
                <select id="edit-menu-item-megamenu-heading-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_heading[<?php echo esc_attr($item->ID); ?>]">
                    <option value="no" <?php selected($item->megamenu_heading, 'no') ?>><?php esc_html_e('No', 'total-plus'); ?></option>
                    <option value="yes" <?php selected($item->megamenu_heading, 'yes') ?>><?php esc_html_e('Yes', 'total-plus'); ?></option>
                    <option value="hide" <?php selected($item->megamenu_heading, 'hide') ?>><?php esc_html_e('Hide', 'total-plus'); ?></option>
                </select>
            </label>
        </p>

        <p class="field-megamenu-template description description-thin">
            <label for="edit-menu-item-megamenu-template-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu Template', 'total-plus'); ?>
                <select id="edit-menu-item-megamenu-template-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_template[<?php echo esc_attr($item->ID); ?>]">
                    <option value="0"><?php esc_html_e('Select Template', 'total-plus'); ?></option>
                    <?php
                    $templates_list = get_posts(array('post_type' => 'ht-megamenu', 'numberposts' => -1, 'post_status' => 'publish'));
                    if (!empty($templates_list)) {
                        foreach ($templates_list as $template) {
                            $templates[$template->ID] = $template->post_title;
                            ?>
                            <option value="<?php echo esc_attr($template->ID); ?>" <?php selected($item->megamenu_template, $template->ID); ?>><?php echo esc_html($template->post_title); ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </label>
        </p>

        <p class="field-megamenu-widgetarea description description-thin">
            <label for="edit-menu-item-megamenu-widgetarea-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu Widget Area', 'total-plus'); ?>
                <select id="edit-menu-item-megamenu-widgetarea-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_widgetarea[<?php echo esc_attr($item->ID); ?>]">
                    <option value="0"><?php esc_html_e('Select Widget Area', 'total-plus'); ?></option>
                    <?php
                    global $wp_registered_sidebars;
                    if (!empty($wp_registered_sidebars) && is_array($wp_registered_sidebars)) :
                        foreach ($wp_registered_sidebars as $sidebar) :
                            ?>
                            <option value="<?php echo esc_attr($sidebar['id']); ?>" <?php selected($item->megamenu_widgetarea, $sidebar['id']); ?>><?php echo esc_html($sidebar['name']); ?>
                            </option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </label>
        </p>
        <?php
    }

    /**
     * Add the custom menu style fields menu item data to fields in database.
     *
     * @access public
     * @param string|int $menu_id         The menu ID.
     * @param string|int $menu_item_db_id The menu ID from the db.
     * @param array      $args            The arguments array.
     * @return void
     */
    public function update_custom_nav_fields($menu_id, $menu_item_db_id, $args) {

        $check = array('megamenu_template', 'category_post', 'megamenu', 'megamenu_col', 'megamenu_heading', 'megamenu_widgetarea', 'icon');

        foreach ($check as $key) {
            if (!isset($_POST['menu-item-' . $key][$menu_item_db_id])) {
                $_POST['menu-item-' . $key][$menu_item_db_id] = '';
            }

            $value = sanitize_text_field(wp_unslash($_POST['menu-item-' . $key][$menu_item_db_id]));
            update_post_meta($menu_item_db_id, '_menu_item_' . $key, $value);
        }
    }

    /**
     * Function to replace normal edit nav walker.
     *
     * @return string Class name of new navwalker
     */
    public function edit_walker() {
        require_once get_template_directory() . '/inc/walker/class-walker-edit-custom.php';
        return 'Walker_Nav_Menu_Edit_Custom';
    }

    public function enqueue_script() {
        wp_enqueue_style('total-plus-mega-menu-admin-style', get_template_directory_uri() . '/inc/walker/assets/mega-menu-admin.css', array(), TOTAL_PLUS_VERSION);
        wp_enqueue_script('total-plus-mega-menu-admin-script', get_template_directory_uri() . '/inc/walker/assets/mega-menu-admin.js', array('jquery', 'jquery-ui-sortable'), TOTAL_PLUS_VERSION, true);
    }

    function avia_ajax_switch_menu_walker() {
        if (!current_user_can('edit_theme_options'))
            die('-1');

        check_ajax_referer('add-menu_item', 'menu-settings-column-nonce');

        require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

        $item_ids = wp_save_nav_menu_items(0, $_POST['menu-item']);
        if (is_wp_error($item_ids))
            die('-1');

        foreach ((array) $item_ids as $menu_item_id) {
            $menu_obj = get_post($menu_item_id);
            if (!empty($menu_obj->ID)) {
                $menu_obj = wp_setup_nav_menu_item($menu_obj);
                $menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
                $menu_items[] = $menu_obj;
            }
        }

        if (!empty($menu_items)) {
            $args = array(
                'after' => '',
                'before' => '',
                'link_after' => '',
                'link_before' => '',
                'walker' => new avia_backend_walker,
            );
            echo walk_nav_menu_tree($menu_items, 0, (object) $args);
        }

        die('end');
    }

}

new Total_Plus_Nav_Walker();
