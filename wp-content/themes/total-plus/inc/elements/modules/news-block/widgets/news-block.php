<?php

namespace TotalPlusElements\Modules\NewsBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class NewsBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'total-plus-news-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('News Block', 'total-plus');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-call-to-action';
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
            'default' => 'Heading'
                ]
        );

        $repeater->add_control(
                'content', [
            'label' => __('Content', 'total-plus'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => 'Proin vulputate eros id magna mattis mattis id sed odio. Aliquam commodo justo eget sodales lacinia. Sed leo diam, pellentesque quis maximus nec, gravida eget neque. Nulla justo mi, tempor vitae auctor vel, placerat quis turpis. Morbi ullamcorper nunc eget auctor iaculis. Proin eu metus finibus, consectetur quam et, sollicitudin sem. Aliquam tellus nibh, dignissim nec pellentesque sed, congue ut lorem. Integer commodo, nunc ac consectetur conv.'
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
                'button_text', [
            'label' => __('Button Text', 'total-plus'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Read More', 'total-plus'),
                ]
        );

        $repeater->add_control(
                'button_link', [
            'label' => __('Button Link', 'total-plus'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'total-plus'),
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => true,
                'nofollow' => true,
            ],
                ]
        );

        $this->add_control(
                'news_list', [
            'label' => __('News List', 'total-plus'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
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
            'label' => __('Layout', 'total-plus'),
            'type' => Controls_Manager::SELECT,
            'default' => 'tp-style1',
            'options' => [
                'tp-style1' => __('Style 1', 'total-plus'),
                'tp-style2' => __('Style 2', 'total-plus'),
                'tp-style3' => __('Style 3', 'total-plus'),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'general_style', [
            'label' => esc_html__('General', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_bg_color', [
            'label' => esc_html__('Content Background Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'layout!' => 'tp-style1',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news-content' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'content_padding', [
            'label' => esc_html__('Content Padding', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'condition' => [
                'layout!' => 'tp-style1',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'news_spacing', [
            'label' => __('Spacing Between News Block(px)', 'total-plus'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 60,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .tp-news-content .tp-news-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-news-content .tp-news-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-news-content .tp-news-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_style', [
            'label' => esc_html__('Content', 'total-plus'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-news-wrap .tp-news-text',
                ]
        );

        $this->add_control(
                'content_margin', [
            'label' => esc_html__('Margin', 'total-plus'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
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

        $this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news-link' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_color_hover', [
            'label' => esc_html__('Color(Hover)', 'total-plus'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-news-wrap .tp-news-link:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'link_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .tp-news-wrap .tp-news-link',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $news_style = $settings['layout'];
        $news_class = array(
            'tp-news-wrap',
            $news_style
        );
        ?>
        <div class="<?php echo esc_attr(implode(' ', $news_class)); ?>">
            <?php
            $news_list = $settings['news_list'];

            if (!empty($news_list)) {
                foreach ($news_list as $news) {
                    $title = $news['title'];
                    $content = $news['content'];
                    $button_text = $news['button_text'];
                    $button_link = $news['button_link']['url'];
                    $target = $news['button_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $news['button_link']['nofollow'] ? ' rel="nofollow"' : '';

                    $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($news['image']['id'], 'thumb', $settings);
                    if (!$image_url) {
                        $image_url = \Elementor\Utils::get_placeholder_image_src();
                    }
                    ?>
                    <div class="tp-news">
                        <div class="tp-news-image">
                            <?php echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($news['image'])) . '" >'; ?>
                        </div>

                        <div class="tp-news-content">
                            <<?php echo $settings['title_html_tag']; ?> class="tp-news-title"><?php echo wp_kses_post($title); ?></<?php echo $settings['title_html_tag']; ?>>

                            <div class="tp-news-text">
                                <?php
                                echo wp_kses_post(wpautop($content));
                                ?>
                            </div>
                            <?php if (!empty($button_text) && !empty($button_link)) { ?>    
                                <a class="tp-news-link" href="<?php echo esc_url($button_link); ?>" <?php echo $target . $nofollow; ?>><?php echo esc_html($button_text); ?><i class="mdi mdi-arrow-right"></i></a>
                                <?php } ?>
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
