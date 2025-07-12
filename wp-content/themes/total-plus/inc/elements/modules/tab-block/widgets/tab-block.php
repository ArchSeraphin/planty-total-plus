<?php

namespace TotalPlusElements\Modules\TabBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TabBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-tab-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Tab Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-tabs';
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
                'icon', [
            'label' => __('Icon', 'total-plus'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid',
            ],
                ]
        );

        $repeater->add_control(
                'title', [
            'label' => __('Tab Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Tab Title'
                ]
        );

        $repeater->add_control(
                'content_from', [
            'label' => __('Add Content From', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'wisiwyg' => __('WISIWYG Editor', 'total-plus'),
                'page' => __('Page', 'total-plus')
            ],
            'default' => 'wisiwyg',
            'label_block' => true
                ]
        );

        $repeater->add_control(
                'content', [
            'label' => __('Tab Content', 'total-plus'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'placeholder' => __('Type your description here', 'total-plus'),
            'condition' => [
                'content_from' => ['wisiwyg']
            ],
                ]
        );

        $repeater->add_control('select_page', [
            'label' => 'Select Page',
            'type' => Controls_Manager::SELECT,
            'label_block' => true,
            'multiple' => false,
            'options' => $this->el_get_pages(),
            'condition' => [
                'content_from' => ['page']
            ],
                ]
        );

        $this->add_control(
                'tabs', [
            'label' => __('Tab List', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'icon' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 1',
                    'content' => 'Nunc commodo, ligula nec vestibulum condimentum, elit ipsum pharetra est, eu convallis mauris massa eget justo. Proin hendrerit orci id turpis egestas, dictum eleifend massa vulputate. Quisque mattis egestas nulla, at ornare nibh blandit id. Donec fringilla urna vitae risus aliquam, a mattis eros ornare. Quisque maximus ex eros, at tincidunt arcu placerat tempus. Quisque at lacinia mauris, a auctor urna. Donec laoreet tincidunt nisi ac sodales.'
                ],
                [
                    'icon' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 2',
                    'content' => 'Proin vulputate eros id magna mattis mattis id sed odio. Aliquam commodo justo eget sodales lacinia. Sed leo diam, pellentesque quis maximus nec, gravida eget neque. Nulla justo mi, tempor vitae auctor vel, placerat quis turpis. Morbi ullamcorper nunc eget auctor iaculis. Proin eu metus finibus, consectetur quam et, sollicitudin sem. Aliquam tellus nibh, dignissim nec pellentesque sed, congue ut lorem. Integer commodo, nunc ac consectetur conv.'
                ],
                [
                    'icon' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 3',
                    'content' => 'Donec justo eros, luctus quis scelerisque id, ultricies sit amet odio. Vestibulum aliquam efficitur eleifend. Praesent dignissim faucibus ex vel sodales. Morbi aliquet libero at augue pharetra vehicula. Cras dapibus lorem efficitur nunc euismod convallis. Nunc molestie risus id lacinia consequat. Integer iaculis orci in ipsum vestibulum, non mattis justo ornare. Cras et lorem tempor ligula suscipit mollis. Nulla vitae augue non leo tempus finibus.'
                ],
            ],
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
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
                'tp-style5' => __('Style 5', 'total-plus'),
                'tp-style6' => __('Style 6', 'total-plus')
            ],
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Tab Title', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-tab-wrap .tp-tab-link',
                ]
        );

        $this->add_control(
                'icon_size', [
            'label' => __('Tab Icon Size', 'total-plus'),
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
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-link i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-link svg' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'icon_spacing', [
            'label' => __('Tab Icon Spacing', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 5,
                    'max' => 30,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap.tp-style1 .tp-tab-link i, {{WRAPPER}} .tp-tab-wrap.tp-style2 .tp-tab-link i, {{WRAPPER}} .tp-tab-wrap.tp-style1 .tp-tab-link svg, {{WRAPPER}} .tp-tab-wrap.tp-style2 .tp-tab-link svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-tab-wrap.tp-style3 .tp-tab-link i, {{WRAPPER}} .tp-tab-wrap.tp-style4 .tp-tab-link i, {{WRAPPER}} .tp-tab-wrap.tp-style5 .tp-tab-link i, {{WRAPPER}} .tp-tab-wrap.tp-style6 .tp-tab-link i, {{WRAPPER}} .tp-tab-wrap.tp-style3 .tp-tab-link svg, {{WRAPPER}} .tp-tab-wrap.tp-style4 .tp-tab-link svg, {{WRAPPER}} .tp-tab-wrap.tp-style5 .tp-tab-link svg, {{WRAPPER}} .tp-tab-wrap.tp-style6 .tp-tab-link svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'tabs_style'
        );

        $this->start_controls_tab(
                'normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'title_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style2'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap.tp-style2 .tp-tab-link' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Title Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-link' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-link svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border_color', [
            'label' => esc_html__('Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style1', 'tp-style4'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap.tp-style1 .tp-tab-anchors, {{WRAPPER}} .tp-tab-wrap.tp-style4 .tp-tab-link span, {{WRAPPER}} .tp-tab-wrap.tp-style4 .tp-tab-link:after' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'active_tab', [
            'label' => esc_html__('Active', 'total-plus'),
                ]
        );

        $this->add_control(
                'title_bg_color_hover', [
            'label' => esc_html__('Background Color (Active)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style2', 'tp-style3', 'tp-style5', 'tp-style6'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap.tp-style2 .tp-tab-link.tp-active, {{WRAPPER}} .tp-tab-wrap.tp-style3 .tp-tab-link.tp-active, {{WRAPPER}} .tp-tab-wrap.tp-style5 .tp-tab-link.tp-active, {{WRAPPER}} .tp-tab-wrap.tp-style6 .tp-tab-link.tp-active, {{WRAPPER}} .tp-tab-wrap.tp-style6 .tp-tab-link.tp-active:after' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .tp-tab-wrap.tp-style2 .tp-tab-link.tp-active:after' => 'border-left-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_color_hover', [
            'label' => esc_html__('Title Color (Active)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-link.tp-active' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-link.tp-active svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border_color_hover', [
            'label' => esc_html__('Border Color (Active)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style1', 'tp-style3', 'tp-style4'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap.tp-style1 .tp-tab-link.tp-active:after, {{WRAPPER}} .tp-tab-wrap.tp-style4 .tp-tab-link.tp-active span:before' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .tp-tab-wrap.tp-style3 .tp-tab-link.tp-active' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'tab_content_style', [
            'label' => esc_html__('Tab Content', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tab_content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-content' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'tab_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style3', 'tp-style4', 'tp-style5', 'tp-style5', 'tp-style6'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap.tp-style3 .tp-tab-content, {{WRAPPER}} .tp-tab-wrap.tp-style4 .tp-tab-content, {{WRAPPER}} .tp-tab-wrap.tp-style5 .tp-tab-content, {{WRAPPER}} .tp-tab-wrap.tp-style6' => 'background-color: {{VALUE}}',
            ],
                ]
        );


        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'tab_content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-tab-wrap .tp-tab-content',
                ]
        );

        $this->add_control(
                'tab_content_padding', [
            'label' => esc_html__('Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-tab-wrap .tp-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $tab_class = array(
            'tp-tab-wrap',
            $settings['layout'],
            'tp-clearfix'
        );
        $tab = $tab_content = '';
        if ($settings['tabs']) {
            foreach ($settings['tabs'] as $index => $item) {
                $tab_count = $index + 1;
                $tab_id = $id . $tab_count;

                ob_start();
                \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                $icon_html = ob_get_clean();
                $tab .= '<div class="tp-tab-link" id="tp-tab-' . $tab_id . '">' . $icon_html . '<span>' . esc_html($item['title']) . '</span></div>';


                $tab_content .= '<div class="tp-content" id="tp-content-' . $tab_id . '" style="display:none;"><div class="tp-clearfix">';

                ob_start();
                if ($item['content_from'] == 'wisiwyg') {
                    echo do_shortcode($item['content']);
                } else if ($item['content_from'] == 'page') {
                    $square_tab_page = $item['select_page'];
                    if ($square_tab_page) {
                        // Get ID
                        $get_id = $square_tab_page;
                        // Check if page is Elementor page
                        $elementor = get_post_meta($get_id, '_elementor_edit_mode', true);
                        $siteorigin = get_post_meta($get_id, 'panels_data', true);

                        // If Elementor
                        if (class_exists('Elementor\Plugin') && $elementor) {
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($get_id);
                        }

                        // If Beaver Builder
                        else if (class_exists('FLBuilder') && !empty($get_id)) {
                            echo do_shortcode('[fl_builder_insert_layout id="' . $get_id . '"]');
                        }

                        // If Site Origin
                        else if (class_exists('SiteOrigin_Panels') && $siteorigin) {
                            echo SiteOrigin_Panels::renderer()->render($get_id);
                        } else {
                            // Get template content
                            $template_id = get_post($get_id);

                            if ($template_id && !is_wp_error($template_id)) {
                                $content = $template_id->post_content;
                            }
                            // Display template content
                            echo do_shortcode($content);
                            //echo apply_filters('the_content', $content);
                        }
                    }
                }
                $tab_content .= ob_get_clean();
                $tab_content .= '</div></div>';
            }
        }
        ?>
        <div class="<?php echo esc_attr(implode(' ', $tab_class)); ?>">
            <div class="tp-tab-anchors">
                <?php echo $tab; ?>
            </div>
            <div class="tp-tab-content">
                <?php echo $tab_content; ?>
            </div>
        </div>
        <?php
    }

    private function el_get_pages() {
        $pages = get_pages(array(
            'order' => 'ASC'
        ));
        $_pages = [];

        foreach ($pages as $key => $object) {
            $_pages[$object->ID] = ucfirst($object->post_title);
        }

        return $_pages;
    }

}
