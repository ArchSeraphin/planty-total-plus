<?php
/*
Plugin Name: SiteOrigin Carousel
Description: Introduce overlay themes, customizable navigation, and Layout Builder integration to carousels, enriching visuals and user interaction.
Version: 1.0.0
Author: SiteOrigin
Author URI: https://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Documentation: https://siteorigin.com/premium-documentation/plugin-addons/carousel
Tags: Widgets Bundle
Video:
Requires: so-widgets-bundle
*/

class SiteOrigin_Premium_Plugin_Carousel {

	public function __construct() {
		if ( ! class_exists( 'SiteOrigin_Widgets_Bundle' ) ) {
			return;
		}

		add_action( 'init', array( $this, 'add_filters' ) );
		add_action( 'wp_loaded', array( $this, 'post_carousel_register_image_sizes' ) );

		add_action( 'siteorigin_widgets_post_carousel_theme_assets', array( $this, 'register_template_assets' ) );
		add_filter( 'siteorigin_widgets_widget_folders', array( $this, 'add_carousel_widgets' ) );
		add_action( 'after_setup_theme', array( $this, 'activate_post_carousel_widgets' ), 12, 0 );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	public function add_filters() {
		if ( class_exists( 'SiteOrigin_Widget_Anything_Carousel_Widget' ) ) {
			add_filter( 'siteorigin_panels_general_style_fields', array( $this, 'style_fields' ), 10, 3 );
			add_filter( 'siteorigin_panels_general_current_styles', array( $this, 'style_migration' ), 10, 4 );

			add_filter( 'siteorigin_widgets_form_options_sow-anything-carousel', array( $this, 'anything_carousel_form_options' ), 10, 2 );
			add_filter( 'siteorigin_widgets_anything_carousel_render_item_content', array( $this, 'anything_carousel_render_item_content' ), 10, 3 );

			add_action( 'siteorigin_premium_version_update', array( $this, 'update_settings_migration' ), 20, 2 );
		}

		// We always add post carousel filters due to two
		// post carousel widgets always being activate.
		add_filter( 'siteorigin_widgets_form_options_sow-post-carousel', array( $this, 'post_carousel_form_options' ), 10, 2 );
		add_filter( 'siteorigin_widgets_post_carousel_settings_form', array( $this, 'post_carousel_settings_form' ) );
		add_filter( 'siteorigin_widgets_post_carousel_settings_frontend', array( $this, 'post_carousel_settings_frontend' ), 10, 2 );
		add_filter( 'siteorigin_post_carousel_ajax_item_template', array( $this, 'post_carousel_ajax_item_template' ), 10, 2 );
		add_filter( 'siteorigin_widgets_template_variables_sow-post-carousel', array( $this, 'post_carousel_template_vars' ), 10, 2 );

		add_filter( 'siteorigin_widgets_less_file_sow-post-carousel', array( $this, 'post_carousel_add_theme_less' ), 10, 3 );
		add_filter( 'siteorigin_widgets_less_variables_sow-post-carousel', array( $this, 'post_carousel_add_theme_less_vars' ), 10, 2 );
	}

	public function add_carousel_widgets( $folders ) {
		$folders[] = plugin_dir_path( __FILE__ ) . 'post-carousel/widgets/';
		return $folders;
	}

	/**
	 * Activate all post carousel widgets if they are not already active.
	 *
	 * This method checks if the specified widgets are active in the SiteOrigin Widgets Bundle. If any of the widgets are not active, it activates them.
	 */
	public function activate_post_carousel_widgets() {
		$so_widgets_bundle = SiteOrigin_Widgets_Bundle::single();
		$active_widgets = $so_widgets_bundle->get_active_widgets();

		$widgets = array(
			'post-carousel',
			'card-carousel',
		);

		foreach ( $widgets as $widget ) {
			if ( empty( $active_widgets[ $widget ] ) ) {
				$so_widgets_bundle->activate_widget( $widget );
			}
		}
	}

	public function update_settings_migration( $new_version, $old_version ) {
		$addons = SiteOrigin_Premium::single()->get_active_addons();

		// If upgrading from version <= 1.32.1, activate the Anchor ID addon.
		if ( version_compare( $old_version, '1.32.1', '<=' ) && ! empty( $addons['plugin/anchor-id'] ) ) {
			SiteOrigin_Premium::single()->set_addon_active( 'plugin/anchor-id', true );
		}
	}

	public function style_fields( $fields, $post_id, $args ) {
		// To prevent display issues, we need to remove Row Layout options.
		if (
			! empty( $args ) &&
			! empty( $args['builderType'] ) &&
			$args['builderType'] === 'anything_carousel_panel_builder' &&
			isset( $fields['row_stretch'] )
		) {
			unset( $fields['row_stretch'] );
		}

		return $fields;
	}

	public function style_migration( $styles, $post_id, $instance, $args ) {
		// Reset Row Layout.
		if (
			! empty( $args ) &&
			! empty( $args['builderType'] ) &&
			$args['builderType'] === 'anything_carousel_panel_builder' &&
			! empty( $styles['row_stretch'] )
		) {
			$styles['row_stretch'] = '';
		}

		return $styles;
	}

	public function anything_carousel_form_options( $form_options, $widget ) {
		if ( empty( $form_options ) ) {
			return $form_options;
		}

		// Builder field.
		$items_fields = $form_options['items']['fields'];

		if ( array_key_exists( 'content_text', $items_fields ) ) {
			$position = 'content_text';
			$items_fields['content_text']['state_handler'] = array(
				'content_type_{$repeater}[text]' => array( 'show' ),
				'_else[content_type_{$repeater}]' => array( 'hide' ),
			);
		} else {
			$position = count( $items_fields );
		}

		// The Builder field currently only works in some contexts so we only output it in those contexts for now.
		if ( is_admin() ||
			( defined( 'REST_REQUEST' ) && function_exists( 'register_block_type' ) ) ||
			! empty( $GLOBALS['SITEORIGIN_WIDGET_BLOCK_RENDER'] )
		) {
			$add_fields = array(
				'content_type' => array(
					'type' => 'radio',
					'label' => __( 'Content Type', 'siteorigin-premium' ),
					'options' => array(
						'text' => __( 'Text', 'siteorigin-premium' ),
						'layout' => __( 'Layout builder', 'siteorigin-premium' ),
					),
					'default' => 'text',
					'state_emitter' => array(
						'callback' => 'select',
						'args' => array( 'content_type_{$repeater}' ),
					),
				),
				'content_layout' => array(
					'type' => 'builder',
					'label' => __( 'Content', 'siteorigin-premium' ),
					'builder_type' => 'anything_carousel_panel_builder',
					'state_handler' => array(
						'content_type_{$repeater}[layout]' => array( 'show' ),
						'_else[content_type_{$repeater}]' => array( 'hide' ),
					),
				),
			);

			siteorigin_widgets_array_insert( $items_fields, $position, $add_fields );
			$form_options['items']['fields'] = $items_fields;
		}

		return $form_options;
	}

	public function anything_carousel_render_item_content( $content, $item, $instance ) {
		if ( ! empty( $item['content_type'] ) && $item['content_type'] === 'layout' ) {
			if ( function_exists( 'siteorigin_panels_render' ) ) {
				$content_builder_id = substr( md5( json_encode( $item['content_layout'] ) ), 0, 8 );

				// Remove non-standard row layouts as they're not compatible.
				if ( ! empty( $item['content_layout']['grids'] ) ) {
					foreach ( $item['content_layout']['grids'] as $grid_id => $grid ) {
						if ( empty( $grid['style' ] ) ) {
							continue;
						}

						if ( isset( $grid['style']['row_stretch'] ) ) {
							unset( $item['content_layout']['grids'][ $grid_id ]['style']['row_stretch'] );
						}
					}
				}

				$content = siteorigin_panels_render( 'w' . $content_builder_id, true, $item['content_layout'] );
			} else {
				$content = __( 'This field requires Page Builder.', 'siteorigin-premium' );
			}
		}

		return $content;
	}

	public function post_carousel_form_options( $form_options, $widget ) {
		if ( empty( $form_options ) ) {
			return $form_options;
		}

		// Add themes preset field.
		$themes = json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'post-carousel/data/themes.json' ), true );

