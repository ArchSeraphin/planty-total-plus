<?php
/**
 * @package Total Plus
 */
add_action('widgets_init', 'total_plus_register_team');

function total_plus_register_team() {
    register_widget('total_plus_team');
}

class total_plus_team extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display Team Member Information', 'total-plus'));
        //$control_ops = array('width' => 500, 'height' => 400);
        parent::__construct('total_plus_team', '&bull; TP : Team', $widget_ops);
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
            'image' => array(
                'total_plus_widgets_name' => 'image',
                'total_plus_widgets_title' => __('Team Member Image', 'total-plus'),
                'total_plus_widgets_field_type' => 'upload'
            ),
            'designation' => array(
                'total_plus_widgets_name' => 'designation',
                'total_plus_widgets_title' => __('Designation', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'intro' => array(
                'total_plus_widgets_name' => 'intro',
                'total_plus_widgets_title' => __('Short Intro', 'total-plus'),
                'total_plus_widgets_field_type' => 'textarea',
                'total_plus_widgets_row' => '4'
            ),
            'detail_page' => array(
                'total_plus_widgets_name' => 'detail_page',
                'total_plus_widgets_title' => __('Detail Page Link', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'facebook' => array(
                'total_plus_widgets_name' => 'facebook',
                'total_plus_widgets_title' => __('Facebook', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'twitter' => array(
                'total_plus_widgets_name' => 'twitter',
                'total_plus_widgets_title' => __('Twitter', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'linkedin' => array(
                'total_plus_widgets_name' => 'linkedin',
                'total_plus_widgets_title' => __('LinkedIn', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
            ),
            'instagram' => array(
                'total_plus_widgets_name' => 'instagram',
                'total_plus_widgets_title' => __('Instagram', 'total-plus'),
                'total_plus_widgets_field_type' => 'text'
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
                'total_plus_widgets_default' => 'style1'
            ),
            'image_size' => array(
                'total_plus_widgets_name' => 'image_size',
                'total_plus_widgets_title' => __('Image Size', 'total-plus'),
                'total_plus_widgets_field_type' => 'select',
                'total_plus_widgets_field_options' => total_get_image_sizes(),
                'total_plus_widgets_field_default' => 'full'
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

        $name = isset($instance['title']) ? $instance['title'] : '';
        $image = isset($instance['image']) ? $instance['image'] : '';
        $designation = isset($instance['designation']) ? $instance['designation'] : '';
        $intro = isset($instance['intro']) ? $instance['intro'] : '';
        $detail_page = isset($instance['detail_page']) ? $instance['detail_page'] : '';
        $facebook_link = isset($instance['facebook']) ? $instance['facebook'] : '';
        $twitter_link = isset($instance['twitter']) ? $instance['twitter'] : '';
        $linkedin = isset($instance['linkedin']) ? $instance['linkedin'] : '';
        $instagram_link = isset($instance['instagram']) ? $instance['instagram'] : '';
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : 'full';

        $image_url = $image;
        if ( $image_size != 'full' && !empty($image) ) {
            $image_id = attachment_url_to_postid($image);
            $image_array = wp_get_attachment_image_src($image_id, $image_size);
            $image_url = $image_array[0];
        }

        echo $before_widget;
        ?>
        <div class="ht-team-member <?php echo esc_attr($style); ?>">
            <div class="ht-team-member-inner">

                <div class="ht-team-image">
                    <?php
                    if ( !empty($image_url) ) { ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr($name); ?>" />
                    <?php } ?>

                    <?php if ($style == 'style3') { ?>
                        <div class="ht-team-image-overlay">
                            <div class="ht-team-image-overlay-inner">
                                <?php if (!empty($intro)) { ?>
                                    <div class="team-short-content">
                                        <?php echo wp_kses_post($intro); ?>
                                    </div>
                                    <?php
                                }

                                if (!empty($detail_page)) {
                                    ?>
                                    <a href="<?php echo esc_url($detail_page); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                    <?php
                                }

                                if ($facebook_link || $twitter_link || $linkedin || $instagram_link) {
                                    ?>
                                    <div class="ht-team-social-id">
                                        <?php if ($facebook_link) { ?>
                                            <a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icofont-facebook"></i></a>
                                        <?php } ?>

                                        <?php if ($twitter_link) { ?>
                                            <a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icofont-x-twitter"></i></a>
                                        <?php } ?>

                                        <?php if ($linkedin) { ?>
                                            <a target="_blank" href="<?php echo esc_url($linkedin) ?>"><i class="icofont-linkedin"></i></a>
                                        <?php } ?>

                                        <?php if ($instagram_link) { ?>
                                            <a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icofont-instagram"></i></a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
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
                                if (!empty($intro)) { ?>
                                    <div class="team-short-content">
                                        <div class="team-intro">
                                            <?php echo wp_kses_post($intro); ?>
                                        </div>
                                        <?php 
                                        if (!empty($detail_page) && $style == 'style5') { ?>
                                            <a href="<?php echo esc_url($detail_page); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }

                                if (!empty($detail_page) && $style != 'style5') {
                                    ?>
                                    <a href="<?php echo esc_url($detail_page); ?>" class="ht-team-detail"><?php _e('Detail', 'total-plus') ?></a>
                                    <?php
                                }

                                if ($facebook_link || $twitter_link || $linkedin || $instagram_link) {
                                    ?>
                                    <div class="ht-team-social-id">
                                        <?php if ($facebook_link) { ?>
                                            <a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icofont-facebook"></i></a>
                                        <?php } ?>

                                        <?php if ($twitter_link) { ?>
                                            <a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icofont-x-twitter"></i></a></i></a>
                                        <?php } ?>

                                        <?php if ($linkedin) { ?>
                                            <a target="_blank" href="<?php echo esc_url($linkedin) ?>"><i class="icofont-linkedin"></i></a></i></a>
                                        <?php } ?>

                                        <?php if ($instagram_link) { ?>
                                            <a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icofont-instagram"></i></a></i></a>
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
