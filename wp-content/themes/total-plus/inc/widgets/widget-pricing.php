<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_pricing');

function total_plus_register_pricing() {
    register_widget('total_plus_pricing');
}

class total_plus_pricing extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_pricing', '&bull; TP : Pricing', array(
            'description' => __('A widget to display Pricing', 'total-plus')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Pricing Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus')
                ),
                'total_plus_widgets_default' => 'style1'
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Pricing Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'currency_symbol' => array(
                'total_plus_widgets_name' => 'currency_symbol',
                'total_plus_widgets_title' => __('Currency Symbol', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'price' => array(
                'total_plus_widgets_name' => 'price',
                'total_plus_widgets_title' => __('Price', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'price_per' => array(
                'total_plus_widgets_name' => 'price_per',
                'total_plus_widgets_title' => __('Price Per(Month/Year)', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'feature_list' => array(
                'total_plus_widgets_name' => 'feature_list',
                'total_plus_widgets_title' => __('Plan Feature List', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_row' => '6',
                'total_plus_widgets_description' => __('Enter Feature list seperated by Enter', 'total-plus')
            ),
            'button_text' => array(
                'total_plus_widgets_name' => 'button_text',
                'total_plus_widgets_title' => __('Button Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'button_link' => array(
                'total_plus_widgets_name' => 'button_link',
                'total_plus_widgets_title' => __('Button Link', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'is_featured' => array(
                'total_plus_widgets_name' => 'is_featured',
                'total_plus_widgets_title' => __('Is Featured', 'total-plus'),
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

        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $currency_symbol = isset($instance['currency_symbol']) ? $instance['currency_symbol'] : '';
        $price = isset($instance['price']) ? $instance['price'] : '';
        $price_per = isset($instance['price_per']) ? $instance['price_per'] : '';
        $feature_list = isset($instance['feature_list']) ? $instance['feature_list'] : '';
        $button_text = isset($instance['button_text']) ? $instance['button_text'] : '';
        $button_link = isset($instance['button_link']) ? $instance['button_link'] : '';
        $featured_class = (isset($instance['is_featured']) && $instance['is_featured'] == true) ? 'ht-featured' : '';

        $pricing_class = array(
            'ht-pricing-widget',
            'ht-pricing',
            $featured_class,
            $style
        );

        echo $before_widget;
        ?>
        <div class="<?php echo esc_attr(implode(' ', array_filter($pricing_class))); ?>">
            <div class="ht-pricing-header">
                <h5><?php echo esc_html($title); ?></h5>
                <div class="ht-pricing-price">
                    <div class="ht-pricing-price-inner">
                        <span class="ht-currency"><?php echo esc_html($currency_symbol); ?></span>
                        <?php echo esc_html($price); ?>
                        <span class="ht-price-per"><?php echo esc_html($price_per); ?></span>
                    </div>
                </div>
            </div>

            <div class="ht-pricing-main">
                <?php
                if (!empty($feature_list)) {
                    $content_lists = explode("\n", $feature_list);
                    ?>
                    <ul class="ht-pricing-list">
                        <?php foreach ($content_lists as $content_list) { ?>
                            <li><?php echo wp_kses_post($content_list); ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>

                <?php if (!empty($button_link) || !empty($button_text)) { ?>
                    <div class="ht-pricing-button">
                        <a href="<?php echo esc_html($button_link) ?>"><?php echo esc_html($button_text) ?></a>
                    </div>
                <?php } ?>
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