		// Inject base slides_to_scroll value.
		$themes['base']['values']['responsive']['desktop']['slides_to_scroll'] = $form_options['responsive']['fields']['desktop']['fields']['slides_to_scroll']['placeholder'];

		siteorigin_widgets_array_insert( $form_options['design']['fields'], 'thumbnail', array(
			'theme' => array(
				'type' => 'presets',
				'label' => __( 'Theme', 'siteorigin-premium' ),
				'default_preset' => 'base',
				'description' => __( 'Please, allow a couple of seconds for the theme settings to be applied.', 'siteorigin-premium' ),
				'options' => $themes,
				'state_emitter' => array(
					'callback' => 'select',
					'args' => array( 'selected_theme' ),
				),
			),
		) );

		// Hide the Thumbnail Overlay Hover Color & Opacity setting for the overlay theme.
		$form_options['design']['fields']['thumbnail']['fields']['thumbnail_overlay_hover_color']['state_handler'] = array(
			'selected_theme[overlay]' => array( 'hide' ),
			'_else[selected_theme]' => array( 'show' ),
		);
		$form_options['design']['fields']['thumbnail']['fields']['thumbnail_overlay_hover_opacity']['state_handler'] = array(
			'selected_theme[overlay]' => array( 'hide' ),
			'_else[selected_theme]' => array( 'show' ),
		);

