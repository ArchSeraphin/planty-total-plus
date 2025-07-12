<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_image_box');

function total_plus_register_image_box() {
    register_widget('total_plus_image_box');
}

class total_plus_image_box extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'total_plus_image_box', '&bull; TP : Image Text', array(
            'description' => __('A widget to display Text with Image', 'total-plus')
                )
        );
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
            'image' => array(
                'total_plus_widgets_name' => 'image',
                'total_plus_widgets_title' => __('Upload Image', 'total-plus'),
                'total_plus_widgets_field_type' => 'upload'
            ),
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Title', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'text' => array(
                'total_plus_widgets_name' => 'text',
                'total_plus_widgets_title' => __('Text', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_row' => '4'
            ),
            'use_paragraph' => array(
                'total_plus_widgets_name' => 'use_paragraph',
                'total_plus_widgets_title' => __('Use Paragraph', 'total-plus'),
                'total_plus_widgets_field_type' => 'checkbox'
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
            'image_position' => array(
                'total_plus_widgets_name' => 'image_position',
                'total_plus_widgets_title' => __('Image Position', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'top' => __('Top', 'total-plus'),
                    'left' => __('Left', 'total-plus'),
                    'right' => __('Right', 'total-plus')
                ),
                'total_plus_widgets_default' => 'top'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
            ),
            'image_width' => array(
                'total_plus_widgets_name' => 'image_width',
                'total_plus_widgets_title' => __('Image Width', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    '10' => __('10%', 'total-plus'),
                    '20' => __('20%', 'total-plus'),
                    '30' => __('30%', 'total-plus'),
                    '40' => __('40%', 'total-plus'),
                    '50' => __('50%', 'total-plus'),
                    '60' => __('60%', 'total-plus'),
                    '70' => __('70%', 'total-plus'),
                    '80' => __('80%', 'total-plus'),
                    '90' => __('90%', 'total-plus'),
                    '100' => __('100%', 'total-plus')
                ),
                'total_plus_widgets_default' => '100'
            ),
            'content_position' => array(
                'total_plus_widgets_name' => 'content_position',
                'total_plus_widgets_title' => __('Content Position', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'image-title-text' => __('Image, Title, Text', 'total-plus'),
                    'title-image-text' => __('Title, Image, Text', 'total-plus')
                ),
                'total_plus_widgets_default' => 'image-title-text'
            ),
            'content_align' => array(
                'total_plus_widgets_name' => 'content_align',
                'total_plus_widgets_title' => __('Content Align', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'ht-left' => __('Left', 'total-plus'),
                    'ht-right' => __('Right', 'total-plus'),
                    'ht-center' => __('Center', 'total-plus')
                ),
                'total_plus_widgets_default' => 'ht-left'
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

        $image = isset($instance['image']) ? $instance['image'] : '';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $text = isset($instance['text']) ? $instance['text'] : '';
        $button_link = isset($instance['button_link']) ? $instance['button_link'] : '';
        $button_text = isset($instance['button_text']) ? $instance['button_text'] : esc_html__('Read More', 'total-plus');
        $title_html_tag = isset($instance['title_html_tag']) ? $instance['title_html_tag'] : 'h5';
        $image_position = isset($instance['image_position']) ? $instance['image_position'] : 'top';
        $image_width = isset($instance['image_width']) ? $instance['image_width'] : '50';
        $content_position = isset($instance['content_position']) ? $instance['content_position'] : 'image-title-text';
        $content_align = isset($instance['content_align']) ? $instance['content_align'] : 'ht-left';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $link_color = isset($instance['link_color']) ? $instance['link_color'] : '';
        $use_paragraph = (isset($instance['use_paragraph']) && $instance['use_paragraph'] == '1') ? true : false;
        $title_css = $text_css = $link_css = '';
        
        if($title_color){
            $title_css = 'style="color:'.$title_color.'"';
        }
        
        if($text_color){
            $text_css = 'style="color:'.$text_color.'"';
        }
        
        if($link_color){
            $link_css = 'style="color:'.$link_color.'"';
        }
        
        $content_width = 100;
        if ($image_position !== 'top') {
            $content_width = 100 - $image_width;
        }

        $image_url = $image;
        if ($image_size != 'full' && !empty($image)) {
            $image_id = attachment_url_to_postid($image);
            $image_array = wp_get_attachment_image_src($image_id, $image_size);
            $image_url = $image_array[0];
        }

        $style = array();

        echo $before_widget;
        ?>
        <div class="ht-image-box image-<?php echo esc_attr($image_position) .' '. $content_align; ?>">
            <?php
            if (!empty($title) && $content_position == 'title-image-text'):
                ?>
                <<?php echo $title_html_tag; ?> class="ht-ib-title" <?php echo $title_css; ?>><?php echo wp_kses_post($title); ?></<?php echo $title_html_tag; ?>>
                <?php
            endif;
            ?>
            <div class="ht-image-box-wrap">
                <?php if (!empty($image_url)) { ?>
                    <div class="ht-ib-image" style="width:<?php echo $image_width; ?>%">
                        <?php
                        if (!empty($button_link)){
                            echo '<a href="' . esc_url($button_link) . '">';
                        }
                        ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                        <?php
                        if (!empty($button_link)){
                            echo '</a>';
                        }
                        ?>
                    </div>
                    <?php }
                ?>

                <div class="ht-ib-content" style="width:<?php echo $content_width; ?>%">
                    <?php
                    if (!empty($title) && $content_position == 'image-title-text'):
                        ?>
                        <<?php echo $title_html_tag; ?> class="ht-ib-title" <?php echo $title_css; ?>><?php echo wp_kses_post($title); ?></<?php echo $title_html_tag; ?>>
                        <?php
                    endif;

                    if (!empty($text)):
                        if ($use_paragraph) {
                            $text = wpautop($text);
                        }
                        ?>
                        <div class="ht-ib-excerpt" <?php echo $text_css; ?>><?php echo wp_kses_post($text); ?></div>
                        <?php
                    endif;

                    if (!empty($button_link)):
                        echo '<div class="ht-ib-readmore">';
                        echo '<a href="' . esc_url($button_link) . '" ' . $link_css . '>' . esc_html($button_text) . '<i class="mdi mdi-chevron-right"></i></a>';
                        echo '</div>';
                    endif;
                    ?>
                </div>
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
