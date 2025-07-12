<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_highlight_block');

function total_plus_register_highlight_block() {
    register_widget('total_plus_highlight_block');
}

class total_plus_highlight_block extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Highlight Block', 'total-plus'));
        parent::__construct('total_plus_highlight_block', '&bull; TP : Highlight Block', $widget_ops);
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
                'total_plus_widgets_default' => 'fas fa-star'
            ),
            'image' => array(
                'total_plus_widgets_name' => 'image',
                'total_plus_widgets_title' => __('Upload Image', 'total-plus'),
                'total_plus_widgets_field_type' => 'upload'
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => __('Heading', 'total-plus')
            ),
            'content' => array(
                'total_plus_widgets_name' => 'content',
                'total_plus_widgets_title' => __('Content', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'total-plus')
            ),
            'link_text' => array(
                'total_plus_widgets_name' => 'link_text',
                'total_plus_widgets_title' => __('Button Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'text',
                'total_plus_widgets_default' => __('Read More', 'total-plus')
            ),
            'link' => array(
                'total_plus_widgets_name' => 'link',
                'total_plus_widgets_title' => __('Button Link', 'total-plus'),
                'total_plus_widgets_field_type' => 'url'
            ),
            'link_icon' => array(
                'total_plus_widgets_name' => 'link_icon',
                'total_plus_widgets_title' => __('Read More Link Icon', 'total-plus'),
                'total_plus_widgets_field_type' => 'icon',
                'total_plus_widgets_default' => 'mdi-chevron-right'
            ),
            'input_close' => array(
                'total_plus_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'total_plus_widgets_class' => 'ht-widget-tab-content',
                'total_plus_widgets_data_id' => 'ht-settings',
                'total_plus_widgets_field_type' => 'open'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
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
            'layout' => array(
                'total_plus_widgets_name' => 'layout',
                'total_plus_widgets_title' => __('Layout', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus')
                ),
                'total_plus_widgets_default' => 'style1'
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

        $layout = isset($instance['layout']) ? $instance['layout'] : 'style1';
        $icon = isset($instance['icon']) ? $instance['icon'] : '';
        $title_html_tag = isset($instance['title_html_tag']) ? $instance['title_html_tag'] : 'h5';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $link = isset($instance['link']) ? $instance['link'] : '';
        $link_text = isset($instance['link_text']) ? $instance['link_text'] : esc_html__('Read More', 'total-plus');
        $link = isset($instance['link']) ? $instance['link'] : '';
        $link_icon = isset($instance['link_icon']) ? $instance['link_icon'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $image = isset($instance['image']) ? $instance['image'] : '';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';

        $highlight_class = array(
            'ht-highlight-style',
            $layout
        );
        $image_url = $image;
        if (!empty($image)) {
            $image_id = attachment_url_to_postid($image);
            $image_array = wp_get_attachment_image_src($image_id, $image_size);
            $image_url = $image_array[0];
        }

        //echo $before_widget;
        ?>

        <div class="<?php echo implode(' ', $highlight_class) ?>">
            <?php
            if ($layout == 'style4') {
                ?>
                <div class="ht-highlight-post">

                    <div class="ht-highlight-title" style="background-image:url(<?php echo esc_url($image_url); ?>)">
                        <div class="ht-highlight-title-inner">
                            <div class="ht-highlight-icon">
                                <?php
                                if (!empty($icon)):
                                    ?>
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                    <?php
                                endif;
                                ?>
                            </div>
                            <<?php echo esc_attr($title_html_tag); ?> class="ht-highlight-heading"><?php echo esc_html($title); ?></<?php echo esc_attr($title_html_tag); ?>>
                        </div>
                    </div>

                    <div class="ht-highlight-hover" style="background-image:url(<?php echo esc_url($image_url); ?>)">
                        <div class="ht-highlight-hover-inner">
                            <div class="ht-highlight-excerpt">
                                <?php echo wp_kses_post($content); ?>
                            </div>

                            <?php if (!empty($link)) { ?>
                                <div class="ht-highlight-link">
                                    <a href="<?php echo esc_url($link); ?>">
                                        <?php echo wp_kses_post($link_text); 
                                        if (!empty($link_icon)):
                                            ?>
                                            <i class="<?php echo esc_attr($link_icon); ?>"></i>
                                            <?php
                                        endif;
                                        ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="ht-highlight-post">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                    <div class="ht-highlight-title">
                        <div class="ht-highlight-title-inner">
                            <div class="ht-highlight-icon">
                                <?php
                                if (!empty($icon)):
                                    ?>
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                    <?php
                                endif;
                                ?>
                            </div>
                            <<?php echo esc_attr($title_html_tag); ?> class="ht-highlight-heading"><?php echo esc_html($title); ?></<?php echo esc_attr($title_html_tag); ?>>
                        </div>
                    </div>

                    <div class="ht-highlight-hover">
                        <?php if ($layout == 'style2') { ?>
                            <div class="ht-highlight-icon">
                                <?php
                                if (!empty($icon)):
                                    ?>
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                    <?php
                                endif;
                                ?>
                            </div>
                            <<?php echo esc_attr($title_html_tag); ?> class="ht-highlight-heading"><?php echo esc_html($title); ?></<?php echo esc_attr($title_html_tag); ?>>
                        <?php } ?>

                        <div class="ht-highlight-hover-inner">
                            <div class="ht-highlight-excerpt">
                                <?php echo wp_kses_post($content); ?>
                            </div>

                            <?php if (!empty($link)) { ?>
                                <div class="ht-highlight-link">
                                    <a href="<?php echo esc_url($link); ?>">
                                        <?php echo wp_kses_post($link_text);
                                        if (!empty($link_icon)):
                                            ?>
                                            <i class="<?php echo esc_attr($link_icon); ?>"></i>
                                            <?php
                                        endif;
                                        ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                    
                <?php
            }
            ?>
        </div>
        <?php

        //echo $after_widget;
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
