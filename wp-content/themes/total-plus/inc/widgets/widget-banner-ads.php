<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_advertisement');

function total_plus_register_advertisement() {
    register_widget('total_plus_advertisement');
}

class total_plus_advertisement extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_advertisement', '&bull; TP : Banner Ads', array(
            'description' => __('A widget to display Advertisement', 'total-plus')
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
            'image' => array(
                'total_plus_widgets_name' => 'image',
                'total_plus_widgets_title' => __('Advertisement Banner', 'total-plus'),
                'total_plus_widgets_field_type' => 'upload'
            ),
            'link' => array(
                'total_plus_widgets_name' => 'link',
                'total_plus_widgets_title' => __('Advertisement Link', 'total-plus'),
                'total_plus_widgets_field_type' => 'url'
            ),
            'newtab' => array(
                'total_plus_widgets_name' => 'newtab',
                'total_plus_widgets_title' => __('Open in new tab', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
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
        $link = isset($instance['link']) ? $instance['link'] : '';
        $newtab = isset($instance['newtab']) ? $instance['newtab'] : '';
        $target = '_self';

        if ($newtab) {
            $target = '_blank';
        }

        echo $before_widget;
        ?>
        <div class="ht-advertisment">
            <?php
            if (!empty($title)):
                echo $before_title . apply_filters('widget_title', $title) . $after_title;
            endif;

            if (!empty($image)):
                echo '<div class="ht-ads-image">';

                if (!empty($link)) {
                    echo '<a href="' . esc_url($link) . '" target="' . $target . '">';
                }
                echo '<img alt="Advertisement" src="' . esc_url($image) . '"/>';

                if (!empty($link)) {
                    echo '</a>';
                }
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