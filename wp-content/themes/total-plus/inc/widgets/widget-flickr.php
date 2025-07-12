<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_flickr');

function total_plus_register_flickr() {
    register_widget('total_plus_flickr');
}

class total_plus_flickr extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'total_plus_flickr', '&bull; TP : Flickr', array(
            'description' => __('A widget to display Flickr Images', 'total-plus')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // Title
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => esc_html__('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            // Other fields
            'api_key' => array(
                'total_plus_widgets_name' => 'api_key',
                'total_plus_widgets_title' => esc_html__('API Key', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'flickr_id' => array(
                'total_plus_widgets_name' => 'flickr_id',
                'total_plus_widgets_title' => esc_html__('Flickr ID', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'count' => array(
                'total_plus_widgets_name' => 'count',
                'total_plus_widgets_title' => esc_html__('Number of Images', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => '9'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => esc_html__('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'q' => esc_html__('Small Square Size', 'total-plus'),
                    't' => esc_html__('Thumbnail', 'total-plus'),
                    'n' => esc_html__('Small Size', 'total-plus'),
                    'z' => esc_html__('Medium Size', 'total-plus'),
                    'b' => esc_html__('Large Size', 'total-plus')
                ),
                'total_plus_widgets_default' => 'q'
            ),
            'enable_space' => array(
                'total_plus_widgets_name' => 'enable_space',
                'total_plus_widgets_title' => esc_html__('Enable Space Between Images', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'show_caption' => array(
                'total_plus_widgets_name' => 'show_caption',
                'total_plus_widgets_title' => esc_html__('Show Caption', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'row_height' => array(
                'total_plus_widgets_name' => 'row_height',
                'total_plus_widgets_title' => esc_html__('Row Height', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => 120,
                'total_plus_widgets_description' => esc_html__('The height determines the no of image in row', 'total-plus')
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

        $title = isset($instance['title']) ? apply_filters('title', $instance['title']) : '';
        $flickr_id = isset($instance['flickr_id']) ? $instance['flickr_id'] : '';
        $count = isset($instance['count']) ? $instance['count'] : '';
        $api_key = isset($instance['api_key']) ? $instance['api_key'] : '';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : '';
        $enable_space = (isset($instance['enable_space']) && $instance['enable_space']) ? 'enable-space' : '';
        $show_caption = (isset($instance['show_caption']) && $instance['show_caption']) ? 'true' : 'false';
        $margin = (isset($instance['enable_space']) && $instance['enable_space']) ? 10 : 0;
        $row_height = (isset($instance['row_height']) && $instance['row_height']) ? $instance['row_height'] : 120;

        echo $before_widget;

        // Show title
        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <div id="<?php echo esc_attr($widget_id); ?>wrapper" class="<?php echo $enable_space; ?>"></div>
        <script>
            jQuery(function ($) {
                $('#<?php echo esc_attr($widget_id); ?>wrapper').photostream({
                    api_key: '<?php echo $api_key; ?>',
                    user_id: '<?php echo $flickr_id; ?>',
                    image_size: '<?php echo $image_size; ?>',
                    image_count: '<?php echo $count; ?>',
                });

                $('#<?php echo esc_attr($widget_id); ?>wrapper').on('ps.complete', function () {
                    $(this).justifiedGallery({
                        rowHeight: <?php echo absint($row_height); ?>,
                        lastRow: 'nojustify',
                        captions: <?php echo $show_caption; ?>,
                        border: 0,
                        margins: <?php echo $margin; ?>
                    });
                });
            });
        </script>
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
