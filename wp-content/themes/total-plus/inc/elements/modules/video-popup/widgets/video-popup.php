<?php

namespace TotalPlusElements\Modules\VideoPopup\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class VideoPopup extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-video-popup';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Video PopUp', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-play';
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
                'video_url', [
            'label' => __('Video URL', 'total-plus'),
            'type' => Controls_Manager::URL,
            'description' => __('To display YouTube, Vimeo or VK video, paste the video URL (https://www.youtube.com/watch?v=6O9Nd1RSZSY)', 'total-plus'),
            'placeholder' => __('https://your-link.com', 'total-plus'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
            'separator' => 'after'
                ]
        );

        $this->add_control(
                'icon_type', [
            'label' => __('Video Icon Type', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => __('Default', 'total-plus'),
                'icon' => __('Font & SVG Icon', 'total-plus'),
                'image' => __('Image Icon', 'total-plus'),
            ],
                ]
        );

        $this->add_control(
                'default_icon_bg_color', [
            'label' => esc_html__('Icon Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#1f74fb',
            'condition' => [
                'icon_type' => ['default'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-play-button, {{WRAPPER}} .tp-play-button:before, {{WRAPPER}} .tp-play-button:after' => 'background-color: {{VALUE}};'
            ],
                ]
        );

        $this->add_control(
                'default_icon_color', [
            'label' => esc_html__('Icon Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'condition' => [
                'icon_type' => ['default'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-play-button i' => 'color: {{VALUE}};'
            ],
                ]
        );

        $this->add_control(
                'font_icon', [
            'label' => __('Select Icon', 'total-plus'),
            'description' => __('On clicking the video play button, the video will show in popup.', 'total-plus'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'far fa-play-circle',
                'library' => 'regular',
            ],
            'condition' => [
                'icon_type' => ['icon'],
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
                    'max' => 1000,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 80,
            ],
            'condition' => [
                'icon_type' => ['icon'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-video-popup a i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .tp-video-popup a svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
            ],
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Icon Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'icon_type' => ['icon'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-video-popup a i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .tp-video-popup a svg' => 'fill: {{VALUE}};',
            ],
                ]
        );

        $this->add_control(
                'icon_color_hover', [
            'label' => esc_html__('Icon Color(Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'icon_type' => ['icon'],
            ],
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-video-popup a:hover i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .tp-video-popup a:hover svg:hover' => 'fill: {{VALUE}};',
            ],
                ]
        );

        $this->add_control(
                'image_icon', [
            'label' => __('Select Image', 'total-plus'),
            'type' => Controls_Manager::MEDIA,
            'description' => __('On clicking the video play button, the video will show in popup.', 'total-plus'),
            'condition' => [
                'icon_type' => ['image'],
            ],
                ]
        );

        $this->add_control(
                'image_size', [
            'label' => __('Image Size', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 1000,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 100,
            ],
            'condition' => [
                'icon_type' => ['image'],
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-video-popup img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
            ],
                ]
        );

        $this->add_control(
                'icon_align', [
            'label' => __('Alignment', 'total-plus'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'total-plus'),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'total-plus'),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'total-plus'),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'separator' => 'before'
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $video_url = $settings['video_url']['url'];
        ?>
        <div class="tp-video-popup <?php echo esc_attr('tp-video-popup-align-' . $settings['icon_align']) ?>">
            <a href="<?php echo esc_url($video_url); ?>">
                <?php
                if ($settings['icon_type'] == 'default') {
                    ?>
                    <span class="tp-play-button"><i class="mdi mdi-play"></i></span>
                        <?php
                    } elseif ($settings['icon_type'] == 'icon') {
                        \Elementor\Icons_Manager::render_icon($settings['font_icon'], ['aria-hidden' => 'true']);
                    } elseif ($settings['icon_type'] == 'image') {
                        echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'image_icon');
                    }
                    ?>
            </a>
        </div>
        <?php
        ?>
        <?php
    }

}
