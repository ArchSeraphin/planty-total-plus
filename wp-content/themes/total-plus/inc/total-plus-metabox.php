<?php

/**
 *
 * @package Total Plus
 */
function total_plus_post_metabox($meta_boxes) {
    $prefix = 'total_plus_';
    $image_url = get_template_directory_uri() . '/inc/customizer/images/';

    $meta_boxes[] = array(
        'id' => 'total_plus_post_setting',
        'title' => esc_html__('Page Setting', 'total-plus'),
        'post_types' => array('page', 'product'),
        'context' => 'advanced',
        'priority' => 'high',
        'autosave' => true,
        'tabs' => array(
            'general-setting' => array(
                'label' => esc_html__('General Setting', 'total-plus'),
                'icon' => 'dashicons-admin-generic'
            ),
            'titlebar-setting' => array(
                'label' => esc_html__('Title Bar Setting', 'total-plus'),
                'icon' => 'dashicons-editor-kitchensink'
            ),
            'content-setting' => array(
                'label' => esc_html__('Content Setting', 'total-plus'),
                'icon' => 'dashicons-admin-page'
            ),
            'sidebar-setting' => array(
                'label' => esc_html__('Sidebar Setting', 'total-plus'),
                'icon' => 'dashicons-welcome-widgets-menus'
            )
        ),
        'tab_style' => 'left',
        'tab_wrapper' => true,
        'fields' => array(
            array(
                'name' => esc_html__('Hide Header', 'total-plus'),
                'id' => 'hide_header',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Footer', 'total-plus'),
                'id' => 'hide_footer',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Disable Space Below Header', 'total-plus'),
                'id' => 'disable_space_below_header',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Disable Space Above Footer', 'total-plus'),
                'id' => 'disable_space_above_footer',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Page Background Options', 'total-plus'),
                'type' => 'group',
                'class' => 'background-group',
                'id' => 'page_background',
                'tab' => 'general-setting',
                'fields' => array(
                    array(
                        'id' => 'page_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'page_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat', 'total-plus'),
                        'id' => 'page_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                            'repeat' => esc_html__('Repeat All', 'total-plus'),
                            'repeat-x' => esc_html__('Repeat Horizontally', 'total-plus'),
                            'repeat-y' => esc_html__('Repeat Vertically', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size', 'total-plus'),
                        'id' => 'page_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'auto' => esc_html__('Auto', 'total-plus'),
                            'cover' => esc_html__('Cover', 'total-plus'),
                            'contain' => esc_html__('Contain', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment', 'total-plus'),
                        'id' => 'page_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'scroll' => esc_html__('Scroll', 'total-plus'),
                            'fixed' => esc_html__('Fixed', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position', 'total-plus'),
                        'id' => 'page_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top', 'total-plus'),
                            'left center' => esc_html__('Left Center', 'total-plus'),
                            'left bottom' => esc_html__('Left Bottom', 'total-plus'),
                            'center top' => esc_html__('Center Top', 'total-plus'),
                            'center center' => esc_html__('Center Center', 'total-plus'),
                            'center bottom' => esc_html__('Center Bottom', 'total-plus'),
                            'right top' => esc_html__('Right Top', 'total-plus'),
                            'right center' => esc_html__('Right Center', 'total-plus'),
                            'right bottom' => esc_html__('Right Bottom', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    )
                )
            ),
            array(
                'name' => esc_html__('Page Text Color', 'total-plus'),
                'id' => 'page_text_color',
                'type' => 'color',
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Titlebar', 'total-plus'),
                'id' => 'hide_titlebar',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Sub Title', 'total-plus'),
                'id' => 'sub_title',
                'type' => 'text',
                'tab' => 'titlebar-setting',
                'attributes' => array(
                    'class' => 'widefat'
                )
            ),
            array(
                'name' => esc_html__('OverWrite Default Style', 'total-plus'),
                'label_description' => esc_html__('A set of settings will appear', 'total-plus'),
                'id' => 'page_overwrite_defaults',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Titlebar Background Options', 'total-plus'),
                'type' => 'group',
                'class' => 'background-group',
                'tab' => 'titlebar-setting',
                'id' => 'titlebar_background',
                'hidden' => array('overwrite_defaults', false),
                'fields' => array(
                    array(
                        'id' => 'titlebar_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'titlebar_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat', 'total-plus'),
                        'id' => 'titlebar_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                            'repeat' => esc_html__('Repeat All', 'total-plus'),
                            'repeat-x' => esc_html__('Repeat Horizontally', 'total-plus'),
                            'repeat-y' => esc_html__('Repeat Vertically', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size', 'total-plus'),
                        'id' => 'titlebar_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit', 'total-plus'),
                            'cover' => esc_html__('Cover', 'total-plus'),
                            'contain' => esc_html__('Contain', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment', 'total-plus'),
                        'id' => 'titlebar_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit', 'total-plus'),
                            'fixed' => esc_html__('Fixed', 'total-plus'),
                            'scroll' => esc_html__('Scroll', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position', 'total-plus'),
                        'id' => 'titlebar_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top', 'total-plus'),
                            'left center' => esc_html__('Left Center', 'total-plus'),
                            'left bottom' => esc_html__('Left Bottom', 'total-plus'),
                            'center top' => esc_html__('Center Top', 'total-plus'),
                            'center center' => esc_html__('Center Center', 'total-plus'),
                            'center bottom' => esc_html__('Center Bottom', 'total-plus'),
                            'right top' => esc_html__('Right Top', 'total-plus'),
                            'right center' => esc_html__('Right Center', 'total-plus'),
                            'right bottom' => esc_html__('Right Bottom', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'name' => esc_html__('Overlay Background Color', 'total-plus'),
                        'id' => 'overlay_bg_color',
                        'type' => 'color',
                        'alpha_channel' => true,
                        'hidden' => array('titlebar_bg_image', 0)
                    ),
                    array(
                        'name' => esc_html__('Enable Parallax Effect', 'total-plus'),
                        'id' => 'enable_parallax_effect',
                        'type' => 'switch',
                        'style' => 'square',
                        'on_label' => esc_html__('Yes', 'total-plus'),
                        'off_label' => esc_html__('No', 'total-plus'),
                        'std' => 0,
                        'class' => 'switch no-margin',
                        'hidden' => array('titlebar_bg_image', 0)
                    )
                )
            ),
            array(
                'name' => esc_html__('Text Color', 'total-plus'),
                'id' => 'titlebar_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Top Bottom Padding', 'total-plus'),
                'id' => 'titlebar_padding',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 80,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Display Title in Content', 'total-plus'),
                'id' => 'content_display_title',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'content-setting'
            ),
            array(
                'name' => esc_html__('Display Featured Image in Content', 'total-plus'),
                'id' => 'content_display_featured_image',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'content-setting'
            ),
            array(
                'name' => esc_html__('Content Width', 'total-plus'),
                'id' => 'content_width',
                'type' => 'radio',
                'options' => array(
                    'container' => esc_html__('Inside Container', 'total-plus'),
                    'full-width' => esc_html__('Full Width', 'total-plus')
                ),
                'inline' => true,
                'std' => 'container',
                'tab' => 'content-setting'
            ),
            array(
                'id' => 'sidebar_layout',
                'type' => 'image_select',
                'name' => esc_html__('Sidebar Layout', 'total-plus'),
                'options' => array(
                    'default-sidebar' => $image_url . 'default.png',
                    'right-sidebar' => $image_url . 'right-sidebar.png',
                    'left-sidebar' => $image_url . 'left-sidebar.png',
                    'no-sidebar' => $image_url . 'no-sidebar.png',
                    'no-sidebar-narrow' => $image_url . 'no-sidebar-narrow.png'
                ),
                'std' => 'default-sidebar',
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Left Sidebar', 'total-plus'),
                'id' => 'left_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar', 'total-plus'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Right Sidebar', 'total-plus'),
                'id' => 'right_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar', 'total-plus'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            )
        )
    );

    $meta_boxes[] = array(
        'id' => 'total_plus_post_setting',
        'title' => esc_html__('Portfolio Setting', 'total-plus'),
        'post_types' => array('portfolio'),
        'context' => 'advanced',
        'priority' => 'high',
        'autosave' => true,
        'tabs' => array(
            'general-setting' => array(
                'label' => esc_html__('General Setting', 'total-plus'),
                'icon' => 'dashicons-admin-generic'
            ),
            'titlebar-setting' => array(
                'label' => esc_html__('Title Bar Setting', 'total-plus'),
                'icon' => 'dashicons-editor-kitchensink'
            ),
            'content-setting' => array(
                'label' => esc_html__('Content Setting', 'total-plus'),
                'icon' => 'dashicons-admin-page'
            ),
            'sidebar-setting' => array(
                'label' => esc_html__('Sidebar Setting', 'total-plus'),
                'icon' => 'dashicons-welcome-widgets-menus'
            )
        ),
        'tab_style' => 'left',
        'tab_wrapper' => true,
        'fields' => array(
            array(
                'name' => esc_html__('Hide Header', 'total-plus'),
                'id' => 'hide_header',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Footer', 'total-plus'),
                'id' => 'hide_footer',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Disable Space Below Header', 'total-plus'),
                'id' => 'disable_space_below_header',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Disable Space Above Footer', 'total-plus'),
                'id' => 'disable_space_above_footer',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Page Background Options', 'total-plus'),
                'type' => 'group',
                'class' => 'background-group',
                'id' => 'page_background',
                'tab' => 'general-setting',
                'fields' => array(
                    array(
                        'id' => 'page_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'page_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat', 'total-plus'),
                        'id' => 'page_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                            'repeat' => esc_html__('Repeat All', 'total-plus'),
                            'repeat-x' => esc_html__('Repeat Horizontally', 'total-plus'),
                            'repeat-y' => esc_html__('Repeat Vertically', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size', 'total-plus'),
                        'id' => 'page_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'auto' => esc_html__('Auto', 'total-plus'),
                            'cover' => esc_html__('Cover', 'total-plus'),
                            'contain' => esc_html__('Contain', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment', 'total-plus'),
                        'id' => 'page_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'scroll' => esc_html__('Scroll', 'total-plus'),
                            'fixed' => esc_html__('Fixed', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position', 'total-plus'),
                        'id' => 'page_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top', 'total-plus'),
                            'left center' => esc_html__('Left Center', 'total-plus'),
                            'left bottom' => esc_html__('Left Bottom', 'total-plus'),
                            'center top' => esc_html__('Center Top', 'total-plus'),
                            'center center' => esc_html__('Center Center', 'total-plus'),
                            'center bottom' => esc_html__('Center Bottom', 'total-plus'),
                            'right top' => esc_html__('Right Top', 'total-plus'),
                            'right center' => esc_html__('Right Center', 'total-plus'),
                            'right bottom' => esc_html__('Right Bottom', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    )
                )
            ),
            array(
                'name' => esc_html__('Page Text Color', 'total-plus'),
                'id' => 'page_text_color',
                'type' => 'color',
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Titlebar', 'total-plus'),
                'id' => 'hide_titlebar',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Sub Title', 'total-plus'),
                'id' => 'sub_title',
                'type' => 'text',
                'tab' => 'titlebar-setting',
                'attributes' => array(
                    'class' => 'widefat'
                )
            ),
            array(
                'name' => esc_html__('OverWrite Default Style', 'total-plus'),
                'label_description' => esc_html__('A set of settings will appear', 'total-plus'),
                'id' => 'page_overwrite_defaults',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Titlebar Background Options', 'total-plus'),
                'type' => 'group',
                'class' => 'background-group',
                'tab' => 'titlebar-setting',
                'id' => 'titlebar_background',
                'hidden' => array('overwrite_defaults', false),
                'fields' => array(
                    array(
                        'id' => 'titlebar_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'titlebar_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat', 'total-plus'),
                        'id' => 'titlebar_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                            'repeat' => esc_html__('Repeat All', 'total-plus'),
                            'repeat-x' => esc_html__('Repeat Horizontally', 'total-plus'),
                            'repeat-y' => esc_html__('Repeat Vertically', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size', 'total-plus'),
                        'id' => 'titlebar_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit', 'total-plus'),
                            'cover' => esc_html__('Cover', 'total-plus'),
                            'contain' => esc_html__('Contain', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment', 'total-plus'),
                        'id' => 'titlebar_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit', 'total-plus'),
                            'fixed' => esc_html__('Fixed', 'total-plus'),
                            'scroll' => esc_html__('Scroll', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position', 'total-plus'),
                        'id' => 'titlebar_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top', 'total-plus'),
                            'left center' => esc_html__('Left Center', 'total-plus'),
                            'left bottom' => esc_html__('Left Bottom', 'total-plus'),
                            'center top' => esc_html__('Center Top', 'total-plus'),
                            'center center' => esc_html__('Center Center', 'total-plus'),
                            'center bottom' => esc_html__('Center Bottom', 'total-plus'),
                            'right top' => esc_html__('Right Top', 'total-plus'),
                            'right center' => esc_html__('Right Center', 'total-plus'),
                            'right bottom' => esc_html__('Right Bottom', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'name' => esc_html__('Overlay Background Color', 'total-plus'),
                        'id' => 'overlay_bg_color',
                        'type' => 'color',
                        'alpha_channel' => true,
                        'hidden' => array('titlebar_bg_image', 0)
                    ),
                    array(
                        'name' => esc_html__('Enable Parallax Effect', 'total-plus'),
                        'id' => 'enable_parallax_effect',
                        'type' => 'switch',
                        'style' => 'square',
                        'on_label' => esc_html__('Yes', 'total-plus'),
                        'off_label' => esc_html__('No', 'total-plus'),
                        'std' => 0,
                        'class' => 'switch no-margin',
                        'hidden' => array('titlebar_bg_image', 0)
                    )
                )
            ),
            array(
                'name' => esc_html__('Text Color', 'total-plus'),
                'id' => 'titlebar_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Top Bottom Padding', 'total-plus'),
                'id' => 'titlebar_padding',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 80,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Display Title in Content', 'total-plus'),
                'id' => 'content_display_title',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'content-setting'
            ),
            array(
                'name' => esc_html__('Display Featured Image in Content', 'total-plus'),
                'id' => 'content_display_featured_image',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'content-setting'
            ),
            array(
                'name' => esc_html__('Portfolio External Link', 'total-plus'),
                'id' => 'external_link',
                'type' => 'text',
                'tab' => 'content-setting',
                'label_description' => esc_html__('Set the external link for the portfolio or it will link to its detail page', 'total-plus'),
                'attributes' => array(
                    'class' => 'widefat'
                )
            ),
            array(
                'name' => esc_html__('Open Portfolio External Link in New Tab', 'total-plus'),
                'label_description' => esc_html__('This will only work for the external link added', 'total-plus'),
                'id' => 'external_link_new_tab',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 1,
                'tab' => 'content-setting'
            ),
            array(
                'name' => esc_html__('Content Width', 'total-plus'),
                'id' => 'content_width',
                'type' => 'radio',
                'options' => array(
                    'container' => esc_html__('Inside Container', 'total-plus'),
                    'full-width' => esc_html__('Full Width', 'total-plus')
                ),
                'inline' => true,
                'std' => 'container',
                'tab' => 'content-setting'
            ),
            array(
                'id' => 'sidebar_layout',
                'type' => 'image_select',
                'name' => esc_html__('Sidebar Layout', 'total-plus'),
                'options' => array(
                    'default-sidebar' => $image_url . 'default.png',
                    'right-sidebar' => $image_url . 'right-sidebar.png',
                    'left-sidebar' => $image_url . 'left-sidebar.png',
                    'no-sidebar' => $image_url . 'no-sidebar.png',
                    'no-sidebar-narrow' => $image_url . 'no-sidebar-narrow.png'
                ),
                'std' => 'default-sidebar',
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Left Sidebar', 'total-plus'),
                'id' => 'left_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar', 'total-plus'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Right Sidebar', 'total-plus'),
                'id' => 'right_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar', 'total-plus'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            )
        )
    );

    $meta_boxes[] = array(
        'id' => 'total_plus_post_setting',
        'title' => esc_html__('Post Setting', 'total-plus'),
        'post_types' => array('post'),
        'context' => 'advanced',
        'priority' => 'high',
        'autosave' => true,
        'tabs' => array(
            'general-setting' => array(
                'label' => esc_html__('General Setting', 'total-plus'),
                'icon' => 'dashicons-admin-generic'
            ),
            'titlebar-setting' => array(
                'label' => esc_html__('Title Bar Setting', 'total-plus'),
                'icon' => 'dashicons-editor-kitchensink'
            ),
            'content-setting' => array(
                'label' => esc_html__('Content Setting', 'total-plus'),
                'icon' => 'dashicons-admin-page'
            ),
            'sidebar-setting' => array(
                'label' => esc_html__('Sidebar Setting', 'total-plus'),
                'icon' => 'dashicons-welcome-widgets-menus'
            )
        ),
        'tab_style' => 'left',
        'tab_wrapper' => true,
        'fields' => array(
            array(
                'name' => esc_html__('Hide Header', 'total-plus'),
                'id' => 'hide_header',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Footer', 'total-plus'),
                'id' => 'hide_footer',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Page Background Options', 'total-plus'),
                'type' => 'group',
                'class' => 'background-group',
                'id' => 'page_background',
                'tab' => 'general-setting',
                'fields' => array(
                    array(
                        'id' => 'page_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'page_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat', 'total-plus'),
                        'id' => 'page_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                            'repeat' => esc_html__('Repeat All', 'total-plus'),
                            'repeat-x' => esc_html__('Repeat Horizontally', 'total-plus'),
                            'repeat-y' => esc_html__('Repeat Vertically', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size', 'total-plus'),
                        'id' => 'page_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'auto' => esc_html__('Auto', 'total-plus'),
                            'cover' => esc_html__('Cover', 'total-plus'),
                            'contain' => esc_html__('Contain', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment', 'total-plus'),
                        'id' => 'page_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'scroll' => esc_html__('Scroll', 'total-plus'),
                            'fixed' => esc_html__('Fixed', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position', 'total-plus'),
                        'id' => 'page_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top', 'total-plus'),
                            'left center' => esc_html__('Left Center', 'total-plus'),
                            'left bottom' => esc_html__('Left Bottom', 'total-plus'),
                            'center top' => esc_html__('Center Top', 'total-plus'),
                            'center center' => esc_html__('Center Center', 'total-plus'),
                            'center bottom' => esc_html__('Center Bottom', 'total-plus'),
                            'right top' => esc_html__('Right Top', 'total-plus'),
                            'right center' => esc_html__('Right Center', 'total-plus'),
                            'right bottom' => esc_html__('Right Bottom', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('page_bg_image', 0),
                        'columns' => 6
                    )
                )
            ),
            array(
                'name' => esc_html__('Page Text Color', 'total-plus'),
                'id' => 'page_text_color',
                'type' => 'color',
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Titlebar', 'total-plus'),
                'id' => 'hide_titlebar',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Sub Title', 'total-plus'),
                'id' => 'sub_title',
                'type' => 'text',
                'tab' => 'titlebar-setting',
                'attributes' => array(
                    'class' => 'widefat'
                )
            ),
            array(
                'name' => esc_html__('OverWrite Default Style', 'total-plus'),
                'label_description' => esc_html__('A set of settings will appear', 'total-plus'),
                'id' => 'page_overwrite_defaults',
                'type' => 'switch',
                'style' => 'square',
                'on_label' => esc_html__('Yes', 'total-plus'),
                'off_label' => esc_html__('No', 'total-plus'),
                'std' => 0,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Titlebar Background Options', 'total-plus'),
                'type' => 'group',
                'class' => 'background-group',
                'tab' => 'titlebar-setting',
                'id' => 'titlebar_background',
                'hidden' => array('overwrite_defaults', false),
                'fields' => array(
                    array(
                        'id' => 'titlebar_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'titlebar_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat', 'total-plus'),
                        'id' => 'titlebar_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat', 'total-plus'),
                            'repeat' => esc_html__('Repeat All', 'total-plus'),
                            'repeat-x' => esc_html__('Repeat Horizontally', 'total-plus'),
                            'repeat-y' => esc_html__('Repeat Vertically', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size', 'total-plus'),
                        'id' => 'titlebar_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit', 'total-plus'),
                            'cover' => esc_html__('Cover', 'total-plus'),
                            'contain' => esc_html__('Contain', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment', 'total-plus'),
                        'id' => 'titlebar_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit', 'total-plus'),
                            'fixed' => esc_html__('Fixed', 'total-plus'),
                            'scroll' => esc_html__('Scroll', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position', 'total-plus'),
                        'id' => 'titlebar_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top', 'total-plus'),
                            'left center' => esc_html__('Left Center', 'total-plus'),
                            'left bottom' => esc_html__('Left Bottom', 'total-plus'),
                            'center top' => esc_html__('Center Top', 'total-plus'),
                            'center center' => esc_html__('Center Center', 'total-plus'),
                            'center bottom' => esc_html__('Center Bottom', 'total-plus'),
                            'right top' => esc_html__('Right Top', 'total-plus'),
                            'right center' => esc_html__('Right Center', 'total-plus'),
                            'right bottom' => esc_html__('Right Bottom', 'total-plus')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'name' => esc_html__('Overlay Background Color', 'total-plus'),
                        'id' => 'overlay_bg_color',
                        'type' => 'color',
                        'alpha_channel' => true,
                        'hidden' => array('titlebar_bg_image', 0)
                    ),
                    array(
                        'name' => esc_html__('Enable Parallax Effect', 'total-plus'),
                        'id' => 'enable_parallax_effect',
                        'type' => 'switch',
                        'style' => 'square',
                        'on_label' => esc_html__('Yes', 'total-plus'),
                        'off_label' => esc_html__('No', 'total-plus'),
                        'std' => 0,
                        'class' => 'switch no-margin',
                        'hidden' => array('titlebar_bg_image', 0)
                    )
                )
            ),
            array(
                'name' => esc_html__('Text Color', 'total-plus'),
                'id' => 'titlebar_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Top Bottom Padding', 'total-plus'),
                'id' => 'titlebar_padding',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 80,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Content Width', 'total-plus'),
                'id' => 'content_width',
                'type' => 'radio',
                'options' => array(
                    'container' => esc_html__('Inside Container', 'total-plus'),
                    'full-width' => esc_html__('Full Width', 'total-plus'),
                ),
                'inline' => true,
                'std' => 'container',
                'tab' => 'content-setting'
            ),
            array(
                'id' => 'sidebar_layout',
                'type' => 'image_select',
                'name' => esc_html__('Sidebar Layout', 'total-plus'),
                'options' => array(
                    'default-sidebar' => $image_url . 'default.png',
                    'right-sidebar' => $image_url . 'right-sidebar.png',
                    'left-sidebar' => $image_url . 'left-sidebar.png',
                    'no-sidebar' => $image_url . 'no-sidebar.png',
                    'no-sidebar-narrow' => $image_url . 'no-sidebar-narrow.png'
                ),
                'std' => 'default-sidebar',
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Left Sidebar', 'total-plus'),
                'id' => esc_html__('left_sidebar', 'total-plus'),
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar', 'total-plus'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Right Sidebar', 'total-plus'),
                'id' => 'right_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar', 'total-plus'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            )
        )
    );

    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'total_plus_post_metabox');
