<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_tabs');

function total_plus_register_tabs() {
    register_widget('total_plus_tabs');
}

class total_plus_tabs extends WP_Widget {

    public function __construct() {
        parent::__construct('total_plus_tabs', '&bull; TP : Tabs', array(
            'description' => __('A widget to display Tabs', 'total-plus')
                )
        );
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
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Tabs Layout', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus'),
                    'style5' => __('Style 5', 'total-plus')
                )
            ),
            'items' => array(
                'total_plus_widgets_name' => 'items',
                'total_plus_widgets_title' => __('Tabs Box', 'total-plus'),
                'total_plus_widgets_repeater_title' => __('Tabs', 'total-plus'),
                'total_plus_widgets_field_type' => 'repeater',
                'total_plus_widgets_repeater_fields_title' => 'title',
                'total_plus_widgets_repeater_fields' => array(
                    'icon' => array(
                        'title' => __('Icon', 'total-plus'),
                        'type' => 'icon'
                    ),
                    'title' => array(
                        'title' => __('Tabs Title', 'total-plus'),
                        'type' => 'text'
                    ),
                    'content' => array(
                        'title' => __('Tabs Content', 'total-plus'),
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
        $style = isset($instance['style']) ? $instance['style'] : 'style1';

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>

        <?php if (!empty($items)) { ?>
            <div class="ht-tab-wrap ht-clearfix <?php echo esc_attr($style); ?>">
                <div class="ht-tabs">
                    <?php
                    $i = 0;
                    $tab_array = array();
                    foreach ($items as $item) {
                        $tab_array[$i] = rand();
                        $tab_id = 'ht-tab-' . $tab_array[$i];
                        ?>
                        <div class="ht-tab" id="<?php echo $tab_id ?>">
                            <i class="<?php echo esc_html($item['icon']); ?>"></i>
                            <span><?php echo esc_html($item['title']); ?></span>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>

                <div class="ht-tab-content">
                    <?php
                    $i = 0;
                    foreach ($items as $item) {
                        $tab_content = 'ht-content-' . $tab_array[$i];
                        ?>
                        <div class="ht-content" id="<?php echo $tab_content; ?>">
                            <?php echo wp_kses_post(wpautop($item['content'])); ?>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
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
