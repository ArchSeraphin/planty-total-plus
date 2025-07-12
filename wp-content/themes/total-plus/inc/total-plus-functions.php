<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Total Plus
 */
if (!function_exists('total_plus_excerpt')) {

    function total_plus_excerpt($content, $letter_count) {
        $new_content = strip_shortcodes($content);
        $new_content = strip_tags($new_content);
        $content = mb_substr($new_content, 0, $letter_count);

        if (($letter_count !== 0) && (strlen($new_content) > $letter_count)) {
            $content .= "...";
        }
        return $content;
    }

}

function total_plus_comment($comment, $args, $depth) {
    extract($args, EXTR_SKIP);
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'parent' : '', $comment); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <div class="comment-author vcard">
                <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                <?php echo sprintf('<b class="fn">%s</b>', get_comment_author_link($comment)); ?>
            </div>
            <!-- .comment-author -->

            <?php if ('0' == $comment->comment_approved) : ?>
                <p class="comment-awaiting-moderation">
                    <?php _e('Your comment is awaiting moderation.', 'total-plus'); ?>
                </p>
            <?php endif; ?>
            <?php edit_comment_link(__('Edit', 'total-plus'), '<span class="edit-link">', '</span>'); ?>
        </footer>
        <!-- .comment-meta -->

        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
        <!-- .comment-content -->

        <div class="comment-metadata ht-clearfix">
            <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                <time datetime="<?php comment_time('c'); ?>">
                    <?php
                    /* translators: 1: comment date, 2: comment time */
                    printf(__('%1$s at %2$s', 'total-plus'), get_comment_date('', $comment), get_comment_time());
                    ?>
                </time>
            </a>

            <?php
            comment_reply_link(array_merge($args, array(
                'add_below' => 'div-comment',
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
                'before' => '<div class="reply">',
                'after' => '</div>'
            )));
            ?>
        </div>
        <!-- .comment-metadata -->
    </article>
    <!-- .comment-body -->
    <?php
}

/* Convert hexdec color string to rgb(a) string */

function total_plus_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

function totalColourBrightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function total_plus_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

function total_plus_sections_array() {
    return array('about', 'highlight', 'featured', 'portfolio', 'service', 'team', 'counter', 'testimonial', 'blog', 'logo', 'cta', 'pricing', 'news', 'tab', 'contact', 'customa', 'customb');
}

