<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_icon_text');

function total_plus_register_icon_text() {
    register_widget('total_plus_icon_text');
}

class total_plus_icon_text extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Text with Icon', 'total-plus'));
        $control_ops = array('width' => 400, 'height' => 400);
        parent::__construct('total_plus_icon_text', '&bull; TP : Icon Text', $widget_ops, $control_ops);
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
            'icon' => array(
                'total_plus_widgets_name' => 'icon',
                'total_plus_widgets_title' => __('Icon', 'total-plus'),
                'total_plus_widgets_field_type' => 'icon',
                'total_plus_widgets_default' => 'fas fa-address-book'
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'text' => array(
                'total_plus_widgets_name' => 'text',
                'total_plus_widgets_title' => __('Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'inline_editor',
                'total_plus_widgets_row' => '4'
            ),
            'button_text' => array(
                'total_plus_widgets_name' => 'button_text',
                'total_plus_widgets_title' => __('Button Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => __('Read More', 'total-plus')
            ),
            'button_link' => array(
                'total_plus_widgets_name' => 'button_link',
                'total_plus_widgets_title' => __('Button Link', 'total-plus'),
                'total_plus_widgets_field_type' => 'url'
            ),
            'input_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-settings',
                'total_plus_widgets_field_type' => 'open'
            ),
            'title_html_tag' => array(
                'total_plus_widgets_name' => 'title_html_tag',
                'total_plus_widgets_title' => __('Title HTMl Tag', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p'
                ),
                'total_plus_widgets_default' => 'h5'
            ),
            'icon_position' => array(
                'total_plus_widgets_name' => 'icon_position',
                'total_plus_widgets_title' => __('Icon Position', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'top' => __('Top', 'total-plus'),
                    'left' => __('Left', 'total-plus'),
                    'right' => __('Right', 'total-plus')
                ),
                'total_plus_widgets_default' => 'h5'
            ),
            'icon_style' => array(
                'total_plus_widgets_name' => 'icon_style',
                'total_plus_widgets_title' => __('Icon Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'default' => __('Default', 'total-plus'),
                    'circle' => __('Circle Line', 'total-plus'),
                    'square' => __('Square Line', 'total-plus'),
                    'circle-bg' => __('Circle Background', 'total-plus'),
                    'square-bg' => __('Square Background', 'total-plus')
                ),
                'total_plus_widgets_default' => 'default'
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
                'total_plus_widgets_title' => __('Short Text Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
            ),
            'link_color' => array(
                'total_plus_widgets_name' => 'link_color',
                'total_plus_widgets_title' => __('Link Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color'
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

        $icon = isset($instance['icon']) ? $instance['icon'] : 'icofont-angry-monster';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $text = isset($instance['text']) ? $instance['text'] : '';
        $name = isset($instance['name']) ? $instance['name'] : '';
        $button_link = isset($instance['button_link']) ? $instance['button_link'] : '';
        $button_text = isset($instance['button_text']) ? $instance['button_text'] : esc_html__('Read More', 'total-plus');
        $title_html_tag = isset($instance['title_html_tag']) ? $instance['title_html_tag'] : 'h5';
        $icon_position = isset($instance['icon_position']) ? $instance['icon_position'] : 'left';
        $icon_style = isset($instance['icon_style']) ? $instance['icon_style'] : 'default';
        $icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '#333333';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '#333333';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '#333333';
        $link_color = isset($instance['link_color']) ? $instance['link_color'] : '#333333';
        $class = 'ht-it-pos-' . $icon_position . ' ht-it-style-' . $icon_style;
        $check_luminance = ariColor::newColor($icon_color);
        $textcolor = ( 127 < $check_luminance->luminance ) ? '#222222' : '#FFFFFF';
        $style = array();

        if ($icon_style == 'default') {
            $style[] = "color:$icon_color";
        }

        if ($icon_style == 'circle' || $icon_style == 'square') {
            $style[] = "border-color:$icon_color";
            $style[] = "color:$icon_color";
        }

        if ($icon_style == 'circle-bg' || $icon_style == 'square-bg') {
            $style[] = "background-color:$icon_color";
            $style[] = "border-color:$icon_color";
            $style[] = "color:$textcolor";
        }

        echo $before_widget;
        ?>
        <div class="ht-icon-text <?php echo esc_attr($class); ?>">
            <?php
            if (!empty($icon)):
                ?>
                <i class="<?php echo esc_attr($icon); ?>" style="<?php echo implode(';', $style); ?>"></i>
                <?php
            endif;
            ?>

            <div class="ht-it-content">
                <?php
                if (!empty($title)):
                    ?>
                    <<?php echo $title_html_tag; ?> class="ht-it-title" style="color:<?php echo $title_color; ?>"><?php echo wp_kses_post($title); ?></<?php echo $title_html_tag; ?>>
                    <?php
                endif;

                if (!empty($text)):
                    ?>
                    <div class="ht-it-excerpt" style="color:<?php echo $text_color; ?>"><?php echo wp_kses_post(wpautop($text)); ?></div>
                    <?php
                endif;

                if (!empty($button_link)):
                    echo '<div class="ht-it-readmore">';
                    echo '<a href="' . esc_url($button_link) . '" style="color:' . $link_color . '">' . esc_html($button_text) . '<i class="mdi mdi-arrow-right"></i></a>';
                    echo '</div>';
                endif;
                ?>
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
