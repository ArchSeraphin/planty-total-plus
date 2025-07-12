<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_progressbar');

function total_plus_register_progressbar() {
    register_widget('total_plus_progressbar');
}

class total_plus_progressbar extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Progress Bar', 'total-plus'));
        parent::__construct('total_plus_progressbar', '&bull; TP : Progress Bar', $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'layout' => array(
                'total_plus_widgets_name' => 'layout',
                'total_plus_widgets_title' => __('Layout', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'ht-pb-style1' => __('Style 1', 'total-plus'),
                    'ht-pb-style2' => __('Style 2', 'total-plus'),
                    'ht-pb-style3' => __('Style 3', 'total-plus'),
                    'ht-pb-style4' => __('Style 4', 'total-plus')
                ),
                'total_plus_widgets_default' => 'ht-pb-style1'
            ),
            'bg-color' => array(
                'total_plus_widgets_name' => 'bg-color',
                'total_plus_widgets_title' => __('Progress Bar Background Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_default' => '#F6F6F6'
            ),
            'bar-color' => array(
                'total_plus_widgets_name' => 'bar-color',
                'total_plus_widgets_title' => __('Progress Bar Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_default' => '#FFC107'
            ),
            'label-color' => array(
                'total_plus_widgets_name' => 'label-color',
                'total_plus_widgets_title' => __('Progress Bar Label Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_default' => '#333333'
            ),
            'items' => array(
                'total_plus_widgets_name' => 'items',
                'total_plus_widgets_title' => __('Progress Bar Box', 'total-plus'),
                'total_plus_widgets_repeater_title' => __('Progress Bar', 'total-plus'),
                'total_plus_widgets_field_type' => 'repeater',
                'total_plus_widgets_repeater_fields_title' => 'title',
                'total_plus_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Progress Bar Label', 'total-plus'),
                        'type' => 'text'
                    ),
                    'percentage' => array(
                        'title' => __('Percentage', 'total-plus'),
                        'type' => 'text',
                        'desc' => __('Enter Value between 1 and 100', 'total-plus')
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
        $layout = isset($instance['layout']) ? $instance['layout'] : 'ht-pb-style1';
        $bg_color = isset($instance['bg-color']) ? $instance['bg-color'] : '#F6F6F6';
        $bar_color = isset($instance['bar-color']) ? $instance['bar-color'] : '#FFC107';
        $label_color = isset($instance['label-color']) ? $instance['label-color'] : '#333333';
        $items = isset($instance['items']) ? $instance['items'] : '';
        
        $check_luminance = ariColor::newColor($bar_color);
        $textcolor = ( 127 < $check_luminance->luminance ) ? '#222222' : '#FFFFFF';

        $span_bg = '';
        if($layout == 'ht-pb-style4'){
            $span_bg = 'style="color:' . esc_attr($textcolor) .'; background:' . esc_attr($bar_color) . '"';
        } elseif ($layout == 'ht-pb-style1') {
            $span_bg = 'style="color:' . esc_attr($label_color) . '"';
        }

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;

        if (!empty($items)) {
            foreach ($items as $item) {
                $progressbar_title = $item['title'];
                $progressbar_percentage = $item['percentage'];
                if ($progressbar_title || $progressbar_percentage) {
                    ?>
                    <div class="ht-progress <?php echo esc_attr($layout); ?>">
                        <h6 style="color:<?php echo esc_attr($label_color) ?>"><?php echo esc_html($progressbar_title); ?></h6>
                        <div class="ht-progress-bar" data-width="<?php echo absint($progressbar_percentage); ?>" style="background:<?php echo esc_attr($bg_color) ?>">
                            <div class="ht-progress-bar-length" style="background:<?php echo esc_attr($bar_color) ?>">
                                <span <?php echo $span_bg; ?>><?php echo absint($progressbar_percentage) . "%"; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }

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
