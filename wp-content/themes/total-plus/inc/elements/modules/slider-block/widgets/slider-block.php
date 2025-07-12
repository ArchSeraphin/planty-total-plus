<?php

namespace TotalPlusElements\Modules\SliderBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SliderBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-slider';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Slider', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-post-slider';
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

        $repeater = new Repeater();

        $repeater->add_control(
                'slider_image', [
            'label' => __('Choose Image', 'total-plus'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'slider_title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Slider Title', 'total-plus')
                ]
        );

        $repeater->add_control(
                'slider_description', [
            'label' => __('Caption', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 5,
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'total-plus'),
            'placeholder' => __('Type your caption here', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'slider_button_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Read More', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'slider_button_link', [
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

        $repeater->add_control(
                'slider_text_alignment', [
            'label' => __('Text Alignment', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'center',
            'options' => [
                'center' => __('Center', 'total-plus'),
                'left' => __('Left', 'total-plus'),
                'right' => __('Right', 'total-plus')
            ],
                ]
        );

        $this->add_control(
                'slider_block', [
            'label' => __('Sliders', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'slider_title' => __('Slider Title', 'total-plus'),
                    'slider_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'total-plus'),
                    'slider_button_text' => __('Read More', 'total-plus'),
                    'slider_button_link' => '',
                    'slider_text_alignment' => 'center'
                ]
            ],
            'title_field' => '{{{ slider_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'slider_settings', [
            'label' => esc_html__('Slider Settings', 'total-plus'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->add_control(
                'slider_transition', [
            'label' => __('Slider Transition', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'slide',
            'options' => [
                'slide' => __('Slide', 'total-plus'),
                'fade' => __('Fade', 'total-plus')
            ],
                ]
        );

        $this->add_control(
                'slider_height_type', [
            'label' => __('Slider Height', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'auto',
            'options' => [
                'auto' => __('Auto', 'total-plus'),
                'full' => __('Full Height', 'total-plus'),
                'custom' => __('Custom Height', 'total-plus'),
            ],
                ]
        );

        $this->add_responsive_control(
                'custom_slider_height', [
            'label' => esc_html__('Custom Slider Height (px)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 200,
                    'max' => 2000,
                    'step' => 1
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 800,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 600,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 400,
                'unit' => 'px',
            ],
            'condition' => ['slider_height_type' => 'custom'],
                ]
        );


        $this->add_control(
                'pause_duration', [
            'label' => esc_html__('Pause Duration', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 20,
                    'step' => 1
                ],
            ],
            'default' => [
                'unit' => 's',
                'size' => 5,
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => esc_html__('Autoplay', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'total-plus'),
            'label_off' => esc_html__('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'nav', [
            'label' => esc_html__('Nav Arrow', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'total-plus'),
            'label_off' => esc_html__('Hide', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'dots', [
            'label' => esc_html__('Nav Dots', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'total-plus'),
            'label_off' => esc_html__('Hide', 'total-plus'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'caption_settings', [
            'label' => esc_html__('Caption Settings', 'total-plus'),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'caption_container_width', [
            'label' => esc_html__('Caption Container Width (px)', 'total-plus'),
            'description' => esc_html__('This width should match with the page container width if the slider is full width.', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 500,
                    'max' => 1600,
                    'step' => 10
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 1200,
            ],
                ]
        );

        $this->add_responsive_control(
                'caption_width', [
            'label' => esc_html__('Caption Width (%)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 40,
                    'max' => 100,
                    'step' => 1
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 60,
                'unit' => '%',
            ],
            'tablet_default' => [
                'size' => 70,
                'unit' => '%',
            ],
            'mobile_default' => [
                'size' => 90,
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-slide-caption' => 'width: {{SIZE}}%;',
            ],
                ]
        );

        $this->add_control(
                'title_background', [
            'label' => esc_html__('Enable Title Background', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'total-plus'),
            'label_off' => esc_html__('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'bottom_separator_styles', [
            'label' => esc_html__('Bottom Separator', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'bottom_separator', [
            'label' => __('Bottom Separator', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                'none' => __('None', 'total-plus'),
                'big-triangle-center' => __('Big Triangle Center', 'total-plus'),
                'big-triangle-left' => __('Big Triangle Left', 'total-plus'),
                'big-triangle-right' => __('Big Triangle Right', 'total-plus'),
                'clouds' => __('Clouds', 'total-plus'),
                'curve-center' => __('Curve Center', 'total-plus'),
                'curve-repeater' => __('Curve Repeater', 'total-plus'),
                'droplets' => __('Droplets', 'total-plus'),
                'paper-cut' => __('Paper Cut', 'total-plus'),
                'small-triangle-center' => __('Small Triangle Center', 'total-plus'),
                'tilt-left' => __('Tilt Left', 'total-plus'),
                'tilt-right' => __('Tilt Right', 'total-plus'),
                'uniform-waves' => __('Uniform Waves', 'total-plus'),
                'water-waves' => __('Water Waves', 'total-plus'),
                'big-waves' => __('Big Waves', 'total-plus'),
                'slanted-waves' => __('Slanted Waves', 'total-plus'),
                'zigzag' => __('Zigzag', 'total-plus')
            ],
                ]
        );

        $this->add_control(
                'bottom_separator_color', [
            'label' => esc_html__('Bottom Separator Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .bottom-section-seperator svg' => 'fill: {{VALUE}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'bottom_separator_height', [
            'label' => esc_html__('Bottom Separator Height (px)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 20,
                    'max' => 200,
                    'step' => 1
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 60,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .bottom-section-seperator svg' => 'height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'slider_style', [
            'label' => esc_html__('Slider', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'slider_overlay_color', [
            'label' => esc_html__('Slider Overlay Background', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide:before' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'caption_style', [
            'label' => esc_html__('Caption', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_bg', [
            'label' => esc_html__('Title Background', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-title-bg .tp-slide-cap-title span' => 'background-color: {{VALUE}}',
            ],
            'default' => '#000000',
            'condition' => [
                'title_background' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'title_padding', [
            'label' => esc_html__('Title Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-title-bg .tp-slide-cap-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'title_background' => 'yes',
            ],
            'separator' => 'after'
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Title Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide-cap-title span' => 'color: {{VALUE}}',
            ],
            'default' => '#FFFFFF'
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-slide-cap-title span',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Title Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-slide-cap-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'separator' => 'after'
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Sub Title Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide-cap-desc' => 'color: {{VALUE}}',
            ],
            'default' => '#FFFFFF'
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Sub Title Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-slide-cap-desc',
                ]
        );

        $this->add_control(
                'description_margin', [
            'label' => esc_html__('Sub Title Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-slide-cap-desc' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Button', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'button_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-slide-button a',
                ]
        );

        $this->add_control(
                'button_padding', [
            'label' => esc_html__('Button Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'button_border_type', [
            'label' => esc_html__('Border Type', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => __('None', 'total-plus'),
                'solid' => __('Solid', 'total-plus'),
                'double' => __('Double', 'total-plus'),
                'dotted' => __('Dotted', 'total-plus'),
                'dashed' => __('Dashed', 'total-plus'),
                'groove' => __('Groove', 'total-plus')
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a' => 'border-style: {{VALUE}};',
            ],
                ]
        );

        $this->add_control(
                'button_border_width', [
            'label' => esc_html__('Border Width(px)', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'default' => [
                'top' => 2,
                'right' => 2,
                'bottom' => 2,
                'left' => 2,
                'isLinked' => true,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'button_border_type!' => '',
            ],
                ]
        );


        $this->start_controls_tabs(
                'button_style_tabs'
        );

        $this->start_controls_tab(
                'normal_button_tab', [
            'label' => __('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'button_border_color', [
            'label' => esc_html__('Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a' => 'border-color: {{VALUE}}',
            ],
            'condition' => [
                'button_border_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'button_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a' => 'color: {{VALUE}}',
            ],
            'default' => '#333333',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_button_tab', [
            'label' => __('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'button_border_hover_color', [
            'label' => esc_html__('Border Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a:hover' => 'border-color: {{VALUE}}',
            ],
            'condition' => [
                'button_border_type!' => '',
            ],
            'default' => '#333333'
                ]
        );

        $this->add_control(
                'button_bg_hover_color', [
            'label' => esc_html__('Background Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a:hover' => 'background-color: {{VALUE}}',
            ],
            'default' => '#333333'
                ]
        );

        $this->add_control(
                'button_hover_color', [
            'label' => esc_html__('Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slide-button a:hover' => 'color: {{VALUE}}',
            ],
            'default' => '#ffffff'
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'navigation_style', [
            'label' => esc_html__('Navigation', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'nav_style_tabs'
        );

        $this->start_controls_tab(
                'nav_normal_tab', [
            'label' => __('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'nav_normal_bg_color', [
            'label' => esc_html__('Nav Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .owl-carousel .owl-nav [class*=owl-]' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_normal_color', [
            'label' => esc_html__('Nav Arrow Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .owl-carousel .owl-nav [class*=owl-]:before, {{WRAPPER}} .tp-slider-section .owl-carousel .owl-nav [class*=owl-]:after' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_bg_color', [
            'label' => esc_html__('Dots Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .owl-carousel .owl-dots .owl-dot' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'nav_hover_tab', [
            'label' => __('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'nav_hover_bg_color', [
            'label' => esc_html__('Nav Background Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .owl-carousel .owl-nav [class*=owl-]:hover' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'nav_hover_color', [
            'label' => esc_html__('Nav Arrow Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .owl-carousel .owl-nav [class*=owl-]:hover:before, {{WRAPPER}} .tp-slider-section .owl-carousel .owl-nav [class*=owl-]:hover:after' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_hover_bg_color', [
            'label' => esc_html__('Dots Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-slider-section .owl-carousel .owl-dots .owl-dot.active' => 'background: {{VALUE}}',
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
        $id = $this->get_id();
        ?>

        <div id="tp-slider-<?php echo esc_attr($id); ?>" class="tp-slider-section">
            <?php
            $full_window_class = $settings['slider_height_type'] == 'full' ? 'tp-full-window-slider' : '';
            $caption_container_width = $settings['caption_container_width'];
            $title_bg_class = $settings['title_background'] == 'yes' ? 'tp-title-bg' : 'tp-title-no-bg';

            $this->add_render_attribute('slider_class', 'class', [
                'tp-slider',
                'owl-carousel',
                $full_window_class,
                $title_bg_class
                    ]
            );

            $sliders = $settings['slider_block'];

            $params = array(
                'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
                'pause' => (int) $settings['pause_duration']['size'] * 1000,
                'nav' => $settings['nav'] == 'yes' ? true : false,
                'dots' => $settings['dots'] == 'yes' ? true : false,
                'transition' => $settings['slider_transition']
            );
            $params = json_encode($params);

            echo '<style>';
            echo '#tp-slider-' . $id . ' .tp-slider .tp-slide .tp-container{width:' . $caption_container_width['size'] . 'px}';
            echo '@media screen and (max-width:' . $caption_container_width['size'] . 'px){';
            echo '#tp-slider-' . $id . ' .tp-slider .tp-slide .tp-container{width:90%;margin-left: 5%;margin-right: 5%;left: 0;transform: translate(0, -50%);}';
            echo '}';
            if ($settings['slider_height_type'] == 'custom') {
                $slider_height = isset($settings['custom_slider_height']['size']) ? $settings['custom_slider_height']['size'] : 800;
                $slider_height_tablet = isset($settings['custom_slider_height_tablet']['size']) ? $settings['custom_slider_height_tablet']['size'] : 600;
                $slider_height_mobile = isset($settings['custom_slider_height_mobile']['size']) ? $settings['custom_slider_height_mobile']['size'] : 400;
                echo '#tp-slider-' . $id . ' .tp-slider .tp-slide img{object-fit:cover; object-position: center; height: 100%;}';
                echo '#tp-slider-' . $id . ' .tp-slider .tp-slide{height:' . $slider_height . 'px}';
                echo '@media screen and (max-width:768px){';
                echo '#tp-slider-' . $id . ' .tp-slider .tp-slide{height:' . $slider_height_tablet . 'px}';
                echo '}';
                echo '@media screen and (max-width:480px){';
                echo '#tp-slider-' . $id . ' .tp-slider .tp-slide{height:' . $slider_height_mobile . 'px}';
                echo '}';
            }
            echo '</style>';
            ?>
            <div <?php echo $this->get_render_attribute_string('slider_class'); ?>  data-params='<?php echo $params; ?>'>

                <?php
                if (!empty($sliders)) {
                    foreach ($sliders as $key => $slider) {
                        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($slider['slider_image']['id'], 'thumb', $settings);
                        if (!$image_url) {
                            $image_url = \Elementor\Utils::get_placeholder_image_src();
                        }
                        $title = $slider['slider_title'];
                        $description = $slider['slider_description'];
                        $alignment = $slider['slider_text_alignment'];
                        ?>
                        <div class="tp-slide">

                            <?php
                            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($slider['slider_image'])) . '" >';
                            ?>

                            <div class="tp-container">
                                <div class="tp-slide-caption tp-slide-<?php echo esc_attr($alignment); ?>">
                                    <?php if ($title) { ?>
                                        <div class="tp-slide-cap-title">
                                            <span><?php echo wp_kses_post($title); ?></span>
                                        </div>
                                    <?php } ?>

                                    <?php if ($description) { ?>
                                        <div class="tp-slide-cap-desc">
                                            <?php echo wp_kses_post($description); ?>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if (!empty($slider['slider_button_link']['url'])) {
                                        $target = $slider['slider_button_link']['is_external'] ? ' target="_blank"' : '';
                                        $nofollow = $slider['slider_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                        ?>
                                        <div class="tp-slide-button">
                                            <a href="<?php echo esc_url($slider['slider_button_link']['url']); ?>"<?php echo $target . $nofollow; ?>><?php echo esc_html($slider['slider_button_text']); ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
            $bottom_seperator = $settings['bottom_separator'];
            if ($bottom_seperator != 'none') {
                echo '<div class="ht-section-seperator bottom-section-seperator svg-' . esc_attr($bottom_seperator) . '-wrap">';
                get_template_part("inc/svg/{$bottom_seperator}");
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }

}
