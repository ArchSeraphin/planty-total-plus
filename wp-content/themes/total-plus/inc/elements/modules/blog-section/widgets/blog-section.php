<?php

namespace TotalPlusElements\Modules\BlogSection\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class BlogSection extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-blog-section';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Blog Section', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'total-plus'),
                ]
        );

        $this->add_control(
                'exclude_cats', [
            'label' => esc_html__('Exclude Category', 'total-plus'),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => $this->get_category()
                ]
        );

        $this->add_control(
                'post_count', [
            'label' => __('No of Posts', 'total-plus'),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'default' => 3,
                ]
        );

        $this->add_responsive_control(
                'column_count', [
            'label' => esc_html__('No of Column', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'step' => 1,
                    'max' => 6,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 3,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'blog-spacing', [
            'label' => esc_html__('Spacing Between Blog Posts (px)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 40,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-box' => 'padding-left: calc( {{SIZE}}{{UNIT}}/2 );padding-right: calc( {{SIZE}}{{UNIT}}/2 ); margin-top: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .tp-blog-wrap' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 );margin-right: calc( -{{SIZE}}{{UNIT}}/2 ); margin-top: -{{SIZE}}{{UNIT}}',
            ],
                ]
        );

        $this->add_control(
                'excerpt_length', [
            'label' => __('Excerpt Length (In Character)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 0,
                    'step' => 1,
                    'max' => 600,
                ],
            ],
            'default' => [
                'size' => 200,
                'unit' => 's',
            ],
            'condition' => [
                'layout!' => 'tp-style4',
            ],
                ]
        );

        $this->add_control(
                'display_date', [
            'label' => __('Display Date', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_author', [
            'label' => __('Display Author', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_comment_count', [
            'label' => __('Display Comment Count', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'readmore_text', [
            'label' => __('Read More Text', 'total-plus'),
            'description' => __('Leave Empty not to display', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Read More', 'total-plus'),
            'label_block' => true,
            'condition' => [
                'layout!' => 'tp-style4',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
                ]
        );

        $this->add_control(
                'title_html_tag', [
            'label' => __('Title HTML Tag', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h5',
            'options' => [
                'h1' => __('H1', 'total-plus'),
                'h2' => __('H2', 'total-plus'),
                'h3' => __('H3', 'total-plus'),
                'h4' => __('H4', 'total-plus'),
                'h5' => __('H5', 'total-plus'),
                'h6' => __('H6', 'total-plus'),
                'div' => __('div', 'total-plus'),
                'span' => __('span', 'total-plus'),
                'p' => __('p', 'total-plus')
            ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large',
                ]
        );

        $this->add_control(
                'image_height', [
            'label' => esc_html__('Image Height(%)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 30,
                    'max' => 150,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 70,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-thumbnail' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus'),
                'tp-style3' => __('Style 3', 'total-plus'),
                'tp-style4' => __('Style 4', 'total-plus')
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'genral_style', [
            'label' => esc_html__('General', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'layout' => ['tp-style1', 'tp-style2']
            ]
                ]
        );

        $this->add_control(
                'tp-style1_border_color', [
            'label' => esc_html__('Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-blog-wrap.tp-style1 .tp-blog-post' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .tp-blog-wrap.tp-style2 .tp-blog-footer:after' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'layout' => ['tp-style1', 'tp-style2']
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Title', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-blog-excerpt .tp-blog-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-blog-excerpt .tp-blog-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-excerpt .tp-blog-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Content', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'layout!' => 'tp-style4',
            ],
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'condition' => [
                'layout!' => 'tp-style4',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-wrap .tp-blog-excerpt-text' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'condition' => [
                'layout!' => 'tp-style4',
            ],
            'selector' => '{{WRAPPER}} .tp-blog-wrap .tp-blog-excerpt-text',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'condition' => [
                'layout!' => 'tp-style4',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-wrap .tp-blog-excerpt-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'post_meta_style', [
            'label' => esc_html__('Post Metas (Author, Comment)', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'post_meta_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-blog-wrap .tp-blog-footer' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'post_meta_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-blog-wrap .tp-blog-footer',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'date_style', [
            'label' => esc_html__('Post Date', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'date_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-blog-date'
                ]
        );

        $this->add_control(
                'date_bg', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => 'tp-style3',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-wrap.tp-style3 .tp-blog-date' => 'background: {{VALUE}}'
            ],
                ]
        );

        $this->add_control(
                'date_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-blog-date' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Read More Link', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'layout' => 'tp-style1',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-blog-read-more a',
            'condition' => [
                'layout' => 'tp-style1',
            ],
                ]
        );

        $this->start_controls_tabs(
                'button_style_tabs'
        );

        $this->start_controls_tab(
                'button_normal_tab', [
            'label' => __('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'condition' => [
                'layout' => 'tp-style1',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-read-more a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'layout' => 'tp-style1',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-read-more a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'button_hover_tab', [
            'label' => __('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'link_hover_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'condition' => [
                'layout' => 'tp-style1',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-read-more a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_bg_hover_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333',
            'condition' => [
                'layout' => 'tp-style1',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-blog-read-more a:hover' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $blog_class = array(
            'tp-blog-wrap',
            $settings['layout'],
            'tp-blog-col-' . $settings['column_count']['size'],
            'tp-blog-tablet-col-' . $settings['column_count_tablet']['size'],
            'tp-blog-mobile-col-' . $settings['column_count_mobile']['size']
        );
        ?>
        <div class="<?php echo esc_attr(implode(' ', $blog_class)); ?>">
            <?php
            if ($settings['layout'] == 'tp-style1') {
                $this->get_blog_style1();
            } elseif ($settings['layout'] == 'tp-style2') {
                $this->get_blog_style2();
            } elseif ($settings['layout'] == 'tp-style3') {
                $this->get_blog_style3();
            } elseif ($settings['layout'] == 'tp-style4') {
                $this->get_blog_style4();
            }
            ?>
        </div>
        <?php
    }

    protected function get_blog_style1() {
        $settings = $this->get_settings_for_display();
        $args = array(
            'posts_per_page' => absint($settings['post_count']),
            'category__not_in' => $settings['exclude_cats']
        );

        $query = new \WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="tp-blog-box">
                    <div class="tp-blog-post">
                        <?php
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="tp-blog-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    echo $this->get_image_html(get_post_thumbnail_id());
                                    ?>

                                    <?php if ($settings['display_comment_count'] || $settings['display_author']) { ?>
                                        <div class="tp-blog-footer">
                                            <?php if ($settings['display_author']) { ?>
                                                <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                                <?php
                                            }
                                            if ($settings['display_comment_count']) {
                                                ?>
                                                <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="tp-blog-excerpt">
                            <<?php echo $settings['title_html_tag']; ?> class="tp-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo $settings['title_html_tag']; ?>>
                            <?php if ($settings['display_date']) { ?>
                                <div class="tp-blog-date"><i class="mdi mdi-calendar-text"></i><?php echo get_the_date(); ?></div>
                            <?php } ?>

                            <div class="tp-blog-excerpt-text">
                                <?php
                                if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo total_plus_excerpt(get_the_content(), $settings['excerpt_length']['size']);
                                }
                                ?>
                            </div>
                        </div>

                        <?php $this->get_readmore_link(); ?>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
    }

    protected function get_blog_style2() {
        $settings = $this->get_settings_for_display();
        $args = array(
            'posts_per_page' => absint($settings['post_count']),
            'category__not_in' => $settings['exclude_cats']
        );

        $query = new \WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="tp-blog-box">
                    <div class="tp-blog-post">
                        <?php
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="tp-blog-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo $this->get_image_html(get_post_thumbnail_id()); ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="tp-blog-excerpt">
                            <?php if ($settings['display_date']) { ?>
                                <div class="tp-blog-date"><?php echo get_the_date(); ?></div>
                            <?php } ?>

                            <<?php echo $settings['title_html_tag']; ?> class="tp-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo $settings['title_html_tag']; ?>>

                            <div class="tp-blog-excerpt-text">
                                <?php
                                if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo total_plus_excerpt(get_the_content(), $settings['excerpt_length']['size']);
                                }
                                ?>
                            </div>
                        </div>

                        <?php if ($settings['display_comment_count'] || $settings['display_author']) { ?>
                            <div class="tp-blog-footer">
                                <?php if ($settings['display_author']) { ?>
                                    <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                    <?php
                                }
                                if ($settings['display_comment_count']) {
                                    ?>
                                    <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
    }

    protected function get_blog_style3() {
        $settings = $this->get_settings_for_display();
        if ($settings['display_date']) {
            $class = '';
        } else {
            $class = 'tp-full-width';
        }

        $args = array(
            'posts_per_page' => absint($settings['post_count']),
            'category__not_in' => $settings['exclude_cats']
        );

        $query = new \WP_Query($args);

        if ($query->have_posts()) {

            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="tp-blog-box">
                    <div class="tp-blog-post">
                        <?php
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="tp-blog-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo $this->get_image_html(get_post_thumbnail_id()); ?>
                                </a>

                                <?php if ($settings['display_comment_count'] || $settings['display_author']) { ?>
                                    <div class="tp-blog-footer">
                                        <?php if ($settings['display_author']) { ?>
                                            <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                            <?php
                                        }
                                        if ($settings['display_comment_count']) {
                                            ?>
                                            <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="tp-blog-excerpt <?php echo esc_attr($class); ?>">
                            <?php if ($settings['display_date']) { ?>
                                <div class="tp-blog-date">
                                    <span><?php echo get_the_date('d'); ?></span>
                                    <span><?php echo get_the_date('M'); ?></span>
                                    <span><?php echo get_the_date('Y'); ?></span>   
                                </div>
                            <?php } ?>

                            <<?php echo $settings['title_html_tag']; ?> class="tp-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo $settings['title_html_tag']; ?>>

                            <div class="tp-blog-excerpt-text">
                                <?php
                                if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo total_plus_excerpt(get_the_content(), $settings['excerpt_length']['size']);
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
    }

    protected function get_blog_style4() {
        $settings = $this->get_settings_for_display();

        $args = array(
            'posts_per_page' => absint($settings['post_count']),
            'category__not_in' => $settings['exclude_cats']
        );

        $query = new \WP_Query($args);

        if ($query->have_posts()) {

            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="tp-blog-box">
                    <div class="tp-blog-post">
                        <?php
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="tp-blog-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo $this->get_image_html(get_post_thumbnail_id()); ?>
                                </a>

                                <div class="tp-blog-excerpt">
                                    <<?php echo $settings['title_html_tag']; ?> class="tp-blog-title"><?php the_title(); ?></<?php echo $settings['title_html_tag']; ?>>

                                    <?php if ($settings['display_date']) { ?>
                                        <div class="tp-blog-date"><?php echo get_the_date(); ?></div>
                                    <?php } ?>  
                                </div>

                                <?php if ($settings['display_comment_count'] || $settings['display_author']) { ?>
                                    <div class="tp-blog-footer">
                                        <?php if ($settings['display_author']) { ?>
                                            <span><i class="mdi mdi-account-box-outline"></i><?php echo get_the_author(); ?></span>
                                            <?php
                                        }
                                        if ($settings['display_comment_count']) {
                                            ?>
                                            <span><i class="mdi mdi-comment-processing-outline"></i><?php echo get_comments_number(); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
    }

    protected function get_readmore_link() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['readmore_text'])) {
            ?>
            <div class="tp-blog-read-more">
                <a href="<?php the_permalink(); ?>"><?php echo esc_html($settings['readmore_text']); ?></a>
            </div>
            <?php
        }
    }

    protected function get_image_html($image_id) {
        $settings = $this->get_settings_for_display();
        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($image_id, 'thumb', $settings);
        if (!$image_url) {
            $image_url = \Elementor\Utils::get_placeholder_image_src();
        }
        $image_alt_text = total_plus_get_image_alt($image_id, esc_html__('Blog Image', 'total-plus'));
        return '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($image_alt_text) . '" />';
    }

    protected function get_category() {
        $categories = get_categories(array('hide_empty' => 0));
        $cat = array();
        foreach ($categories as $category) {
            $cat[$category->term_id] = $category->cat_name;
        }
        return $cat;
    }

}
