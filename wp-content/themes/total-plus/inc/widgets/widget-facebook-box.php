<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_facebook_box');

function total_plus_register_facebook_box() {
    register_widget('total_plus_facebook_box');
}

class total_plus_facebook_box extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_facebook_box', '&bull; TP : Facebook Box', array(
            'description' => __('A widget to Facebook Like Box', 'total-plus')
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
            'facebook_url' => array(
                'total_plus_widgets_name' => 'facebook_url',
                'total_plus_widgets_title' => __('Facebook Page URL', 'total-plus'),
                'total_plus_widgets_field_type' => 'url'
            ),
            'facebook_app_id' => array(
                'total_plus_widgets_name' => 'facebook_app_id',
                'total_plus_widgets_title' => __('Facebook App Id', 'total-plus'),
                'total_plus_widgets_description' => sprintf(__('This is required to display the Facebook box. Click %s for the tutorial to generate Facebook App Id', 'total-plus'), '<a href="https://webkul.com/blog/how-to-generate-facebook-app-id/" target="_blank">'.__('here', 'total-plus').'</a>'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'tabs' => array(
                'total_plus_widgets_name' => 'tabs',
                'total_plus_widgets_title' => __('Tabs', 'total-plus'),
                'total_plus_widgets_field_type' => 'multicheckbox',
                'total_plus_widgets_field_options' => array(
                    'timeline' => __('Show Timeline', 'total-plus'),
                    'messages' => __('Show Message', 'total-plus'),
                    'events' => __('Show Events', 'total-plus')
                )
            ),
            'width' => array(
                'total_plus_widgets_name' => 'width',
                'total_plus_widgets_title' => __('Width', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => 300
            ),
            'height' => array(
                'total_plus_widgets_name' => 'height',
                'total_plus_widgets_title' => __('Height', 'total-plus'),
                'total_plus_widgets_field_type' => 'number',
                'total_plus_widgets_default' => 500
            ),
            'use_small_header' => array(
                'total_plus_widgets_name' => 'use_small_header',
                'total_plus_widgets_title' => __('Use Small Header', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'hide_cover_photo' => array(
                'total_plus_widgets_name' => 'hide_cover_photo',
                'total_plus_widgets_title' => __('Hide Cover Photo', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
            ),
            'show_faces' => array(
                'total_plus_widgets_name' => 'show_faces',
                'total_plus_widgets_title' => __('Show Friend\'s Faces', 'total-plus'),
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
        $facebook_url = isset($instance['facebook_url']) ? $instance['facebook_url'] : '';
        $facebook_app_id = isset($instance['facebook_app_id']) ? $instance['facebook_app_id'] : '';
        $tabs = isset($instance['tabs']) ? $instance['tabs'] : '';
        $width = isset($instance['width']) ? $instance['width'] : 300;
        $height = isset($instance['height']) ? $instance['height'] : 500;
        $use_small_header = (isset($instance['use_small_header']) && $instance['use_small_header'] == '1') ? 'true' : 'false';
        $hide_cover_photo = (isset($instance['hide_cover_photo']) && $instance['hide_cover_photo'] == '1') ? 'true' : 'false';
        $show_faces = (isset($instance['show_faces']) && $instance['show_faces'] == '1') ? 'true' : 'false';
        $data_tabs = '';
        if (!empty($tabs)) {
            $new = array();
            foreach ($tabs as $tab_key => $tab_value) {
                $new[] = $tab_key;
            }
            $data_tabs = implode(',', $new);
        }
        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <div class="ht-facebook-box">
            <div class="fb-page" 
                 data-href="<?php echo esc_url($facebook_url) ?>" 
                 data-width="<?php echo absint($width) ?>"
                 data-height="<?php echo absint($height) ?>" 
                 data-small-header="<?php echo esc_attr($use_small_header) ?>" 
                 data-adapt-container-width="true" 
                 data-hide-cover="<?php echo esc_attr($hide_cover_photo) ?>" 
                 data-show-facepile="<?php echo esc_attr($show_faces) ?>"
                 data-tabs="<?php echo esc_attr($data_tabs); ?>" >
                <blockquote cite="<?php echo esc_url($facebook_url) ?>" class="fb-xfbml-parse-ignore">
                    <a href="<?php echo esc_url($facebook_url) ?>">Facebook</a>
                </blockquote>
            </div>
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=<?php echo $facebook_app_id ?>&autoLogAppEvents=1"></script>
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