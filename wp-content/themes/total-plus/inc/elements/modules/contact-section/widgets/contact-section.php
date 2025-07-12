<?php

namespace TotalPlusElements\Modules\ContactSection\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ContactSection extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-contact-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Contact Form With Google Map', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'section_map', [
            'label' => __('Google Map', 'total-plus'),
                ]
        );

        $default_address = __('London Eye, London, United Kingdom', 'total-plus');
        $this->add_control(
                'address', [
            'label' => __('Location', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'dynamic' => [
                'active' => true,
                'categories' => [
                    TagsModule::POST_META_CATEGORY,
                ],
            ],
            'placeholder' => $default_address,
            'default' => $default_address,
            'label_block' => true,
                ]
        );

        $this->add_control(
                'zoom', [
            'label' => __('Zoom', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 15,
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 20,
                ],
            ],
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'view', [
            'label' => __('View', 'total-plus'),
            'type' => Controls_Manager::HIDDEN,
            'default' => 'traditional',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_contact_detail', [
            'label' => esc_html__('Contact Detail', 'total-plus'),
                ]
        );

        $this->add_control(
                'shortcode', [
            'label' => __('Contact Form Shortcode', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('[contact-form-7 id="1" title="Contact form"]', 'total-plus'),
            'label_block' => true,
                ]
        );

        $this->add_control(
                'contact_detail', [
            'label' => __('Contact Detail', 'total-plus'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => '<h4>Get In Touch</h4><p>Please get in touch with us at your appropriate method.</p><p>Address:<br>Riverside Building, Country Hall, South Bank, London, United Kingdom</p><p>Phone No:<br>(1800) 123 4567</p>'
                ]
        );

        $this->add_control(
                'show_icons', [
            'label' => __('Display Social Icons', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'social_icon_title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'social_icon', [
            'label' => __('Social Icon', 'total-plus'),
            'type' => Controls_Manager::ICONS,
                ]
        );

        $repeater->add_control(
                'social_icon_link', [
            'label' => __('Button Link', 'total-plus'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('Enter URL', 'total-plus'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'social_icons', [
            'label' => __('Social Icons', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'social_icon_title' => __('Facebook', 'total-plus'),
                    'social_icon' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'social_icon_link' => '#'
                ],
                [
                    'social_icon_title' => __('Twitter', 'total-plus'),
                    'social_icon' => [
                        'value' => 'fab fa-twitter',
                        'library' => 'solid',
                    ],
                    'social_icon_link' => '#'
                ],
                [
                    'social_icon_title' => __('Instagram', 'total-plus'),
                    'social_icon' => [
                        'value' => 'fab fa-instagram',
                        'library' => 'solid',
                    ],
                    'social_icon_link' => '#'
                ],
            ],
            'title_field' => '{{{ social_icon_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
                ]
        );

        $this->add_responsive_control(
                'content_box_width', [
            'label' => __('Contact Box Width', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 100,
                    'max' => 1600,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 80,
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-contact-content' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'edge_padding', [
            'label' => esc_html__('Edge Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default' => [
                'top' => '100',
                'right' => '0',
                'bottom' => '100',
                'left' => '0',
                'isLinked' => false,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-contact-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'contact_form_width(%)', [
            'label' => esc_html__('Contact Form Width', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                '%' => [
                    'min' => 20,
                    'max' => 80,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 70,
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form' => 'width: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-contact-detail' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'contact_form_style', [
            'label' => esc_html__('Contact Form', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'contact_form_bg', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'contact_form_text_color', [
            'label' => esc_html__('Text Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'contact_form_input_text_color', [
            'label' => esc_html__('Input Text Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form input[type="text"],
                {{WRAPPER}} .tp-contact-form input[type="email"],
                {{WRAPPER}} .tp-contact-form input[type="url"],
                {{WRAPPER}} .tp-contact-form input[type="password"],
                {{WRAPPER}} .tp-contact-form input[type="search"],
                {{WRAPPER}} .tp-contact-form input[type="number"],
                {{WRAPPER}} .tp-contact-form input[type="tel"],
                {{WRAPPER}} .tp-contact-form input[type="range"],
                {{WRAPPER}} .tp-contact-form input[type="date"],
                {{WRAPPER}} .tp-contact-form input[type="month"],
                {{WRAPPER}} .tp-contact-form input[type="week"],
                {{WRAPPER}} .tp-contact-form input[type="time"],
                {{WRAPPER}} .tp-contact-form input[type="datetime"],
                {{WRAPPER}} .tp-contact-form input[type="datetime-local"],
                {{WRAPPER}} .tp-contact-form input[type="color"],
                {{WRAPPER}} .tp-contact-form textarea' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'contact_form_input_border_color', [
            'label' => esc_html__('Input Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#CCC',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form input[type="text"],
                {{WRAPPER}} .tp-contact-form input[type="email"],
                {{WRAPPER}} .tp-contact-form input[type="url"],
                {{WRAPPER}} .tp-contact-form input[type="password"],
                {{WRAPPER}} .tp-contact-form input[type="search"],
                {{WRAPPER}} .tp-contact-form input[type="number"],
                {{WRAPPER}} .tp-contact-form input[type="tel"],
                {{WRAPPER}} .tp-contact-form input[type="range"],
                {{WRAPPER}} .tp-contact-form input[type="date"],
                {{WRAPPER}} .tp-contact-form input[type="month"],
                {{WRAPPER}} .tp-contact-form input[type="week"],
                {{WRAPPER}} .tp-contact-form input[type="time"],
                {{WRAPPER}} .tp-contact-form input[type="datetime"],
                {{WRAPPER}} .tp-contact-form input[type="datetime-local"],
                {{WRAPPER}} .tp-contact-form input[type="color"],
                {{WRAPPER}} .tp-contact-form textarea' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'contact_form_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-contact-form *',
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
                'button_bg_color', [
            'label' => esc_html__('Button Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form input[type="submit"], {{WRAPPER}} .tp-contact-form button[type="submit"]' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_color', [
            'label' => esc_html__('Button Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form input[type="submit"], {{WRAPPER}} .tp-contact-form button[type="submit"]' => 'color: {{VALUE}}',
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
                'button_bg_hover_color', [
            'label' => esc_html__('Button Background Color(Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form input[type="submit"]:hover, {{WRAPPER}} .tp-contact-form button[type="submit"]:hover' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_hover_color', [
            'label' => esc_html__('Button Color(Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-form input[type="submit"]:hover, {{WRAPPER}} .tp-contact-form button[type="submit"]:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
            'selector' => '{{WRAPPER}} .tp-contact-form input[type="submit"]',
                ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
                'contact_detail_style', [
            'label' => esc_html__('Contact Detail', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'contact_detail_bg', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'contact_detail_content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail *' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'contact_detail_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-contact-detail',
                ]
        );

        $this->add_control(
                'contact_detail_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'social_button_tabs'
        );

        $this->start_controls_tab(
                'social_button_normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'social_button_bg_color', [
            'label' => esc_html__('Social Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-social-icon a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'social_button_icon_color', [
            'label' => esc_html__('Social Icon Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-social-icon a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'social_button_hover_tab', [
            'label' => esc_html__('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'social_button_bg_color_hover', [
            'label' => esc_html__('Social Background Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-social-icon a:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'social_button_icon_color_hover', [
            'label' => esc_html__('Social Icon Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-social-icon a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'open_close_button_style', [
            'label' => esc_html__('Open/Close Button', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'open_close_button_tabs'
        );

        $this->start_controls_tab(
                'open_close_button_normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'open_close_button_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail-toggle' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'open_close_button_icon_color', [
            'label' => esc_html__('Icon Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail-toggle' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'open_close_button_hover_tab', [
            'label' => esc_html__('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'open_close_button_bg_color_hover', [
            'label' => esc_html__('Background Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail-toggle:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'open_close_button_icon_color_hover', [
            'label' => esc_html__('Icon Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-contact-detail-toggle:hover' => 'color: {{VALUE}}',
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
        ?>
        <div class="tp-contact-module">
            <?php $this->get_iframe(); ?>

            <div class="tp-contact-box">
                <div class="tp-contact-detail-toggle tp-open"><i class="flaticon-add"></i></div>
                <div class="tp-contact-content">
                    <div class="tp-contact-form">
                        <?php echo do_shortcode($settings['shortcode']); ?>
                    </div>

                    <div class="tp-contact-detail">
                        <?php echo wp_kses_post($settings['contact_detail']); ?>

                        <div class="tp-contact-social-icon">
                            <?php
                            if ($settings['show_icons'] == 'yes') {
                                $this->get_social_icons();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    protected function get_iframe() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['address'])) {
            return;
        }

        if (0 === absint($settings['zoom']['size'])) {
            $settings['zoom']['size'] = 10;
        }

        printf(
                '<div class="tp-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$d&amp;output=embed&amp;iwloc=near" title="%3$s" aria-label="%3$s"></iframe></div>', rawurlencode($settings['address']), absint($settings['zoom']['size']), esc_attr($settings['address'])
        );
    }

    protected function get_social_icons() {
        $settings = $this->get_settings_for_display();
        $social_icons = $settings['social_icons'];

        foreach ($social_icons as $social_icon) {
            $target = $social_icon['social_icon_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $social_icon['social_icon_link']['nofollow'] ? ' rel="nofollow"' : '';
            ?>
            <a href="<?php echo esc_attr($social_icon['social_icon_link']['url']) ?>" <?php echo $target . $nofollow ?>>
                <?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true']); ?>
            </a>
            <?php
        }
    }

}
