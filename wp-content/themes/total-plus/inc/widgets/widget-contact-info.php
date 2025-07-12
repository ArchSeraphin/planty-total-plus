<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_contact_info');

function total_plus_register_contact_info() {
    register_widget('total_plus_contact_info');
}

class total_plus_contact_info extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_contact_info', '&bull; TP : Contact Info', array(
            'description' => __('A widget to display Contact Information', 'total-plus')
                )
        );
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
            'phone' => array(
                'total_plus_widgets_name' => 'phone',
                'total_plus_widgets_title' => __('Phone', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'contact_info_email' => array(
                'total_plus_widgets_name' => 'email',
                'total_plus_widgets_title' => __('Email', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'website' => array(
                'total_plus_widgets_name' => 'website',
                'total_plus_widgets_title' => __('Website', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'address' => array(
                'total_plus_widgets_name' => 'address',
                'total_plus_widgets_title' => __('Contact Address', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_row' => '4'
            ),
            'time' => array(
                'total_plus_widgets_name' => 'time',
                'total_plus_widgets_title' => __('Contact Time', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_row' => '3'
            ),
            'input_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-settings',
                'total_plus_widgets_field_type' => 'open'
            ),
            'title_color' => array(
                'total_plus_widgets_name' => 'title_color',
                'total_plus_widgets_title' => __('Title Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'text_color' => array(
                'total_plus_widgets_name' => 'text_color',
                'total_plus_widgets_title' => __('Text Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'icon_color' => array(
                'total_plus_widgets_name' => 'icon_color',
                'total_plus_widgets_title' => __('Icon Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'background_color' => array(
                'total_plus_widgets_name' => 'background_color',
                'total_plus_widgets_title' => __('Background Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'padding' => array(
                'total_plus_widgets_name' => 'padding',
                'total_plus_widgets_title' => __('Padding', 'total-plus'),
                'total_plus_widgets_field_type' => 'number'
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
        $phone = isset($instance['phone']) ? $instance['phone'] : '';
        $email = isset($instance['email']) ? $instance['email'] : '';
        $website = isset($instance['website']) ? $instance['website'] : '';
        $address = isset($instance['address']) ? $instance['address'] : '';
        $time = isset($instance['time']) ? $instance['time'] : '';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
        $background_color = isset($instance['background_color']) ? $instance['background_color'] : '';
        $padding = isset($instance['padding']) ? $instance['padding'] : '';

        $title_style = $text_style = $icon_style = $wrap_style = '';
        $wrap_css = array();

        if (!empty($title_color)) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if (!empty($text_color)) {
            $text_style = 'style="color:' . $text_color . '"';
        }

        if (!empty($icon_color)) {
            $icon_style = 'style="color:' . $icon_color . '"';
        }

        if (!empty($background_color)) {
            $wrap_css[] = "background-color:$background_color";
        }

        if (!empty($padding)) {
            $wrap_css[] = "padding:" . $padding . "px";
        }

        if (!empty($wrap_css)) {
            $wrap_style = 'style="' . implode(';', $wrap_css) . '"';
        }

        echo $before_widget;
        ?>
        <div class="ht-contact-info" <?php echo $wrap_style; ?>>

            <?php
            echo '<style>.ht-sidebar-style1 .widget-area #' . $widget_id . ' .widget-title:after{background-color:' . $title_color . '}.ht-sidebar-style3 .widget-area #' . $widget_id . ' .widget-title{border-left-color:' . $title_color . '</style>';
            if (!empty($title)):
                echo $before_title . '<span ' . $title_style . '>' . apply_filters('widget_title', $title) . '</span>' . $after_title;
            endif;
            ?>

            <ul <?php echo $text_style; ?>>
                <?php if (!empty($phone)): ?>
                    <li><i class="icofont-phone" <?php echo $icon_style; ?>></i><?php echo wp_kses_post($phone); ?></li>
                <?php endif; ?>

                <?php if (!empty($email)): ?>
                    <li><i class="icofont-envelope" <?php echo $icon_style; ?>></i><?php echo wp_kses_post($email); ?></li>
                <?php endif; ?>

                <?php if (!empty($website)): ?>
                    <li><i class="icofont-globe-alt" <?php echo $icon_style; ?>></i><?php echo wp_kses_post($website); ?></li>
                <?php endif; ?>

                <?php if (!empty($address)): ?>
                    <li><i class="icofont-address-book" <?php echo $icon_style; ?>></i><?php echo wpautop(esc_html($address)); ?></li>
                <?php endif; ?>

                <?php if (!empty($time)): ?>
                    <li><i class="icofont-clock-time" <?php echo $icon_style; ?>></i><?php echo wpautop(esc_html($time)); ?></li>
                    <?php endif; ?>
            </ul>
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
