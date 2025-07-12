<?php

namespace TotalPlusElements\Modules\PricingBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class PricingBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-pricing-module';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Pricing Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-price-table';
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
                'title', [
            'label' => __('Pricing Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Pricing'
                ]
        );

        $this->add_control(
                'currency', [
            'label' => __('Currency Symbol', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '$'
                ]
        );

        $this->add_control(
                'price', [
            'label' => __('Price', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '500'
                ]
        );

        $this->add_control(
                'price_per', [
            'label' => __('Price Per(/month, /year)', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '/year'
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'list', [
            'label' => __('Features', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $this->add_control(
                'feature_list', [
            'label' => __('Plan Feature List', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'list' => 'Enter Features List'
                ],
                [
                    'list' => 'Enter Features List'
                ],
                [
                    'list' => 'Enter Features List'
                ],
            ],
            'title_field' => '{{{ list }}}',
                ]
        );

        $this->add_control(
                'link_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Buy Now'
                ]
        );

        $this->add_control(
                'link', [
            'label' => __('Button Link', 'total-plus'),
            'type' => Controls_Manager::URL,
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
                ]
        );

        $this->add_control(
                'is_featured', [
            'label' => __('Is Featured', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
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
                'general_style', [
            'label' => esc_html__('General Styles', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'header_bg_color', [
            'label' => esc_html__('Header Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => ['layout' => ['tp-style1', 'tp-style2']],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing.tp-style1 .tp-pricing-header,
                {{WRAPPER}} .tp-pricing.tp-style1 .tp-pricing-header:before,
                {{WRAPPER}} .tp-pricing.tp-style1 .tp-pricing-header:after,
                {{WRAPPER}} .tp-pricing.tp-style2 .tp-pricing-header' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'header_bg_color_hover', [
            'label' => esc_html__('Header Background Color', 'total-plus'),
            'description' => esc_html__('(Hover & Featured)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => ['layout' => ['tp-style1', 'tp-style2']],
            'default' => '#1f74fb',
            'selectors' => [
                '{{WRAPPER}} .tp-pricing.tp-style1:hover .tp-pricing-header,
                {{WRAPPER}} .tp-pricing.tp-style1:hover .tp-pricing-header:before,
                {{WRAPPER}} .tp-pricing.tp-style1:hover .tp-pricing-header:after,
                {{WRAPPER}} .tp-pricing.tp-style1:hover .tp-pricing-button a,
                {{WRAPPER}} .tp-pricing.tp-style1.tp-featured .tp-pricing-header,
                {{WRAPPER}} .tp-pricing.tp-style1.tp-featured .tp-pricing-header:before,
                {{WRAPPER}} .tp-pricing.tp-style1.tp-featured .tp-pricing-header:after,
                {{WRAPPER}} .tp-pricing.tp-style1.tp-featured .tp-pricing-button a,
                {{WRAPPER}} .tp-pricing.tp-style2:hover .tp-pricing-header,
                {{WRAPPER}} .tp-pricing.tp-style2.tp-featured .tp-pricing-header' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'header_text_color', [
            'label' => esc_html__('Header Text Color', 'total-plus'),
            'description' => esc_html__('(Hover & Featured)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'condition' => ['layout' => ['tp-style1', 'tp-style2']],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing.tp-style1:hover .tp-pricing-header *, {{WRAPPER}} .tp-pricing.tp-style1:hover .tp-pricing-button a, {{WRAPPER}} .tp-pricing.tp-style1.tp-featured .tp-pricing-header *, {{WRAPPER}} .tp-pricing.tp-style1.tp-featured .tp-pricing-button a, {{WRAPPER}} .tp-pricing.tp-style2:hover .tp-pricing-header *, {{WRAPPER}} .tp-pricing.tp-style2.tp-featured .tp-pricing-header *' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'primary_color', [
            'label' => esc_html__('Primary Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#1f74fb',
            'condition' => ['layout' => ['tp-style3', 'tp-style4']],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing.tp-style4 .tp-pricing-header, 
                {{WRAPPER}} .tp-pricing.tp-style4 .tp-pricing-button a,
                {{WRAPPER}} .tp-pricing.tp-style3 .tp-pricing-price,
                {{WRAPPER}} .tp-pricing.tp-style3 .tp-pricing-main' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .tp-pricing.tp-style4 .tp-pricing-header:before' => 'background-image: linear-gradient(-45deg,transparent 14px,{{VALUE}} 0),linear-gradient(45deg,transparent 14px,{{VALUE}} 0);',
                '{{WRAPPER}} .tp-pricing.tp-style3' => 'border-color: {{VALUE}}'
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
                '{{WRAPPER}} .tp-pricing .tp-pricing-header .tp-pricing-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-pricing .tp-pricing-header .tp-pricing-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-header .tp-pricing-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'price_style', [
            'label' => esc_html__('Price', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'price_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-price em, {{WRAPPER}} .tp-pricing.tp-style2 .tp-pricing-price .tp-currency, {{WRAPPER}} .tp-pricing.tp-style4 .tp-pricing-price .tp-currency' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'price_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-pricing .tp-pricing-price em, {{WRAPPER}} .tp-pricing.tp-style2 .tp-pricing-price .tp-currency, {{WRAPPER}} .tp-pricing.tp-style4 .tp-pricing-price .tp-currency',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'price_per_style', [
            'label' => esc_html__('Price Per', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'price_per_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-pricing.tp-style1 .tp-pricing-price span, {{WRAPPER}} .tp-pricing.tp-style2 .tp-pricing-price .tp-price-per, {{WRAPPER}} .tp-pricing.tp-style3 .tp-pricing-price span, {{WRAPPER}} .tp-pricing.tp-style4 .tp-price-per' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'price_per_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-pricing.tp-style1 .tp-pricing-price span, {{WRAPPER}} .tp-pricing.tp-style2 .tp-pricing-price .tp-price-per, {{WRAPPER}} .tp-pricing.tp-style3 .tp-pricing-price span, {{WRAPPER}} .tp-pricing.tp-style4 .tp-price-per',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'feature_list_style', [
            'label' => esc_html__('Features List', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'feature_list_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-list li' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'feature_list_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-pricing .tp-pricing-list',
                ]
        );

        $this->add_control(
                'feature_list_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-list li' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Button', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-pricing .tp-pricing-button a',
                ]
        );

        $this->add_control(
                'link_bg_color', [
            'label' => esc_html__('Backgrond Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => ['layout!' => ['tp-style3', 'tp-style4']],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-button a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-button a' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-pricing.tp-style3 .tp-pricing-button a' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-pricing .tp-pricing-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $featured_class = $settings['is_featured'] == 'yes' ? 'tp-featured' : '';

        $pricing_class = array(
            'tp-pricing',
            $featured_class,
            $settings['layout']
        );
        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <div class="<?php echo esc_attr(implode(' ', array_filter($pricing_class))); ?>">
            <div class="tp-pricing-header">
                <<?php echo $settings['title_html_tag']; ?> class="tp-pricing-title"><?php echo esc_html($settings['title']); ?></<?php echo $settings['title_html_tag']; ?>>
                <div class="tp-pricing-price">
                    <div class="tp-pricing-price-inner">
                        <span class="tp-currency"><?php echo esc_html($settings['currency']); ?></span>
                        <em><?php echo esc_html($settings['price']); ?></em>
                        <span class="tp-price-per"><?php echo esc_html($settings['price_per']); ?></span>
                    </div>
                </div>
            </div>

            <div class="tp-pricing-main">
                <?php
                $this->get_pricing_list();
                ?>

                <?php if (!empty($settings['link']['url'])) { ?>
                    <div class="tp-pricing-button">
                        <a href="<?php echo esc_url($settings['link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                            <?php echo wp_kses_post($settings['link_text']); ?> 
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    protected function get_pricing_list() {
        $settings = $this->get_settings_for_display();
        if ($settings['feature_list']) {
            echo '<ul class="tp-pricing-list">';
            foreach ($settings['feature_list'] as $item) {
                echo '<li>' . wp_kses_post($item['list']) . '</li>';
            }
            echo '</ul>';
        }
    }

}
