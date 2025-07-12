<?php

/**
 * Total Plus Theme Customizer
 *
 * @package Total Plus
 */
$wp_customize->add_section('total_plus_blog_options_section', array(
    'title' => __('Blog/Single Post Settings', 'total-plus'),
    'priority' => 30
));

$wp_customize->add_setting('total_plus_blog_sec_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Total_Plus_Control_Tab($wp_customize, 'total_plus_blog_sec_nav', array(
    'type' => 'tab',
    'section' => 'total_plus_blog_options_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Blog Page', 'total-plus'),
            'fields' => array(
                'total_plus_blog_layout',
                'total_plus_blog_cat',
                'total_plus_archive_content',
                'total_plus_archive_excerpt_length',
                'total_plus_archive_readmore',
                'total_plus_blog_date',
                'total_plus_blog_author',
                'total_plus_blog_comment',
                'total_plus_blog_category',
                'total_plus_blog_tag',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Single Post', 'total-plus'),
            'fields' => array(
                'total_plus_single_blog_title',
                'total_plus_single_post_top_elements',
                'total_plus_single_post_bottom_elements'
            ),
        ),
    ),
)));

$wp_customize->add_setting('total_plus_blog_layout', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => 'blog-layout1'
));

$wp_customize->add_control(new Total_Plus_Image_Select($wp_customize, 'total_plus_blog_layout', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Blog Layout', 'total-plus'),
    'image_path' => $imagepath . '/inc/customizer/images/',
    'choices' => array(
        'blog-layout1' => esc_html__('Layout 1', 'total-plus'),
        'blog-layout2' => esc_html__('Layout 2', 'total-plus'),
        'blog-layout3' => esc_html__('Layout 3', 'total-plus'),
        'blog-layout4' => esc_html__('Layout 4', 'total-plus')
    )
)));

$wp_customize->add_setting('total_plus_blog_cat', array(
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control(new Total_Plus_Customize_Checkbox_Multiple($wp_customize, 'total_plus_blog_cat', array(
    'label' => esc_html__('Exclude Category', 'total-plus'),
    'section' => 'total_plus_blog_options_section',
    'choices' => $total_plus_cat,
    'description' => esc_html__('Post with selected category will not display in the blog page', 'total-plus')
)));

$wp_customize->add_setting('total_plus_archive_content', array(
    'default' => 'excerpt',
    'sanitize_callback' => 'total_plus_sanitize_choices'
));

$wp_customize->add_control('total_plus_archive_content', array(
    'section' => 'total_plus_blog_options_section',
    'type' => 'radio',
    'label' => esc_html__('Archive Content', 'total-plus'),
    'choices' => array(
        'full-content' => esc_html__('Full Content', 'total-plus'),
        'excerpt' => esc_html__('Excerpt', 'total-plus')
    )
));

$wp_customize->add_setting('total_plus_archive_excerpt_length', array(
    'sanitize_callback' => 'absint',
    'default' => 100
));

$wp_customize->add_control(new Total_Plus_Range_Control($wp_customize, 'total_plus_archive_excerpt_length', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Excerpt Length (words)', 'total-plus'),
    'input_attrs' => array(
        'min' => 50,
        'max' => 200,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_plus_archive_readmore', array(
    'default' => esc_html__('Read More', 'total-plus'),
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control('total_plus_archive_readmore', array(
    'section' => 'total_plus_blog_options_section',
    'type' => 'text',
    'label' => esc_html__('Read More Text', 'total-plus')
));

$wp_customize->add_setting('total_plus_blog_date', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_date', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Display Posted Date', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_author', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_author', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Display Author', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_comment', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_comment', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Display Comment', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_category', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_category', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Display Category', 'total-plus')
)));

$wp_customize->add_setting('total_plus_blog_tag', array(
    'sanitize_callback' => 'total_plus_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Plus_Checkbox_Control($wp_customize, 'total_plus_blog_tag', array(
    'section' => 'total_plus_blog_options_section',
    'label' => esc_html__('Display Tag', 'total-plus')
)));

$wp_customize->add_setting('total_plus_single_blog_title', array(
    'default' => esc_html__('Blog Post', 'total-plus'),
    'sanitize_callback' => 'total_plus_sanitize_text'
));

$wp_customize->add_control('total_plus_single_blog_title', array(
    'section' => 'total_plus_blog_options_section',
    'type' => 'text',
    'label' => esc_html__('Header Title', 'total-plus')
));

$wp_customize->add_setting('total_plus_single_post_top_elements', array(
    'default' => array('post_meta', 'featured_image', 'content', 'category', 'tag', 'social_share'),
    'sanitize_callback' => 'total_plus_sanitize_multi_choices',
));

$wp_customize->add_control(new Total_Plus_Sortable_Control($wp_customize, 'total_plus_single_post_top_elements', array(
    'label' => esc_html__('Content Display & Order', 'total-plus'),
    'description' => esc_html__('Drag to reorder and click on the eye icon to enable/disable', 'total-plus'),
    'section' => 'total_plus_blog_options_section',
    'settings' => 'total_plus_single_post_top_elements',
    'choices' => array(
        'featured_image' => esc_html__('Featured Image', 'total-plus'),
        'post_meta' => esc_html__('Post Meta', 'total-plus'),
        'content' => esc_html__('Content', 'total-plus'),
        'category' => esc_html__('Category', 'total-plus'),
        'tag' => esc_html__('Tags', 'total-plus'),
        'social_share' => esc_html__('Social Share', 'total-plus'),
    )
)));

$wp_customize->add_setting('total_plus_single_post_bottom_elements', array(
    'default' => array('author_box', 'pagination', 'comment', 'related_posts'),
    'sanitize_callback' => 'total_plus_sanitize_multi_choices',
));

$wp_customize->add_control(new Total_Plus_Sortable_Control($wp_customize, 'total_plus_single_post_bottom_elements', array(
    'label' => esc_html__('Content Display & Order', 'total-plus'),
    'description' => esc_html__('Drag to reorder and click on the eye icon to enable/disable', 'total-plus'),
    'section' => 'total_plus_blog_options_section',
    'settings' => 'total_plus_single_post_bottom_elements',
    'choices' => array(
        'author_box' => esc_html__('Author Box', 'total-plus'),
        'pagination' => esc_html__('Prev/Next Navigation', 'total-plus'),
        'comment' => esc_html__('Comment', 'total-plus'),
        'related_posts' => esc_html__('Related Posts', 'total-plus')
    )
)));
