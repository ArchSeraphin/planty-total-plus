<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_latest_posts');

function total_plus_register_latest_posts() {
    register_widget('total_plus_latest_posts');
}

class total_plus_latest_posts extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display latest post with thumbnail.', 'total-plus'));
        parent::__construct('total_plus_latest_posts', '&bull; TP : Latest Posts', $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'ht_tab' => array(
                'total_plus_widgets_tabs' => array(
                    'ht-input' => __('Inputs', 'total-plus'),
                    'ht-settings' => __('Settings', 'total-plus')
                ),
                'total_plus_widgets_field_type' => 'tab'
            ),
            'tab_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content-wrap',
                'total_plus_widgets_field_type' => 'open'
            ),
            'input_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-input',
                'total_plus_widgets_field_type' => 'open'
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'post_count' => array(
                'total_plus_widgets_name' => 'post_count',
                'total_plus_widgets_title' => __('No of Posts to Display', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => '5'
            ),
            'display_thumb' => array(
                'total_plus_widgets_name' => 'display_thumb',
                'total_plus_widgets_title' => __('Display Thumbnail', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'thumbnail_size' => array(
                'total_plus_widgets_name' => 'thumbnail_size',
                'total_plus_widgets_title' => __('Thumbnail Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_default' => 'total-100x100'
            ),
            'thumbnail_width' => array(
                'total_plus_widgets_name' => 'thumbnail_width',
                'total_plus_widgets_title' => __('Thumbnail Width', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    '10' => __('10%', 'total-plus'),
                    '20' => __('20%', 'total-plus'),
                    '30' => __('30%', 'total-plus'),
                    '40' => __('40%', 'total-plus'),
                    '50' => __('50%', 'total-plus')
                ),
                'total_plus_widgets_default' => '30'
            ),
            'display_date' => array(
                'total_plus_widgets_name' => 'display_date',
                'total_plus_widgets_title' => __('Display Date', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'display_excerpt' => array(
                'total_plus_widgets_name' => 'display_excerpt',
                'total_plus_widgets_title' => __('Display Excerpt', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
            ),
            'excerpt_letter_count' => array(
                'total_plus_widgets_name' => 'excerpt_letter_count',
                'total_plus_widgets_title' => __('No of Letter to Display in Excerpt', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => '100'
            ),
            'input_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-settings',
                'total_plus_widgets_field_type' => 'open'
            ),
            'title_html_tag' => array(
                'total_plus_widgets_name' => 'title_html_tag',
                'total_plus_widgets_title' => __('Title HTMl Tag', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p'
                ),
                'total_plus_widgets_default' => 'div'
            ),
            'title_color' => array(
                'total_plus_widgets_name' => 'title_color',
                'total_plus_widgets_title' => __('Title Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'exceprt_color' => array(
                'total_plus_widgets_name' => 'exceprt_color',
                'total_plus_widgets_title' => __('Excerpt Text Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'settings_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'tab_close' => array(
                'total_plus_widgets_field_type' => 'close'
            )
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $title = isset($instance['title']) ? $instance['title'] : '';
        $post_count = isset($instance['post_count']) ? $instance['post_count'] : 5;
        $display_thumb = (isset($instance['display_thumb']) && $instance['display_thumb']) ? true : false;
        $thumbnail_size = isset($instance['thumbnail_size']) ? $instance['thumbnail_size'] : 'total-plus-100x100';
        $thumbnail_width = isset($instance['thumbnail_width']) ? $instance['thumbnail_width'] : 30;
        $display_date = (isset($instance['display_date']) && $instance['display_date']) ? true : false;
        $display_excerpt = (isset($instance['display_excerpt']) && $instance['display_excerpt']) ? true : false;
        $excerpt_letter_count = isset($instance['excerpt_letter_count']) ? $instance['excerpt_letter_count'] : 100;
        $title_html_tag = isset($instance['title_html_tag']) ? $instance['title_html_tag'] : 'div';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $exceprt_color = isset($instance['exceprt_color']) ? $instance['exceprt_color'] : '';
        $content_width = 100;
        $title_style = $excerpt_style = '';

        if ($title_color) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if ($exceprt_color) {
            $excerpt_style = 'style="color:' . $exceprt_color . '"';
        }

        echo $before_widget;
        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <ul class="ht-latest-posts">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $post_count
            );

            $query = new WP_Query($args);

            while ($query->have_posts()) : $query->the_post();
                ?>
                <li class="ht-clearfix">
                    <?php
                    if ($display_thumb && has_post_thumbnail()) {
                        $content_width = 100 - $thumbnail_width;
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $thumbnail_size);
                        $image_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                        ?>
                        <div class="ht-lp-image" style="width:<?php echo $thumbnail_width; ?>%">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            </a>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="ht-lp-content" style="width:<?php echo $content_width; ?>%">
                        <<?php echo $title_html_tag; ?> class="ht-lp-title">
                        <a href="<?php the_permalink(); ?>" <?php echo $title_style; ?>>
                            <?php the_title(); ?>
                        </a>
                        </<?php echo $title_html_tag; ?>>

                        <?php if ($display_date) { ?>
                            <div class="ht-lp-date" <?php echo $excerpt_style; ?>>
                                <?php echo get_the_date(); ?>
                            </div>
                        <?php } ?>

                        <?php if ($display_excerpt) { ?>
                            <div class="ht-lp-excerpt" <?php echo $excerpt_style; ?>>
                                <?php echo total_plus_excerpt(get_the_content(), $excerpt_letter_count); ?>
                            </div>
                        <?php } ?>
                    </div>
                </li>   
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </ul>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    total_plus_widgets_updated_field_value()        defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            if (!total_plus_exclude_widget_update($total_plus_widgets_field_type)) {
                $new = isset($new_instance[$total_plus_widgets_name]) ? $new_instance[$total_plus_widgets_name] : '';
                // Use helper function to get updated field values
                $instance[$total_plus_widgets_name] = total_plus_widgets_updated_field_value($widget_field, $new);
            }
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    total_plus_widgets_show_widget_field()      defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            // Make array elements available as variables
            extract($widget_field);

            if (!total_plus_exclude_widget_update($total_plus_widgets_field_type)) {
                $total_plus_widgets_field_value = !empty($instance[$total_plus_widgets_name]) ? $instance[$total_plus_widgets_name] : '';
            } else {
                $total_plus_widgets_field_value = '';
            }

            total_plus_widgets_show_widget_field($this, $widget_field, $total_plus_widgets_field_value);
        }
    }

}
