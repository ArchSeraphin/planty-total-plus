<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_contact_detail');

function total_plus_register_contact_detail() {
    register_widget('total_plus_contact_detail');
}

class total_plus_contact_detail extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Call To Action', 'total-plus'));
        $control_ops = array('width' => 400, 'height' => 400);
        parent::__construct('total_plus_contact_detail', '&bull; TP : Contact Detail', $widget_ops, $control_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $image_path = get_template_directory_uri();
        $fields = array(
            'ht_tab' => array(
                'total_plus_widgets_tabs' => array(
                    'ht-location' => __('Location', 'total-plus'),
                    'ht-phone' => __('Phone', 'total-plus'),
                    'ht-email' => __('Email', 'total-plus'),
                    'ht-style' => __('Style', 'total-plus')
                ),
                'total_plus_widgets_field_type' => 'tab'
            ),
            'tab_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content-wrap',
                'total_plus_widgets_field_type' => 'open'
            ),
            'location_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-location',
                'total_plus_widgets_field_type' => 'open'
            ),
            'location_icon' => array(
                'total_plus_widgets_name' => 'location_icon',
                'total_plus_widgets_title' => __('Icon', 'total-plus'),
                'total_plus_widgets_default' => 'fas fa-map-marker-alt',
                'total_plus_widgets_field_type' => 'icon'
            ),
            'location_main_text' => array(
                'total_plus_widgets_name' => 'location_main_text',
                'total_plus_widgets_title' => __('Main Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => __('Find Us', 'total-plus')
            ),
            'location_sub_text' => array(
                'total_plus_widgets_name' => 'location_sub_text',
                'total_plus_widgets_title' => __('Sub Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_default' => __('Arizona Park, Australia', 'total-plus')
            ),
            'location_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'phone_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-phone',
                'total_plus_widgets_field_type' => 'open'
            ),
            'phone_icon' => array(
                'total_plus_widgets_name' => 'phone_icon',
                'total_plus_widgets_title' => __('Icon', 'total-plus'),
                'total_plus_widgets_default' => 'fas fa-phone',
                'total_plus_widgets_field_type' => 'icon'
            ),
            'phone_main_text' => array(
                'total_plus_widgets_name' => 'phone_main_text',
                'total_plus_widgets_title' => __('Main Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => __('Ring Us', 'total-plus')
            ),
            'phone_sub_text' => array(
                'total_plus_widgets_name' => 'phone_sub_text',
                'total_plus_widgets_title' => __('Sub Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_default' => __('+61 45768202', 'total-plus')
            ),
            'phone_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'email_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-email',
                'total_plus_widgets_field_type' => 'open'
            ),
            'email_icon' => array(
                'total_plus_widgets_name' => 'email_icon',
                'total_plus_widgets_title' => __('Icon', 'total-plus'),
                'total_plus_widgets_default' => 'fas fa-envelope-open',
                'total_plus_widgets_field_type' => 'icon'
            ),
            'email_main_text' => array(
                'total_plus_widgets_name' => 'email_main_text',
                'total_plus_widgets_title' => __('Main Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => __('Mail Us', 'total-plus')
            ),
            'email_sub_text' => array(
                'total_plus_widgets_name' => 'email_sub_text',
                'total_plus_widgets_title' => __('Sub Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_default' => __('info@totalplus.com', 'total-plus')
            ),
            'email_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'style_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-style',
                'total_plus_widgets_field_type' => 'open'
            ),
            'ht_layout' => array(
                'total_plus_widgets_name' => 'ht_layout',
                'total_plus_widgets_title' => __('Contact Detail Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'selector',
                'total_plus_widgets_field_options' => array(
                    'style1' => $image_path . '/inc/widgets/images/contact-detail1.png',
                    'style2' => $image_path . '/inc/widgets/images/contact-detail2.png',
                    'style3' => $image_path . '/inc/widgets/images/contact-detail3.png'
                ),
                'total_plus_widgets_default' => 'style1'
            ),
            'icon_color' => array(
                'total_plus_widgets_name' => 'icon_color',
                'total_plus_widgets_title' => __('Icon Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
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
            'style_close' => array(
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

        $ht_layout = isset($instance['ht_layout']) ? $instance['ht_layout'] : '';
        $location_icon = isset($instance['location_icon']) ? $instance['location_icon'] : 'fa fa-map-marker';
        $location_main_text = isset($instance['location_main_text']) ? $instance['location_main_text'] : 'Find Us';
        $location_sub_text = isset($instance['location_sub_text']) ? $instance['location_sub_text'] : 'Arizona Park, Australia';
        $phone_icon = isset($instance['phone_icon']) ? $instance['phone_icon'] : 'fa fa-phone';
        $phone_main_text = isset($instance['phone_main_text']) ? $instance['phone_main_text'] : 'Ring Us';
        $phone_sub_text = isset($instance['phone_sub_text']) ? $instance['phone_sub_text'] : '+61 45768202';
        $email_icon = isset($instance['email_icon']) ? $instance['email_icon'] : 'fa fa-envelope-o';
        $email_main_text = isset($instance['email_main_text']) ? $instance['email_main_text'] : 'Mail Us';
        $email_sub_text = isset($instance['email_sub_text']) ? $instance['email_sub_text'] : 'info@totalplus.com';
        $icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $icon_style = $title_style = $text_style = '';

        if (!empty($icon_color)) {
            $icon_style = 'style="color:' . $icon_color . '"';
        }

        if (!empty($title_color)) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if (!empty($text_color)) {
            $text_style = 'style="color:' . $text_color . '"';
        }

        echo $before_widget;
        ?>
        <div class="ht-contact-box <?php echo esc_attr($ht_layout); ?>">
            <?php if (!empty($location_main_text) && !empty($location_sub_text)) { ?>
                <div class="ht-contact-field">
                    <i class="<?php echo esc_attr($location_icon); ?>" <?php echo $icon_style; ?>></i>
                    <div class="ht-contact-text">
                        <h6 <?php echo $title_style; ?>><?php echo esc_html($location_main_text); ?></h6>
                        <div <?php echo $text_style; ?>><?php echo wp_kses_post(wpautop($location_sub_text)); ?></div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($phone_main_text) && !empty($phone_sub_text)) { ?>
                <div class="ht-contact-field">
                    <i class="<?php echo esc_attr($phone_icon); ?>" <?php echo $icon_style; ?>></i>
                    <div class="ht-contact-text">
                        <h6 <?php echo $title_style; ?>><?php echo esc_html($phone_main_text); ?></h6>
                        <div <?php echo $text_style; ?>><?php echo wp_kses_post(wpautop($phone_sub_text)); ?></div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($email_main_text) || !empty($email_sub_text)) { ?>
                <div class="ht-contact-field">
                    <i class="<?php echo esc_attr($email_icon); ?>" <?php echo $icon_style; ?>></i>
                    <div class="ht-contact-text">
                        <h6 <?php echo $title_style; ?>><?php echo esc_html($email_main_text); ?></h6>
                        <div <?php echo $text_style; ?>><?php echo wp_kses_post(wpautop($email_sub_text)); ?></div>
                    </div>
                </div>
            <?php } ?>
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
