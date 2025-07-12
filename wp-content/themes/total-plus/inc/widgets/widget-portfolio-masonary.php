<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_portfolio_masonary');

function total_plus_register_portfolio_masonary() {
    register_widget('total_plus_portfolio_masonary');
}

class total_plus_portfolio_masonary extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_portfolio_masonary', '&bull; TP : Portfolio Masonary', array(
            'description' => __('A widget to display portfolio in masonary', 'total-plus')
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
            'all' => array(
                'total_plus_widgets_name' => 'all',
                'total_plus_widgets_title' => __('Show All Tab', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'active_category' => array(
                'total_plus_widgets_name' => 'active_category',
                'total_plus_widgets_title' => __('Active Category', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => $total_plus_portfolio_cat_all
            ),
            'tab_style' => array(
                'total_plus_widgets_name' => 'tab_style',
                'total_plus_widgets_title' => __('Tab Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus')
                ),
                'total_plus_widgets_default' => 'style1'
            ),
            'portfolio_style' => array(
                'total_plus_widgets_name' => 'portfolio_style',
                'total_plus_widgets_title' => __('Portfolio Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus'),
                    'style5' => __('Style 5', 'total-plus'),
                    'style6' => __('Style 6', 'total-plus')
                ),
                'total_plus_widgets_default' => 'style1'
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
            'show_tab' => array(
                'total_plus_widgets_name' => 'show_tab',
                'total_plus_widgets_title' => __('Show Category Tabs', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
                'total_plus_widgets_default' => '1'
            ),
            'gap' => array(
                'total_plus_widgets_name' => 'gap',
                'total_plus_widgets_title' => __('Gap Between Images', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
                'total_plus_widgets_default' => '1'
            ),
            'show_zoom' => array(
                'total_plus_widgets_name' => 'show_zoom',
                'total_plus_widgets_title' => __('Show Zoom Button on Image Hover', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
                'total_plus_widgets_default' => '1'
            ),
            'show_link' => array(
                'total_plus_widgets_name' => 'show_link',
                'total_plus_widgets_title' => __('Show Link Button on Image Hover', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
                'total_plus_widgets_default' => '1'
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
        $tab_style = isset($instance['tab_style']) ? $instance['tab_style'] : 'style1';
        $portfolio_style = isset($instance['portfolio_style']) ? $instance['portfolio_style'] : 'style1';
        $orderby = isset($instance['portfolio_orderby']) ? $instance['portfolio_orderby'] : 'date';
        $order = isset($instance['portfolio_order']) ? $instance['portfolio_order'] : 'DESC';
        $show_tab = isset($instance['show_tab']) ? $instance['show_tab'] : '';
        $gap = (isset($instance['gap']) && $instance['gap']) ? '1' : '';
        $show_zoom = (isset($instance['show_zoom']) && $instance['show_zoom'] ) ? $instance['show_zoom'] : '';
        $show_link = (isset($instance['show_link']) && $instance['show_link']) ? $instance['show_link'] : '';

        echo $before_widget;
        ?>
        <div class="ht-portfolio-masonary">
            <?php
            if (!empty($title)):
                echo $before_title . apply_filters('widget_title', $title) . $after_title;
            endif;
            ?>

            <div class="ht-portfolio-masonary-wrap">
                <?php
                $total_active_tab = ($active_category == '*') ? '*' : '.total-portfolio-' . $active_category;

                if ($category && $show_tab) {
                    $total_plus_portfolio_cat_array = array_keys($category);
                    ?>
                    <div class="ht-portfolio-cat-name-list <?php echo $tab_style; ?>">
                        <div class="ht-portfolio-switch">
                            <i class="flaticon-menu-4"></i>
                        </div>

                        <div class="ht-portfolio-cat-wrap" data-active="<?php echo $total_active_tab; ?>">
                            <?php if ($all) { ?>
                                <div class="ht-portfolio-cat-name" data-filter="*">
                                    <?php _e('All', 'total-plus'); ?>
                                </div>
                                <?php
                            }

                            foreach ($total_plus_portfolio_cat_array as $total_plus_portfolio_cat_single) {
                                $category_slug = "";
                                $category_slug = '.total-portfolio-' . $total_plus_portfolio_cat_single;
                                $term = get_term($total_plus_portfolio_cat_single, 'portfolio_type');
                                if (!empty($term) && !is_wp_error($term)) {
                                    $term_name = esc_html($term->name);
                                    ?>
                                    <div class="ht-portfolio-cat-name" data-filter="<?php echo esc_attr($category_slug); ?>">
                                        <?php echo esc_html($term_name); ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="ht-portfolio-post-wrap <?php echo esc_attr($portfolio_style); ?>" data-gutter="<?php echo $gap; ?>">
                    <div class="ht-portfolio-posts">
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
                                        $total_plus_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-600x600');
                                        $total_plus_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                    } else {
                                        $total_plus_image = "";
                                    }
                                    ?>
                                    <div class="ht-portfolio <?php echo esc_attr($category_slug); ?>">
                                        <div class="ht-portfolio-outer-wrap">
                                            <div class="ht-portfolio-wrap" style="background-image: url(<?php echo esc_url($total_plus_image[0]) ?>);">
                                                <div class="ht-portfolio-caption">
                                                    <h5><?php the_title(); ?></h5>

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
                                                        ?>
                                                        <a target="<?php echo esc_attr($total_plus_target); ?>" class="ht-portfolio-link" href="<?php echo esc_url($total_plus_portfolio_link); ?>"><i class="icofont-link"></i></a>
                                                    <?php } ?>

                                                    <?php if (has_post_thumbnail() && $show_zoom) { ?>
                                                        <a class="ht-portfolio-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($total_plus_image_large[0]) ?>"><i class="icofont-search-1"></i></a>
                                                        <?php } ?>
                                                </div>
                                            </div>
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
