<?php

/* ============BLOG PANEL============ */
$wp_customize->add_section(new Total_Plus_Toggle_Section($wp_customize, 'total_plus_blog_section', array(
    'title' => esc_html__('Blog Section', 'total-plus'),
    'panel' => 'total_plus_home_panel',
    'priority' => total_plus_get_section_position('total_plus_blog_section'),
    'hiding_control' => 'total_plus_blog_section_disable'
)));

//ENABLE/DISABLE BLOG SECTION
$wp_customize->add_setting('total_plus_blog_section_disable', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Total_Plus_Switch_Control($wp_customize, 'total_plus_blog_section_disable', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Disable Section', 'total-plus'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'total-plus'),
        'off' => esc_html__('No', 'total-plus')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('total_plus_blog_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_blog_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_blog_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'total-plus'),
            'fields' => array(
                'total_plus_blog_title_subtitle_heading',
                'total_plus_blog_super_title',
                'total_plus_blog_title',
                'total_plus_blog_sub_title',
                'total_plus_blog_title_style',
                'total_plus_blog_cat_exclude',
                'total_plus_blog_setting_heading',
                'total_plus_blog_style',
                'total_plus_blog_col',
                'total_plus_blog_post_count',
                'total_plus_blog_excerpt_count',
                'total_plus_blog_show_date',
                'total_plus_blog_show_author_comment',
                'total_plus_blog_more_button_heading',
                'total_plus_blog_button_text',
                'total_plus_blog_button_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'total-plus'),
            'fields' => array(
                'total_plus_blog_cs_heading',
                'total_plus_blog_super_title_color',
                'total_plus_blog_title_color',
                'total_plus_blog_text_color',
                'total_plus_blog_link_color',
                'total_plus_blog_link_hov_color',
                'total_plus_blog_block_seperator',
                'total_plus_blog_block_title_color',
                'total_plus_blog_block_excerpt_color',
                'total_plus_blog_block_meta_color',
                'total_plus_blog_block_meta_background_color',
                'total_plus_blog_block_readmore_button_bg_color',
                'total_plus_blog_block_readmore_button_text_color',
                'total_plus_blog_mb_seperator',
                'total_plus_blog_mb_color_group',
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'total-plus'),
            'fields' => array(
                'total_plus_blog_enable_fullwindow',
                'total_plus_blog_align_item',
                'total_plus_blog_fw_seperator',
                'total_plus_blog_bg_type',
                'total_plus_blog_bg_color',
                'total_plus_blog_bg_gradient',
                'total_plus_blog_bg_image',
                'total_plus_blog_parallax_effect',
                'total_plus_blog_bg_video',
                'total_plus_blog_overlay_color',
                'total_plus_blog_cs_seperator',
                'total_plus_blog_padding',
                'total_plus_blog_seperator0',
                'total_plus_blog_section_seperator',
                'total_plus_blog_seperator1',
                'total_plus_blog_top_seperator',
                'total_plus_blog_ts_color',
                'total_plus_blog_ts_height',
                'total_plus_blog_seperator2',
                'total_plus_blog_bottom_seperator',
                'total_plus_blog_bs_color',
                'total_plus_blog_bs_height'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_blog_title_subtitle_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_blog_title_subtitle_heading', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Section Title & Sub Title', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_super_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_blog_super_title', array(
    'section' => 'total_plus_blog_section',
    'type' => 'text',
    'label' => esc_html__('Super Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_blog_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Blog Section', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_blog_title', array(
    'section' => 'total_plus_blog_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_blog_sub_title', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => esc_html__('Blog Section SubTitle', 'total-plus'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_blog_sub_title', array(
    'section' => 'total_plus_blog_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_blog_title_style', array(
    'default' => 'ht-section-title-top-center',
    'sanitize_callback' => 'total_plus_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_blog_title_style', array(
    'section' => 'total_plus_blog_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'total-plus'),
    'choices' => total_plus_tagline_style()
));

//BLOG SETTINGS
$wp_customize->add_setting('total_plus_blog_setting_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_blog_setting_heading', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Settings', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_style', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Selector($wp_customize, 'total_plus_blog_style', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Blog Style', 'total-plus'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/blog-style1.png',
        'style2' => $imagepath . '/inc/customizer/images/blog-style2.png',
        'style3' => $imagepath . '/inc/customizer/images/blog-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/blog-style4.png',
    )
)));

$wp_customize->add_setting('total_plus_blog_cat_exclude', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Customize_Checkbox_Multiple($wp_customize, 'total_plus_blog_cat_exclude', array(
    'label' => esc_html__('Exclude Category from Blog Posts', 'total-plus'),
    'section' => 'total_plus_blog_section',
    'choices' => $total_plus_cat
)));

$wp_customize->add_setting('total_plus_blog_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_blog_col', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('No of Columns', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 4,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_blog_post_count', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_blog_post_count', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Number of Posts to show', 'total-plus'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 15,
        'step' => 1,
    )
)));

$wp_customize->add_setting('total_plus_blog_excerpt_count', array(
    'sanitize_callback' => 'absint',
    'default' => 120,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_blog_excerpt_count', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Excerpt Character', 'total-plus'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 600,
        'step' => 10,
    )
)));

$wp_customize->add_setting('total_plus_blog_show_date', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_show_date', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Show Date', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_show_author_comment', array(
    'sanitize_callback' => 'total_plus_sanitize_checkbox',
    'default' => true,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_show_author_comment', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('Show Author & Comment Count', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_more_button_heading', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Heading($wp_customize, 'total_plus_blog_more_button_heading', array(
    'section' => 'total_plus_blog_section',
    'label' => esc_html__('More Button', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_button_text', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_blog_button_text', array(
    'section' => 'total_plus_blog_section',
    'type' => 'text',
    'label' => esc_html__('More Button Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_blog_button_link', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control('total_plus_blog_button_link', array(
    'section' => 'total_plus_blog_section',
    'type' => 'text',
    'label' => esc_html__('More Button Link', 'total-plus')
));

$wp_customize->add_setting("total_plus_blog_block_seperator", array(
    'sanitize_callback' => 'total_plus_sanitize_text',
));

$wp_customize->add_control(new Total_Plus_Separator_Control($wp_customize, "total_plus_blog_block_seperator", array(
    'section' => 'total_plus_blog_section',
    'priority' => 56
)));

$wp_customize->add_setting('total_plus_blog_block_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_blog_block_title_color', array(
    'section' => 'total_plus_blog_section',
    'priority' => 56,
    'label' => esc_html__('Blog Block Title Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_block_excerpt_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_blog_block_excerpt_color', array(
    'section' => 'total_plus_blog_section',
    'priority' => 56,
    'label' => esc_html__('Blog Block Excerpt Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_block_meta_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_blog_block_meta_color', array(
    'section' => 'total_plus_blog_section',
    'priority' => 56,
    'label' => esc_html__('Blog Block Meta(date/author/comment) Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_block_meta_background_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_blog_block_meta_background_color', array(
    'section' => 'total_plus_blog_section',
    'priority' => 56,
    'label' => esc_html__('Blog Block Meta(date) Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_block_readmore_button_bg_color', array(
    'default' => '#FFC107',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_blog_block_readmore_button_bg_color', array(
    'section' => 'total_plus_blog_section',
    'priority' => 56,
    'label' => esc_html__('Blog Block Read More Button Background Color', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_block_readmore_button_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_plus_blog_block_readmore_button_text_color', array(
    'section' => 'total_plus_blog_section',
    'priority' => 56,
    'label' => esc_html__('Blog Block Read More Button Text Color', 'total-plus')
)));

$wp_customize->selective_refresh->add_partial('total_plus_blog_title_style', array(
    'selector' => '.ht-blog-section',
    'render_callback' => 'total_plus_blog_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_super_title', array(
    'selector' => '.ht-blog-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_blog_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_title', array(
    'selector' => '.ht-blog-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_blog_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_sub_title', array(
    'selector' => '.ht-blog-section .ht-section-title-tagline',
    'render_callback' => 'total_plus_blog_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_cat_exclude', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_style', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_col', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_post_count', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_excerpt_count', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_show_date', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_show_author_comment', array(
    'selector' => '.ht-blog-content',
    'render_callback' => 'total_plus_blog_content'
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_button_text', array(
    'selector' => '.ht-blog-section',
    'render_callback' => 'total_plus_blog_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('total_plus_blog_button_link', array(
    'selector' => '.ht-blog-section',
    'render_callback' => 'total_plus_blog_section',
    'container_inclusive' => true
));

