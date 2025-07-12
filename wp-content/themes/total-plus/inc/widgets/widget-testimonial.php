<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_testimonial');

function total_plus_register_testimonial() {
    register_widget('total_plus_testimonial');
}

class total_plus_testimonial extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Clients Tesimonials', 'total-plus'));
        //$control_ops = array('width' => 500, 'height' => 400);
        parent::__construct('total_plus_testimonial', '&bull; TP : Testimonial', $widget_ops);
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
            'image' => array(
                'total_plus_widgets_name' => 'image',
                'total_plus_widgets_title' => __('Clients Image', 'total-plus'),
                'total_plus_widgets_field_type' => 'upload'
            ),
            'designation' => array(
                'total_plus_widgets_name' => 'designation',
                'total_plus_widgets_title' => __('Designation', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'intro' => array(
                'total_plus_widgets_name' => 'intro',
                'total_plus_widgets_title' => __('Short Intro', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_row' => '4'
            ),
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Testimonial Block Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus')
                ),
                'total_plus_widgets_default' => 'style1'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
            ),
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
        $image = isset($instance['image']) ? $instance['image'] : '';
        $designation = isset($instance['designation']) ? $instance['designation'] : '';
        $intro = isset($instance['intro']) ? $instance['intro'] : '';
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';

        $image_url = $image;
        if ( $image_size != 'full' && !empty($image) ) {
            $image_id = attachment_url_to_postid($image);
            $image_array = wp_get_attachment_image_src($image_id, $image_size);
            $image_url = $image_array[0];
        }

        echo $before_widget;
        ?>
        <div class="ht-testimonial-widget <?php echo esc_attr($style); ?>">
            <?php
            if (!empty($image_url) && ( $style == 'style2' || $style == 'style4')) {
                ?>
                <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title); ?>">
                <?php
            }
            ?>
            <div class="ht-testimonial-excerpt">
                <?php
                if (!empty($intro)) {
                    echo wp_kses_post($intro);
                }
                ?>
            </div>

            <div class="ht-testimonial-footer">
                <?php
                if (!empty($image_url) && ( $style == 'style1' || $style == 'style3')) {
                    ?>
                    <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title); ?>">
                    <?php
                }
                ?>

                <div class="ht-testimonial-title">
                    <h5><?php echo esc_html($title); ?></h5>
                    <div class="designation"><?php echo esc_html($designation); ?></div>
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
            }else{
                $total_plus_widgets_field_value = '';
            }

            total_plus_widgets_show_widget_field($this, $widget_field, $total_plus_widgets_field_value);
        }
    }

}
