<?php

/**
 * total functions and definitions
 *
 * @package total
 */
if (!defined('TOTAL_PLUS_VERSION')) {
    $total_plus_get_theme = wp_get_theme();
    $total_plus_version = $total_plus_get_theme->Version;
    define('TOTAL_PLUS_VERSION', $total_plus_version);
}

if (!function_exists('total_plus_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function total_plus_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on total, use a find and replace
         * to change 'total-plus' to the name of your theme in all the template files
         */
        load_theme_textdomain('total-plus', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size('total-840x420', 840, 420, true);
        add_image_size('total-600x600', 600, 600, true);
        add_image_size('total-400x400', 400, 400, true);
        add_image_size('total-400x280', 400, 280, true);
        add_image_size('total-350x420', 350, 420, true);
        add_image_size('total-100x100', 100, 100, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'total-plus'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('total_plus_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('custom-logo', array(
            'height' => 62,
            'width' => 300,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('.ht-site-title', '.ht-site-description'),
        ));

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', total_plus_fonts_url()));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
    }

endif; // total_plus_setup
add_action('after_setup_theme', 'total_plus_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function total_plus_content_width() {
    $GLOBALS['content_width'] = apply_filters('total_plus_content_width', 840);
}

add_action('after_setup_theme', 'total_plus_content_width', 0);

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function total_plus_add_excerpt_support_for_pages() {
    add_post_type_support('page', 'excerpt');
}

add_action('init', 'total_plus_add_excerpt_support_for_pages');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function total_plus_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'total-plus'),
        'id' => 'total-right-sidebar',
        'description' => __('Add widgets here to appear in your sidebar.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'total-plus'),
        'id' => 'total-left-sidebar',
        'description' => __('Add widgets here to appear in your sidebar.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    if (total_plus_is_woocommerce_activated()) {
        register_sidebar(array(
            'name' => esc_html__('Shop Right Sidebar', 'total-plus'),
            'id' => 'total-shop-right-sidebar',
            'description' => __('Add widgets here to appear in your sidebar of shop page.', 'total-plus'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Shop Left Sidebar', 'total-plus'),
            'id' => 'total-shop-left-sidebar',
            'description' => __('Add widgets here to appear in your sidebar of shop page.', 'total-plus'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
    }

    register_sidebar(array(
        'name' => esc_html__('Header Widget', 'total-plus'),
        'id' => 'total-header-widget',
        'description' => __('Add widgets in the Header. Works with Header 4 and Header 6 Only', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Top Footer', 'total-plus'),
        'id' => 'total-top-footer',
        'description' => __('Add widgets here to appear in your Footer.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer One', 'total-plus'),
        'id' => 'total-footer1',
        'description' => __('Add widgets here to appear in your Footer.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Two', 'total-plus'),
        'id' => 'total-footer2',
        'description' => __('Add widgets here to appear in your Footer.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Three', 'total-plus'),
        'id' => 'total-footer3',
        'description' => __('Add widgets here to appear in your Footer.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Four', 'total-plus'),
        'id' => 'total-footer4',
        'description' => __('Add widgets here to appear in your Footer.', 'total-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'total_plus_widgets_init');

if (!function_exists('total_plus_fonts_url')) :

    /**
     * Register Google fonts for Total Plus.
     *
     * @since Total Plus 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function total_plus_fonts_url() {
        $fonts_url = '';
        $fonts = $standard_font_family = $font_family_array = array();
        $subsets = 'latin,latin-ext';
        $variants_array = $font_array = $google_fonts = array();
        $total_plus_standard_font = total_plus_standard_font_array();
        $customizer_fonts = total_plus_get_customizer_fonts();
        $google_font_list = total_plus_google_font_array();

        foreach ($total_plus_standard_font as $key => $value) {
            $standard_font_family[] = $value['family'];
        }

        foreach ($customizer_fonts as $key => $value) {
            $font_family_array[] = get_theme_mod($key . '_font_family', $value['font_family']);
        }

        $font_family_array = array_unique($font_family_array);
        $font_family_array = array_diff($font_family_array, $standard_font_family);

        foreach ($font_family_array as $font_family) {
            $font_array = total_plus_search_key($google_font_list, 'family', $font_family);
            $variants_array = $font_array['0']['variants'];
            $variants_keys = array_keys($variants_array);
            $variants = implode(',', $variants_keys);

            $fonts[] = $font_family . ':' . str_replace('italic', 'i', $variants);
        }
        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = esc_html_x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'total-plus');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                'display' => 'swap',
                    ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

/**
 * Enqueue scripts and styles.
 */
function total_plus_scripts() {
    $google_map_api = of_get_option('api_key', '');
    $customizer_gdpr_settings = of_get_option('customizer_gdpr_settings', '1');

    if ($google_map_api) {
        $key = 'key=' . $google_map_api . '&';
        wp_enqueue_script('total-plus-google-map', '//maps.googleapis.com/maps/api/js?&' . $key . 'sensor=false', array(), TOTAL_PLUS_VERSION, false);
    }

    if ($customizer_gdpr_settings) {
        wp_enqueue_script('js-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    }

    wp_register_script('YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.min.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('jquery-nav', get_template_directory_uri() . '/js/jquery.nav.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('owl-filter', get_template_directory_uri() . '/js/jquery.owl-filter.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('isotope-pkgd', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery', 'imagesloaded'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('lightgallery', get_template_directory_uri() . '/js/lightgallery.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('hoverintent', get_template_directory_uri() . '/js/hoverintent.js', array(), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('odometer', get_template_directory_uri() . '/js/odometer.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('waypoint', get_template_directory_uri() . '/js/waypoint.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('espy', get_template_directory_uri() . '/js/jquery.espy.min.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('motio', get_template_directory_uri() . '/js/motio.min.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('flipster', get_template_directory_uri() . '/js/jquery.flipster.min.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('jquery-mcustomscrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('jquery-accordion', get_template_directory_uri() . '/js/jquery.accordion.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('photostream', get_template_directory_uri() . '/js/jquery.photostream.min.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('justifiedGallery', get_template_directory_uri() . '/js/jquery.justifiedGallery.min.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('countdown', get_template_directory_uri() . '/js/jquery.countdown.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('total-plus-megamenu', get_template_directory_uri() . '/inc/walker/assets/megaMenu.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('headroom', get_template_directory_uri() . '/js/headroom.js', array('jquery'), TOTAL_PLUS_VERSION, true);
    wp_enqueue_script('total-plus-custom', get_template_directory_uri() . '/js/total-plus-custom.js', array('jquery'), TOTAL_PLUS_VERSION, true);

    $page_overwrite_defaults = '';
    if (is_singular(array('post', 'page', 'product', 'portfolio'))) {
        $page_overwrite_defaults = rwmb_meta('page_overwrite_defaults');
    }

    if (!$page_overwrite_defaults) {
        $title_padding = get_theme_mod('total_plus_titlebar_padding', 50);
    } else {
        $title_padding = rwmb_meta('titlebar_padding');
    }

    $is_rtl = (is_rtl()) ? 'true' : 'false';

    $is_customize_preview = (is_customize_preview()) ? 'true' : 'false';

    wp_localize_script('total-plus-custom', 'total_plus_options', array(
        'template_path' => get_template_directory_uri(),
        'rtl' => $is_rtl,
        'customize_preview' => $is_customize_preview,
        'customizer_gdpr_settings' => $customizer_gdpr_settings,
        'title_padding' => $title_padding
    ));

    wp_localize_script('total-plus-megamenu', 'total_plus_megamenu', array(
        'rtl' => $is_rtl
    ));

    wp_enqueue_style('total-plus-loaders', get_template_directory_uri() . '/css/loaders.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('total-plus-fonts', total_plus_fonts_url(), array(), NULL);
    wp_enqueue_style('font-awesome-6.4.2', get_template_directory_uri() . '/css/all.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('font-awesome-v4-shims', get_template_directory_uri() . '/css/v4-shims.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('essential-icon', get_template_directory_uri() . '/css/essential-icon.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('lightgallery', get_template_directory_uri() . '/css/lightgallery.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('YTPlayer', get_template_directory_uri() . '/css/jquery.mb.YTPlayer.min.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('flipster', get_template_directory_uri() . '/css/jquery.flipster.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('jquery-mcustomscrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('justifiedGallery', get_template_directory_uri() . '/css/justifiedGallery.min.css', array(), TOTAL_PLUS_VERSION);
    wp_enqueue_style('total-plus-style', get_stylesheet_uri(), array(), TOTAL_PLUS_VERSION);
    wp_style_add_data('total-plus-style', 'rtl', 'replace');

    if ('file' != get_theme_mod('total_plus_style_option', 'head')) {
        wp_add_inline_style('total-plus-style', total_plus_dymanic_styles());
    } else {

        // We will probably need to load this file
        require_once( ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php' );

        global $wp_filesystem;
        $upload_dir = wp_upload_dir(); // Grab uploads folder array
        $dir = trailingslashit($upload_dir['basedir']) . 'total-plus' . DIRECTORY_SEPARATOR; // Set storage directory path

        WP_Filesystem(); // Initial WP file system
        $wp_filesystem->mkdir($dir); // Make a new folder 'oceanwp' for storing our file if not created already.
        $wp_filesystem->put_contents($dir . 'custom-style.css', total_plus_dymanic_styles(), 0644); // Store in the file.
        wp_enqueue_style('total-plus-dynamic-style', trailingslashit($upload_dir['baseurl']) . 'total-plus/custom-style.css', array(), NULL);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'total_plus_scripts');

/**
 * BreadCrumb
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/total-plus-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Custom PostType additions.
 */
require get_template_directory() . '/inc/total-plus-custom-post-types.php';

/**
 * MetaBox additions.
 */
require get_template_directory() . '/inc/total-plus-metabox.php';

/**
 * FontAwesome Array
 */
require get_template_directory() . '/inc/font-icons.php';

/**
 * Typography
 */
require get_template_directory() . '/inc/typography/typography.php';

/**
 * Theme Settings
 */
require get_template_directory() . '/inc/total-plus/welcome.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Header Functions
 */
require get_template_directory() . '/inc/header/header-functions.php';

/**
 * Home Page Functions
 */
require get_template_directory() . '/inc/home-functions.php';

/**
 * Hooks
 */
require get_template_directory() . '/inc/total-plus-hooks.php';

/**
 * Woo Commerce Functions
 */
require get_template_directory() . '/inc/woo-functions.php';

/**
 * AriColor
 */
require get_template_directory() . '/inc/aricolor.php';

/**
 * MetaBox
 */
if (!class_exists('RWMB_Loader')) {
    require get_template_directory() . '/inc/assets/meta-box/meta-box.php';
}
if (!class_exists('MB_Columns_Row')) {
    require get_template_directory() . '/inc/assets/meta-box-columns/meta-box-columns.php';
}
if (!class_exists('MB_Tabs')) {
    require get_template_directory() . '/inc/assets/meta-box-tabs/meta-box-tabs.php';
}
if (!class_exists('MB_Conditional_Logic')) {
    require get_template_directory() . '/inc/assets/meta-box-conditional-logic/meta-box-conditional-logic.php';
}
if (!class_exists('RWMB_Group')) {
    require get_template_directory() . '/inc/assets/meta-box-group/meta-box-group.php';
}

/**
 * Menu Icons
 */
if (!class_exists('Menu_Icons')) {
    require get_template_directory() . '/inc/assets/menu-icons/menu-icons.php';
}

/**
 * Menu Walker
 */
require get_template_directory() . '/inc/walker/init.php';
require get_template_directory() . '/inc/walker/menu-walker.php';

/**
 * Elementor Elements
 */
if (defined('ELEMENTOR_VERSION')) {
    require get_template_directory() . '/inc/elements/elements.php';
}

/**
 * Dynamic Styles additions
 */
require get_template_directory() . '/inc/style.php';

function total_plus_remove_jet_menus() {
    remove_submenu_page('jet-dashboard', 'jet-dashboard-license-page');
    remove_submenu_page('jet-dashboard', 'jet-dashboard');
}

add_action('admin_menu', 'total_plus_remove_jet_menus');
