<?php

namespace TotalPlusElements\Modules\LogoCarousel\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LogoCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-logo-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Logo Carousel', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-carousel';
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
                'title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Title'
                ]
        );

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
                'logo_link', [
            'label' => __('Logo Link', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $this->add_control(
                'slides', [
            'label' => __('Slides', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->add_control(
                'link_new_tab', [
            'label' => __('Open Link in New Tab', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
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
                'size' => 20,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 20,
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
                'dots', [
            'label' => __('Navigation Dots', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'dot_style', [
            'label' => esc_html__('Naviagation Dot Style', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'dot_tabs'
        );

        $this->start_controls_tab(
                'dot_style_normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'dot_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-logo-carousel .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dot_style_active_tab', [
            'label' => esc_html__('Hover', 'total-plus'),
                ]
        );

        $this->add_control(
                'dot_color_hover', [
            'label' => esc_html__('Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-logo-carousel .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
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
        $target = $settings['link_new_tab'] ? '_blank' : '_self';
        $params = array(
            'items' => isset($settings['slides_to_show']['size']) ? (int) $settings['slides_to_show']['size'] : 3,
            'items_tablet' => isset($settings['slides_to_show_tablet']['size']) ? (int) $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => isset($settings['slides_to_show_mobile']['size']) ? (int) $settings['slides_to_show_mobile']['size'] : 1,
            'margin' => isset($settings['slides_margin']['size']) && $settings['slides_margin']['size'] !== null ? (int) $settings['slides_margin']['size'] : 20,
            'margin_tablet' => isset($settings['slides_margin_tablet']['size']) && $settings['slides_margin_tablet']['size'] !== null ? (int) $settings['slides_margin_tablet']['size'] : 20,
            'margin_mobile' => isset($settings['slides_margin_mobile']['size']) && $settings['slides_margin_mobile']['size'] !== null ? (int) $settings['slides_margin_mobile']['size'] : 20,
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] == 'yes' ? true : false,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['dots'] == 'yes' ? true : false
        );

        if ($settings['autoplay'] == 'yes') {
            $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
        }
        $params = json_encode($params);
        ?>
        <div class="tp-logo-carousel owl-carousel" data-params='<?php echo $params; ?>'>
            <?php
            if ($settings['slides']) {
                foreach ($settings['slides'] as $item) {
                    $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                    if (!$image_url) {
                        $image_url = \Elementor\Utils::get_placeholder_image_src();
                    }
                    $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item['image'])) . '" />';
                    echo '<div class="tp-logo-slide">';
                    if (!empty($item['logo_link'])) {
                        ?>
                        <a href="<?php echo esc_url($item['logo_link']) ?>" target="<?php echo esc_attr($target) ?>">
                            <?php echo $image_html; ?>
                        </a>
                        <?php
                    } else {
                        echo $image_html;
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
        <?php
    }

}