		// Move Post Title section above Post Content section.
		$post_title_settings = $form_options['design']['fields']['item_title'];
		siteorigin_widgets_array_insert(
			$form_options['design']['fields'],
			'thumbnail',
			array(
				'item_title' => $post_title_settings,
			)
		);

		// Add additional settings to Design > Post Thumbnail section.
		// Overlay.
		$form_options['design']['fields']['thumbnail']['fields']['thumbnail_overlay_color'] = array(
			'type' => 'color',
			'label' => __( 'Thumbnail Overlay Color', 'siteorigin-premium' ),
			'default' => '#000',
			'alpha' => true,
			'state_handler' => array(
				'selected_theme[overlay]' => array( 'show' ),
				'_else[selected_theme]' => array( 'hide' ),
			),
		);

		$form_options['design']['fields']['thumbnail']['fields']['border_radius'] = array(
			'type' => 'slider',
			'label' => __( 'Border Radius', 'siteorigin-premium' ),
			'default' => '6',
			'min' => 0,
			'max' => 100,
			'state_handler' => array(
				'selected_theme[overlay]' => array( 'show' ),
				'_else[selected_theme]' => array( 'hide' ),
			),
		);


		// Hide the Responsive Slides to Show setting for non-overlay themes.
		$slides_to_show_state_handler = array(
			'selected_theme[overlay]' => array( 'show' ),
			'_else[selected_theme]' => array( 'hide' ),
		);

		$form_options['responsive']['fields']['desktop']['fields']['slides_to_show']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['desktop']['fields']['navigation_dots']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['tablet']['fields']['landscape']['fields']['slides_to_show']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['tablet']['fields']['landscape']['fields']['navigation_dots']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['tablet']['fields']['portrait']['fields']['slides_to_show']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['tablet']['fields']['portrait']['fields']['navigation_dots']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['mobile']['fields']['slides_to_show']['state_handler'] = $slides_to_show_state_handler;
		$form_options['responsive']['fields']['mobile']['fields']['navigation_dots']['state_handler'] = $slides_to_show_state_handler;

