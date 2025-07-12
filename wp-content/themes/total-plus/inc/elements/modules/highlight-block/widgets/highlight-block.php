<?php

namespace TotalPlusElements\Modules\HighlightBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Image_Size;
use ELementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class HighlightBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-highlight-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Highlights Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-featured-image';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Content', 'total-plus'),
                ]
        );

        $this->add_control(
                'icon', [
            'label' => __('Icon', 'total-plus'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid',
            ],
                ]
        );

        $this->add_control(
                'image', [
            'label' => __('Choose Image', 'total-plus'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' => __('Enter your title here', 'total-plus'),
            'default' => __('Heading', 'total-plus')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'placeholder' => __('Type your description here', 'total-plus'),
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'total-plus'),
            'label_block' => true
                ]
        );

        $this->add_control(
                'link_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' => __('Enter the button text here', 'total-plus'),
            'default' => __('Read More', 'total-plus')
                ]
        );

        $this->add_control(
                'link', [
            'label' => __('Button Link', 'total-plus'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('Enter URL', 'total-plus'),
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'link_icon', [
            'label' => __('Read More Link Icon', 'total-plus'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-long-arrow-alt-right',
                'library' => 'solid',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'settings_section', [
            'label' => esc_html__('Settings', 'total-plus'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'custom_height', [
            'label' => __('Custom Image Height', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
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
                '{{WRAPPER}} .tp-highlight-image, {{WRAPPER}} .tp-highlight-post.tp-style4' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'custom_height' => 'yes',
            ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
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

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus'),
                'tp-style3' => __('Style 3', 'total-plus'),
                'tp-style4' => __('Style 4', 'total-plus'),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'general_styles', [
            'label' => esc_html__('General', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_bg_color', [
            'label' => esc_html__('Title Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#4fc5ef',
            'condition' => ['layout' => ['tp-style1']],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post.tp-style1 .tp-highlight-title-wrap' => 'background: {{VALUE}}',
            ]
                ]
        );

        $this->add_control(
                'excerpt_bg_color', [
            'label' => esc_html__('Excerpt Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#4fc5ef',
            'condition' => ['layout' => ['tp-style1']],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post.tp-style1 .tp-highlight-hover' => 'background: {{VALUE}}',
            ]
                ]
        );

        $this->add_control(
                'title_excerpt_bg_color', [
            'label' => esc_html__('Title & Excerpt Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => ['layout' => ['tp-style2']],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post.tp-style2 .tp-highlight-title-wrap, {{WRAPPER}} .tp-highlight-post.tp-style2 .tp-highlight-hover' => 'background: {{VALUE}}',
            ]
                ]
        );

        $this->add_control(
                'front_view_bg_color', [
            'label' => esc_html__('Front View Overlay Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => ['layout' => ['tp-style3', 'tp-style4']],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post.tp-style3 .tp-highlight-title-wrap:before, {{WRAPPER}} .tp-highlight-post.tp-style4 .tp-highlight-title-wrap:after' => 'background: {{VALUE}}',
            ]
                ]
        );

        $this->add_control(
                'back_view_bg_color', [
            'label' => esc_html__('Back View Overlay Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#4fc5ef',
            'condition' => ['layout' => ['tp-style3', 'tp-style4']],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post.tp-style3 .tp-highlight-hover:before, {{WRAPPER}} .tp-highlight-post.tp-style4 .tp-highlight-hover:before' => 'background: {{VALUE}}',
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_styles', [
            'label' => esc_html__('Icon', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post .tp-highlight-icon i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-highlight-post.tp-style4 .tp-highlight-icon:before,
                 {{WRAPPER}} .tp-highlight-post.tp-style4 .tp-highlight-icon:after' => 'background: {{VALUE}}',
                '{{WRAPPER}} .tp-highlight-post svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_bg_color', [
            'label' => esc_html__('Icon Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => ['layout' => ['tp-style1', 'tp-style2']],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post.tp-style1 .tp-highlight-icon, {{WRAPPER}} .tp-highlight-post.tp-style2 .tp-highlight-icon, {{WRAPPER}} .tp-highlight-post.tp-style2 .tp-highlight-icon' => 'background: {{VALUE}}',
            ]
                ]
        );

        $this->add_control(
                'icon_size', [
            'label' => __('Icon Size', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post .tp-highlight-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-highlight-post .tp-highlight-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_styles', [
            'label' => esc_html__('Title', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-highlight-post .tp-highlight-title',
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post .tp-highlight-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'excerpt_styles', [
            'label' => esc_html__('Excerpt', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-highlight-post .tp-highlight-excerpt',
                ]
        );

        $this->add_control(
                'excerpt_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-post .tp-highlight-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_styles', [
            'label' => esc_html__('Read More Link', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-highlight-link a',
                ]
        );

        $this->start_controls_tabs(
                'link_style_tabs'
        );

        $this->start_controls_tab(
                'link_normal_tab', [
            'label' => __('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'link_normal_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-link a' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-highlight-link a svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'link_hover_tab', [
            'label' => __('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'link_hover_color', [
            'label' => esc_html__('Color(Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-highlight-link a:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-highlight-link a:hover svg' => 'fill: {{VALUE}}',
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
        $image_id = $settings['image']['id'];
        $title = $settings['title'];
        $content = $settings['content'];
        $custom_height_class = $settings['custom_height'] == 'yes' ? 'tp-custom-height' : '';

        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

        $layout = $settings['layout'];
        $highlight_class = array(
            'tp-highlight-post',
            $layout,
            $custom_height_class
        );
        ?>
        <div class="<?php echo implode(' ', $highlight_class) ?>">
            <?php
            if ($layout == 'tp-style4') {
                $image_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'thumb', $settings);
                if (!$image_url) {
                    $image_url = \Elementor\Utils::get_placeholder_image_src();
                }
                ?>
                <div class="tp-highlight-title-wrap" style="background-image:url(<?php echo esc_url($image_url); ?>)">
                    <div class="tp-highlight-title-inner">
                        <div class="tp-highlight-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <<?php echo $settings['title_html_tag']; ?> class="tp-highlight-title"><?php echo esc_html($settings['title']); ?></<?php echo $settings['title_html_tag']; ?>>
                    </div>
                </div>

                <div class="tp-highlight-hover" style="background-image:url(<?php echo esc_url($image_url); ?>)">
                    <div class="tp-highlight-hover-inner">
                        <div class="tp-highlight-excerpt">
                            <?php echo wp_kses_post($content); ?>
                        </div>

                        <?php if (!empty($settings['link']['url'])) { ?>
                            <div class="tp-highlight-link">
                                <a href="<?php echo esc_url($settings['link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                                    <?php echo wp_kses_post($settings['link_text']); ?> 
                                    <span class="tp-highlight-link-icon"><?php \Elementor\Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?></span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="tp-highlight-image">
                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumb', 'image'); ?>
                </div>
                <div class="tp-highlight-title-wrap">
                    <div class="tp-highlight-title-inner">
                        <div class="tp-highlight-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <<?php echo $settings['title_html_tag']; ?> class="tp-highlight-title"><?php echo esc_html($settings['title']); ?></<?php echo $settings['title_html_tag']; ?>>
                    </div>
                </div>

                <div class="tp-highlight-hover">
                    <?php if ($layout == 'tp-style2') { ?>
                        <div class="tp-highlight-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <<?php echo $settings['title_html_tag']; ?> class="tp-highlight-title"><?php echo esc_html($title); ?></<?php echo $settings['title_html_tag']; ?>>
                    <?php } ?>

                    <div class="tp-highlight-hover-inner">
                        <div class="tp-highlight-excerpt">
                            <?php echo wp_kses_post($content); ?>
                        </div>

                        <?php if (!empty($settings['link']['url'])) { ?>
                            <div class="tp-highlight-link">
                                <a href="<?php echo esc_url($settings['link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                                    <?php echo wp_kses_post($settings['link_text']); ?> 
                                    <span class="tp-highlight-link-icon"><?php \Elementor\Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?></span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
