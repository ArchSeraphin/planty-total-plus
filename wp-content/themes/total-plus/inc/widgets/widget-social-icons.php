<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_social_icons');

function total_plus_register_social_icons() {
    register_widget('total_plus_social_icons');
}

class total_plus_social_icons extends WP_Widget {

    public function __construct() {
        parent::__construct('total_plus_social_icons', '&bull; TP : Social Icons', array(
            'description' => __('A widget to display Social Icons', 'total-plus')
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
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Square', 'total-plus'),
                    'style2' => __('Circle', 'total-plus'),
                    'style3' => __('Square Outline', 'total-plus'),
                    'style4' => __('Circle Outline', 'total-plus'),
                    'style5' => __('Rounded Corner', 'total-plus'),
                    'style6' => __('Rounded Corner With Circle', 'total-plus'),
                    'style7' => __('3D', 'total-plus')
                )
            ),
            'hover_effect' => array(
                'total_plus_widgets_name' => 'hover_effect',
                'total_plus_widgets_title' => __('Hover Effect', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'si-no-effect' => __('No Effect', 'total-plus'),
                    'si-fade-in' => __('Fade In', 'total-plus'),
                    'si-zoom' => __('Zoom', 'total-plus'),
                    'si-rotate' => __('Rotate', 'total-plus'),
                    'si-slide-up' => __('Slide Up', 'total-plus')
                )
            ),
            'align' => array(
                'total_plus_widgets_name' => 'align',
                'total_plus_widgets_title' => __('Alignment', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'left' => __('Left', 'total-plus'),
                    'center' => __('Center', 'total-plus'),
                    'right' => __('Right', 'total-plus')
                )
            ),
            'size' => array(
                'total_plus_widgets_name' => 'size',
                'total_plus_widgets_title' => __('Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'small' => __('Small', 'total-plus'),
                    'normal' => __('Normal', 'total-plus'),
                    'big' => __('Big', 'total-plus'),
                    'large' => __('Large', 'total-plus')
                )
            ),
            'bg-color' => array(
                'total_plus_widgets_name' => 'bg-color',
                'total_plus_widgets_title' => __('Icon Background Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_field_default' => '#FFFFFF'
            ),
            'icon-color' => array(
                'total_plus_widgets_name' => 'icon-color',
                'total_plus_widgets_title' => __('Icon Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_field_default' => '#333333'
            ),
            'items' => array(
                'total_plus_widgets_name' => 'items',
                'total_plus_widgets_title' => __('Icons Box', 'total-plus'),
                'total_plus_widgets_repeater_title' => __('Icons', 'total-plus'),
                'total_plus_widgets_field_type' => 'repeater',
                'total_plus_widgets_repeater_fields_title' => 'title',
                'total_plus_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Title', 'total-plus'),
                        'type' => 'text'
                    ),
                    'icon' => array(
                        'title' => __('Icon', 'total-plus'),
                        'type' => 'icon',
                        'icon_array' => total_plus_brand_icon_array()
                    ),
                    'url' => array(
                        'title' => __('URL', 'total-plus'),
                        'type' => 'text'
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
        $bg_color = isset($instance['bg-color']) ? $instance['bg-color'] : '#FFFFFF';
        $icon_color = isset($instance['icon-color']) ? $instance['icon-color'] : '#333333';
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $hover_effect = isset($instance['hover_effect']) ? $instance['hover_effect'] : 'si-no-effect';
        $size = isset($instance['size']) ? $instance['size'] : 'normal';
        $align = isset($instance['align']) ? $instance['align'] : 'center';
        $items = isset($instance['items']) ? $instance['items'] : '';
        $css_style = '';
        $css_styles = array();
        if (!empty($bg_color) && ($style == 'style1' || $style == 'style2' || $style == 'style5' || $style == 'style6' || $style == 'style7')) {
            $css_styles[] = "background-color:$bg_color";
        }

        if (!empty($icon_color)) {
            $css_styles[] = "color:$icon_color";
            $css_styles[] = "border-color:$icon_color";
        }

        if (!empty($css_styles)) {
            $css_style = 'style="' . implode(';', $css_styles) . '"';
        }

        $class = array(
            'ht-social-icons',
            $style,
            'icon-' . $size,
            'icon-' . $align,
            $hover_effect
        );

        if ($style == 'style5' || $style == 'style6' || $style == 'style7') {
            $class[] = 'rounded-corner';
        }

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
            <?php
            if (!empty($items)) {
                foreach ($items as $item) {
                    $title = $item['title'];
                    $icon = $item['icon'];
                    $url = $item['url'];
                    ?>
                    <a <?php echo $css_style; ?> class="ht-social-button" href="<?php echo esc_attr($url); ?>" title="<?php echo esc_attr($title); ?>" target="_blank">
                        <i class='<?php echo esc_attr($icon) ?>'></i>
                    </a>
                    <?php
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
