<?php

namespace TotalPlusElements\Modules\TestimonialBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TestimonialBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-testimonial-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Testimonial Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-testimonial';
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
                'image', [
            'label' => __('Choose Image', 'total-plus'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'name', [
            'label' => __('Name', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'John Doe'
                ]
        );

        $this->add_control(
                'designation', [
            'label' => __('Designation', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Support Engineer'
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Testimonial', 'total-plus'),
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
            'default' => 'full',
                ]
        );

        $this->add_control(
                'image_shape', [
            'label' => __('Image Shape', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-round',
            'options' => [
                'tp-square' => __('Square', 'total-plus'),
                'tp-round' => __('Round', 'total-plus')
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'general_style', [
            'label' => esc_html__('General Styles', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'bg_color', [
            'label' => esc_html__('Backgrond Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'name_style', [
            'label' => esc_html__('Name', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'name_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box .tp-testimonial-title' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-box .tp-testimonial-title',
                ]
        );

        $this->add_control(
                'name_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box .tp-testimonial-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'designation_style', [
            'label' => esc_html__('Designation', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'designation_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box .tp-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-box .tp-designation',
                ]
        );

        $this->add_control(
                'designation_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box .tp-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Testimonial', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box .tp-testimonial-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-box .tp-testimonial-excerpt',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-box .tp-testimonial-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="tp-testimonial-box <?php echo $settings['image_shape'] ?>">
            <div class="tp-testimonial-excerpt">
                <?php
                if (!empty($settings['content'])) {
                    echo wp_kses_post($settings['content']);
                }
                ?>
            </div>

            <div class="tp-testimonial-footer">
                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumb', 'image'); ?>

                <div class="tp-testimonial-title-wrap">
                    <<?php echo $settings['title_html_tag']; ?> class="tp-testimonial-title"><?php echo esc_html($settings['name']); ?></<?php echo $settings['title_html_tag']; ?>>
                    <div class="tp-designation"><?php echo esc_html($settings['designation']); ?></div>
                </div>
            </div>         
        </div>
        <?php
    }

}
