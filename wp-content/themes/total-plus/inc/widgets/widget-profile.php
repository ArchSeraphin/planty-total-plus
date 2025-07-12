<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_profile');

function total_plus_register_profile() {
    register_widget('total_plus_profile');
}

class total_plus_profile extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Personal/Company Information', 'total-plus'));
        //$control_ops = array('width' => 500, 'height' => 400);
        parent::__construct('total_plus_profile', '&bull; TP : Profile', $widget_ops);
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
            'image' => array(
                'total_plus_widgets_name' => 'image',
                'total_plus_widgets_title' => __('Image', 'total-plus'),
                'total_plus_widgets_field_type' => 'upload'
            ),
            'intro' => array(
                'total_plus_widgets_name' => 'intro',
                'total_plus_widgets_title' => __('Short Intro', 'total-plus'),
                'total_plus_widgets_field_type' => 'inline_editor',
                'total_plus_widgets_row' => '4'
            ),
            'name' => array(
                'total_plus_widgets_name' => 'name',
                'total_plus_widgets_title' => __('Name', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'readmore_text' => array(
                'total_plus_widgets_name' => 'readmore_text',
                'total_plus_widgets_title' => __('Read More Text', 'total-plus'),
                'total_plus_widgets_default' => __('Read More', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'readmore_link' => array(
                'total_plus_widgets_name' => 'readmore_link',
                'total_plus_widgets_title' => __('Read More Link', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'alignment' => array(
                'total_plus_widgets_name' => 'alignment',
                'total_plus_widgets_title' => __('Content Alignment', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'left' => __('Left', 'total-plus'),
                    'center' => __('Center', 'total-plus'),
                    'right' => __('Right', 'total-plus'),
                ),
                'total_plus_widgets_field_default' => 'left'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
            ),
            'round_image' => array(
                'total_plus_widgets_name' => 'round_image',
                'total_plus_widgets_title' => __('Round Image (Upload or Choose Square Image size)', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox',
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
            'link_color' => array(
                'total_plus_widgets_name' => 'link_color',
                'total_plus_widgets_title' => __('Read More Link Color', 'total-plus'),
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
        $image = isset($instance['image']) ? $instance['image'] : '';
        $intro = isset($instance['intro']) ? $instance['intro'] : '';
        $name = isset($instance['name']) ? $instance['name'] : '';
        $alignment = isset($instance['alignment']) ? $instance['alignment'] : 'left';
        $readmore_link = isset($instance['readmore_link']) ? $instance['readmore_link'] : '';
        $readmore_text = isset($instance['readmore_text']) ? $instance['readmore_text'] : esc_html__('Read More', 'total-plus');
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $link_color = isset($instance['link_color']) ? $instance['link_color'] : '';
        $background_color = isset($instance['background_color']) ? $instance['background_color'] : '';
        $padding = isset($instance['padding']) ? $instance['padding'] : '';
        $round_image = (isset($instance['round_image']) && $instance['round_image']) ? ' ht-round-image' : '';

        $title_style = $text_style = $link_style = $wrap_style = '';
        $wrap_css = array();

        if (!empty($title_color)) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if (!empty($text_color)) {
            $text_style = 'style="color:' . $text_color . '"';
        }

        if (!empty($link_color)) {
            $link_style = 'style="color:' . $link_color . '"';
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

        $image_url = $image;
        if ($image_size != 'full' && !empty($image)) {
            $image_id = attachment_url_to_postid($image);
            $image_array = wp_get_attachment_image_src($image_id, $image_size);
            $image_url = $image_array[0];
        }

        echo $before_widget;
        echo '<style>.ht-sidebar-style1 .widget-area #' . $widget_id . ' .widget-title:after{background-color:' . $title_color . '}.ht-sidebar-style3 .widget-area #' . $widget_id . ' .widget-title{border-left-color:' . $title_color . '</style>';
        ?>
        <div class="ht-personal-info ht-pi-<?php echo esc_attr($alignment); ?>" <?php echo $wrap_style; ?>>

            <?php
            if (!empty($title)):
                echo $before_title . '<span '.$title_style.'>' . apply_filters('widget_title', $title) . '</span>'. $after_title;
            endif;

            if (!empty($image_url)):
                echo '<div class="ht-pi-image'.$round_image.'"><img alt="' . esc_html($title) . '" src="' . esc_url($image_url) . '"/></div>';
            endif;

            if (!empty($name)):
                echo '<div class="ht-pi-name"><h5 ' . $text_style . '>' . esc_html($name) . '</h5></div>';
            endif;

            if (!empty($intro)):
                echo '<div class="ht-pi-intro" ' . $text_style . '>' . wp_kses_post(wpautop($intro)) . '</div>';
            endif;

            if (!empty($readmore_link)):
                echo '<div class="ht-pi-readmore">';
                echo '<a href="' . esc_url($readmore_link) . '" ' . $link_style . '>' . esc_html($readmore_text) . '<i class="mdi mdi-arrow-right"></i></a>';
                echo '</div>';
            endif;
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
