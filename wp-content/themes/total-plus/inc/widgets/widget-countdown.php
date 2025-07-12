<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_countdown');

function total_plus_register_countdown() {
    register_widget('total_plus_countdown');
}

class total_plus_countdown extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Countdown', 'total-plus'));
        $control_ops = array('width' => 400, 'height' => 400);
        parent::__construct('total_plus_countdown', '&bull; TP : Countdown', $widget_ops, $control_ops);
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
                'total_plus_widgets_class' => 'ht-widget-tab-content ht-flex-wrap',
                'total_plus_widgets_data_id' => 'ht-input',
                'total_plus_widgets_field_type' => 'open'
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'date' => array(
                'total_plus_widgets_name' => 'date',
                'total_plus_widgets_title' => __('Countdown Date', 'total-plus'),
                'total_plus_widgets_field_type' => 'datepicker'
            ),
            'days' => array(
                'total_plus_widgets_name' => 'days',
                'total_plus_widgets_title' => __('Days Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => esc_html__('Days', 'total-plus'),
                'total_plus_widgets_class' => 'ht-col6'
            ),
            'hours' => array(
                'total_plus_widgets_name' => 'hours',
                'total_plus_widgets_title' => __('Hours Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => esc_html__('Hours', 'total-plus'),
                'total_plus_widgets_class' => 'ht-col6'
            ),
            'minutes' => array(
                'total_plus_widgets_name' => 'minutes',
                'total_plus_widgets_title' => __('Minutes Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => esc_html__('Minutes', 'total-plus'),
                'total_plus_widgets_class' => 'ht-col6'
            ),
            'seconds' => array(
                'total_plus_widgets_name' => 'seconds',
                'total_plus_widgets_title' => __('Seconds Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => esc_html__('Seconds', 'total-plus'),
                'total_plus_widgets_class' => 'ht-col6'
            ),
            'input_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content ht-flex-wrap',
                'total_plus_widgets_data_id' => 'ht-settings',
                'total_plus_widgets_field_type' => 'open'
            ),
            'text-color' => array(
                'total_plus_widgets_name' => 'text-color',
                'total_plus_widgets_title' => __('Text Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_default' => '#333333'
            ),
            'background-color' => array(
                'total_plus_widgets_name' => 'background-color',
                'total_plus_widgets_title' => __('Background Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_description' => __('Leave Blank if you don\'t want to apply it.', 'total-plus'),
            ),
            'border-color' => array(
                'total_plus_widgets_name' => 'border-color',
                'total_plus_widgets_title' => __('Border Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_description' => __('Leave Blank if you don\'t want to apply it.', 'total-plus')
            ),
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Counter Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'block' => __('Block', 'total-plus'),
                    'border-block' => __('Top Bordered Block', 'total-plus'),
                    'circular' => __('Circular', 'total-plus'),
                    'diamond' => __('Diamond', 'total-plus')
                ),
                'total_plus_widgets_default' => 'block'
            ),
            'shadow' => array(
                'total_plus_widgets_name' => 'shadow',
                'total_plus_widgets_title' => __('Enable Shadow', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
                'total_plus_widgets_default' => true
            ),
            'num-size' => array(
                'total_plus_widgets_name' => 'num-size',
                'total_plus_widgets_title' => __('Number Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => '62',
                'total_plus_widgets_class' => 'ht-col6',
                'total_plus_widgets_description' => __('in px', 'total-plus')
            ),
            'text-size' => array(
                'total_plus_widgets_name' => 'text-size',
                'total_plus_widgets_title' => __('Text Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => '16',
                'total_plus_widgets_class' => 'ht-col6',
                'total_plus_widgets_description' => __('in px', 'total-plus')
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
        
        $class = array();
        $title = isset($instance['title']) ? $instance['title'] : '';
        $date = isset($instance['date']) ? $instance['date'] : '';
        $days = isset($instance['days']) ? $instance['days'] : esc_html__('Days', 'total-plus');
        $hours = isset($instance['hours']) ? $instance['hours'] : esc_html__('Hours', 'total-plus');
        $minutes = isset($instance['minutes']) ? $instance['minutes'] : esc_html__('Minutes', 'total-plus');
        $seconds = isset($instance['seconds']) ? $instance['seconds'] : esc_html__('Seconds', 'total-plus');
        $bg_color = isset($instance['background-color']) ? $instance['background-color'] : '';
        $text_color = isset($instance['text-color']) ? $instance['text-color'] : '#333333';
        $border_color = isset($instance['border-color']) ? $instance['border-color'] : '';
        $class[] = isset($instance['style']) ? $instance['style'] : 'block';
        $class[] = (isset($instance['shadow']) && ($instance['shadow'] == true) ) ? 'ht-enable-shadow' : '';
        $num_size = isset($instance['num-size']) ? $instance['num-size'] : '62';
        $text_size = isset($instance['text-size']) ? $instance['text-size'] : '16';
        $classes = implode(' ', $class);

        $css_array = array();
        $css = $num_style = '';

        if ($bg_color) {
            $css_array[] = "background:$bg_color";
        }

        if ($text_color) {
            $css_array[] = "color:$text_color";
        }

        if ($border_color) {
            $css_array[] = "border-color:$border_color";
        }

        if ($num_size) {
            $css_array[] = "font-size:{$num_size}px";
        }

        if ($text_size) {
            $text_size = 'style="font-size:' . $text_size . 'px"';
        }

        if ($css_array) {
            $css = 'style="' . implode(';', $css_array) . '"';
        }

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <div class="ht-countdown <?php echo $classes; ?>" id="<?php echo $widget_id ?>-wrap"></div>
        <script>
            jQuery(function ($) {
                $('#<?php echo $widget_id ?>-wrap').countdown('<?php echo $date; ?>', function (event) {
                    var $this = $(this).html(event.strftime(''
                            + '<div <?php echo $css; ?>><div>%D<label <?php echo $text_size; ?>><?php echo $days; ?></label> </div></div>'
                            + '<div <?php echo $css; ?>><div>%H<label <?php echo $text_size; ?>><?php echo $hours; ?></label> </div></div>'
                            + '<div <?php echo $css; ?>><div>%M<label <?php echo $text_size; ?>><?php echo $minutes; ?></label> </div></div>'
                            + '<div <?php echo $css; ?>><div>%S<label <?php echo $text_size; ?>><?php echo $seconds; ?></label> </div></div>'));
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
