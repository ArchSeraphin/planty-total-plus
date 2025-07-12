<?php

namespace TotalPlusElements\Modules\CounterBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class CounterBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-counter-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Counter Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-counter';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'counter', [
            'label' => esc_html__('Counter', 'total-plus'),
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
            'default' => __('Counter Title', 'total-plus'),
            'placeholder' => __('Enter the counter title here', 'total-plus')
                ]
        );

        $this->add_control(
                'prefix', [
            'label' => __('Prefix', 'total-plus'),
            'description' => __('Text that displays before counter', 'total-plus'),
            'type' => Controls_Manager::TEXT,
                ]
        );

        $this->add_control(
                'count', [
            'label' => __('Count Value (Number Only)', 'total-plus'),
            'type' => Controls_Manager::NUMBER,
            'default' => 500,
                ]
        );

        $this->add_control(
                'suffix', [
            'label' => __('Suffix', 'total-plus'),
            'description' => __('Text that displays after counter', 'total-plus'),
            'type' => Controls_Manager::TEXT,
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
            'label' => __('Counter Style', 'total-plus'),
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
                'box_style', [
            'label' => esc_html__('Box Styles', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'box_border_color', [
            'label' => esc_html__('Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#4ec5ef',
            'selectors' => [
                '{{WRAPPER}} .tp-counter.tp-style1, 
                 {{WRAPPER}} .tp-counter.tp-style3:before' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .tp-counter.tp-style1:before,
                 {{WRAPPER}} .tp-counter.tp-style1:after,
                 {{WRAPPER}} .tp-counter.tp-style2:before,
                 {{WRAPPER}} .tp-counter.tp-style2:after, 
                 {{WRAPPER}} .tp-counter.tp-style2 >span:before, 
                 {{WRAPPER}} .tp-counter.tp-style2 >span:after' => 'background: {{VALUE}}'
            ],
            'condition' => [
                'layout!' => 'tp-style4'
            ]
                ]
        );

        $this->add_control(
                'box_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'condition' => [
                'layout' => 'tp-style3'
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-counter.tp-style3' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'box_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
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
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-counter .tp-counter-icon i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-counter.tp-style2 .tp-counter-icon:after' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .tp-counter .tp-counter-icon svg' => 'fill: {{VALUE}}',
            ],
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
                '{{WRAPPER}} .tp-counter .tp-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-counter .tp-counter-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'number_count_style', [
            'label' => esc_html__('Number Count', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'number_count_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-counter .tp-counter-count' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'number_count_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-counter .tp-counter-count',
                ]
        );

        $this->add_control(
                'counter_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-counter .tp-counter-count' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'counter_title_style', [
            'label' => esc_html__('Counter Title', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'counter_title_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-counter .tp-counter-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'counter_title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-counter .tp-counter-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-counter .tp-counter-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $counter_style = $settings['layout'];
        ?>
        <?php
        $counter_title = $settings['title'];
        $counter_count = $settings['count'];
        if ($counter_count) {
            if ($counter_style == 'tp-style1' || $counter_style == 'tp-style2') {
                ?>
                <div class="tp-counter <?php echo esc_attr($counter_style) ?>">
                    <div class="tp-counter-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>

                    <div class="tp-counter-count odometer odometer-auto-theme" data-prefix="<?php echo esc_attr($settings['prefix']); ?>" data-suffix="<?php echo esc_attr($settings['suffix']); ?>" data-count="<?php echo absint($counter_count); ?>">
                        99
                    </div>

                    <<?php echo $settings['title_html_tag']; ?> class="tp-counter-title">
                    <?php echo esc_html($counter_title); ?>
                    </<?php echo $settings['title_html_tag']; ?>>
                    <span></span>
                </div>
                <?php
            } elseif ($counter_style == 'tp-style3') {
                ?>
                <div class="tp-counter <?php echo esc_attr($counter_style) ?>"">
                    <div class="tp-counter-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>

                    <div class="tp-counter-count odometer" data-prefix="<?php echo esc_attr($settings['prefix']); ?>" data-suffix="<?php echo esc_attr($settings['suffix']); ?>" data-count="<?php echo absint($counter_count); ?>">
                        99
                    </div>

                    <<?php echo $settings['title_html_tag']; ?> class="tp-counter-title">
                    <?php echo esc_html($counter_title); ?>
                    </<?php echo $settings['title_html_tag']; ?>>
                </div>
                <?php
            } elseif ($counter_style == 'tp-style4') {
                ?>
                <div class="tp-counter <?php echo esc_attr($counter_style) ?>"">
                    <div class="tp-counter-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>

                    <div class="tp-counter-right-block">
                        <div class="tp-counter-count odometer" data-prefix="<?php echo esc_attr($settings['prefix']); ?>" data-suffix="<?php echo esc_attr($settings['suffix']); ?>" data-count="<?php echo absint($counter_count); ?>">
                            99
                        </div>

                        <<?php echo $settings['title_html_tag']; ?> class="tp-counter-title">
                        <?php echo esc_html($counter_title); ?>
                        </<?php echo $settings['title_html_tag']; ?>>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <?php
    }

}
