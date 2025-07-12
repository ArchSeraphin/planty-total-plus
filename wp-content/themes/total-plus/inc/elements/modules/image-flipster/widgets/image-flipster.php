<?php

namespace TotalPlusElements\Modules\ImageFlipster\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ImageFlipster extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-image-flipster';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Image Flipster Carousel', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-slider-album';
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
            'label' => __('Image Link', 'total-plus'),
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

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'carousel',
            'options' => [
                'carousel' => __('Carousel', 'total-plus'),
                'coverflow' => __('Coverflow', 'total-plus')
            ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
            'separator' => 'after'
                ]
        );

        $this->add_control(
                'image_height', [
            'label' => __('Image Height', 'total-plus'),
            'type' => Controls_Manager::NUMBER,
            'min' => 50,
            'max' => 1000,
            'step' => 1,
            'default' => 400,
                ]
        );

        $this->add_control(
                'image_width', [
            'label' => __('Image Width', 'total-plus'),
            'type' => Controls_Manager::NUMBER,
            'min' => 50,
            'max' => 1000,
            'step' => 1,
            'default' => 400,
                ]
        );

        $this->add_control(
                'image_stretch', [
            'label' => __('Image Stretch', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-image-stretch-yes',
            'options' => [
                'tp-image-stretch-yes' => __('Yes', 'total-plus'),
                'tp-image-stretch-no' => __('No', 'total-plus')
            ],
                ]
        );

        $this->add_control(
                'image_bg', [
            'label' => esc_html__('Image Box Background', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'condition' => [
                'image_stretch' => 'tp-image-stretch-no',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-image-flipster-carousel .tp-image-slide .flip-content' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'enable_nav', [
            'label' => __('Enable Navigation Buttons', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'nav_position', [
            'label' => __('Navigation Buttons Position', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-nav-bottom',
            'options' => [
                'tp-nav-bottom' => __('Bottom Center', 'total-plus'),
                'tp-nav-side' => __('Middle Side Ways', 'total-plus')
            ],
            'condition' => [
                'enable_nav' => 'yes',
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
                'navigation_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-image-flipster-carousel .flipto-nav a' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color', [
            'label' => esc_html__('Arrow Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-image-flipster-carousel .flipto-nav a' => 'color: {{VALUE}}',
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
                'navigation_bg_color_hover', [
            'label' => esc_html__('Background Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-image-flipster-carousel .flipto-nav a:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color_hover', [
            'label' => esc_html__('Arrow Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-image-flipster-carousel .flipto-nav a:hover' => 'color: {{VALUE}}',
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
        $style = array();
        $target = $settings['link_new_tab'] ? '_blank' : '_self';
        $style[] = ($settings['image_height']) ? 'height:' . $settings['image_height'] . 'px' : '';
        $style[] = ($settings['image_width']) ? 'width:' . $settings['image_width'] . 'px' : '';
        $nav_class = $settings['enable_nav'] == 'yes' ? '' : 'tp-disable-nav';

        $this->add_render_attribute('wrapper', [
            'class' => ['tp-image-flipster-carousel', esc_attr($settings['image_stretch']), esc_attr($settings['nav_position']), esc_attr($nav_class)],
            'data-style' => $settings['layout'],
                ]
        );
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php
            if ($settings['slides']) {
                echo '<div class="tp-flipster">';
                foreach ($settings['slides'] as $item) {

                    $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                    if (!$image_url) {
                        $image_url = \Elementor\Utils::get_placeholder_image_src();
                    }
                    $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item['image'])) . '" />';

                    echo '<div class="tp-image-slide" style="' . implode(';', $style) . '">';
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
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }

}
