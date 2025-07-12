<?php

namespace TotalPlusElements\Modules\ProgressBar\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ProgressBar extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-progress-bar';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Progress Bar', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-skill-bar';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'progressbar', [
            'label' => esc_html__('Progress Bars', 'total-plus'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'progressbar_title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Progress Bar', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'progressbar_percentage', [
            'label' => __('Percentage', 'total-plus'),
            'type' => Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default' => 90,
                ]
        );

        $this->add_control(
                'progressbar_block', [
            'label' => __('Progress Bars', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'progressbar_title' => __('Progress Bar', 'total-plus'),
                    'progressbar_percentage' => 90
                ]
            ],
            'title_field' => '{{{ progressbar_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'progressbar_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
                ]
        );

        $this->add_control(
                'progressbar_spacing', [
            'label' => __('Spacing Between Progress Bars (px)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 20,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-progress' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-progress h6, {{WRAPPER}} .tp-progress-bar-length span',
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-progress h6,
                 {{WRAPPER}} .tp-progress-bar-length span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'progressbar_style', [
            'label' => esc_html__('Progress Bar', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'progressbar_text_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-progress-bar' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'progress_indication_color', [
            'label' => esc_html__('Progress Indication Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-progress-bar-length' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $progressbars = $settings['progressbar_block'];
        ?>
        <div class="tp-progress-bar-sec">
            <?php
            foreach ($progressbars as $key => $progressbar) {
                ?>
                <div class="tp-progress">
                    <h6><?php echo esc_html($progressbar['progressbar_title']); ?></h6>
                    <div class="tp-progress-bar" data-width="<?php echo absint($progressbar['progressbar_percentage']); ?>">
                        <div class="tp-progress-bar-length">
                            <span><?php echo absint($progressbar['progressbar_percentage']) . "%"; ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
