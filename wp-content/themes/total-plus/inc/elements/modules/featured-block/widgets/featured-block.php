<?php

namespace TotalPlusElements\Modules\FeaturedBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class FeaturedBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-featured-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Featured Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'featured', [
            'label' => esc_html__('Featured Block', 'total-plus'),
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
                'title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Heading', 'total-plus')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'placeholder' => __('Type your content here', 'total-plus'),
            'label_block' => true,
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'total-plus')
                ]
        );

        $this->add_control(
                'button_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Read More', 'total-plus')
                ]
        );

        $this->add_control(
                'button_link', [
            'label' => __('Read More Link', 'total-plus'),
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
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
            'tab' => Controls_Manager::TAB_CONTENT,
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
            'label' => __('Featured Block Style', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus'),
                'tp-style3' => __('Style 3', 'total-plus'),
                'tp-style4' => __('Style 4', 'total-plus'),
                'tp-style5' => __('Style 5', 'total-plus'),
                'tp-style6' => __('Style 6', 'total-plus'),
                'tp-style7' => __('Style 7', 'total-plus'),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'box_style', [
            'label' => esc_html__('Box Styles', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'layout!' => ['tp-style4', 'tp-style5', 'tp-style6']
            ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(), [
            'name' => 'box_background',
            'label' => __('Background', 'total-plus'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .tp-featured-box',
            'condition' => [
                'layout' => ['tp-style2', 'tp-style7']
            ],
                ]
        );

        $this->add_control(
                'box_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-featured-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'layout' => ['tp-style1', 'tp-style2', 'tp-style3']
            ],
                ]
        );

        $this->add_control(
                'border_color', [
            'label' => esc_html__('Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-featured-box.tp-style1, 
                {{WRAPPER}} .tp-featured-box.tp-style2,
                {{WRAPPER}} .tp-featured-box.tp-style3' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .tp-featured-box.tp-style1:before, {{WRAPPER}} .tp-featured-box.tp-style1:after' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'layout' => ['tp-style1', 'tp-style2', 'tp-style3']
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_style', [
            'label' => esc_html__('Icon', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-featured-icon i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-featured-icon svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-featured-box.tp-style7 .tp-featured-icon' => 'background: {{VALUE}}',
            ],
            'condition' => ['layout' => 'tp-style7']
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
            'default' => [
                'unit' => 'px',
                'size' => 30,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-featured-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-featured-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
            ],
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
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-featured-box .tp-featured-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-featured-box .tp-featured-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-featured-box .tp-featured-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Content', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-featured-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-featured-excerpt',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-featured-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Read More Link', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-featured-link a',
                ]
        );

        $this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-featured-link a' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-featured-link svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-featured-link a' => 'background-color: {{VALUE}}',
            ],
            'condition' => ['layout' => 'tp-style1']
                ]
        );

        $this->add_control(
                'link_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-featured-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => ['layout' => 'tp-style1']
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <div class="tp-featured-box <?php echo esc_attr($settings['layout']) ?>">
            <div class="tp-featured-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
            </div>

            <div class="tp-featured-content">
                <<?php echo $settings['title_html_tag']; ?> class="tp-featured-title"><?php echo esc_html($settings['title']); ?></<?php echo $settings['title_html_tag']; ?>>

                <div class="tp-featured-excerpt">
                    <?php echo wp_kses_post($settings['content']); ?>
                </div>

                <?php if (!empty($settings['button_link']['url'])) { ?>
                    <div class="tp-featured-link">
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                            <?php echo esc_html($settings['button_text']); ?>
                            <span class="tp-featured-link-icon"><?php \Elementor\Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?></span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}