		// Add Design > Category section.
		siteorigin_widgets_array_insert(
			$form_options['design']['fields'],
			'navigation',
			array(
				'category' => array(
					'type' => 'section',
					'label' => __( 'Category', 'siteorigin-premium' ),
					'hide' => true,
					'fields' => array(
						'color' => array(
							'type' => 'color',
							'label' => __( 'Color', 'siteorigin-premium' ),
						),
						'size' => array(
							'type' => 'measurement',
							'label' => __( 'Font Size', 'siteorigin-premium' ),
							'default' => '13px',
						),
						'background_color' => array(
							'type' => 'color',
							'label' => __( 'Background Color', 'siteorigin-premium' ),
							'default' => '#ffffff',
						),
					),
				),
			)
		);

		// Additional Design > Navigation section.
		siteorigin_widgets_array_insert(
			$form_options['design']['fields']['navigation']['fields'],
			'navigation_background',
			array(
				'dots_color' => array(
					'type' => 'color',
					'label' => __( 'Dots Color', 'siteorigin-premium' ),
					'default' => '#bebebe',
					'state_handler' => array(
						'selected_theme[base]' => array( 'hide' ),
						'_else[selected_theme]' => array( 'show' ),
					),
				),
				'dots_color_hover' => array(
					'type' => 'color',
					'label' => __( 'Dots Selected and Hover Color', 'siteorigin-premium' ),
					'default' => '#f14e4e',
					'state_handler' => array(
						'selected_theme[base]' => array( 'hide' ),
						'_else[selected_theme]' => array( 'show' ),
					),
				),
				'nav_top_margin' => array(
					'type' => 'measurement',
					'label' => __( 'Navigation Top Margin', 'siteorigin-premium' ),
					'description' => __( 'The space between the posts and navigation elements.', 'siteorigin-premium' ),
					'default' => '38px',
					'state_handler' => array(
						'selected_theme[base]' => array( 'hide' ),
						'_else[selected_theme]' => array( 'show' ),
					),
				),
			)
		);

