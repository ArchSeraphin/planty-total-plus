<?php

namespace TotalPlusElements\Modules\Heading\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Heading extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-heading';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Heading', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-t-letter';
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
                'super_title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Super Title'
                ]
        );

        $this->add_control(
                'title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Your Heading Text'
                ]
        );

        $this->add_control(
                'sub_title', [
            'label' => __('Sub Title', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 8,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
                ]
        );

        $this->add_control(
                'super_title_html_tag', [
            'label' => __('Super Title HTML Tag', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'span',
            'options' => [
                'h1' => __('H1', 'total-plus'),
                'h2' => __('H2', 'total-plus'),
                'h3' => __('H3', 'total-plus'),
                'h4' => __('H4', 'total-plus'),
                'h5' => __('H5', 'total-plus'),
                'h6' => __('H6', 'total-plus'),
                'div' => __('div', 'total-plus'),
                'span' => __('span', 'total-plus'),
            ],
            'label_block' => true,
                ]
        );

        $this->add_control(
                'title_html_tag', [
            'label' => __('Title HTML Tag', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => [
                'h1' => __('H1', 'total-plus'),
                'h2' => __('H2', 'total-plus'),
                'h3' => __('H3', 'total-plus'),
                'h4' => __('H4', 'total-plus'),
                'h5' => __('H5', 'total-plus'),
                'h6' => __('H6', 'total-plus'),
                'div' => __('div', 'total-plus'),
                'span' => __('span', 'total-plus'),
            ],
            'label_block' => true,
                ]
        );

        $this->add_control(
                'style', [
            'label' => __('Style', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-normal-title',
            'options' => [
                'tp-normal-title' => __('Simple Heading', 'total-plus'),
                'tp-normal-title-sep' => __('Simple Heading with Seperator', 'total-plus'),
                'tp-normal-title-multi-sep' => __('Simple Heading with Double Seperator', 'total-plus'),
                'tp-single-row-title' => __('Single Row', 'total-plus'),
                'tp-big-super-title' => __('Big Super Title Heading', 'total-plus')
            ],
            'label_block' => true,
                ]
        );

        $this->add_control(
                'alignment', [
            'label' => __('Alignment', 'total-plus'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'total-plus'),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'total-plus'),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'total-plus'),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'super_title_style', [
            'label' => esc_html__('Super Title', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'super_title_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-supertitle' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'super_title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-section-title-tagline .tp-section-supertitle',
                ]
        );

        $this->add_control(
                'super_title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-supertitle' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
            'selectors' => [
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-title' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-title:after, {{WRAPPER}} .tp-section-title-tagline .tp-section-title:before' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-section-title-tagline .tp-section-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'sub_title_style', [
            'label' => esc_html__('Sub Title', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'sub_title_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-subtitle' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-single-row-title.tp-section-title-tagline .tp-section-header' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'sub_title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-section-title-tagline .tp-section-subtitle',
                ]
        );

        $this->add_control(
                'sub_title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-section-title-tagline .tp-section-subtitle' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('heading_class', 'class', [
            'tp-section-title-tagline',
            $settings['style'],
            'tp-align-' . $settings['alignment']
                ]
        );
        ?>
        <div <?php echo $this->get_render_attribute_string('heading_class'); ?>>
            <div class="tp-section-header">
                <?php
                if (!empty($settings['super_title'])) {
                    ?>
                    <<?php echo $settings['super_title_html_tag']; ?> class="tp-section-supertitle">
                    <?php echo $settings['super_title']; ?>
                    </<?php echo esc_html($settings['super_title_html_tag']); ?>>
                <?php } ?>

                <?php
                if (!empty($settings['title'])) {
                    ?>
                    <<?php echo $settings['title_html_tag']; ?> class="tp-section-title">
                    <?php echo $settings['title']; ?>
                    </<?php echo esc_html($settings['title_html_tag']); ?>>
                <?php } ?>
            </div>

            <?php
            if (!empty($settings['sub_title'])) {
                ?>
                <div class="tp-section-subtitle">
                    <?php echo wpautop(wp_kses_post($settings['sub_title'])); ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}
