<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_accordian');

function total_plus_register_accordian() {
    register_widget('total_plus_accordian');
}

class total_plus_accordian extends WP_Widget {

    public function __construct() {
        parent::__construct('total_plus_accordian', '&bull; TP : Accordian', array(
            'description' => __('A widget to display Accordian', 'total-plus')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $image_path = get_template_directory_uri();
        $fields = array(
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'layout' => array(
                'total_plus_widgets_name' => 'layout',
                'total_plus_widgets_title' => __('Accordian Layout', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'ht-style1-accordion' => __('Style 1', 'total-plus'),
                    'ht-style2-accordion' => __('Style 2', 'total-plus')
                )
            ),
            'items' => array(
                'total_plus_widgets_name' => 'items',
                'total_plus_widgets_title' => __('Accordian Box', 'total-plus'),
                'total_plus_widgets_repeater_title' => __('Accordian', 'total-plus'),
                'total_plus_widgets_field_type' => 'repeater',
                'total_plus_widgets_repeater_fields_title' => 'title',
                'total_plus_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Accordian Title', 'total-plus'),
                        'type' => 'text'
                    ),
                    'content' => array(
                        'title' => __('Accordian Content', 'total-plus'),
                        'type' => 'editor'
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
        $items = isset($instance['items']) ? $instance['items'] : '';
        $layout = isset($instance['layout']) ? $instance['layout'] : 'ht-style1-accordion';

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <div class="ht-accordion <?php echo esc_attr($layout); ?>" data-accordion-group>
            <?php
            if (!empty($items)) {
                $i = 0;
                foreach ($items as $item) {
                    $accordion_open = ($i == 0) ? ' open' : '';
                    ?>
                    <div class="ht-accordion-box<?php echo esc_attr($accordion_open); ?>" data-accordion>
                        <div class="ht-accordion-header" data-control>
                            <?php echo esc_html($item['title']); ?>
                        </div>

                        <div class="ht-accordion-content" data-content>
                            <div class="ht-accordion-content-wrap ht-clearfix">
                                <?php echo wp_kses_post(wpautop($item['content'])); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
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
