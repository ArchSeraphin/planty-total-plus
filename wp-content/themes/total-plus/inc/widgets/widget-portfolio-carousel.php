<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_portfolio_carousel');

function total_plus_register_portfolio_carousel() {
    register_widget('total_plus_portfolio_carousel');
}

class total_plus_portfolio_carousel extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_portfolio_carousel', '&bull; TP : Portfolio Carousel', array(
            'description' => __('A widget to display portfolio in carousel', 'total-plus')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $total_plus_portfolio_categories = get_categories(array('taxonomy' => 'portfolio_type', 'hide_empty' => 0));

        $total_plus_portfolio_cat = array();

        if ($total_plus_portfolio_categories) {
            foreach ($total_plus_portfolio_categories as $total_plus_portfolio_category) {
                $total_plus_portfolio_cat[$total_plus_portfolio_category->term_id] = $total_plus_portfolio_category->cat_name;
            }
        }

        $total_plus_portfolio_cat_all = $total_plus_portfolio_cat;
        $total_plus_portfolio_cat_all['*'] = __('All', 'total-plus');

        $fields = array(
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'category' => array(
                'total_plus_widgets_name' => 'category',
                'total_plus_widgets_title' => __('Select Category', 'total-plus'),
                'total_plus_widgets_field_type' => 'multicheckbox',
                'total_plus_widgets_field_options' => $total_plus_portfolio_cat
            ),
            'active_category' => array(
                'total_plus_widgets_name' => 'active_category',
                'total_plus_widgets_title' => __('Active Category', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => $total_plus_portfolio_cat_all
            ),
            'show_tab' => array(
                'total_plus_widgets_name' => 'show_tab',
                'total_plus_widgets_title' => __('Show Category Tabs', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'all' => array(
                'total_plus_widgets_name' => 'all',
                'total_plus_widgets_title' => __('Show All in Tab', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'portfolio_orderby' => array(
                'total_plus_widgets_name' => 'portfolio_orderby',
                'total_plus_widgets_title' => __('Portfolio Order By', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'title' => esc_html__('Post Title', 'total-plus'),
                    'date' => esc_html__('Posted Dated', 'total-plus'),
                    'rand' => esc_html__('Random', 'total-plus')
                ),
                'total_plus_widgets_default' => 'date'
            ),
            'portfolio_order' => array(
                'total_plus_widgets_name' => 'portfolio_order',
                'total_plus_widgets_title' => __('Portfolio Order', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'ASC' => esc_html__('Ascending Order', 'total-plus'),
                    'DESC' => esc_html__('Descending Order', 'total-plus')
                ),
                'total_plus_widgets_default' => 'DESC'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'total-100x100' => __('Thumbail - 100x100px', 'total-plus'),
                    'total-400x400' => __('Medium Square - 400x400px', 'total-plus'),
                    'total-400x280' => __('Medium Rectangle - 400x280px', 'total-plus'),
                    'total-350x420' => __('Medium Tall Rectangle - 350x420px', 'total-plus'),
                    'total-600x600' => __('Big Square - 600x600px', 'total-plus'),
                    'total-840x420' => __('Big Banner - 840x420px', 'total-plus')
                ),
                'total_plus_widgets_default' => 'total-400x400'
            ),
            'show_link' => array(
                'total_plus_widgets_name' => 'show_link',
                'total_plus_widgets_title' => __('Link to Detail Page', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'show_zoom' => array(
                'total_plus_widgets_name' => 'show_zoom',
                'total_plus_widgets_title' => __('Show Zoom Button on Image Hover', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'slider_heading' => array(
                'total_plus_widgets_name' => 'slider_heading',
                'total_plus_widgets_title' => __('Carousel Settings', 'total-plus'),
                'total_plus_widgets_field_type' => 'heading'
            ),
            'slides' => array(
                'total_plus_widgets_name' => 'slides',
                'total_plus_widgets_title' => __('Number of Slides', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    '1' => __('1', 'total-plus'),
                    '2' => __('2', 'total-plus'),
                    '3' => __('3', 'total-plus'),
                    '4' => __('4', 'total-plus'),
                    '5' => __('5', 'total-plus'),
                    '6' => __('6', 'total-plus'),
                    '7' => __('7', 'total-plus'),
                    '8' => __('8', 'total-plus')
                ),
                'total_plus_widgets_default' => 4
            ),
            'slide_margin' => array(
                'total_plus_widgets_name' => 'slide_margin',
                'total_plus_widgets_title' => __('Space Between Slides', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => 10,
                'total_plus_widgets_description' => __('in px', 'total-plus')
            ),
            'pause' => array(
                'total_plus_widgets_name' => 'pause',
                'total_plus_widgets_title' => __('Slider Transition Time', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => 8000,
                'total_plus_widgets_description' => __('Time in Milliseconds (1000 = 1s)', 'total-plus')
            ),
            'autoplay' => array(
                'total_plus_widgets_name' => 'autoplay',
                'total_plus_widgets_title' => __('Auto Transition', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'show_arrow' => array(
                'total_plus_widgets_name' => 'show_arrow',
                'total_plus_widgets_title' => __('Show Slider Navigation Arrow', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'show_dots' => array(
                'total_plus_widgets_name' => 'show_dots',
                'total_plus_widgets_title' => __('Show Slider Navigation Pager', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
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
        $category = isset($instance['category']) ? $instance['category'] : '';
        $all = isset($instance['all']) ? $instance['all'] : '';
        $active_category = isset($instance['active_category']) ? $instance['active_category'] : '';
        $orderby = isset($instance['portfolio_orderby']) ? $instance['portfolio_orderby'] : 'date';
        $order = isset($instance['portfolio_order']) ? $instance['portfolio_order'] : 'DESC';
        $slides = isset($instance['slides']) ? $instance['slides'] : 4;
        $slide_margin = isset($instance['slide_margin']) ? $instance['slide_margin'] : 10;
        $show_tab = isset($instance['show_tab']) ? $instance['show_tab'] : '';
        $show_link = (isset($instance['show_link']) && $instance['show_link']) ? $instance['show_link'] : '';
        $show_zoom = (isset($instance['show_zoom']) && $instance['show_zoom']) ? $instance['show_zoom'] : '';
        $show_arrow = (isset($instance['show_arrow']) && $instance['show_arrow'] ) ? 'true' : 'false';
        $show_dots = (isset($instance['show_dots']) && $instance['show_dots'] ) ? 'true' : 'false';
        $autoplay = (isset($instance['autoplay']) && $instance['autoplay'] ) ? 'true' : 'false';
        $pause = isset($instance['pause']) ? $instance['pause'] : 8000;
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'total-100x100';

        $data_params = array(
            'dots' => $show_dots,
            'margin' => $slide_margin,
            'items' => $slides,
            'pause' => $pause,
            'autoplay' => $autoplay,
            'show_tab' => $show_tab
        );

        echo $before_widget;
        ?>
        <div class="ht-portfolio-carousel">
            <?php
            if (!empty($title)):
                echo $before_title . apply_filters('widget_title', $title) . $after_title;
            endif;
            ?>

            <div class="ht-portfolio-carousel-button ht-clearfix">
                <?php
                $total_active_tab = ($active_category == '*') ? '*' : '.total-portfolio-' . $active_category;

                if ($category && $show_tab) {
                    $total_plus_portfolio_cat_array = array_keys($category);
                    ?>
                    <div class="ht-portfolio-filter-wrap" data-active="<?php echo $total_active_tab; ?>">
                        <?php
                        foreach ($total_plus_portfolio_cat_array as $total_plus_portfolio_cat_single) {
                            $category_slug = "";
                            $category_slug = '.total-portfolio-' . $total_plus_portfolio_cat_single;
                            $term = get_term($total_plus_portfolio_cat_single, 'portfolio_type');
                            if (!empty($term) && !is_wp_error($term)) {
                                $term_name = esc_html($term->name);
                                ?>
                                <div class="ht-portfolio-filter-btn" data-filter="<?php echo esc_attr($category_slug); ?>">
                                    <?php echo esc_html($term_name); ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($all) { ?>
                            <div class="ht-portfolio-filter-btn" data-filter="*">
                                <?php _e('All', 'total-plus'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                }

                if ($show_arrow == 'true') {
                    ?>
                    <div class="ht-owl-nav">
                        <div class="owl-prev"><i class="mdi mdi-chevron-left"></i></div>
                        <div class="owl-next"><i class="mdi mdi-chevron-right"></i></div>
                    </div>
                <?php } ?>
            </div>

            <div class="owl-carousel ht-portfolio-carousel-slides" data-params='<?php echo json_encode($data_params); ?>'>
                <?php
                if ($category) {
                    $total_plus_portfolio_cat_array = array_keys($category);

                    $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => -1,
                        'order' => $order,
                        'orderby' => $orderby,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_type',
                                'field' => 'id',
                                'terms' => $total_plus_portfolio_cat_array
                            )
                        )
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()):
                        while ($query->have_posts()) : $query->the_post();
                            $categories = get_the_terms(get_the_ID(), 'portfolio_type');
                            $category_slug = "";
                            $cat_slug = array();

                            foreach ($categories as $category) {
                                $cat_slug[] = 'total-portfolio-' . $category->term_id;
                            }

                            $category_slug = implode(" ", $cat_slug);

                            if (has_post_thumbnail()) {
                                $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                                $total_plus_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            } else {
                                $total_plus_image = get_template_directory_uri() . '/images/portfolio-carousel.png';
                            }
                            ?>
                            <div class="ht-portfolio-carousel-item <?php echo esc_attr($category_slug); ?>">
                                <div class="ht-portfolio-carousel-wrap">
                                    <?php
                                    if ($show_link) {
                                        $total_plus_portfolio_link = get_permalink();
                                        $total_plus_external_link = rwmb_meta('external_link', get_the_ID());
                                        $total_plus_target = '_self';

                                        if ($total_plus_external_link) {
                                            $total_plus_portfolio_link = $total_plus_external_link;
                                            $total_plus_external_link_new_tab = rwmb_meta('external_link_new_tab', get_the_ID());
                                            $total_plus_target = $total_plus_external_link_new_tab ? '_blank' : '_self';
                                        }
                                    }
                                    ?>
                                    <div class="ht-portfolio-carousel-image-wrap">
                                        <?php if ($show_link) {
                                            ?>
                                            <a target="<?php echo esc_attr($total_plus_target); ?>" class="ht-portfolio-carousel-link" href="<?php echo esc_url($total_plus_portfolio_link); ?>">
                                            <?php } ?>
                                            <img src="<?php echo esc_url($total_plus_image[0]) ?>"/>
                                            <?php if ($show_link) { ?>
                                            </a>
                                        <?php } ?>

                                        <?php if (has_post_thumbnail() && $show_zoom) { ?>
                                            <a class="ht-portfolio-carousel-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($total_plus_image_large[0]) ?>"><i class="icofont-search-1"></i></a>
                                        <?php } ?>
                                    </div>
                                    <h5>
                                        <?php
                                        if ($show_link) {
                                            ?>
                                            <a target="<?php echo esc_attr($total_plus_target); ?>" class="ht-portfolio-carousel-link" href="<?php echo esc_url($total_plus_portfolio_link); ?>">
                                            <?php } ?>

                                            <?php the_title(); ?>
                                            <?php if ($show_link) { ?>
                                            </a>
                                        <?php } ?>
                                    </h5>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
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
