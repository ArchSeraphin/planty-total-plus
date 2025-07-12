<?php

namespace TotalPlusElements\Modules\TestimonialSlider\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TestimonialSlider extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-testimonial-slider';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Testimonial Slider', 'total-plus');
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
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Quisque maximus ex eros, at tincidunt arcu placerat tempus. Quisque at lacinia mauris, a auctor urna. Donec laoreet tincidunt nisi ac sodales.'
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

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus')
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_settings', [
            'label' => esc_html__('Carousel Settings', 'total-plus'),
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
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial .tp-testimonial-title' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial img' => 'border-color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial .tp-testimonial-title',
                ]
        );

        $this->add_control(
                'name_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial .tp-testimonial-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial .tp-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial .tp-designation',
                ]
        );

        $this->add_control(
                'designation_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial .tp-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial-excerpt, {{WRAPPER}} .tp-testimonial-slider .tp-testimonial-excerpt .icofont-quote-left' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial-excerpt',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-slider .tp-testimonial-excerpt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'navigation_style', [
            'label' => esc_html__('Navigation', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'dots_color', [
            'label' => esc_html__('Dots Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-slider .owl-dots .owl-dot, {{WRAPPER}} .tp-testimonial-slider .slick-dots li button' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dots_color_hover', [
            'label' => esc_html__('Dots Color(Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-testimonial-slider .owl-dots .owl-dot.active, {{WRAPPER}} .tp-testimonial-slider .slick-dots li.slick-active button' => 'background-color: {{VALUE}}',
            ],
                ]
        );


        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $params = array(
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

        $layout = $settings['layout'];
        $image_shape = $settings['image_shape'];

        $testimonial_class = array(
            'tp-testimonial-slider',
            $layout,
            $image_shape
        );

        $dir_rtl = (is_rtl()) ? 'dir="rtl"' : '';

        $testimonials = $settings['testimonials'];

        if ($testimonials) {
            ?>
            <div class="<?php echo esc_attr(implode(' ', $testimonial_class)) ?>">
                <?php
                if ($layout == 'tp-style1') {
                    ?>
                    <div class="tp-testimonial-slider owl-carousel" data-params='<?php echo $params ?>'>
                        <?php
                        foreach ($testimonials as $testimonial) {

                            $name = $testimonial['name'];
                            $designation = $testimonial['designation'];
                            $content = $testimonial['content'];
                            ?>
                            <div class="tp-testimonial">
                                <div class="tp-testimonial-excerpt">
                                    <i class="icofont-quote-left"></i>
                                    <?php
                                    if (!empty($content)) {
                                        echo wp_kses_post($content);
                                    }
                                    ?>
                                </div>
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($testimonial, 'thumb', 'image'); ?>
                                <<?php echo $settings['title_html_tag']; ?> class="tp-testimonial-title"><?php echo esc_html($name); ?></<?php echo $settings['title_html_tag']; ?>>
                                <div class="tp-designation"><?php echo esc_html($designation); ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } elseif ($layout == 'tp-style2') {
                    $image = $content = '';
                    $params = array(
                        'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
                        'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
                        'loop' => $settings['infinite'] == 'yes' ? true : false,
                        'speed' => (int) $settings['speed'],
                        'dots' => $settings['dots'] == 'yes' ? true : false,
                        'count' => (int) count($settings['testimonials'])
                    );
                    $count = (int) count($settings['testimonials']);

                    if ($settings['autoplay'] == 'yes') {
                        $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
                    }

                    $params = json_encode($params);

                    if ($settings['testimonials']) {
                        foreach ($settings['testimonials'] as $item) {
                            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                            if (!$image_url) {
                                $image_url = \Elementor\Utils::get_placeholder_image_src();
                            }
                            $image .= '<div class="tp-testimonial-image-slide">';
                            $image .= '<div class="tp-testimonial-image-box">';
                            $image .= '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item['image'])) . '" />';
                            $image .= '</div>';
                            $image .= '</div>';

                            $content .= '<div class="tp-testimonial">';
                            $content .= '<div class="tp-testimonial-excerpt">';
                            $content .= wp_kses_post($item['content']);
                            $content .= '</div>';
                            $content .= '<' . $settings['title_html_tag'] . ' class="tp-testimonial-title">' . esc_html($item['name']) . '</' . $settings['title_html_tag'] . '>';
                            $content .= '<div class="tp-designation">' . esc_html($item['designation']) . '</div>';
                            $content .= '</div>';
                        }
                    }
                    ?>
                    <div class="tp-testimonial-image-wrap" <?php echo $dir_rtl; ?> data-count="<?php echo $count; ?>">
                        <?php echo $image; ?>
                    </div>

                    <div class="tp-testimonial-content-wrap" <?php echo $dir_rtl; ?>  data-params='<?php echo $params; ?>'>
                        <?php echo $content; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <?php
    }

}