function total_plus_get_customizer_fonts() {
    $fonts = array(
        'body' => array(
            'font_family' => 'Pontano Sans',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '18',
            'line_height' => '1.8',
            'color' => '#333333',
            'letter_spacing' => '0'
        ),
        'menu' => array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'uppercase',
            'text_decoration' => 'none',
            'font_size' => '14',
            'line_height' => '3',
            'letter_spacing' => '0'
        ),
        'section_title' => array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '36',
            'line_height' => '1.5',
            'letter_spacing' => '0'
        ),
        'page_title' => array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '40',
            'line_height' => '1.5',
            'letter_spacing' => '0'
        )
    );

    $common_header_typography = get_theme_mod('common_header_typography', false);

    if (!$common_header_typography) {
        $fonts['h1'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '38',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h2'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '34',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h3'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '30',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h4'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '26',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h5'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '22',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h6'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '18',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
    } else {
        $fonts['h'] = array(
            'font_family' => 'Oswald',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '38',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
    }
    return $fonts;
}

function total_parallax_background($section_name = '') {
    $bg_type = get_theme_mod("total_plus_{$section_name}_bg_type");
    $bg_image = get_theme_mod("total_plus_{$section_name}_bg_image_url");
    $bg_video = get_theme_mod("total_plus_{$section_name}_bg_video", '6O9Nd1RSZSY');
    $parallax_mode = '';

    if ($bg_type == "image-bg" && !empty($bg_image)) {
        $parallax_effect = get_theme_mod("total_plus_{$section_name}_parallax_effect");
        if ($parallax_effect == 'parallax') {
            $parallax_mode = 'data-pllx-bg-ratio="0.5"';
        } elseif ($parallax_effect == 'scroll') {
            $parallax_mode = 'data-motion="true"';
        }
    } elseif ($bg_type == "video-bg" && !empty($bg_video)) {
        $parallax_mode = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
    }

    return $parallax_mode;
}

if (!function_exists('total_plus_is_woocommerce_activated')) {

    function total_plus_is_woocommerce_activated() {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('total_plus_single_author_box')) {

    function total_plus_single_author_box() {

        global $post;

        if (is_single() && isset($post->post_author)) {
            // Get Author Data
            $author = get_the_author();
            $author_description = get_the_author_meta('description', $post->post_author);
            $author_url = get_author_posts_url($post->post_author);
            $author_avatar = get_avatar(get_the_author_meta('user_email', $post->post_author), apply_filters('wpex_author_bio_avatar_size', 100));

            // Only display if author has a description
            if ($author_description) :
                ?>

                <div class="total-plus-author-info ht-clearfix">

                    <?php if ($author_avatar) { ?>
                        <div class="total-plus-author-avatar">
                            <a href="<?php echo esc_url($author_url); ?>" rel="author">
                                <?php echo $author_avatar; ?>
                            </a>
                        </div><!-- .author-avatar -->
                    <?php } ?>

                    <div class="total-plus-author-description">
                        <h5><?php printf(esc_html__('By %s', 'total-plus'), esc_html($author)); ?></h5>
                        <p><?php echo wp_kses_post($author_description); ?></p>

                        <div class="total-plus-author-icons">
                            <?php
                            $website_url = get_the_author_meta('url', $post->post_author);
                            if ($website_url && $website_url != '') {
                                echo '<a href="' . esc_url($website_url) . '"><i class="icofont-home"></i></a>';
                            }

                            $facebook_profile = get_the_author_meta('facebook_profile', $post->post_author);
                            if ($facebook_profile && $facebook_profile != '') {
                                echo '<a href="' . esc_url($facebook_profile) . '"><i class="icofont-facebook"></i></a>';
                            }

                            $twitter_profile = get_the_author_meta('twitter_profile', $post->post_author);
                            if ($twitter_profile && $twitter_profile != '') {
                                echo '<a href="' . esc_url($twitter_profile) . '"><i class="icofont-x-twitter"></i></a>';
                            }

                            $linkedin_profile = get_the_author_meta('linkedin_profile', $post->post_author);
                            if ($linkedin_profile && $linkedin_profile != '') {
                                echo '<a href="' . esc_url($linkedin_profile) . '"><i class="icofont-linkedin"></i></a>';
                            }

                            $instagram_profile = get_the_author_meta('instagram_profile', $post->post_author);
                            if ($instagram_profile && $instagram_profile != '') {
                                echo '<a href="' . esc_url($instagram_profile) . '"><i class="social_instagram_total"></i></a>';
                            }

                            $rss_url = get_the_author_meta('rss_url', $post->post_author);
                            if ($rss_url && $rss_url != '') {
                                echo '<a href="' . esc_url($rss_url) . '"><i class="icofont-instagram"></i></a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
            endif;
        }
    }

}

if (!function_exists('total_plus_entry_social_share')) {

    function total_plus_entry_social_share() {
        global $post;

        $post_url = get_permalink();

        // Get current page title
        $post_title = str_replace(' ', '%20', get_the_title());

        // Get Post Thumbnail for pinterest
        $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

        // Construct sharing URL
        $twitterURL = 'https://twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $post_url;
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
        $googleURL = 'https://plus.google.com/share?url=' . $post_url;
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $post_url . '&amp;media=' . $post_thumbnail[0] . '&amp;description=' . $post_title;
        $linkedinURL = 'https://linkedin.com/shareArticle?mini=true&amp;url=' . $post_url . '&amp;title=' . $post_title;
        $stumbleuponURL = 'https://stumbleupon.com/submit?url=' . $post_url . '&amp;title=' . $post_title;
        $mailURL = 'mailto:?Subject=' . $post_title . '&amp;Body=' . $post_url;

        $content = '<div class="total-plus-share-buttons">';
        $content .= '<a class="facebook-share" target="_blank" href="' . $facebookURL . '" target="_blank"><i class="icofont-facebook"></i><span class="screen-reader-text">' . esc_html__('Facebook', 'total-plus') . '</span></a>';
        $content .= '<a class="twitter-share" target="_blank" href="' . $twitterURL . '" target="_blank"><i class="icofont-x-twitter"></i><span class="screen-reader-text">' . esc_html__('Twitter', 'total-plus') . '</span></a>';
        $content .= '<a class="linkedin-share" target="_blank" href="' . $linkedinURL . '" target="_blank"><i class="icofont-linkedin"></i><span class="screen-reader-text">' . esc_html__('LinkedIn', 'total-plus') . '</span></a>';
        $content .= '<a class="pinterest-share" target="_blank" href="' . $pinterestURL . '" target="_blank"><i class="icofont-pinterest"></i><span class="screen-reader-text">' . esc_html__('Pinterest', 'total-plus') . '</span></a>';
        $content .= '<a class="stumbleupon-share" target="_blank" href="' . $stumbleuponURL . '" target="_blank"><i class="icofont-stumbleupon"></i><span class="screen-reader-text">' . esc_html__('Stumbleupon', 'total-plus') . '</span></a>';
        $content .= '<a class="email-share" target="_blank" href="' . $mailURL . '"><i class="icofont-envelope"></i><span class="screen-reader-text">' . esc_html__('Email', 'total-plus') . '</span></a>';
        $content .= '</div>';

        echo $content;
    }

}

if (!function_exists('total_plus_single_pagination')) {

    function total_plus_single_pagination() {
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <div class="nav-links">
                <div class="nav-previous">
                    <?php previous_post_link('%link', '<span><i class="mdi mdi-chevron-left"></i>' . __('Prev', 'total-plus') . '</span>%title'); ?> 
                </div>

                <div class="nav-next">
                    <?php next_post_link('%link', '<span>' . __('Next', 'total-plus') . '<i class="mdi mdi-chevron-right"></i></span>%title'); ?>
                </div>
            </div>
        </nav>
        <?php
    }

}

if (!function_exists('total_plus_single_related_posts')) {

    function total_plus_single_related_posts() {
        if (is_singular('post')) {
            global $post;

            $categories = get_the_category($post->ID);

            if ($categories) {
                $category_ids = array();
                foreach ($categories as $category) {
                    $category_ids[] = $category->term_id;
                }

                $args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page' => 3,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()):
                    echo '<div class="total-plus-related-post">';
                    echo '<h3 class="related-post-title">' . __('Related Posts', 'total-plus') . '</h3>';
                    echo '<ul class="total-plus-related-post-wrap ht-clearfix">';
                    while ($query->have_posts()): $query->the_post();
                        ?>
                        <li>
                            <div class="relatedthumb">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-400x280');
                                        $image_url = $image[0];
                                    } else {
                                        $image_url = get_template_directory_uri() . '/images/default-blog-thumb-small.jpg';
                                    }
                                    echo '<img src="' . $image_url . '" alt=' . get_the_title() . '/>';
                                    ?>
                                </a>
                            </div>

                            <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h4>
                        </li>
                        <?php
                    endwhile;
                    echo '</ul>';
                    echo '</div>';
                endif;
                wp_reset_postdata();
            }
        }
    }

}

if (!function_exists('total_plus_single_comment')) {

    function total_plus_single_comment() {
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
    }

}

function total_get_attachment_id_from_src($attachment_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$attachment_src'";
    $id = $wpdb->get_var($query);
    return $id;
}

function total_get_image_sizes() {

    foreach (get_intermediate_image_sizes() as $_size) {
        if (in_array($_size, array('thumbnail', 'medium', 'large'))) {
            $default_sizes[$_size] = 'Image Size - ' . get_option("{$_size}_size_w") . 'x' . get_option("{$_size}_size_h") . ' (' . ucfirst($_size) . ')';
        }
    }

    $sizes = array(
        'full' => __('Full Size', 'total-plus'),
        'total-840x420' => __('Image Size - 840x420', 'total-plus'),
        'total-600x600' => __('Image Size - 600x600', 'total-plus'),
        'total-400x400' => __('Image Size - 400x400', 'total-plus'),
        'total-400x280' => __('Image Size - 400x280', 'total-plus'),
        'total-350x420' => __('Image Size - 350x420', 'total-plus'),
        'total-100x100' => __('Image Size - 100x100', 'total-plus')
    );

    $all_sizes = array_merge($sizes, $default_sizes);

    return $all_sizes;
}

function total_plus_check_active_footer() {
    $total_plus_footer_col = get_theme_mod('total_plus_footer_col', 'col-3-1-1-1');
    $total_plus_footer_array = explode('-', $total_plus_footer_col);
    $count = count($total_plus_footer_array);
    $footer_col = $count - 2;
    $status = false;

    for ($i = 1; $i <= $footer_col; $i++) {
        if (is_active_sidebar('total-footer' . $i)) {
            $status = true;
        }
    }

    return $status;
}

function total_plus_pll_string_register_helper($theme_mod, $group) {
    if (has_action('wpml_register_single_string') || function_exists('pll_register_string')) {
        $repeater_content = get_theme_mod($theme_mod);
        $repeater_content = json_decode($repeater_content);
        $exclude_fields = array('page', 'image', 'icon', 'enable', 'percentage', 'is_featured', 'value', 'alignment', 'facebook_link', 'twitter_link', 'instagram_link');

        if (!empty($repeater_content)) {
            foreach ($repeater_content as $key => $repeater_item) {
                foreach ($repeater_item as $field_name => $field_value) {

                    if ($field_value !== 'undefined') {
                        if (!in_array($field_name, $exclude_fields)) {
                            $name = str_replace('_', ' ', $field_name);
                            $name = ucwords($name);
                            if (function_exists('pll_register_string')) {
                                pll_register_string($name, $field_value, $group, true);
                            }

                            if (has_action('wpml_register_single_string')) {
                                do_action('wpml_register_single_string', $group, $field_value, $field_value);
                            }
                        }
                    }
                }
            }
        }
    }
}

function total_plus_sections_register_strings() {
    $translatable_sections = array(
        'total_plus_sliders' => __('Sliders', 'total-plus'),
        'total_plus_progressbar' => __('Progress Bar', 'total-plus'),
        'total_plus_featured' => __('Featured Block', 'total-plus'),
        'total_plus_highlight' => __('Highlight Block', 'total-plus'),
        'total_plus_service' => __('Service Block', 'total-plus'),
        'total_plus_counter' => __('Counter Block', 'total-plus'),
        'total_plus_team' => __('Team Block', 'total-plus'),
        'total_plus_testimonial' => __('Testimonial Block', 'total-plus'),
        'total_plus_pricing' => __('Pricing Block', 'total-plus'),
        'total_plus_news' => __('News & Update Block', 'total-plus'),
        'total_plus_tabs' => __('Tabs Block', 'total-plus')
    );
    foreach ($translatable_sections as $field_mods => $field_name) {
        total_plus_pll_string_register_helper($field_mods, $field_name);
    }
}

add_action('after_setup_theme', 'total_plus_sections_register_strings', 11);

/**
 * Filter to translate strings
 */
function total_plus_translate_string($original_value, $domain) {
    if (is_customize_preview()) {
        $wpml_translation = $original_value;
    } else {
        $wpml_translation = apply_filters('wpml_translate_single_string', $original_value, $domain, $original_value);
        if ($wpml_translation === $original_value && function_exists('pll__')) {
            return pll__($original_value);
        }
    }
    return $wpml_translation;
}

add_filter('total_plus_translate_string', 'total_plus_translate_string', 10, 2);

function total_plus_enable_frontpage_default() {
    if (!($fresh_install = get_theme_mod('total_plus_fresh_install'))) {
        $theme_mods = count(get_theme_mods());
        if ($theme_mods > 3) {
            set_theme_mod('total_plus_fresh_install', 'no');
        } else {
            set_theme_mod('total_plus_fresh_install', 'yes');
        }
    }

    return $fresh_install == 'yes' ? true : false;
}

function total_plus_get_image_alt($image_id, $default = '') {
    if ($image_id && ($image_alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true))) {
        return $image_alt_text;
    } else {
        return $default;
    }
}
