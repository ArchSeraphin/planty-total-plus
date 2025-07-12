<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_testimonial_slider');

function total_plus_register_testimonial_slider() {
    register_widget('total_plus_testimonial_slider');
}

class total_plus_testimonial_slider extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Clients Tesimonials In Slider', 'total-plus'));
        //$control_ops = array('width' => 500, 'height' => 400);
        parent::__construct('total_plus_testimonial_slider', '&bull; TP : Testimonial Slider', $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Name', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Layout', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus')
                ),
                'total_plus_widgets_field_default' => 'style1'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
            ),
            'items' => array(
                'total_plus_widgets_name' => 'items',
                'total_plus_widgets_title' => __('Testimonials Box', 'total-plus'),
                'total_plus_widgets_repeater_title' => __('Testimonial', 'total-plus'),
                'total_plus_widgets_field_type' => 'repeater',
                'total_plus_widgets_repeater_fields_title' => 'title',
                'total_plus_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Clients Name', 'total-plus'),
                        'type' => 'text'
                    ),
                    'image' => array(
                        'title' => __('Clients Image', 'total-plus'),
                        'type' => 'upload'
                    ),
                    'designation' => array(
                        'title' => __('Designation', 'total-plus'),
                        'type' => 'text'
                    ),
                    'intro' => array(
                        'title' => __('Short Intro', 'total-plus'),
                        'type' => 'textarea'
                    )
                ),
                'total_plus_widgets_add_button' => __('Add New', 'total-plus')
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
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $items = isset($instance['items']) ? $instance['items'] : '';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <div class="ht-testimonial-carousel-widget">
            <?php
            $testimonial_class = array(
                'ht-testimonial-wrap',
                'ht-clearfix',
                $style
            );

            if (!empty($items)) {
                ?>
                <div class="<?php echo esc_attr(implode(' ', $testimonial_class)) ?>">
                    <?php
                    if ($style == 'style1') {
                        ?>
                        <div class="ht-testimonial-slider owl-carousel">
                            <?php
                            foreach ($items as $item) {
                                $image = $item['image'];
                                $name = $item['title'];
                                $designation = $item['designation'];
                                $content = $item['intro'];
                                
                                $image_url = $image;
                                if ( $image_size != 'full' && !empty($image) ) {
                                    $image_id = attachment_url_to_postid($image);
                                    $image_array = wp_get_attachment_image_src($image_id, $image_size);
                                    $image_url = $image_array[0];
                                }
                                ?>
                                <div class="ht-testimonial">
                                    <div class="ht-testimonial-excerpt">
                                        <i class="icofont-quote-left"></i>
                                        <?php
                                        if (!empty($content)) {
                                            echo wp_kses_post($content);
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (!empty($image_url)) {
                                        ?>
                                        <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($name); ?>">
                                        <?php
                                    }
                                    ?>
                                    <h5><?php echo esc_html($name); ?></h5>
                                    <div class="designation"><?php echo esc_html($designation); ?></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    } elseif ($style == 'style2') {
                        ?>
                        <div class="ht-testimonial-image-wrap">
                            <?php
                            foreach ($items as $item) {
                                $image = $item['image'];
                                $name = $item['title'];
                                $image_url = $image;
                                if ( $image_size != 'full' && !empty($image) ) {
                                    $image_id = attachment_url_to_postid($image);
                                    $image_array = wp_get_attachment_image_src($image_id, $image_size);
                                    $image_url = $image_array[0];
                                }
                                ?>
                                <div class="ht-testimonial-image-slide">
                                    <?php if (!empty($image_url)) { ?>
                                        <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($name); ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="ht-testimonial-content-wrap">
                            <?php
                            foreach ($items as $item) {
                                $name = $item['title'];
                                $designation = $item['designation'];
                                $content = $item['intro'];
                                $image_url = $image;
                                if ( $image_size != 'full' && !empty($image) ) {
                                    $image_id = attachment_url_to_postid($image);
                                    $image_array = wp_get_attachment_image_src($image_id, $image_size);
                                    $image_url = $image_array[0];
                                }
                                ?>
                                <div class="ht-testimonial">
                                    <div class="ht-testimonial-excerpt">
                                        <?php
                                        if (!empty($content)) {
                                            echo wp_kses_post($content);
                                        }
                                        ?>
                                    </div>
                                    <h5><?php echo esc_html($name); ?></h5>
                                    <div class="designation"><?php echo esc_html($designation); ?></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php }
                    ?>
                </div>
                <?php
            }
            ?>
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
            }else{
                $total_plus_widgets_field_value = '';
            }

            total_plus_widgets_show_widget_field($this, $widget_field, $total_plus_widgets_field_value);
        }
    }

}