		return $widget->dynamic_preset_state_handler(
			'selected_theme',
			$themes,
			$form_options,
			true
		);
	}

	private static function is_non_default_theme( $instance ) {
		return ! empty( $instance ) &&
			isset( $instance['design'] ) &&
			! empty( $instance['design']['theme'] ) &&
			$instance['design']['theme'] != 'base';
	}

	/**
	 * This change allows for the Slides to Show Responsive settings to show when the Overlay theme is active.
	 */
	public function post_carousel_settings_form( $settings ) {
		unset( $settings['slides_to_show'] );
		unset( $settings['navigation_dots_label'] );

		return $settings;
	}

	public function post_carousel_settings_frontend( $settings, $instance ) {
		if (
			! self::is_non_default_theme( $instance ) ||
			! file_exists( plugin_dir_path( __FILE__ ) . 'post-carousel/templates/' . $instance['design']['theme'] . '.php' )
		) {
			unset( $settings['dots'] );
		} else {
			$settings['theme'] = $instance['design']['theme'];
			$settings['appendDots'] = 'true';
		}

		return $settings;
	}

	public function register_template_assets() {
		wp_register_style(
			'sow-post-carousel-overlay',
			plugin_dir_url( __FILE__ ) . 'post-carousel/css/overlay.css',
			array(),
			SITEORIGIN_PREMIUM_VERSION
		);

		wp_register_style(
			'sow-post-carousel-cards',
			plugin_dir_url( __FILE__ ) . 'post-carousel/css/cards.css',
			array(),
			SITEORIGIN_PREMIUM_VERSION
		);

		if ( SiteOrigin_Premium_Utility::single()->is_block_editor() ) {
			wp_enqueue_style( 'sow-post-carousel-overlay' );
			wp_enqueue_style( 'sow-post-carousel-cards' );
		}
	}

	public function post_carousel_register_image_sizes() {
		add_image_size( 'sow-post-carousel-overlay-theme', 360, 476, true );
		add_image_size( 'sow-post-carousel-cards-theme', 360, 240, true );
	}

	public function post_carousel_ajax_item_template( $template, $instance ) {
		if (
			self::is_non_default_theme( $instance ) &&
			file_exists( plugin_dir_path( __FILE__ ) . 'post-carousel/templates/' . $instance['design']['theme'] . '.php' )
		) {
			$template = plugin_dir_path( __FILE__ ) . 'post-carousel/templates/' . $instance['design']['theme'] . '.php';
		}

		return $template;
	}

	public function post_carousel_template_vars( $template_vars, $instance ) {
		if (
			! self::is_non_default_theme( $instance ) ||
			! file_exists( plugin_dir_path( __FILE__ ) . 'post-carousel/templates/' . $instance['design']['theme'] . '.php' )
		) {
			return $template_vars;
		}

		$valid_themes = array(
			'overlay',
			'cards',
		);

		// Is a valid theme set? If not, bail.
		if ( ! in_array( $instance['design']['theme'], $valid_themes ) ) {
			return;
		}

		wp_enqueue_style( 'sow-post-carousel-' . $instance['design']['theme'] );

		$template_vars['settings']['item_template'] = plugin_dir_path( __FILE__ ) . 'post-carousel/templates/' . basename( $instance['design']['theme'] ) . '.php';

		$size = siteorigin_widgets_get_image_size( $instance['image_size'] );

		if ( ! ( empty( $size['width'] ) || empty( $size['height'] ) ) ) {
			$template_vars['settings']['height'] = $size['height'] . 'px';
		}

		unset( $template_vars['settings']['attributes']['variable_width'] );


		if ( $instance['design']['theme'] === 'cards' ) {
			$template_vars['settings']['navigation'] = 'full';
		} else {
			$template_vars['settings']['navigation'] = 'container';
		}

		return $template_vars;
	}

	public function post_carousel_add_theme_less( $less_file, $instance, $widget ) {
		if ( self::is_non_default_theme( $instance ) ) {
			$less_file = plugin_dir_path( __FILE__ ) . 'post-carousel/less/' . $instance['design']['theme'] . '.less';
		}

		return $less_file;
	}

	public function post_carousel_add_theme_less_vars( $less_vars, $instance ) {
		if ( ! self::is_non_default_theme( $instance ) ) {
			return $less_vars;
		}

		if ( $instance['design']['theme'] === 'overlay' ) {
			// Post Thumbnail.
			$less_vars['thumbnail_overlay_color'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['thumbnail'],
				'thumbnail_overlay_color'
			);

			$less_vars['thumbnail_border_radius'] = SiteOrigin_Premium_Utility::less_var(
				$instance['design']['thumbnail'],
				'border_radius'
			) . 'px';

			// Category.
			if ( ! empty( $instance['design']['category'] ) ) {
				$less_vars['category_color'] = SiteOrigin_Premium_Utility::less_var(
					$instance['design']['category'],
					'color',
					'#2d2d2d'
				);

				$less_vars['category_size'] = SiteOrigin_Premium_Utility::less_var(
					$instance['design']['category'],
					'size',
					'12px'
				);

				$less_vars['category_background'] = SiteOrigin_Premium_Utility::less_var(
					$instance['design']['category'],
					'background_color',
					'#fff'
				);
			}
		}

		// Navigation.
		$less_vars['navigation_arrow_margin'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['navigation'],
			'arrow_margin'
		);

		$less_vars['navigation_dots_color'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['navigation'],
			'dots_color',
			'#bebebe'
		);

		$less_vars['navigation_dots_color_hover'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['navigation'],
			'dots_color_hover',
			'#f14e4e'
		);

		$less_vars['navigation_dots_top_margin'] = SiteOrigin_Premium_Utility::less_var(
			$instance['design']['navigation'],
			'nav_top_margin',
			'40px'
		);

		$less_vars['navigation_arrows'] = isset( $instance['carousel_settings']['arrows'] ) ? $instance['carousel_settings']['arrows'] : 1;

		return $less_vars;
	}
	public static function post_featured_image( $settings ) {
		if ( ! $settings['featured_image'] ) {
			return;
		}

		if ( ! has_post_thumbnail() ) {
			if ( empty( $settings['default_thumbnail'] ) ) {
				return;
			}

			$image = '<img src="' . esc_url( $settings['default_thumbnail'] ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
		} else {
			$image = wp_get_attachment_image(
				get_post_thumbnail_id(),
				$settings['image_size']
			);
		}
		?>
		<div class="sow-carousel-item-image">
			<?php if ( $settings['post_meta_placement'] === 'below_title' ) { ?>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php
			}

			echo $image;

			if ( $settings['post_meta_placement'] === 'thumbnail' ) {
				SiteOrigin_Premium_Plugin_Carousel::post_meta( $settings );
			}

			if ( $settings['post_meta_placement'] === 'below_title' ) {
				?>
				</a>
				<?php
			}
			?>
		</div>
		<?php
	}

	public static function post_meta( $settings ) {
		if ( ! $settings['date'] && ! $settings['categories'] ) {
			return;
		}
		?>
		<div class="sow-carousel-item-meta">
			<?php
			if ( $settings['date'] ) {
				?>
				<time
					class="sow-carousel-item-date"
					datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
				>
					<?php
					echo esc_html(
						apply_filters(
							'siteorigin_widgets_post_carousel_date',
							get_the_date( $settings['date_format'] ),
							$settings
						)
					);
					?>
				</time>
				<?php
			}

			if ( $settings['categories'] ) {
				?>
				<span class="sow-carousel-item-categories">
					<?php
					$categories = get_the_category();

					$number_of_categories_to_show = apply_filters(
						'siteorigin_widgets_post_carousel_number_of_categories_to_show',
						$settings['post_meta_placement'] === 'thumbnail' ? 2 : 1,
						$settings
					);

					if (
						! empty( $number_of_categories_to_show ) &&
						is_numeric( $number_of_categories_to_show )
					) {
						$categories = array_slice(
							$categories,
							0,
							$number_of_categories_to_show
						);
					}

					$total_categories = count( $categories );

					for ( $i = 0; $i < $total_categories; $i++ ) {
						echo '<a href="' . esc_url( get_category_link( $categories[ $i ]->term_id ) ) . '">' . esc_html( $categories[ $i ]->name ) . '</a>';

						// Add a comma if there are more categories to show.
						if ( $i !== $total_categories - 1 ) {
							echo ',&nbsp;';
						}
					}
					?>
				</span>
				<?php
			}

			if ( $settings['post_meta_placement'] === 'thumbnail' ) { ?>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="sow-carousel-item-ima-thumbnail-overlay">&nbsp;</a>
				<?php
			}
			?>
		</div>

		<?php
	}

	public static function output_content( $settings ) {
		if (
			! apply_filters( 'siteorigin_widgets_post_carousel_content', true, $settings ) ||
			$settings['content'] === 'none'
		) {
			return;
		}
		?>
		<div class="sow-carousel-item-content">
			<?php
			if ( $settings['content'] == 'full' ) {
				the_content();
			} else {
				self::generate_excerpt( $settings );
			}
			?>
		</div>
		<?php
	}

	public static function generate_excerpt( $settings ) {
		$excerpt = get_the_excerpt();

		if ( empty( $excerpt ) ) {
			return;
		}

		$excerpt = wp_trim_words(
			$excerpt,
			$settings['excerpt_length'],
			apply_filters( 'siteorigin_widgets_blog_excerpt_trim', '...' )
		);

		echo '<p>' . wp_kses_post( $excerpt ) . '</p>';
	}

	public static function generate_readmore( $settings ) {
		if (
			$settings['content'] === 'full' ||
			empty( $settings['read_more'] )
		) {
			return;
		}

		$read_more_text = sprintf(
			'<a class="sow-more-link" href="%s">%s&nbsp;<span class="sow-more-link-arrow">&rarr;</span></a>',
			esc_url( get_permalink() ),
			esc_html(
				! empty( $settings['read_more_text'] ) ? $settings['read_more_text'] : __( 'Read More', 'siteorigin-premium' )
			)
		);

		echo $read_more_text;
	}
}
