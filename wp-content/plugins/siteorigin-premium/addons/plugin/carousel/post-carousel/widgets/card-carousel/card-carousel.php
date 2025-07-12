<?php
/*
Widget Name: Post Carousel Cards
Description: Display posts in a sleek carousel with modern, elevated card layouts. Features clean typography and flexible meta display options.
Author: SiteOrigin
Author URI: https://siteorigin.com
Documentation: https://siteorigin.com/premium-documentation/plugin-addons/carousel/
Hide Activate: true
*/

if ( ! class_exists( 'SiteOrigin_Widget_PostCarousel_Widget' ) ) {
	return;
}

class SiteOrigin_Premium_Post_Carousel_Cards extends SiteOrigin_Widget_PostCarousel_Widget {

	public $carousel_instance;

	public function __construct() {
		// We use SiteOrigin_Widget directly here to prevent the
		// base Post Carousel widget from taking over.
		SiteOrigin_Widget::__construct(
			'so-premium-post-carousel-cards',
			__( 'SiteOrigin Post Carousel Cards', 'so-widgets-bundle' ),
			array(
				'description' => __( 'Display posts in a sleek carousel with modern cards and flexible meta.', 'siteorigin-premium' ),
				'instance_storage' => true,
				'help' => 'https://siteorigin.com/premium-documentation/plugin-addons/carousel/',
			),
			array(
			),
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	public function initialize() {
		parent::initialize();

		$this->carousel_instance = new SiteOrigin_Premium_Plugin_Carousel();
		add_action( 'init', array( $this, 'add_filters' ), 20, 0 );
	}

	public function add_filters() {
		add_filter( 'siteorigin_widgets_form_options_so-premium-post-carousel-cards', array( $this, 'add_form_options' ), 20, 1 );
		add_filter( 'siteorigin_widgets_less_variables_so-premium-post-carousel-cards', array( $this, 'add_theme_less_vars' ), 10, 2 );
		add_filter( 'siteorigin_widgets_template_file_so-premium-post-carousel-cards', array( $this, 'override_template_file' ), 10, 0 );

		add_filter( 'siteorigin_widgets_template_variables_so-premium-post-carousel-cards', array( $this->carousel_instance, 'post_carousel_template_vars' ), 10, 2 );
		add_filter( 'siteorigin_widgets_less_file_so-premium-post-carousel-cards', array( $this->carousel_instance, 'post_carousel_add_theme_less' ), 10, 3 );
		add_filter( 'siteorigin_widgets_less_variables_so-premium-post-carousel-cards', array( $this->carousel_instance, 'post_carousel_add_theme_less_vars' ), 10, 2 );
	}

	public function override_template_file() {
		return siteorigin_widget_get_plugin_dir_path( 'sow-post-carousel' ) . 'tpl/base.php';
	}

	// Remove anything not used by this widget.
	private function form_cleanup( $form_options ) {
		unset( $form_options['link_target'] );
		unset( $form_options['design']['fields']['thumbnail'] );
		unset( $form_options['design']['fields']['navigation']['fields']['navigation_background'] );
		unset( $form_options['design']['fields']['navigation']['fields']['navigation_hover_background'] );
		unset( $form_options['responsive']['fields']['desktop']['fields']['slides_to_show']['state_handler'] );
		unset( $form_options['responsive']['fields']['desktop']['fields']['navigation_dots']['state_handler'] );
		unset( $form_options['responsive']['fields']['tablet']['fields']['landscape']['fields']['slides_to_show']['state_handler'] );
		unset( $form_options['responsive']['fields']['tablet']['fields']['landscape']['fields']['navigation_dots']['state_handler'] );
		unset( $form_options['responsive']['fields']['tablet']['fields']['portrait']['fields']['slides_to_show']['state_handler'] );
		unset( $form_options['responsive']['fields']['tablet']['fields']['portrait']['fields']['navigation_dots']['state_handler'] );
		unset( $form_options['responsive']['fields']['mobile']['fields']['slides_to_show']['state_handler'] );
		unset( $form_options['responsive']['fields']['mobile']['fields']['navigation_dots']['state_handler'] );

		return $form_options;
	}

	public function add_form_options( $form_options ) {
		if ( empty( $form_options ) ) {
			return $form_options;
		}

		$form_options['carousel_settings']['fields'] += array(
			'featured_image' => array(
				'type' => 'checkbox',
				'label' => __( 'Featured Image', 'siteorigin-premium' ),
				'default' => true,
				'state_emitter' => array(
					'callback' => 'conditional',
					'args' => array(
						'featured_image[show]: val',
						'featured_image[hide]: ! val',
					),
				),
			),
			'content' => array(
				'type' => 'select',
				'label' => __( 'Post Content ', 'siteorigin-premium' ),
				'description' => __( 'Choose how to display your post content. Select Full Post Content if using the "more" quicktag.', 'siteorigin-premium' ),
				'default' => 'excerpt',
				'options' => array(
					'none' => __( 'None', 'siteorigin-premium' ),
					'excerpt' => __( 'Post Excerpt', 'siteorigin-premium' ),
					'full' => __( 'Full Post Content', 'siteorigin-premium' ),
				),
				'state_emitter' => array(
					'callback' => 'select',
					'args' => array( 'content_type' ),
				),
			),
			'excerpt_length' => array(
				'type' => 'number',
				'label' => __( 'Excerpt Length', 'siteorigin-premium' ),
				'default' => 55,
				'state_handler' => array(
					'content_type[excerpt]' => array( 'show' ),
					'_else[content_type]' => array( 'hide' ),
				),
			),
			'read_more' => array(
				'type' => 'checkbox',
				'label' => __( 'Post Excerpt Read More Link', 'siteorigin-premium' ),
				'description' => __( 'Display the Read More link below the post excerpt.', 'siteorigin-premium' ),
				'state_handler' => array(
					'content_type[excerpt,none]' => array( 'show' ),
					'_else[content_type]' => array( 'hide' ),
				),
				'state_emitter' => array(
					'callback' => 'conditional',
					'args' => array(
						'read_more[show]: val',
						'read_more[hide]: ! val',
					),
				),
			),
			'read_more_text' => array(
				'type' => 'text',
				'label' => __( 'Post Read More Link Text', 'siteorigin-premium' ),
				'default' => __( 'Read More', 'siteorigin-premium' ),
				'state_handler' => array(
					'read_more[show]' => array( 'show' ),
					'_else[read_more]' => array( 'hide' ),
				),
			),
			'date' => array(
				'type' => 'checkbox',
				'label' => __( 'Show Post Date', 'siteorigin-premium' ),
				'default' => true,
				'state_emitter' => array(
					'callback' => 'conditional',
					'args' => array(
						'date[show]: val',
						'date[hide]: ! val',
					),
				),
			),
			'date_format' => array(
				'type' => 'select',
				'label' => __( 'Post Date Format', 'siteorigin-premium' ),
				'state_handler' => array(
					'date[show]' => array( 'show' ),
					'_else[date]' => array( 'hide' ),
				),
				'options' => array(
					'' => sprintf( __( 'Default (%s)', 'siteorigin-premium' ), date( get_option( 'date_format' ) ) ),
					'Y-m-d' => sprintf( __( 'yyyy-mm-dd (%s)', 'siteorigin-premium' ), date( 'Y/m/d' ) ),
					'm/d/Y' => sprintf( __( 'mm/dd/yyyy (%s)', 'siteorigin-premium' ), date( 'm/d/Y' ) ),
					'd/m/Y' => sprintf( __( 'dd/mm/yyyy (%s)', 'siteorigin-premium' ), date( 'd/m/Y' ) ),
				),
			),
			'categories' => array(
				'type' => 'checkbox',
				'label' => __( 'Show Post Categories', 'siteorigin-premium' ),
				'default' => true,
			),
			'link_overlay' => array(
				'type' => 'checkbox',
				'label' => __( 'Add Link Overlay', 'siteorigin-premium' ),
				'default' => false,
				'state_emitter' => array(
					'callback' => 'conditional',
					'args' => array(
						'link_overlay[show]: val',
						'link_overlay[hide]: ! val',
					),
				),
			),
			'link_target' => array(
				'type' => 'checkbox',
				'label' => __( 'Open Link in New Window', 'siteorigin-premium' ),
				'default' => false,
				'state_handler' => array(
					'link_overlay[show]' => array( 'show' ),
					'_else[link_overlay]' => array( 'hide' ),
				),
			),
		);

		$design_fields = $form_options['design']['fields'];

		siteorigin_widgets_array_insert( $design_fields, 'post_title', array(
			'container' => array(
				'type' => 'section',
				'label' => __( 'Container', 'siteorigin-premium' ),
				'hide' => true,
				'fields' => array(
					'background_color' => array(
						'type' => 'color',
						'label' => __( 'Background', 'siteorigin-premium' ),
						'default' => '#fff',
					),
					'border_radius' => array(
						'type' => 'measurement',
						'label' => __( 'Border Radius', 'siteorigin-premium' ),
						'default' => '8px',
					),
					'shadow_color' => array(
						'type' => 'color',
						'label' => __( 'Drop Shadow Color', 'siteorigin-premium' ),
						'default' => 'rgba(0,0,0,0.08)',
						'alpha' => true,
					),
					'shadow_offset_horizontal' => array(
						'type' => 'measurement',
						'label' => __( 'Drop Shadow Horizontal Offset', 'siteorigin-premium' ),
						'default' => 0,
					),
					'shadow_offset_vertical' => array(
						'type' => 'measurement',
						'label' => __( 'Drop Shadow Vertical Offset', 'siteorigin-premium' ),
						'default' => '4px',
					),
					'shadow_blur' => array(
						'type' => 'measurement',
						'label' => __( 'Drop Shadow Blur', 'siteorigin-premium' ),
						'default' => '8px',
					),
					'shadow_spread' => array(
						'type' => 'measurement',
						'label' => __( 'Drop Shadow Spread', 'siteorigin-premium' ),
						'default' => 0,
					),
				),
			),
			'content_container' => array(
				'type' => 'section',
				'label' => __( 'Content Container', 'siteorigin-premium' ),
				'hide' => true,
				'fields' => array(
					'padding' => array(
						'type' => 'multi-measurement',
						'label' => __( 'Padding', 'siteorigin-premium' ),
						'default' => '24px 24px 32px 24px',
						'measurements' => array(
							'top' => __( 'Top', 'siteorigin-premium' ),
							'right' => __( 'Right', 'siteorigin-premium' ),
							'bottom' => __( 'Bottom', 'siteorigin-premium' ),
							'left' => __( 'Left', 'siteorigin-premium' ),
						),
					),
				),
			),
		) );

		siteorigin_widgets_array_insert( $design_fields, 'navigation', array(
			'post_meta' => array(
				'type' => 'section',
				'label' => __( 'Post Meta', 'siteorigin-premium' ),
				'hide' => true,
				'fields' => array(
					'display' => array(
						'type' => 'radio',
						'default' => 'below_title',
						'options' => array(
							'below_title' => __( 'Below Title', 'siteorigin-premium' ),
							'thumbnail' => __( 'On Featured Image Hover', 'siteorigin-premium' ),
						),
						'state_emitter' => array(
							'callback' => 'select',
							'args' => array( 'meta' ),
						),
					),
					'bottom_margin' => array(
						'type' => 'measurement',
						'label' => __( 'Bottom Margin', 'siteorigin-premium' ),
						'default' => '20px',
						'state_handler' => array(
							'meta[below_title]' => array( 'show' ),
							'_else[meta]' => array( 'hide' ),
						),
					),
					'thumbnail' => array(
						'type' => 'section',
						'label' => __( 'Featured Image', 'siteorigin-premium' ),
						'hide' => true,
						'fields' => array(
							'overlay_color' => array(
								'type' => 'color',
								'label' => __( 'Overlay Color', 'siteorigin-premium' ),
								'default' => 'rgba(45,45,45,0.8)',
								'alpha' => true,
							),
						),
						'state_handler' => array(
							'meta[thumbnail]' => array( 'show' ),
							'_else[meta]' => array( 'hide' ),
						),
					),
					'date' => array(
						'type' => 'section',
						'label' => __( 'Date', 'siteorigin-premium' ),
						'hide' => true,
						'fields' => array(
							'size' => array(
								'type' => 'measurement',
								'label' => __( 'Font Size', 'siteorigin-premium' ),
								'default' => '14px',
								'state_handler' => array(
									'meta[below_title]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
							'size_thumbnail' => array(
								'type' => 'measurement',
								'label' => __( 'Font Size', 'siteorigin-premium' ),
								'default' => '14px',
								'state_handler' => array(
									'meta[thumbnail]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),

							'font' => array(
								'type' => 'font',
								'label' => __( 'Font', 'siteorigin-premium' ),
								'default' => 'Open Sans',
							),

							'color' => array(
								'type' => 'color',
								'label' => __( 'Color', 'siteorigin-premium' ),
								'alpha' => true,
								'default' => '#929292',
								'state_handler' => array(
									'meta[below_title]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
							'color_thumbnail' => array(
								'type' => 'color',
								'label' => __( 'Color', 'siteorigin-premium' ),
								'alpha' => true,
								'default' => '#fff',
								'state_handler' => array(
									'meta[thumbnail]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
						),
					),
					'categories' => array(
						'type' => 'section',
						'label' => __( 'Post Categories', 'siteorigin-premium' ),
						'hide' => true,
						'fields' => array(
							'size' => array(
								'type' => 'measurement',
								'label' => __( 'Font Size', 'siteorigin-premium' ),
								'default' => '13px',
								'state_handler' => array(
									'meta[below_title]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
							'size_thumbnail' => array(
								'type' => 'measurement',
								'label' => __( 'Font Size', 'siteorigin-premium' ),
								'default' => '14px',
								'state_handler' => array(
									'meta[thumbnail]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),

							'font' => array(
								'type' => 'font',
								'label' => __( 'Font', 'siteorigin-premium' ),
								'default' => 'Open Sans',
							),

							'color' => array(
								'type' => 'color',
								'label' => __( 'Color', 'siteorigin-premium' ),
								'default' => '#2d2d2d',
								'state_handler' => array(
									'meta[below_title]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
							'color_thumbnail' => array(
								'type' => 'color',
								'label' => __( 'Color', 'siteorigin-premium' ),
								'default' => '#fff',
								'state_handler' => array(
									'meta[thumbnail]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),

							'color_hover' => array(
								'type' => 'color',
								'label' => __( 'Color Hover', 'siteorigin-premium' ),
								'alpha' => true,
								'default' => '#f14e4e',
								'state_handler' => array(
									'meta[below_title]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
							'color_hover_thumbnail' => array(
								'type' => 'color',
								'label' => __( 'Color Hover', 'siteorigin-premium' ),
								'alpha' => true,
								'default' => '#f14e4e',
								'state_handler' => array(
									'meta[thumbnail]' => array( 'show' ),
									'_else[meta]' => array( 'hide' ),
								),
							),
						),
					),
				),
			),
			'post_content' => array(
				'type' => 'section',
				'label' => __( 'Post Content', 'siteorigin-premium' ),
				'hide' => true,
				'fields' => array(
					'font' => array(
						'type' => 'font',
						'label' => __( 'Font', 'siteorigin-premium' ),
						'default' => 'Open Sans',
					),
					'size' => array(
						'type' => 'measurement',
						'label' => __( 'Font Size', 'siteorigin-premium' ),
						'default' => '14px',
					),
					'color' => array(
						'type' => 'color',
						'label' => __( 'Color', 'siteorigin-premium' ),
						'default' => '#626262',
					),
					'read_more' => array(
						'type' => 'section',
						'label' => __( 'Read More', 'siteorigin-premium' ),
						'hide' => true,
						'fields' => array(
							'color' => array(
								'type' => 'color',
								'label' => __( 'Color', 'siteorigin-premium' ),
								'default' => '#f14e4e',
								),
							'color_hover' => array(
								'type' => 'color',
								'label' => __( 'Color Hover', 'siteorigin-premium' ),
								'default' => '#626262',
							),
						),
					),
				),
			),
		) );

		// Additional Design > Navigation Settings.
		siteorigin_widgets_array_insert(
			$design_fields['navigation']['fields'],
			'navigation_background',
			array(
				'dots_color' => array(
					'type' => 'color',
					'label' => __( 'Dots Color', 'siteorigin-premium' ),
					'default' => '#bebebe',
				),
				'dots_color_hover' => array(
					'type' => 'color',
					'label' => __( 'Dots Selected and Hover Color', 'siteorigin-premium' ),
					'default' => '#f14e4e',
				),
				'nav_top_margin' => array(
					'type' => 'measurement',
					'label' => __( 'Dots Top Margin', 'siteorigin-premium' ),
					'default' => '40px',
				),
			)
		);

		$design_fields['item_title']['fields']['color_hover'] = array(
			'type' => 'color',
			'label' => __( 'Title Hover Color', 'siteorigin-premium' ),
			'default' => '#626262',
		);

		// Alter defaults.
		$design_fields['item_title']['fields']['color']['default'] = '#2d2d2d';
		$design_fields['item_title']['fields']['size']['default'] = '18px';
		$design_fields['item_title']['fields']['font']['default'] = 'Montserrat:600';

		$design_fields['navigation']['fields']['navigation_color']['default'] = '#2d2d2d';
		$design_fields['navigation']['fields']['navigation_color_hover']['default'] = '#626262';

		$form_options['design']['fields'] = $design_fields;

		return $this->form_cleanup( $form_options );
	}

	public function get_template_variables( $instance, $args ) {
		$template_vars = parent::get_template_variables( $instance, $args );

		$template_vars['settings']['theme'] = 'cards';

		$template_vars['settings']['navigation'] = 'full';

		$template_vars['settings']['featured_image'] = ! empty( $instance['carousel_settings']['featured_image'] );
		$template_vars['settings']['featured_image_size'] = empty( $instance['settings']['featured_image_size'] ) ? 'full' : $instance['settings']['featured_image_size'];
		$template_vars['settings']['content'] = empty( $instance['carousel_settings']['content'] ) ? 'full' : $instance['carousel_settings']['content'];
		$template_vars['settings']['excerpt_length'] = empty( $instance['carousel_settings']['excerpt_length'] ) ? 55 : $instance['carousel_settings']['excerpt_length'];
		$template_vars['settings']['read_more'] = ! empty( $instance['carousel_settings']['read_more'] );
		$template_vars['settings']['read_more_text'] = ! empty( $instance['carousel_settings']['read_more_text'] ) ? $instance['carousel_settings']['read_more_text'] : __( 'Read More', 'siteorigin-premium' );
		$template_vars['settings']['date'] = ! empty( $instance['carousel_settings']['date'] );
		$template_vars['settings']['date_format'] = empty( $instance['carousel_settings']['date_format'] ) ? get_option( 'date_format' ) : $instance['carousel_settings']['date_format'];
		$template_vars['settings']['categories'] = ! empty( $instance['carousel_settings']['categories'] );

		$template_vars['settings']['link_overlay'] = ! empty( $instance['carousel_settings']['link_overlay'] );
		$template_vars['settings']['link_target'] = ! empty( $instance['carousel_settings']['link_target'] );

		$template_vars['settings']['post_meta_placement'] = $instance['design']['post_meta']['display'];

		// Add class to carousel container if arrows are enabled.
		if ( ! empty( $instance['carousel_settings']['arrows'] ) ) {
			if (
				empty( $template_vars['settings']['container_classes'] ) ||
				! is_array( $template_vars['settings']['container_classes'] )
			) {
				$template_vars['settings']['container_classes'] = array();
			}
			$template_vars['settings']['container_classes'][] = 'sow-carousel-card-arrows';
		}

		return $template_vars;
	}

	/**
	 * Modify the instance to reference the theme name.
	 *
	 * This method extends the parent `modify_instance` method to add a 'theme' key
	 * to the 'design' array within the instance. This allows for the widget to
	 * pass the `is_non_default_theme` check in the Carousel addon.
	 *
	 * @param array $instance The instance settings.
	 *
	 * @return array The modified instance settings.
	 */
	public function modify_instance( $instance ) {
		$instance = parent::modify_instance( $instance );

		// Is this a valid instance?
		if ( ! empty( $instance ) ) {
			// Ensure we have default values. This check is required due to a
			// delay that can occurs when adding a new instance.
			if (
				empty( $instance['design'] ) ||
				empty( $instance['design']['container'] )
			) {
				$instance = $this->add_defaults(
					$this->form_options(),
					$instance
				);
			}

			$instance['design']['theme'] = 'cards';
		}

		return $instance;
	}

	public function add_theme_less_vars( $less_vars, $instance ) {
		if (
			empty( $instance ) ||
			empty( $instance['design'] ) ||
			empty( $instance['design']['container'] )
		) {
			return $less_vars;
		}

		// Navigation Dots.
    	$less_vars['dots'] = ! empty( $instance['carousel_settings']['dots'] ) ? 1 : 0;

		// Card: Container.
		$less_vars['card_background_color'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'background_color',
			'#fff'
		);

		$less_vars['card_border_radius'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'border_radius',
			'8px'
		);

		$shadow_color = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'shadow_color',
			'rgba(0,0,0,0.08)'
		);

		$shadow_offset_horizontal = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'shadow_offset_horizontal',
			'0px'
		);

		$shadow_offset_vertical = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'shadow_offset_vertical',
			'4px'
		);

		$shadow_blur = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'shadow_blur',
			'8px'
		);

		$shadow_spread = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['container'],
			'shadow_spread',
			'0px'
		);

		$less_vars['card_shadow'] = "$shadow_offset_horizontal $shadow_offset_vertical $shadow_blur $shadow_spread $shadow_color";

		$less_vars['card_shadow_vertical_space'] = $shadow_offset_vertical;

		$less_vars['card_shadow_blur'] = $shadow_blur;

		$less_vars['card_shadow_spread'] = $shadow_spread;

		$less_vars['card_shadow_offset'] = (int) apply_filters( 'siteorigin_premium_carousel_card_item_gap', 12 ) . 'px';

		$less_vars['card_content_container_padding'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['content_container'],
			'padding',
			'24px 24px 32px 24px'
		);

		// Card: Post Meta.
		$less_vars['card_post_meta_display'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['post_meta'],
			'display',
			'below_title'
		);

		if ( $less_vars['card_post_meta_display'] === 'thumbnail' ) {
			$less_vars['card_post_meta_category_color'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['categories'],
				'color_thumbnail',
				'#fff'
			);

			$less_vars['card_post_meta_category_color_hover'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['categories'],
				'color_hover_thumbnail',
				'#f14e4e'
			);

			$less_vars['card_post_meta_category_size'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['categories'],
				'size_thumbnail',
				'12px'
			);

			$less_vars['card_post_meta_date_color'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['date'],
				'color_thumbnail',
				'#2d2d2d'
			);

			$less_vars['card_post_meta_date_size'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['date'],
				'size_thumbnail',
				'12px'
			);

			$less_vars['thumbnail_overlay_color'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['thumbnail'],
				'overlay_color',
				'rgba(45,45,45,0.8)'
			);

		} else {
			$less_vars['card_post_meta_bottom_margin'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta'],
				'bottom_margin',
				'0'
			);

			$less_vars['card_post_meta_category_color'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['categories'],
				'color',
				'#2d2d2d'
			);

			$less_vars['card_post_meta_category_color_hover'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['categories'],
				'color_hover',
				'#f14e4e'
			);

			$less_vars['card_post_meta_category_size'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['categories'],
				'size',
				'13px'
			);

			$less_vars['card_post_meta_date_color'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['date'],
				'color',
				'#2d2d2d'
			);

			$less_vars['card_post_meta_date_size'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['post_meta']['date'],
				'size',
				'13px'
			);
		}

		if ( ! empty( $instance['design']['post_meta']['category']['font'] ) ) {
			$font = siteorigin_widget_get_font( $instance['design']['post_meta']['category']['font'] );
			$less_vars['card_post_meta_category_font'] = $font['family'];

			if ( ! empty( $font['weight'] ) ) {
				$less_vars['card_post_meta_category_font_style'] = $font['style'];
				$less_vars['card_post_meta_category_font_weight'] = $font['weight_raw'];
			}
		}

		if ( ! empty( $instance['design']['post_meta']['date']['font'] ) ) {
			$font = siteorigin_widget_get_font( $instance['design']['post_meta']['date']['font'] );
			$less_vars['card_post_meta_date_font'] = $font['family'];

			if ( ! empty( $font['weight'] ) ) {
				$less_vars['card_post_meta_date_font_style'] = $font['style'];
				$less_vars['card_post_meta_date_font_weight'] = $font['weight_raw'];
			}
		}

		// Card: Post Content.
		if ( ! empty( $instance['design']['post_content']['font'] ) ) {
			$font = siteorigin_widget_get_font( $instance['design']['post_content']['font'] );
			$less_vars['card_post_content_font'] = $font['family'];

			if ( ! empty( $font['weight'] ) ) {
				$less_vars['card_post_content_font_style'] = $font['style'];
				$less_vars['card_post_content_font_weight'] = $font['weight_raw'];
			}
		}

		$less_vars['card_post_content_size'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['post_content'],
			'size',
			'14px'
		);

		$less_vars['card_post_content_color'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['post_content'],
			'color',
			'#626262'
		);

		// Card: Read More.
		$less_vars['card_read_more_color'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['post_content']['read_more'],
			'color',
			'#f14e4e'
		);

		$less_vars['card_read_more_color_hover'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['post_content']['read_more'],
			'color_hover',
			'#fff'
		);

		$less_vars['card_post_meta_date_bottom_margin'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['post_meta']['date'],
			'bottom_margin',
			'0'
		);

		$less_vars['item_title_color_hover'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['item_title'],
			'color_hover',
			'#626262'
		);

		return $less_vars;
	}
}
siteorigin_widget_register( 'so-premium-post-carousel-cards', __FILE__, 'SiteOrigin_Premium_Post_Carousel_Cards' );
