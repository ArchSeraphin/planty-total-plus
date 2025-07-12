<?php

namespace TotalPlusElements\Modules\TestimonialCarousel\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TestimonialCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-testimonial-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Testimonial Carousel', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-media-carousel';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'total-plus'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'name', [
            'label' => __('Name', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'John Doe'
                ]
        );

        $repeater->add_control(
                'designation', [
            'label' => __('Designation', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Support Engineer'
                ]
        );

        $repeater->add_control(
                'content', [
            'label' => __('Testimonial Content', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 8,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                ]
        );

        $this->add_control(
                'testimonials', [
            'label' => __('Testimonials', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ name }}}',
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
                'carousel_settings', [
            'label' => esc_html__('Carousel Settings', 'total-plus'),
                ]
        );

        $this->add_responsive_control(
                'slides_to_show', [
            'label' => esc_html__('Slides To Show', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
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

        $this->add_responsive_control(
                'slides_margin', [
            'label' => esc_html__('Spacing Between Slides', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => __('Autoplay', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_on_hover', [
            'label' => __('Pause on Hover', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'infinite', [
            'label' => __('Infinite Loop', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'autoplay_speed', [
            'label' => __('Autoplay Speed (in Seconds)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 15,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 5,
                'unit' => 's',
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'speed', [
            'label' => __('Animation Speed', 'total-plus'),
            'type' => Controls_Manager::NUMBER,
            'default' => 500,
                ]
        );

        $this->add_control(
                'nav_control', [
            'label' => __('Choose Navigation', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'nav',
            'options' => [
                'nav' => __('Navigation Arrow', 'total-plus'),
                'dots' => __('Navigation Dots', 'total-plus')
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
                '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-box' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-title' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-title',
                ]
        );

        $this->add_control(
                'name_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
                '{{WRAPPER}} .tp-testimonial-carousel .tp-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-carousel .tp-designation',
                ]
        );

        $this->add_control(
                'designation_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .tp-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
                '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-excerpt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-excerpt',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .tp-testimonial-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'navigation_style', [
            'label' => esc_html__('Navigation Button', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'navigation_tabs'
        );

        $this->start_controls_tab(
                'normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'arrow_color', [
            'label' => esc_html__('Arrow Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'nav_control' => 'nav',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .owl-nav .owl-prev, {{WRAPPER}} .tp-testimonial-carousel .owl-nav .owl-next' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'navigation_dots_color', [
            'label' => esc_html__('Dots Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'nav_control' => 'dots',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'active_tab', [
            'label' => esc_html__('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'arrow_color_hover', [
            'label' => esc_html__('Arrow Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'nav_control' => 'nav',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .owl-nav .owl-prev:hover, {{WRAPPER}} .tp-testimonial-carousel .owl-nav .owl-next:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'navigation_dots_color_hover', [
            'label' => esc_html__('Dots Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'nav_control' => 'dots',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-carousel .owl-dots .owl-dot.active, {{WRAPPER}} .tp-testimonial-carousel .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
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

        $params = array(
            'items' => isset($settings['slides_to_show']['size']) ? (int) $settings['slides_to_show']['size'] : 3,
            'items_tablet' => isset($settings['slides_to_show_tablet']['size']) ? (int) $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => isset($settings['slides_to_show_mobile']['size']) ? (int) $settings['slides_to_show_mobile']['size'] : 1,
            'margin' => isset($settings['slides_margin']['size']) && $settings['slides_margin']['size'] !== null ? $settings['slides_margin']['size'] : 20,
            'margin_tablet' => isset($settings['slides_margin_tablet']['size']) && $settings['slides_margin_tablet']['size'] !== null ? $settings['slides_margin_tablet']['size'] : 20,
            'margin_mobile' => isset($settings['slides_margin_mobile']['size']) && $settings['slides_margin_mobile']['size'] !== null ? $settings['slides_margin_mobile']['size'] : 20,
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] == 'yes' ? true : false,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['nav_control'] == 'dots' ? true : false,
            'nav' => $settings['nav_control'] == 'nav' ? true : false
        );

        if ($settings['autoplay'] == 'yes') {
            $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
        }

        $params = json_encode($params);

        if ($settings['testimonials']) {
            ?>
            <div class="tp-testimonial-carousel owl-carousel" data-params='<?php echo $params; ?>'>
                <?php
                foreach ($settings['testimonials'] as $item) {
                    ?>
                    <div class="tp-testimonial-box <?php echo esc_attr($settings['image_shape']); ?>">
                        <div class="tp-testimonial-excerpt">
                            <?php
                            if (!empty($item['content'])) {
                                echo wp_kses_post($item['content']);
                            }
                            ?>
                        </div>

                        <div class="tp-testimonial-footer">
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'thumb', 'image'); ?>

                            <div class="tp-testimonial-title-wrap">
                                <<?php echo $settings['title_html_tag']; ?> class="tp-testimonial-title"><?php echo esc_html($item['name']); ?></<?php echo $settings['title_html_tag']; ?>>
                                <div class="tp-designation"><?php echo esc_html($item['designation']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
            <?php
        }
    }

}
