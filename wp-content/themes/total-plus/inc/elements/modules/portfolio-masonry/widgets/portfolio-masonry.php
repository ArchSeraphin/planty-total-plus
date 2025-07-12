<?php

namespace TotalPlusElements\Modules\PortfolioMasonry\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class PortfolioMasonry extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-portfolio-masonry';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Portfolio Masonry', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-gallery-justified';
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
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_all_tab', [
            'label' => __('Display All Tab', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
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
                'tab_style', [
            'label' => __('Tab Style', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus'),
                'tp-style3' => __('Style 3', 'total-plus'),
                'tp-style4' => __('Style 4', 'total-plus')
            ],
            'condition' => [
                'display_tab' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'portfolio_style', [
            'label' => __('Portfolio Style', 'total-plus'),
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
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'portfolio_order_by', [
            'label' => __('Portfolio Order By', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'title',
            'options' => [
                'title' => __('Post Title', 'total-plus'),
                'date' => __('Posted Dated', 'total-plus'),
                'rand' => __('Random', 'total-plus')
            ],
                ]
        );

        $this->add_control(
                'portfolio_order', [
            'label' => __('Portfolio Order', 'total-plus'),
            'type' => Controls_Manager::SELECT,
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
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_zoom_button', [
            'label' => __('Display Zoom Button', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'display_link_button', [
            'label' => __('Display Link Button', 'total-plus'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'total-plus'),
            'label_off' => __('No', 'total-plus'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'portfolio_spacing', [
            'label' => esc_html__('Spacing Between Portfolio (px)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 2
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 10,
            ],
            'separator' => 'after'
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
            'default' => 'large',
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
            'selector' => '{{WRAPPER}} .tp-portfolio-cat-name-list .tp-portfolio-cat-name',
                ]
        );

        $this->add_control(
                'tab_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-cat-name-list' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->add_control(
                'tab_alignment', [
            'label' => __('Tab Alignment', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-tab-center',
            'options' => [
                'tp-tab-left' => __('Left', 'total-plus'),
                'tp-tab-center' => __('Center', 'total-plus'),
                'tp-tab-right' => __('Right', 'total-plus')
            ],
                ]
        );

        $this->start_controls_tabs(
                'tab_tabs'
        );

        $this->start_controls_tab(
                'normal_tab', [
            'label' => esc_html__('Normal', 'total-plus'),
                ]
        );

        $this->add_control(
                'tab_bg_color', [
            'label' => esc_html__('Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-cat-name-list.tp-style4 .tp-portfolio-cat-wrap, {{WRAPPER}} .tp-portfolio-cat-name-list.tp-style4 .tp-portfolio-switch' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'tab_style' => ['tp-style4'],
            ],
                ]
        );

        $this->add_control(
                'tab_color', [
            'label' => esc_html__('Text Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-cat-name-list .tp-portfolio-cat-name, {{WRAPPER}} .tp-portfolio-cat-name-list:not(.tp-style3) .tp-portfolio-switch i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-portfolio-cat-name-list.tp-style1 .tp-portfolio-cat-name, {{WRAPPER}} .tp-portfolio-cat-name-list.tp-style2 .tp-portfolio-cat-name' => 'border-color: {{VALUE}}',
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
                'tab_bg_color_hover', [
            'label' => esc_html__('Background Color (Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-cat-name-list.tp-style4 .tp-portfolio-cat-name.active' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'tab_style' => ['tp-style4'],
            ],
                ]
        );

        $this->add_control(
                'tab_color_hover', [
            'label' => esc_html__('Text Color (Active)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-cat-name-list .tp-portfolio-cat-name.active, {{WRAPPER}} .tp-portfolio-cat-name-list:not(.tp-style4) .tp-portfolio-cat-name:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .tp-portfolio-cat-name-list.tp-style2 .tp-portfolio-cat-name.active:after' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .tp-portfolio-cat-name-list.tp-style2 .tp-portfolio-cat-name:hover' => 'border-color: {{VALUE}}',
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
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-caption .tp-portfolio-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-portfolio-caption .tp-portfolio-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Title Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-caption .tp-portfolio-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->add_control(
                'portfolio_hover_bg', [
            'label' => esc_html__('Portfolio Hover Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-caption' => 'background-color: {{VALUE}}',
            ],
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'button_bg_color', [
            'label' => esc_html__('Zoom & Link Buttons Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-caption a.tp-portfolio-link, {{WRAPPER}} .tp-portfolio-caption a.tp-portfolio-image' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'button_color', [
            'label' => esc_html__('Zoom & Link Buttons Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .tp-portfolio-caption a.tp-portfolio-link, {{WRAPPER}} .tp-portfolio-caption a.tp-portfolio-image' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $portfolio_cat = $settings['portfolio_cats'];
        $portfolio_active_cat = $settings['active_cat'];
        $active_tab = ($portfolio_active_cat == '*') ? '*' : '.total-plus-portfolio-' . $portfolio_active_cat;
        $portfolio_cat_menu = $settings['display_tab'];
        $portfolio_tab_style = $settings['tab_style'];
        $portfolio_style = $settings['portfolio_style'];
        $portfolio_spacing = absint($settings['portfolio_spacing']['size']) / 2;

        $portfolio_class = array(
            'tp-portfolio-post-wrap',
            $portfolio_style
        );
        ?>
        <div class="tp-portfolio-masonary-wrap">

            <?php $this->get_portfolio_tab(); ?>

            <div class="<?php echo esc_attr(implode(' ', $portfolio_class)); ?>">
                <div class="tp-portfolio-posts-container">
                    <div class="tp-portfolio-posts tp-portfolio-posts-<?php echo $id; ?>" style="margin:-<?php echo absint($portfolio_spacing); ?>px">
                        <?php
                        if ($portfolio_cat) {
                            $portfolio_cat_array = $portfolio_cat;
                            $enable_zoom_button = $settings['display_zoom_button'];
                            $enable_link_button = $settings['display_link_button'];
                            $enable_title_link = $settings['enable_title_link'];
                            $orderby = $settings['portfolio_order_by'];
                            $order = $settings['portfolio_order'];

                            $args = array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => -1,
                                'order' => $order,
                                'orderby' => $orderby,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'portfolio_type',
                                        'field' => 'id',
                                        'terms' => $portfolio_cat_array,
                                    ),
                                ),
                            );
                            $query = new \WP_Query($args);
                            if ($query->have_posts()):
                                while ($query->have_posts()) : $query->the_post();

                                    $categories = get_the_terms(get_the_ID(), 'portfolio_type');
                                    $category_slug = "";
                                    $cat_slug = array();

                                    foreach ($categories as $category) {
                                        $cat_slug[] = 'total-plus-portfolio-' . $category->term_id;
                                    }

                                    $category_slug = implode(" ", $cat_slug);

                                    $url = \Elementor\Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(), 'thumb', $settings);
                                    if (!$url) {
                                        $url = \Elementor\Utils::get_placeholder_image_src();
                                    }

                                    $image_large = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                    ?>
                                    <div class="tp-portfolio <?php echo esc_attr($category_slug); ?>">
                                        <div class="tp-portfolio-outer-wrap" style="margin:<?php echo absint($portfolio_spacing); ?>px">
                                            <div class="tp-portfolio-wrap" style="background-image: url(<?php echo esc_url($url) ?>);">
                                                <div class="tp-portfolio-caption">
                                                    <?php
                                                    $portfolio_link = get_permalink();
                                                    $external_link = rwmb_meta('external_link');
                                                    $target = '_self';

                                                    if ($external_link) {
                                                        $portfolio_link = $external_link;
                                                        $external_link_new_tab = rwmb_meta('external_link_new_tab');
                                                        $target = $external_link_new_tab ? '_blank' : '_self';
                                                    }
                                                    ?>
                                                    <<?php echo $settings['title_html_tag']; ?> class="tp-portfolio-title">
                                                    <?php
                                                    if ($enable_title_link) {
                                                        echo '<a target="' . esc_attr($target) . '" href="' . esc_url($portfolio_link) . '">';
                                                    }
                                                    the_title();
                                                    if ($enable_title_link) {
                                                        echo '</a>';
                                                    }
                                                    ?>
                                                    </<?php echo $settings['title_html_tag']; ?>>

                                                    <?php
                                                    if ($enable_link_button) {
                                                        ?>
                                                        <a target="<?php echo esc_attr($target); ?>" class="tp-portfolio-link" href="<?php echo esc_url($portfolio_link); ?>"><i class="icofont-link"></i></a>
                                                    <?php } ?>

                                                    <?php if (has_post_thumbnail() && $enable_zoom_button) { ?>
                                                        <a class="tp-portfolio-image" data-lightbox-gallery="gallery1" href="<?php echo esc_url($image_large[0]) ?>"><i class="icofont-search-1"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function get_portfolio_tab() {
        $settings = $this->get_settings_for_display();
        $portfolio_cat = $settings['portfolio_cats'];
        $portfolio_active_cat = $settings['active_cat'];
        $active_tab = ($portfolio_active_cat == '*') ? '*' : '.total-plus-portfolio-' . $portfolio_active_cat;
        $portfolio_cat_menu = $settings['display_tab'];
        $portfolio_tab_style = $settings['tab_style'];
        $portfolio_style = $settings['portfolio_style'];
        $tab_alignment = $settings['tab_alignment'];

        if ($portfolio_cat && $portfolio_cat_menu) {
            $portfolio_cat_array = $portfolio_cat;
            $portfolio_show_all = $settings['display_all_tab'];
            ?>
            <div class="tp-portfolio-cat-name-list <?php echo $portfolio_tab_style . ' ' . $tab_alignment; ?>">
                <div class="tp-portfolio-cat-name-flex">
                    <div class="tp-portfolio-switch">
                        <i class="flaticon-menu-4"></i>
                    </div>

                    <div class="tp-portfolio-cat-wrap" data-active="<?php echo $active_tab; ?>">
                        <?php if ($portfolio_show_all) { ?>
                            <div class="tp-portfolio-cat-name" data-filter="*">
                                <?php _e('All', 'total-plus'); ?>
                            </div>
                            <?php
                        }

                        foreach ($portfolio_cat_array as $portfolio_cat_single) {
                            $category_slug = "";
                            $category_slug = '.total-plus-portfolio-' . $portfolio_cat_single;
                            $term = get_term($portfolio_cat_single, 'portfolio_type');
                            if (!empty($term) && !is_wp_error($term)) {
                                $term_name = esc_html($term->name);
                                ?>
                                <div class="tp-portfolio-cat-name" data-filter="<?php echo esc_attr($category_slug); ?>">
                                    <?php echo esc_html($term_name); ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}
