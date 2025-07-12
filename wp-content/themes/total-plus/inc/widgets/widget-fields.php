<?php

/**
 * @package Total Plus
 */
function total_plus_widgets_show_widget_field($instance = '', $widget_field = '', $total_plus_field_value = '') {

    extract($widget_field);

    if (isset($total_plus_widgets_default)) {
        if ($total_plus_widgets_field_type == 'checkbox') {
            $total_plus_field_value = !empty($total_plus_field_value) ? $total_plus_field_value : '0';
        } else {
            $total_plus_field_value = !empty($total_plus_field_value) ? $total_plus_field_value : $total_plus_widgets_default;
        }
    }

    $total_plus_widgets_class = isset($total_plus_widgets_class) ? $total_plus_widgets_class : '';
    $total_plus_widgets_row = isset($total_plus_widgets_row) ? $total_plus_widgets_row : 3;

    switch ($total_plus_widgets_field_type) {
        case 'tab' :
            $selector = 'total_plus_' . md5(uniqid(rand(), true));
            ?>
            <script>
                jQuery(function ($) {
                    var id = $('#<?php echo $selector; ?>').parent();
                    total_widget_tabs(id);
                });
            </script>
            <div class="ht-widget-tab <?php echo $total_plus_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php
                foreach ($total_plus_widgets_tabs as $total_plus_widgets_class => $total_plus_widgets_tab_name) {
                    ?>
                    <div class="<?php echo esc_attr($total_plus_widgets_class); ?>"><?php echo esc_attr($total_plus_widgets_tab_name) ?></div>
                <?php }
                ?>
            </div>
            <?php
            break;

        case 'open' :
            $data_id = '';
            if (isset($total_plus_widgets_data_id)) {
                $data_id .= 'data-id ="' . $total_plus_widgets_data_id . '"';
            }
            echo '<div class ="' . $total_plus_widgets_class . '" ' . $data_id . '>';
            break;

        case 'close' :
            echo '</div>';
            break;

        case 'icon' :
            ?>
            <div class="ht-widget-icon-box ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <div class="ht-selected-icon">
                    <i class="<?php echo esc_attr($total_plus_field_value); ?>"></i>
                    <span><i class="icofont-simple-down"></i></span>
                </div>

                <div class="ht-icon-box">
                    <div class="ht-icon-search">
                        <input type="text" class="ht-icon-search-input" placeholder="<?php echo esc_html__('Type to filter', 'total-plus') ?>" />
                    </div>

                    <ul class="ht-icon-list clearfix">
                        <?php
                        if (isset($total_plus_icon_array) && !empty($total_plus_icon_array)) {
                            $icon_array = $total_plus_icon_array;
                        } else {
                            $icon_array = total_plus_font_awesome_icon_array();
                        }

                        foreach ($icon_array as $icon) {
                            $icon_class = ($total_plus_field_value == $icon) ? 'icon-active' : '';
                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($icon) . '"></i></li>';
                        }
                        ?>
                    </ul>
                </div>
                <input type="hidden" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" value="<?php echo esc_attr($total_plus_field_value); ?>" />

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </div>
            <?php
            break;

        case 'selector' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label><?php echo esc_html($total_plus_widgets_title); ?></label>
                <?php } ?>

                <?php foreach ($total_plus_widgets_field_options as $total_plus_option_name => $total_plus_option_title) { ?>
                    <label class="ht-image-label" for="<?php echo $instance->get_field_id($total_plus_option_name); ?>">
                        <input id="<?php echo $instance->get_field_id($total_plus_option_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="radio" value="<?php echo esc_attr($total_plus_option_name); ?>" <?php checked($total_plus_option_name, $total_plus_field_value); ?> />
                        <img src="<?php echo esc_url($total_plus_option_title); ?>" />
                    </label>
                <?php }
                ?>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'text' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="text" value="<?php echo esc_html($total_plus_field_value); ?>" />

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'url' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="text" value="<?php echo esc_url($total_plus_field_value); ?>" />

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'editor' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php }
                ?>
                <input class="widefat" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" value='<?php echo wp_kses_post($total_plus_field_value); ?>' type="hidden" />
                <a href="#" class="button ht-wp-editor-button"><?php esc_html_e('Add/Edit Content', 'total-plus') ?></a>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'inline_editor' :
            $selector = 'total_plus_' . md5(uniqid(rand(), true));
            ?>
            <div class="ht-form-row <?php echo $total_plus_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <textarea class="widefat ht-inline-editor" rows="<?php echo absint($total_plus_widgets_row); ?>" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>"><?php echo wp_kses_post($total_plus_field_value); ?></textarea>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        total_widget_editor('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'textarea' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <textarea class="widefat" rows="<?php echo absint($total_plus_widgets_row); ?>" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>"><?php echo wp_kses_post($total_plus_field_value); ?></textarea>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'color' :
            $selector = 'total_plus_' . md5(uniqid(rand(), true));
            ?>
            <div class="ht-color-widget ht-form-row <?php echo $total_plus_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <input class="ht-widget-color-picker" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="text" value="<?php echo esc_attr($total_plus_field_value) ?>"/>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        total_widget_color_picker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'checkbox' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <input id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $total_plus_field_value); ?>/>

                <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?></label>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'multicheckbox' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label><?php echo esc_html($total_plus_widgets_title); ?></label>
                    <?php
                }

                if (!empty($total_plus_widgets_field_options)) {
                    foreach ($total_plus_widgets_field_options as $total_plus_option_name => $total_plus_option_title) {
                        ?>
                        <input id="<?php echo $instance->get_field_id($total_plus_option_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name) . '[' . $total_plus_option_name . ']'; ?>" type="checkbox" value="1" <?php checked('1', isset($total_plus_field_value[$total_plus_option_name])); ?>/>

                        <label for="<?php echo $instance->get_field_id($total_plus_option_name); ?>"><?php echo esc_html($total_plus_option_title); ?></label><br />
                        <?php
                    }
                } else {
                    esc_html_e('- No options found', 'total-plus');
                }
                ?>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'radio' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label><?php echo esc_html($total_plus_widgets_title); ?></label>
                <?php } ?>

                <?php foreach ($total_plus_widgets_field_options as $total_plus_option_name => $total_plus_option_title) { ?>
                    <input id="<?php echo $instance->get_field_id($total_plus_option_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="radio" value="<?php echo esc_attr($total_plus_option_name); ?>" <?php checked($total_plus_option_name, $total_plus_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($total_plus_option_name); ?>"><?php echo esc_html($total_plus_option_title); ?></label>
                    <br />
                <?php }
                ?>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'select' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <select name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" class="widefat">
                    <?php foreach ($total_plus_widgets_field_options as $total_plus_option_name => $total_plus_option_title) { ?>
                        <option value="<?php echo esc_attr($total_plus_option_name); ?>" <?php selected($total_plus_option_name, $total_plus_field_value); ?>><?php echo esc_html($total_plus_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <input name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="number" step="1" min="0" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" value="<?php echo absint($total_plus_field_value); ?>" class="small-text" />

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload':
            $image = $image_class = "";
            if ($total_plus_field_value) {
                $image = '<img src="' . esc_url($total_plus_field_value) . '" style="max-width:100%;"/>';
                $image_class = ' hidden';
            }
            ?>
            <div class="ht-form-row attachment-media-view widget-media-view <?php echo $total_plus_widgets_class; ?>">

                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <div class="placeholder<?php echo $image_class; ?>">
                    <?php esc_html_e('No image selected', 'total-plus'); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo $image; ?>
                </div>

                <div class="actions clearfix">
                    <button type="button" class="button ht-delete-button align-left"><?php esc_html_e('Remove', 'total-plus'); ?></button>
                    <button type="button" class="button ht-upload-button alignright"><?php esc_html_e('Select Image', 'total-plus'); ?></button>

                    <input name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($total_plus_field_value) ?>"/>
                </div>

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>

            </div>
            <?php
            break;

        case 'datepicker' :
            $selector = 'total_plus_' . md5(uniqid(rand(), true));
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat ht-datepicker" id="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>" name="<?php echo $instance->get_field_name($total_plus_widgets_name); ?>" type="text" value="<?php echo esc_html($total_plus_field_value); ?>" autocomplete="off" />

                <?php if (isset($total_plus_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        total_widget_datepicker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'heading' :
            ?>
            <p class="ht-form-row <?php echo $total_plus_widgets_class; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <label class="ht-label-heading" for="<?php echo $instance->get_field_id($total_plus_widgets_name); ?>"><?php echo esc_html($total_plus_widgets_title); ?>:</label>
                    <?php
                }

                if (isset($total_plus_widgets_description)) {
                    ?>
                    <br />
                    <small><?php echo wp_kses_post($total_plus_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'repeater':
            $selector = 'total_plus_' . md5(uniqid(rand(), true));
            ?>
            <div class="ht-form-row ht-widget-repeater-wrap <?php echo $total_plus_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($total_plus_widgets_title)) { ?>
                    <p><?php echo esc_html($total_plus_widgets_title); ?></p>
                    <?php
                }

                if (!is_array($total_plus_field_value)) {
                    foreach ($total_plus_widgets_repeater_fields as $key => $total_plus_widgets_repeater_field) {
                        $total_plus_default_fields[$key] = '';
                    }

                    $total_plus_field_value = array();
                    $total_plus_field_value[1] = $total_plus_default_fields;
                }

                $count = count($total_plus_field_value);
                ?>

                <div class="ht-widget-repeater" data-count="<?php echo $count; ?>">
                    <?php
                    $i = 0;
                    foreach ($total_plus_field_value as $total_plus_field_val) {
                        $i++;
                        ?>
                        <div class="ht-widget-repeater-box">
                            <?php if (isset($total_plus_widgets_repeater_title)) { ?>
                                <div class="ht-repeater-box-title"><?php echo '<span>' . esc_html($total_plus_widgets_repeater_title) . ' - ' . $total_plus_field_val[$total_plus_widgets_repeater_fields_title] . '</span>'; ?> <span class="ht-repeater-toggle"></span></div>
                            <?php }
                            ?>
                            <div class="ht-repeater-content">
                                <?php
                                foreach ($total_plus_widgets_repeater_fields as $key => $total_plus_widgets_repeater_field) {
                                    $id = $instance->get_field_id($total_plus_widgets_name . '-' . $i . '-' . $key);
                                    $name = $instance->get_field_name($total_plus_widgets_name);
                                    $value = isset($total_plus_field_val[$key]) ? $total_plus_field_val[$key] : '';

                                    switch ($total_plus_widgets_repeater_field['type']) {
                                        case 'text':
                                            ?>
                                            <p>
                                                <?php if (isset($total_plus_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($total_plus_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <input class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" type="text" value="<?php echo wp_kses_post($value); ?>" />

                                                <?php if (isset($total_plus_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($total_plus_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'textarea':
                                            ?>
                                            <p>
                                                <?php if (isset($total_plus_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($total_plus_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <textarea class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>"><?php echo wp_kses_post($value); ?></textarea>

                                                <?php if (isset($total_plus_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($total_plus_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'select' :
                                            ?>
                                            <p>
                                                <?php if (isset($total_plus_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($total_plus_widgets_repeater_field['title']); ?>:</label><br />
                                                    <?php
                                                }

                                                $options = $total_plus_widgets_repeater_field['options'];
                                                if ($options) {
                                                    ?>
                                                    <select name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" id="<?php echo esc_attr($id); ?>" class="widefat">
                                                        <?php foreach ($options as $total_plus_option_name => $total_plus_option_title) { ?>
                                                            <option value="<?php echo esc_attr($total_plus_option_name); ?>" <?php selected($total_plus_option_name, $value); ?>><?php echo esc_html($total_plus_option_title); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php
                                                }
                                                if (isset($total_plus_widgets_repeater_field['desc'])) {
                                                    ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($total_plus_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'icon' :
                                            ?>
                                            <div class="ht-widget-icon-box">
                                                <?php if (isset($total_plus_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($total_plus_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>

                                                <div class="ht-selected-icon">
                                                    <i class="<?php echo esc_attr($value); ?>"></i>
                                                    <span><i class="icofont-simple-down"></i></span>
                                                </div>

                                                <div class="ht-icon-box">
                                                    <div class="ht-icon-search">
                                                        <input type="text" class="ht-icon-search-input" placeholder="<?php echo esc_html__('Type to filter', 'total-plus') ?>" />
                                                    </div>
                                                    <ul class="ht-icon-list clearfix">
                                                        <?php
                                                        if (isset($total_plus_widgets_repeater_field['icon_array']) && !empty($total_plus_widgets_repeater_field['icon_array'])) {
                                                            $icon_array = $total_plus_widgets_repeater_field['icon_array'];
                                                        } else {
                                                            $icon_array = total_plus_font_awesome_icon_array();
                                                        }
                                                        foreach ($icon_array as $icon) {
                                                            $icon_class = $value == $icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . $icon . '"></i></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" value="<?php echo esc_attr($value); ?>" />

                                                <?php if (isset($total_plus_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($total_plus_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            break;

                                        case 'editor' :
                                            ?>
                                            <p>
                                                <?php if (isset($total_plus_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($total_plus_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <input class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" value="<?php echo esc_textarea($value); ?>" type="hidden" />
                                                <a href="#" class="button ht-wp-editor-button"><?php esc_html_e('Add/Edit Content', 'total-plus') ?></a>
                                                <?php if (isset($total_plus_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($total_plus_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($value) {
                                                $image = '<img src="' . esc_url($value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            ?>
                                            <div class="attachment-media-view widget-media-view">

                                                <?php if (isset($total_plus_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($total_plus_widgets_repeater_field['title']); ?>:</label>
                                                <?php } ?>

                                                <div class="placeholder<?php echo $image_class; ?>">
                                                    <?php esc_html_e('No image selected', 'total-plus'); ?>
                                                </div>
                                                <div class="thumbnail thumbnail-image">
                                                    <?php echo $image; ?>
                                                </div>

                                                <div class="actions clearfix">
                                                    <button type="button" class="button ht-delete-button align-left"><?php esc_html_e('Remove', 'total-plus'); ?></button>
                                                    <button type="button" class="button ht-upload-button alignright"><?php esc_html_e('Select Image', 'total-plus'); ?></button>

                                                    <input name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" id="<?php echo esc_attr($id); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($value) ?>"/>
                                                </div>

                                                <?php if (isset($total_plus_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($total_plus_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>

                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                                <a href="#" class="button ht-widget-repeater-remove"><?php esc_html_e('Remove', 'total-plus'); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <a href="#" class="button ht-widget-add-item"><?php echo esc_html($total_plus_widgets_add_button); ?></a>
            </div>
            <script>
                jQuery(function ($) {
                    total_widget_sortable('#<?php echo $selector; ?>');
                });
            </script>
            <?php
            break;
    }
}

function total_plus_exclude_widget_update($widget_field_type) {
    $uncheck_array = array('tab', 'open', 'close', 'heading');
    if (in_array($widget_field_type, $uncheck_array)) {
        return true;
    } else {
        return false;
    }
}

function total_plus_widgets_updated_field_value($widget_field, $new_field_value) {
    extract($widget_field);
    if ($total_plus_widgets_field_type == 'number') {
        return absint($new_field_value);
    } elseif ($total_plus_widgets_field_type == 'editor' || $total_plus_widgets_field_type == 'inline_editor' || $total_plus_widgets_field_type == 'textarea') {
        return wp_kses_post(force_balance_tags($new_field_value));
    } elseif ($total_plus_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } elseif ($total_plus_widgets_field_type == 'multicheckbox') {
        return $new_field_value;
    } elseif ($total_plus_widgets_field_type == 'checkbox') {
        if ($new_field_value) {
            return '1';
        } else {
            return '0';
        }
    } elseif ($total_plus_widgets_field_type == 'repeater') {
        if (!empty($new_field_value)) {
            foreach ($new_field_value as $new_field_key => $new_field_val) {
                foreach ($new_field_val as $key => $value) {
                    $output[$new_field_key][$key] = wp_kses_post($value);
                }
            }
            return $output;
        }
    } else {
        return wp_kses_post(force_balance_tags($new_field_value));
    }
}
