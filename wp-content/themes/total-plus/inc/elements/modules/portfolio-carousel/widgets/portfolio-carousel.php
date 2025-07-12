<?php

namespace TotalPlusElements\Modules\PortfolioCarousel\Widgets;

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

/**
 * Tiled Posts Widget
 */
class PortfolioCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-portfolio-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Portfolio Carousel', 'total-plus');
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

        $this->add_control(
                'portfolio_cats', [
            'label' => esc_html__('Portfolio Category', 'total-plus'),
            'description' => esc_html__('Choose the Portfolio Category to Display', 'total-plus'),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => tp_get_portfolio_category()
                ]
        );

        $this->add_control(
                'active_cat', [
            'label' => esc_html__('Active Category', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'label_block' => true,
            'default' => '*',
            'options' => ['*' => esc_html__('All', 'total-plus')] + tp_get_portfolio_category()
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'total-plus'),
                ]
        );

        $this->add_control(
                'display_tab', [
            'label' => __('Display Tab', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_all_tab', [
            'label' => __('Display All Tab', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => [
                'display_tab' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'portfolio_order_by', [
            'label' => __('Portfolio Order By', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'title',
            'options' => [
                'title' => __('Post Title', 'total-plus'),
                'date' => __('Posted Dated', 'total-plus'),
                'rand' => __('Random', 'total-plus')
            ],
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'portfolio_order', [
            'label' => __('Portfolio Order', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => [
                'ASC' => __('Ascending Order', 'total-plus'),
                'DESC' => __('Descending Order', 'total-plus')
            ],
                ]
        );

        $this->add_control(
                'enable_title_link', [
            'label' => __('Enable Link in Title', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_zoom_button', [
            'label' => __('Display Zoom Button', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'title_html_tag', [
            'label' => __('Title HTML Tag', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SELECT,
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
            'default' => 'large',
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
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_on_hover', [
            'label' => __('Pause on Hover', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
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
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'autoplay_speed', [
            'label' => __('Autoplay Speed (in Seconds)', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SLIDER,
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
                'navigation', [
            'label' => __('Navigation Buttons', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'dots', [
            'label' => __('Navigation Dots', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'tab_styles', [
            'label' => esc_html__('Tab Button', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'tab_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-portfolio-carousel-button .tp-portfolio-filter-btn',
                ]
        );

        $this->add_control(
                'tab_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-carousel-button' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->start_controls_tabs(
                'tab_tabs'
        );

        $this->start_controls_tab(
                'style_normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'tab_border_color', [
            'label' => esc_html__('Border Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-filter-wrap, {{WRAPPER}} .tp-portfolio-filter-btn' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'tab_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-filter-wrap' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'tab_color', [
            'label' => esc_html__('Text Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-filter-btn' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'style_active_tab', [
            'label' => esc_html__('Active', 'total-plus'),
                ]
        );

        $this->add_control(
                'tab_bg_color_hover', [
            'label' => esc_html__('Background Color (Active)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-filter-btn.btn-active' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'tab_color_hover', [
            'label' => esc_html__('Text Color (Active)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-filter-btn.btn-active' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'portfolio_style_tab', [
            'label' => esc_html__('Portfolio', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Title Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-portfolio-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border', [
            'label' => esc_html__('Title Border', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#EEE',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-portfolio-title' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_bg', [
            'label' => esc_html__('Title Background', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-portfolio-title' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-portfolio-slider .tp-portfolio-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Title Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-portfolio-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'button_bg', [
            'label' => esc_html__('Zoom Button Background', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-carousel-image-wrap > a' => 'background-color: {{VALUE}}',
            ],
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'button_color', [
            'label' => esc_html__('Zoom Button Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-carousel-image-wrap > a' => 'color: {{VALUE}}',
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
                'navigation_height', [
            'label' => __('Navigation Arrow Height (px)', 'total-plus'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 20,
                    'max' => 100,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 40,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-owl-nav' => 'height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'navigation_tabs'
        );

        $this->start_controls_tab(
                'navigation_normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'navigation_border', [
            'label' => esc_html__('Navigation Border', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-owl-nav, {{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-prev' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'navigation_bg', [
            'label' => esc_html__('Navigation Background', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-prev, {{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-next' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'navigation_color', [
            'label' => esc_html__('Navigation Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-prev, {{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-next' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_color', [
            'label' => esc_html__('Dots Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-carousel .owl-carousel .owl-dot' => 'background-color: {{VALUE}}',
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
                'navigation_bg_hover', [
            'label' => esc_html__('Navigation Background (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-prev:hover, {{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-next:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'navigation_color_hover', [
            'label' => esc_html__('Navigation Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-prev:hover, {{WRAPPER}} .tp-portfolio-slider .tp-owl-nav .owl-next:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_color_hover', [
            'label' => esc_html__('Dots Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-carousel .owl-carousel .owl-dot:hover' => 'background-color: {{VALUE}}',
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
        $category = $settings['portfolio_cats'];
        ?>
        <div class="tp-portfolio-slider">
            <?php
            if ($category) {
                $category_array = $category;
                $active_category = $settings['active_cat'];
                $all = $settings['display_all_tab'];
                $show_zoom = $settings['display_zoom_button'];
                $orderby = $settings['portfolio_order_by'];
                $order = $settings['portfolio_order'];
                $show_tab = $settings['display_tab'];
                $show_arrow = $settings['navigation'];
                $enable_title_link = $settings['enable_title_link'];

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
                    'dots' => $settings['dots'] == 'yes' ? true : false,
                    'show_tab' => $settings['display_tab'] == 'yes' ? true : false
                );

                if ($settings['autoplay'] == 'yes') {
                    $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
                }

                $params = json_encode($params);
                ?>

                <?php if ($show_tab || $show_arrow) { ?>
                    <div class="tp-portfolio-carousel-button">
                        <?php
                        $active_tab = ($active_category == '*') ? '*' : '.tp-portfolio-' . $active_category;

                        if ($show_tab) {
                            ?>
                            <div class="tp-portfolio-filter-btns-wrap">
                                <div class="tp-portfolio-filter-wrap" data-active="<?php echo $active_tab; ?>">
                                    <?php if ($all) { ?>
                                        <div class="tp-portfolio-filter-btn" data-filter="*">
                                            <?php _e('All', 'total-plus'); ?>
                                        </div>
                                        <?php
                                    }

                                    foreach ($category_array as $portfolio_cat_single) {
                                        $category_slug = "";
                                        $category_slug = '.tp-portfolio-' . $portfolio_cat_single;
                                        $term = get_term($portfolio_cat_single, 'portfolio_type');
                                        if (!empty($term) && !is_wp_error($term)) {
                                            $term_name = esc_html($term->name);
                                            ?>
                                            <div class="tp-portfolio-filter-btn" data-filter="<?php echo esc_attr($category_slug); ?>">
                                                <?php echo esc_html($term_name); ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }

                        if ($show_arrow) {
                            ?>
                            <div class="tp-owl-nav">
                                <div class="owl-prev"><i class="mdi mdi-chevron-left"></i></div>
                                <div class="owl-next"><i class="mdi mdi-chevron-right"></i></div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="tp-portfolio-carousel">
                    <div class="owl-carousel tp-portfolio-carousel-slides" data-params='<?php echo $params; ?>'>
                        <?php
                        $args = array(
                            'post_type' => 'portfolio',
                            'posts_per_page' => -1,
                            'order' => $order,
                            'orderby' => $orderby,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'portfolio_type',
                                    'field' => 'id',
                                    'terms' => $category_array
                                )
                            )
                        );
                        $query = new \WP_Query($args);
                        if ($query->have_posts()):
                            while ($query->have_posts()) : $query->the_post();
                                $categories = get_the_terms(get_the_ID(), 'portfolio_type');
                                $category_slug = "";
                                $cat_slug = array();

                                foreach ($categories as $category) {
                                    $cat_slug[] = 'tp-portfolio-' . $category->term_id;
                                }

                                $category_slug = implode(" ", $cat_slug);

                                $image = \Elementor\Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(), 'thumb', $settings);
                                if (!$image) {
                                    $image = \Elementor\Utils::get_placeholder_image_src();
                                }

                                $image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');

                                $image_alt = total_plus_get_image_alt(get_post_thumbnail_id(), get_the_title());

                                $portfolio_link = get_permalink();
                                $external_link = rwmb_meta('external_link');
                                $target = '_self';

                                if ($external_link) {
                                    $portfolio_link = $external_link;
                                    $external_link_new_tab = rwmb_meta('external_link_new_tab');
                                    $target = $external_link_new_tab ? '_blank' : '_self';
                                }
                                ?>
                                <div class="tp-portfolio-carousel-item <?php echo esc_attr($category_slug); ?>">
                                    <div class="tp-portfolio-carousel-image-wrap">
                                        <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
                                        <?php if ($show_zoom) { ?>
                                            <a class="tp-portfolio-carousel-image" data-lightbox-gallery="gallery2" href="<?php echo esc_url($image_large[0]) ?>"><i class="icofont-search-1"></i></a>
                                                <?php
                                            }
                                            ?>
                                    </div>

                                    <<?php echo $settings['title_html_tag']; ?> class="tp-portfolio-title">
                                    <?php
                                    if ($enable_title_link) {
                                        echo '<a target="' . esc_attr($target) . '" href="' . esc_url($portfolio_link) . '">';
                                    }
                                    echo '<span>';
                                    the_title();
                                    echo '</span>';
                                    if ($enable_title_link) {
                                        echo '</a>';
                                    }
                                    ?>
                                    </<?php echo $settings['title_html_tag']; ?>>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
