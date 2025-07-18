<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_team_carousel');

function total_plus_register_team_carousel() {
    register_widget('total_plus_team_carousel');
}

class total_plus_team_carousel extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Team Member in Carousel', 'total-plus'));
        //$control_ops = array('width' => 500, 'height' => 400);
        parent::__construct('total_plus_team_carousel', '&bull; TP : Team Carousel', $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'total_plus_widgets_name' => 'title',
                'total_plus_widgets_title' => __('Name', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'col' => array(
                'total_plus_widgets_name' => 'col',
                'total_plus_widgets_title' => __('Number of Slides in a Row', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    '1' => __('1', 'total-plus'),
                    '2' => __('2', 'total-plus'),
                    '3' => __('3', 'total-plus'),
                    '4' => __('4', 'total-plus'),
                    '5' => __('5', 'total-plus'),
                    '6' => __('6', 'total-plus')
                ),
                'total_plus_widgets_field_default' => '3'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
            ),
            'style' => array(
                'total_plus_widgets_name' => 'style',
                'total_plus_widgets_title' => __('Team Block Style', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => array(
                    'style1' => __('Style 1', 'total-plus'),
                    'style2' => __('Style 2', 'total-plus'),
                    'style3' => __('Style 3', 'total-plus'),
                    'style4' => __('Style 4', 'total-plus'),
                    'style5' => __('Style 5', 'total-plus'),
                    'style6' => __('Style 6', 'total-plus')
                ),
                'total_plus_widgets_field_default' => 'style1'
            ),
            'items' => array(
                'total_plus_widgets_name' => 'items',
                'total_plus_widgets_title' => __('Team Box', 'total-plus'),
                'total_plus_widgets_repeater_title' => __('Team', 'total-plus'),
                'total_plus_widgets_field_type' => 'repeater',
                'total_plus_widgets_repeater_fields_title' => 'title',
                'total_plus_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Name', 'total-plus'),
                        'type' => 'text'
                    ),
                    'image' => array(
                        'title' => __('Image', 'total-plus'),
                        'type' => 'upload'
                    ),
                    'designation' => array(
                        'title' => __('Designation', 'total-plus'),
                        'type' => 'text'
                    ),
                    'intro' => array(
                        'title' => __('Short Intro', 'total-plus'),
                        'type' => 'textarea'
                    ),
                    'detail_page' => array(
                        'title' => __('Detail Page Link', 'total-plus'),
                        'type' => 'text'
                    ),
                    'facebook' => array(
                        'title' => __('Facebook', 'total-plus'),
                        'type' => 'text'
                    ),
                    'twitter' => array(
                        'title' => __('Twitter', 'total-plus'),
                        'type' => 'text'
                    ),
                    'linkedin' => array(
                        'title' => __('LinkedIn', 'total-plus'),
                        'type' => 'text'
                    ),
                    'instagram' => array(
                        'title' => __('Instagram', 'total-plus'),
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
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $col = isset($instance['col']) ? $instance['col'] : '3';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';
        $items = isset($instance['items']) ? $instance['items'] : '';

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;

        $team_class = array(
            'ht-team-member-wrap',
            'ht-clearfix'
        );

        if (!empty($items)) {
            ?>
            <div class="<?php echo esc_attr(implode(' ', $team_class)) ?>" >
                <div class="ht-team-carousel owl-carousel" data-col="<?php echo absint($col); ?>">
                    <?php
                    foreach ($items as $item) {
                        $image = $item['image'];
                        $name = $item['title'];
                        $designation = $item['designation'];
                        $content = $item['intro'];
                        $facebook_link = $item['facebook'];
                        $twitter_link = $item['twitter'];
                        $linkedin_link = isset($item['linkedin']) ? $item['linkedin'] : '';
                        $instagram_link = $item['instagram'];
                        $link = $item['detail_page'];

                        ?>
                        <div class="ht-team-member <?php echo esc_attr($style); ?>">

                            <div class="ht-team-member-inner">
                                <?php
                                $image_url = $image;
                                if ( $image_size != 'full' && !empty($image) ) {
                                    $image_id = attachment_url_to_postid($image);
                                    $image_array = wp_get_attachment_image_src($image_id, $image_size);
                                    $image_url = $image_array[0];
                                }
                                ?>

                                <div class="ht-team-image">
                                    <?php
                                    if ( !empty($image_url) ) { ?>
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr($name); ?>" />
                                    <?php  } ?>

                                    <?php if ($style == 'style3') { ?>
                                        <div class="ht-team-image-overlay">
                                            <div class="ht-team-image-overlay-inner">
                                                <?php if (!empty($content)) { ?>
                                                    <div class="team-short-content">
                                                        <?php echo wp_kses_post($content); ?>
                                                    </div>
                                                    <?php
                                                }

                                                if (!empty($link)) {
                                                    ?>
                                                    <a href="<?php echo esc_url($link); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                                    <?php
                                                }

                                                if ($facebook_link || $twitter_link || $linkedin_link || $instagram_link) {
                                                    ?>
                                                    <div class="ht-team-social-id">
                                                        <?php if ($facebook_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icofont-facebook"></i></a>
                                                        <?php } ?>

                                                        <?php if ($twitter_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icofont-x-twitter"></i></a>
                                                        <?php } ?>

                                                        <?php if ($linkedin_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($linkedin_link) ?>"><i class="icofont-linkedin"></i></a>
                                                        <?php } ?>

                                                        <?php if ($instagram_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icofont-instagram"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>

                                <?php if ($style == 'style1') { ?>
                                    <div class="ht-title-wrap">
                                        <h5><?php echo esc_html($name); ?></h5>
                                    </div>
                                <?php } ?>

                                <div class="ht-team-member-content">
                                    <div class="ht-team-member-excerpt">
                                        <div class="ht-team-member-span">
                                            <h5><?php echo esc_html($name); ?></h5>

                                            <?php if (!empty($designation)) { ?>
                                                <div class="ht-team-designation"><?php echo esc_html($designation); ?></div>
                                                <?php
                                            }

                                            if ($style != 'style3') {
                                                if (!empty($content)) {
                                                    ?>
                                                    <div class="team-short-content">
                                                        <div class="team-brief">
                                                            <?php echo wp_kses_post($content); ?>
                                                        </div>
                                                        <?php if (!empty($link) && $style == 'style5') { ?>
                                                            <a href="<?php echo esc_url($link); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }

                                                if (!empty($link) && $style != 'style5') {
                                                    ?>
                                                    <a href="<?php echo esc_url($link); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                                    <?php
                                                }

                                                if ($facebook_link || $twitter_link || $linkedin_link || $instagram_link) {
                                                    ?>
                                                    <div class="ht-team-social-id">
                                                        <?php if ($facebook_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icofont-facebook"></i></a>
                                                        <?php } ?>

                                                        <?php if ($twitter_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icofont-x-twitter"></i></a>
                                                        <?php } ?>

                                                        <?php if ($linkedin_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($linkedin_link) ?>"><i class="icofont-linkedin"></i></a>
                                                        <?php } ?>

                                                        <?php if ($instagram_link) { ?>
                                                            <a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icofont-instagram"></i></a>
                                                            <?php } ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
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
