<?php

namespace TotalPlusElements\Modules\TeamCarousel\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TeamCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-team-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Team Carousel', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-slider-push';
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
            'label' => __('Short Detail', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 8,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                ]
        );

        $repeater->add_control(
                'link_text', [
            'label' => __('Read More Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Read More'
                ]
        );

        $repeater->add_control(
                'link', [
            'label' => __('Read More Link', 'total-plus'),
            'type' => Controls_Manager::URL,
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
                ]
        );

        $repeater->add_control(
                'facebook', [
            'label' => __('Facebook Link', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '#'
                ]
        );

        $repeater->add_control(
                'twitter', [
            'label' => __('Twitter Link', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '#'
                ]
        );

        $repeater->add_control(
                'instagram', [
            'label' => __('Instagram Link', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '#'
                ]
        );

        $this->add_control(
                'teams', [
            'label' => __('Team Members', 'total-plus'),
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
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
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
                'nav', [
            'label' => __('Navigation Arrows', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
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
                'overlay_color', [
            'label' => esc_html__('Overlay Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style1', 'tp-style3']
            ],
            'default' => 'rgba(255,255,255,0.9)',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member.tp-style1 .tp-title-wrap, 
                {{WRAPPER}} .tp-team-member.tp-style1 .tp-team-member-excerpt, 
                {{WRAPPER}} .tp-team-member.tp-style3 .tp-team-image-overlay' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'background_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style2', 'tp-style3', 'tp-style4', 'tp-style5', 'tp-style6']
            ],
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member.tp-style2 .tp-team-member-inner, 
                {{WRAPPER}} .tp-team-member.tp-style3 .tp-team-member-content, 
                {{WRAPPER}} .tp-team-member.tp-style4,
                {{WRAPPER}} .tp-team-member.tp-style5 .tp-team-member-content,
                {{WRAPPER}} .tp-team-member.tp-style6 .tp-team-member-content' => 'background: {{VALUE}}',
            ],
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
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member .tp-team-title' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-team-member.tp-style1 .tp-team-member-excerpt .tp-team-title:after' => 'background: {{VALUE}}',
                '{{WRAPPER}} .tp-team-member.tp-style4 .tp-team-image' => 'border-color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-team-member .tp-team-title',
                ]
        );

        $this->add_control(
                'name_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-team-member .tp-team-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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
            'default' => '#222222',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member .tp-team-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-team-member .tp-team-designation',
                ]
        );

        $this->add_control(
                'designation_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-team-member .tp-team-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Short Detail', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member .team-short-content' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-team-member .team-short-content',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-team-member .team-short-content' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'link_style', [
            'label' => esc_html__('Read More Link', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-team-member a.tp-team-detail',
                ]
        );

        $this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member a.tp-team-detail' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-team-member a.tp-team-detail:before, 
                {{WRAPPER}} .tp-team-member a.tp-team-detail:after' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-team-member a.tp-team-detail' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'social_style', [
            'label' => esc_html__('Social Icons', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'social_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .tp-team-social-id a' => 'color: {{VALUE}}; border-color: {{VALUE}}',
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
                '{{WRAPPER}} .tp-team-carousel.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tp-team-carousel.owl-carousel .owl-nav .owl-next' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color', [
            'label' => esc_html__('Arrow Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-team-carousel.owl-carousel .owl-nav .owl-prev, {{WRAPPER}} .tp-team-carousel.owl-carousel .owl-nav .owl-next' => 'color: {{VALUE}}',
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
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color_hover', [
            'label' => esc_html__('Arrow Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .owl-carousel .owl-nav button.owl-next:hover' => 'color: {{VALUE}}',
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

        $params = array(
            'items' => isset($settings['slides_to_show']['size']) ? (int) $settings['slides_to_show']['size'] : 3,
            'items_tablet' => isset($settings['slides_to_show_tablet']['size']) ? (int) $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => isset($settings['slides_to_show_mobile']['size']) ? (int) $settings['slides_to_show_mobile']['size'] : 1,
            'margin' => isset($settings['slides_margin']['size']) && $settings['slides_margin']['size'] !== null ? $settings['slides_margin']['size'] : 20,
            'margin_tablet' => isset($settings['slides_margin_tablet']['size']) && $settings['slides_margin_tablet']['size'] !== null ? $settings['slides_margin_tablet']['size'] : 20,
            'margin_mobile' => isset($settings['slides_margin_mobile']['size']) && $settings['slides_margin_mobile']['size'] !== null ? $settings['slides_margin_mobile']['size'] : 20,
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] == 'yes' ? true : false,
            'speed' => (int) $settings['speed'],
            'nav' => $settings['nav'] == 'yes' ? true : false
        );

        if ($settings['autoplay'] == 'yes') {
            $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
        }

        $team_style = $settings['layout'];

        $params = json_encode($params);
        if ($settings['teams']) {
            ?>
            <div class="tp-team-carousel owl-carousel"  data-params='<?php echo $params; ?>'>
                <?php
                foreach ($settings['teams'] as $item) {
                    $name = $item['name'];
                    $designation = $item['designation'];
                    $content = $item['content'];
                    ?>
                    <div class="tp-team-member <?php echo esc_attr($team_style); ?>">
                        <div class="tp-team-member-inner">

                            <div class="tp-team-image">
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'thumb', 'image'); ?>


                                <?php if ($team_style == 'tp-style3') { ?>
                                    <div class="tp-team-image-overlay">
                                        <div class="tp-team-image-overlay-inner">
                                            <?php if (!empty($content)) { ?>
                                                <div class="team-short-content">
                                                    <?php echo wp_kses_post($content); ?>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            $this->get_readmore_link($item);

                                            $this->get_social_links($item);
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <?php if ($team_style == 'tp-style1' && !empty($name)) { ?>
                                <div class="tp-title-wrap">
                                    <<?php echo $settings['title_html_tag']; ?> class="tp-team-title"><?php echo esc_html($name); ?></<?php echo $settings['title_html_tag']; ?>>
                                </div>
                            <?php } ?>

                            <div class="tp-team-member-content">
                                <div class="tp-team-member-excerpt">
                                    <div class="tp-team-member-span">
                                        <<?php echo $settings['title_html_tag']; ?> class="tp-team-title"><?php echo esc_html($name); ?></<?php echo $settings['title_html_tag']; ?>>

                                        <?php if (!empty($designation)) { ?>
                                            <div class="tp-team-designation"><?php echo esc_html($designation); ?></div>
                                        <?php } ?>

                                        <?php
                                        if ($team_style != 'tp-style3') {
                                            if (!empty($content)) {
                                                ?>
                                                <div class="team-short-content">
                                                    <div class="">
                                                        <?php echo wp_kses_post($content); ?>
                                                    </div>
                                                    <?php
                                                    if (!empty($link) && $team_style == 'tp-style5') {
                                                        $this->get_readmore_link($item);
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }

                                            if (!empty($link) && $team_style != 'tp-style5') {
                                                $this->get_readmore_link($item);
                                            }
                                            ?>

                                            <?php
                                            $this->get_social_links($item);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php
        }
    }

    protected function get_readmore_link($item) {
        $target = $item['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
        if (!empty($item['link']['url'])) {
            ?>
            <a class="tp-team-detail" href="<?php echo esc_url($item['link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                <?php echo wp_kses_post($item['link_text']); ?> 
            </a>
            <?php
        }
    }

    protected function get_social_links($item) {
        $social_icons = array(
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
        );
        if ($item['facebook'] || $item['twitter'] || $item['instagram']) {
            echo '<div class="tp-team-social-id">';
            foreach ($social_icons as $key => $social_icon) {
                if ($item[$key]) {
                    echo '<a title="' . $key . '" href="' . $item[$key] . '" target="_blank">';
                    echo '<i class="' . $social_icon . '"></i>';
                    echo '</a>';
                }
            }
            echo '</div>';
        }
    }

}
