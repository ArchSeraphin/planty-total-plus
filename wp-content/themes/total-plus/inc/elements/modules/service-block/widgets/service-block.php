<?php

namespace TotalPlusElements\Modules\ServiceBlock\Widgets;

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

class ServiceBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-service-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Service Toggle Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-toggle';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'services_content', [
            'label' => esc_html__('Services', 'total-plus'),
                ]
        );

        $repeater = new Repeater();

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
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Service Heading', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'description', [
            'label' => __('Description', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => __('Ad has pertinax salutandi definitiones, quo ex omnis paulo equidem, minim alterum urbanitas eam et. ...', 'total-plus'),
            'placeholder' => __('Type your description here', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'button_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Read More'
                ]
        );

        $repeater->add_control(
                'button_link', [
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

        $this->add_control(
                'service_blocks', [
            'label' => __('Services', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title' => __('Service Heading', 'total-plus'),
                ]
            ],
            'title_field' => '{{{ title }}}',
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
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle .tp-service-icon i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-service-toggle .tp-service-icon svg' => 'fill: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle .tp-service-icon,{{WRAPPER}} .tp-service-toggle .tp-service-post:after' => 'background: {{VALUE}}',
                '{{WRAPPER}} .tp-service-toggle .tp-service-icon:before' => 'border-color: {{VALUE}}',
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
                '{{WRAPPER}} .tp-service-toggle .tp-service-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-service-toggle .tp-service-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle .tp-service-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'description_style', [
            'label' => esc_html__('Description', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle .tp-service-text-inner' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-service-toggle .tp-service-text-inner',
                ]
        );

        $this->add_control(
                'description_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle .tp-service-text-inner' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Link', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-service-toggle a.tp-service-more',
                ]
        );

        $this->start_controls_tabs(
                'link_style_tabs'
        );

        $this->start_controls_tab(
                'normal_link_tab', [
            'label' => __('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'normal_link_icon_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle a.tp-service-more' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'hover_link_tab', [
            'label' => __('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'hover_link_icon_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-service-toggle a.tp-service-more:hover' => 'color: {{VALUE}}',
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

        <div class="tp-service-toggle">
            <?php
            $services = $settings['service_blocks'];
            if (!empty($services)) {
                foreach ($services as $service) {
                    $title = $service['title'];
                    $content = $service['description'];
                    $link_text = $service['button_text'];

                    $link = $service['button_link']['url'];
                    $target = $service['button_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $service['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                    ?>
                    <div class="tp-service-post">
                        <div class="tp-service-icon">
                            <?php \Elementor\Icons_Manager::render_icon($service['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <div class="tp-service-excerpt tp-clearfix">
                            <<?php echo $settings['title_html_tag']; ?> class="tp-service-title"><?php echo esc_html($title); ?></<?php echo $settings['title_html_tag']; ?>>

                            <div class="tp-service-text">
                                <div class="tp-service-text-inner">
                                    <?php echo wp_kses_post($content); ?>
                                </div>
                                <?php if (!empty($link)) { ?>
                                    <a class="tp-service-more" href="<?php echo esc_url($link); ?>" <?php echo $target . $nofollow; ?>>
                                        <?php echo esc_html($link_text); ?>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
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
    }

}
