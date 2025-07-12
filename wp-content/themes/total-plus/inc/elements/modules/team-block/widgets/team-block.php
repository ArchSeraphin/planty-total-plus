<?php

namespace TotalPlusElements\Modules\TeamBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TeamBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-team-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Team Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-person';
    }

    /** Category */
    public function get_categories() {
        return ['total-plus-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'team', [
            'label' => esc_html__('Team', 'total-plus'),
                ]
        );

        $this->add_control(
                'member_name', [
            'label' => __('Name', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('John Doe', 'total-plus'),
            'placeholder' => __('Enter the name here', 'total-plus'),
                ]
        );

        $this->add_control(
                'member_designation', [
            'label' => __('Designations', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' => __('Enter the designation here', 'total-plus'),
            'default' => __('Support Engineer', 'total-plus')
                ]
        );

        $this->add_control(
                'member_description', [
            'label' => __('Description', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'placeholder' => __('Type the description here', 'total-plus'),
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'total-plus')
                ]
        );

        $this->add_control(
                'member_image', [
            'label' => __('Choose Photo', 'total-plus'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'button_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Detail'
                ]
        );

        $this->add_control(
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

        $repeater = new Repeater();

        $repeater->add_control(
                'social_icon_title', [
            'label' => __('Title', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Twitter', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'social_icon', [
            'label' => __('Social Icon', 'total-plus'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fab fa-twitter',
                'library' => 'solid',
            ],
                ]
        );

        $repeater->add_control(
                'social_icon_link', [
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
                'social_icons_block', [
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

        $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->add_control(
                'layout', [
            'label' => __('Team Block Style', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus'),
                'tp-style3' => __('Style 3', 'total-plus'),
                'tp-style4' => __('Style 4', 'total-plus'),
                'tp-style5' => __('Style 5', 'total-plus'),
                'tp-style6' => __('Style 6', 'total-plus'),
                'tp-style7' => __('Style 7', 'total-plus'),
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
                'overlay_color', [
            'label' => esc_html__('Overlay Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout' => ['tp-style1', 'tp-style3', 'tp-style7']
            ],
            'default' => 'rgba(255,255,255,0.9)',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member.tp-style1 .tp-title-wrap, 
                {{WRAPPER}} .tp-team-member.tp-style1 .tp-team-member-excerpt, 
                {{WRAPPER}} .tp-team-member.tp-style3 .tp-team-image-overlay,
                {{WRAPPER}} .tp-team-member.tp-style7 .tp-title-wrap' => 'background: {{VALUE}}',
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
            'condition' => [
                'layout!' => 'tp-style7',
            ],
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
                'link_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgba(255,255,255,0.9)',
            'selectors' => [
                '{{WRAPPER}} .tp-team-member.tp-style7 .tp-team-detail' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'condition' => [
                'layout!' => 'tp-style7',
            ],
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
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image = $settings['member_image']['url'];
        $name = $settings['member_name'];
        $designation = $settings['member_designation'];
        $content = $settings['member_description'];
        $link = $settings['button_link']['url'];
        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        $link_text = $settings['button_text'];
        $social_icons = $settings['social_icons_block'];
        $team_style = $settings['layout'];
        ?>
        <div class="tp-team-member <?php echo esc_attr($team_style); ?>">
            <div class="tp-team-member-inner">

                <div class="tp-team-image">
                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumb', 'member_image'); ?>


                    <?php if ($team_style == 'tp-style3') { ?>
                        <div class="tp-team-image-overlay">
                            <div class="tp-team-image-overlay-inner">
                                <?php if (!empty($content)) { ?>
                                    <div class="team-short-content">
                                        <?php echo wp_kses_post($content); ?>
                                    </div>
                                <?php } ?>

                                <?php
                                if (!empty($link)) {
                                    ?>
                                    <a href="<?php echo esc_url($link); ?>" class="tp-team-detail" <?php echo $target . $nofollow; ?>>
                                        <?php echo esc_attr($link_text); ?>
                                    </a>
                                    <?php
                                }

                                if (!empty($social_icons)) {
                                    ?>
                                    <div class="tp-team-social-id">
                                        <?php
                                        foreach ($social_icons as $key => $social_icon) {
                                            $social_icon_target = $social_icon['social_icon_link']['is_external'] ? ' target="_blank"' : '';
                                            $social_icon_nofollow = $social_icon['social_icon_link']['nofollow'] ? ' rel="nofollow"' : '';
                                            ?>
                                            <a href="<?php echo esc_url($social_icon['social_icon_link']['url']) ?>" <?php echo $social_icon_target . $social_icon_nofollow; ?>>
                                                <?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if ($team_style == 'tp-style7' && !empty($name)) {
                        if (!empty($link)) {
                            ?>
                            <a href="<?php echo esc_url($link); ?>" class="tp-team-detail" <?php echo $target . $nofollow; ?>>
                            </a>
                            <?php
                        }
                        ?>
                        <div class="tp-title-wrap">
                            <<?php echo $settings['title_html_tag']; ?> class="tp-team-title"><?php echo esc_html($name); ?></<?php echo $settings['title_html_tag']; ?>>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($team_style == 'tp-style1' && !empty($name)) { ?>
                    <div class="tp-title-wrap">
                        <<?php echo $settings['title_html_tag']; ?> class="tp-team-title"><?php echo esc_html($name); ?></<?php echo $settings['title_html_tag']; ?>>
                    </div>
                <?php } ?>

                <div class="tp-team-member-content">
                    <div class="tp-team-member-excerpt">
                        <div class="tp-team-member-span">
                            <?php if ($team_style != 'tp-style7' && !empty($name)) { ?>
                                <<?php echo $settings['title_html_tag']; ?> class="tp-team-title"><?php echo esc_html($name); ?></<?php echo $settings['title_html_tag']; ?>>
                            <?php } ?>

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
                                        <?php if (!empty($link) && $team_style == 'tp-style5') { ?>
                                            <a href="<?php echo esc_url($link); ?>" class="tp-team-detail" <?php echo $target . $nofollow; ?>><?php _e('Detail', 'total-plus') ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }

                                if (!empty($link) && ( $team_style != 'tp-style5' && $team_style != 'tp-style7')) {
                                    ?>
                                    <a href="<?php echo esc_url($link); ?>" class="tp-team-detail" <?php echo $target . $nofollow; ?>>
                                        <?php _e('Detail', 'total-plus') ?>
                                    </a>
                                <?php } ?>

                                <?php
                                if (!empty($social_icons)) {
                                    ?>
                                    <div class="tp-team-social-id">
                                        <?php
                                        foreach ($social_icons as $key => $social_icon) {
                                            $social_icon_target = $social_icon['social_icon_link']['is_external'] ? ' target="_blank"' : '';
                                            $social_icon_nofollow = $social_icon['social_icon_link']['nofollow'] ? ' rel="nofollow"' : '';
                                            ?>
                                            <a href="<?php echo esc_url($social_icon['social_icon_link']['url']) ?>" <?php echo $social_icon_target . $social_icon_nofollow; ?>>
                                                <?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

}
