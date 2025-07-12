<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_counter');

function total_plus_register_counter() {
    register_widget('total_plus_counter');
}

class total_plus_counter extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_counter', '&bull; TP : Counter', array(
            'description' => __('A widget to display Counter', 'total-plus')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'icon' => array(
                'total_plus_widgets_name' => 'icon',
                'total_plus_widgets_title' => __('Icon', 'total-plus'),
                'total_plus_widgets_field_type' => 'icon',
                'total_plus_widgets_default' => 'fas fa-address-book',
            ),
            'prefix' => array(
                'total_plus_widgets_name' => 'prefix',
                'total_plus_widgets_title' => __('Prefix', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_description' => __('Text that displays before counter', 'total-plus')
            ),
            'count' => array(
                'total_plus_widgets_name' => 'count',
                'total_plus_widgets_title' => __('Count Value', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_description' => __('Add only Digits', 'total-plus')
            ),
            'suffix' => array(
                'total_plus_widgets_name' => 'suffix',
                'total_plus_widgets_title' => __('Suffix', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_description' => __('Text that displays after counter', 'total-plus')
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'counter-color' => array(
                'total_plus_widgets_name' => 'counter-color',
                'total_plus_widgets_title' => __('Color', 'total-plus'),
                'total_plus_widgets_field_type' => 'color',
                'total_plus_widgets_default' => '#333333'
            ),
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Counter Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus')
                ),
                'total_plus_widgets_default' => 'style1'
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

        $icon = isset($instance['icon']) ? $instance['icon'] : '';
        $prefix = isset($instance['prefix']) ? $instance['prefix'] : '';
        $count = isset($instance['count']) ? $instance['count'] : '';
        $suffix = isset($instance['suffix']) ? $instance['suffix'] : '';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $counter_color = isset($instance['counter-color']) ? $instance['counter-color'] : '#333333';
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $data = '';

        if ($prefix) {
            $data = 'data-prefix= "' . $prefix . '"';
        }

        if ($suffix) {
            $data .= ' data-suffix= "' . $suffix . '"';
        }
		
		$background = "background-color:{$counter_color}";
		$border_color = "border-color:{$counter_color}";
		$color = "color:{$counter_color}";

        echo $before_widget;
        ?>
        <div class="ht-counter-widget <?php echo $style; ?>">
            <?php
            if ($style == 'style1' || $style == 'style2') {
                ?>
                <div class="ht-counter" style="<?php echo $border_color; ?>">
					<span class="ht-counter-left" style="<?php echo $background; ?>"><span style="<?php echo $background; ?>"></span></span>
                    <div class="ht-counter-icon" style="<?php echo $color; ?>">
                        <i class="<?php echo esc_attr($icon); ?>"></i>
						<span style="<?php echo $background; ?>"></span>
                    </div>

                    <div class="ht-counter-count odometer" <?php echo $data; ?> data-count="<?php echo absint($count); ?>" style="<?php echo $color; ?>">
                        99
                    </div>

                    <h5 class="ht-counter-title" style="<?php echo $color; ?>">
                        <?php echo esc_html($title); ?>
                    </h5>
                    <span class="ht-counter-right" style="<?php echo $background; ?>"><span style="<?php echo $background; ?>"></span></span>
                </div>
                <?php
            } elseif ($style == 'style3') {
                ?>
                <div class="ht-counter">
					<span style="<?php echo $border_color; ?>"></span>
                    <div class="ht-counter-icon" style="<?php echo $color; ?>">
                        <i class="<?php echo esc_attr($icon); ?>"></i>
                    </div>

                    <div class="ht-counter-count odometer" <?php echo $data; ?> data-count="<?php echo absint($count); ?>" style="<?php echo $color; ?>">
                        99
                    </div>

                    <h5 class="ht-counter-title" style="<?php echo $color; ?>">
                        <?php echo esc_html($title); ?>
                    </h5>
                </div>
                <?php
            } elseif ($style == 'style4') {
                ?>
                <div class="ht-counter">
                    <div class="ht-counter-icon" style="<?php echo $color; ?>">
                        <i class="<?php echo esc_attr($icon); ?>"></i>
                    </div>

                    <div class="ht-counter-right-block">
                        <div class="ht-counter-count odometer" <?php echo $data; ?> data-count="<?php echo absint($count); ?>" style="<?php echo $color; ?>">
                            99
                        </div>

                        <h5 class="ht-counter-title" style="<?php echo $color; ?>">
                            <?php echo esc_html($title); ?>
                        </h5>
                    </div>
                </div>
                <?php
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