<?php
/*
Plugin Name: SiteOrigin Lightbox
Description: Showcase your images in striking lightbox galleries, allowing for immersive viewing with options to customize overlay color, opacity, and navigation controls.
Version: 1.0.0
Author: SiteOrigin
Author URI: https://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Documentation: https://siteorigin.com/premium-documentation/plugin-addons/lightbox/
Tags: Widgets Bundle
Video: 314963153
Requires: so-widgets-bundle/image, so-widgets-bundle/image-grid, so-widgets-bundle/simple-masonry, so-widgets-bundle/slider
*/

class SiteOrigin_Premium_Plugin_Lightbox {
	const SO_IMAGE_ID_BASE = 'sow-image';
	const SO_IMAGE_GRID_ID_BASE = 'sow-image-grid';
	const SO_SIMPLE_MASONRY_ID_BASE = 'sow-simple-masonry';
	const SO_IMAGE_SLIDER_ID_BASE = 'sow-slider';

	private $enabled_on_processed = false;

	public function __construct() {
		$widget_ids = array(
			self::SO_IMAGE_ID_BASE,
			self::SO_IMAGE_GRID_ID_BASE,
			self::SO_SIMPLE_MASONRY_ID_BASE,
			self::SO_IMAGE_SLIDER_ID_BASE,
		);

		foreach ( $widget_ids as $widget_id ) {
			add_filter( 'siteorigin_widgets_form_options_' . $widget_id, array( $this, 'admin_form_options' ) );
			add_filter( 'siteorigin_widgets_form_instance_' . $widget_id, array( $this, 'update_form_instance', ), 10, 2 );
			add_filter( 'siteorigin_widgets_template_variables_' . $widget_id, array( $this, 'update_template_vars', ), 10, 4 );

			add_action( 'siteorigin_widgets_enqueue_frontend_scripts_' . $widget_id, array( $this, 'enqueue_lightbox_scripts' ), 10, 2 );
		}

		// Some special handling for the slider wrapper
		add_filter( 'siteorigin_widgets_slider_wrapper_attributes', array( $this, 'update_slider_wrapper' ), 10, 3 );

		add_action( 'init', array( $this, 'register_lightbox_scripts' ) );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	public function get_settings_form() {
		return new SiteOrigin_Premium_Form(
			'so-addon-lightbox-settings',
			array(
				'always_show_nav_on_touch_devices' => array(
					'type'    => 'checkbox',
					'label'   => __( 'Always show navigation controls on touch devices', 'siteorigin-premium' ),
					'default' => false,
				),
				'disabled_on_tablet' => array(
					'type'        => 'checkbox',
					'label'       => 'Disable on tablet',
					'description' => __( 'Disable all lightboxes on tablet devices.', 'siteorigin-premium' ),
					'default'     => false,
				),
				'disabled_on_mobile' => array(
					'type'        => 'checkbox',
					'label'       => 'Disable on mobile',
					'description' => __( 'Disable all lightboxes on mobile devices.', 'siteorigin-premium' ),
					'default'     => false,
				),
				'disable_scrolling' => array(
					'type'    => 'checkbox',
					'label'   => __( 'Disable page scrolling when the lightbox is open', 'siteorigin-premium' ),
					'default' => false,
				),
				'overlay_color' => array(
					'type'    => 'color',
					'label'   => __( 'Overlay color', 'siteorigin-premium' ),
					'default' => '#000',
				),
				'overlay_opacity' => array(
					'type'    => 'slider',
					'label'   => __( 'Overlay opacity', 'siteorigin-premium' ),
					'min'     => 0,
					'max'     => 1,
					'step'    => 0.01,
					'default' => 0.8,
				),
				'fade_duration' => array(
					'type'        => 'number',
					'label'       => __( 'Fade duration', 'siteorigin-premium' ),
					'default'     => 600,
					'description' => __( 'Time, in milliseconds, for the lightbox container and overlay to fade in/out.', 'siteorigin-premium' ),
				),
				'fit_images_in_viewport' => array(
					'type'        => 'checkbox',
					'label'       => __( 'Fit images in viewport', 'siteorigin-premium' ),
					'default'     => true,
					'description' => __( 'Resize images that are too large to fit in the current viewport.', 'siteorigin-premium' ),
				),
				'image_fade_duration' => array(
					'type'        => 'number',
					'label'       => __( 'Image fade duration', 'siteorigin-premium' ),
					'default'     => 600,
					'description' => __( 'Time, in milliseconds, for an image to fade in, once loaded.', 'siteorigin-premium' ),
				),
				'max_height' => array(
					'type'  => 'number',
					'label' => __( 'Max image height (in pixels)', 'siteorigin-premium' ),
				),
				'max_width' => array(
					'type'  => 'number',
					'label' => __( 'Max image width (in pixels)', 'siteorigin-premium' ),
				),
				'position_from_top' => array(
					'type'        => 'number',
					'label'       => __( 'Top offset', 'siteorigin-premium' ),
					'default'     => 50,
					'description' => __( 'Position, in pixels, of the lightbox from the top of the viewport.', 'siteorigin-premium' ),
				),
				'resize_duration' => array(
					'type'        => 'number',
					'label'       => __( 'Resize duration', 'siteorigin-premium' ),
					'default'     => 700,
					'description' => __( 'The time it takes for the lightbox container to animate its width and height when transitioning between different size images, in milliseconds.', 'siteorigin-premium' ),
				),
				'show_image_number_label' => array(
					'type'        => 'checkbox',
					'label'       => __( 'Show image number label', 'siteorigin-premium' ),
					'default'     => true,
					'description' => __( 'Show text indicating the current image number and the total number of images in the set.', 'siteorigin-premium' ),
				),
				'disable_caption' => array(
					'type'  => 'checkbox',
					'label' => __( 'Disable captions for all lightboxes', 'siteorigin-premium' ),
				),
				'wrap_around' => array(
					'type'        => 'checkbox',
					'label'       => __( 'Wrap around', 'siteorigin-premium' ),
					'default'     => true,
					'description' => __( 'Go back to the first image when the last image is reached.', 'siteorigin-premium' ),
				),
			)
		);
	}

	public function admin_form_options( $form_options ) {
		if ( empty( $form_options ) ) {
			return $form_options;
		}

		$form_options['lightbox'] = array(
			'type'   => 'section',
			'label'  => __( 'Lightbox', 'siteorigin-premium' ),
			'hide'   => true,
			'fields' => array(
				'enable_lightbox' => array(
					'type'          => 'checkbox',
					'label'         => __( 'Enable Lightbox', 'siteorigin-premium' ),
					'description'   => __( 'This will override the destination URL.', 'siteorigin-premium' ),
					'state_emitter' => array(
						'callback' => 'conditional',
						'args'     => array(
							'enable_lightbox[show]: val',
							'enable_lightbox[hide]: ! val',
						),
					),
				),
				'image_set_slug' => array(
					'type'          => 'text',
					'label'         => __( 'Album name', 'siteorigin-premium' ),
					'description'   => __( 'Images with the same album name will be displayed together.', 'siteorigin-premium' ),
					'sanitize'      => 'sanitize_title_with_dashes',
					'state_handler' => array(
						'enable_lightbox[show]' => array( 'slideDown' ),
						'enable_lightbox[hide]' => array( 'slideUp' ),
					),
				),
				'disable_caption' => array(
					'type'          => 'checkbox',
					'label'         => __( 'Disable caption for this lightbox', 'siteorigin-premium' ),
					'state_handler' => array(
						'enable_lightbox[show]' => array( 'slideDown' ),
						'enable_lightbox[hide]' => array( 'slideUp' ),
					),
				),

			),
		);


		return $form_options;
	}

	public function update_form_instance( $instance, $widget = array() ) {
		if ( empty( $instance ) || ! is_array( $instance ) ) {
			return array();
		}

		if ( ! isset( $instance['lightbox'] ) || ! is_array( $instance['lightbox'] ) ) {
			$instance['lightbox'] = array();
		}

		// Migrate Lightbox settings to dedicated section.
		if ( isset( $instance['enable_lightbox'] ) ) {
			$instance['lightbox']['enable_lightbox'] = ! empty( $instance['enable_lightbox'] );
			$instance['lightbox']['image_set_slug'] = ! empty( $instance['image_set_slug'] ) ? $instance['image_set_slug'] : '';
			$instance['lightbox']['disable_caption'] = ! empty( $instance['disable_caption'] );
			unset( $instance['enable_lightbox'] );
			unset( $instance['image_set_slug'] );
			unset( $instance['disable_caption'] );
		}

		if ( ! empty( $instance['lightbox']['image_set_slug'] ) ) {
			$instance['lightbox']['image_set_slug'] = $this->unslugify( $instance['lightbox']['image_set_slug'] );
		}

		return $instance;
	}

	private function unslugify( $name ) {
		return implode( ' ', array_map( 'ucfirst', explode( '-', $name ) ) );
	}

	/**
	 * @param $template_vars array
	 * @param $instance array
	 * @param $args array
	 * @param $widget WP_Widget
	 *
	 * @return mixed
	 */
	public function update_template_vars( $template_vars, $instance, $args, $widget ) {
		$instance = $this->update_form_instance( $instance );

		if ( ! empty( $instance['lightbox']['enable_lightbox'] ) ) {
			$premium_options = SiteOrigin_Premium_Options::single();

			$lightbox_settings = $premium_options->get_settings( 'plugin/lightbox' );

			$lightbox_settings['album_label'] = $this->unslugify( $instance['lightbox']['image_set_slug'] ) . ' ' . __( '%1 of %2', 'siteorigin-premium' );

			if ( ! empty( $lightbox_settings['disable_caption'] ) || ! empty( $instance['disable_caption'] ) ) {
				$lightbox_settings['show_image_number_label'] = false;
			}

			switch ( $widget->id_base ) {
				case self::SO_IMAGE_ID_BASE:
					$template_vars = $this->update_image_vars( $template_vars, $instance, $lightbox_settings );
					break;

				case self::SO_IMAGE_GRID_ID_BASE:
					$template_vars = $this->update_image_grid_vars( $template_vars, $instance, $lightbox_settings );
					break;

				case self::SO_SIMPLE_MASONRY_ID_BASE:
					$template_vars = $this->update_simple_masonry_vars( $template_vars, $instance, $lightbox_settings );
					break;

				case self::SO_IMAGE_SLIDER_ID_BASE:
					$template_vars = $this->update_image_slider_vars( $template_vars, $instance, $lightbox_settings );
					break;
			}
		}

		return $template_vars;
	}

	public function register_lightbox_scripts() {
		wp_register_script(
			'so-premium-lightbox',
			plugin_dir_url( __FILE__ ) . 'js/lib/lightbox/js/lightbox' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
			array( 'jquery' ),
			'2.9.0',
			true
		);
		wp_register_style(
			'so-premium-lightbox',
			plugin_dir_url( __FILE__ ) . 'js/lib/lightbox/css/lightbox' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.css',
			array(),
			'2.9.0'
		);
		wp_register_script(
			'so-premium-lightbox-options',
			plugin_dir_url( __FILE__ ) . 'js/lightbox-options' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
			array( 'jquery', 'so-premium-lightbox' ),
			SITEORIGIN_PREMIUM_VERSION,
			true
		);
	}

	public function enqueue_lightbox_scripts( $instance, $widget ) {
		$instance = $this->update_form_instance( $instance );

		if ( ! empty( $instance['lightbox']['enable_lightbox'] ) || is_admin() ) {
			wp_enqueue_script( 'so-premium-lightbox' );
			wp_enqueue_style( 'so-premium-lightbox' );
			wp_enqueue_script( 'so-premium-lightbox-options' );

			if ( ! $this->enabled_on_processed ) {
				$premium_options = SiteOrigin_Premium_Options::single();
				$lightbox_settings = $premium_options->get_settings( 'plugin/lightbox' );
				$css = '';

				// If SiteOrigin Page Builder is active, use its breakpoints. If not, use default breakpoints
				$tablet_width = function_exists( 'siteorigin_panels_setting' ) ? siteorigin_panels_setting( 'tablet-width' ) : '1024';
				$mobile_width = function_exists( 'siteorigin_panels_setting' ) ? siteorigin_panels_setting( 'mobile-width' ) : '780';

				if ( $lightbox_settings['disabled_on_tablet'] ) {
					$css .= '
					@media (max-width: ' . $tablet_width . 'px) and (min-width: ' . $mobile_width . 'px) {
						a[data-lightbox-options] {
							pointer-events: none;
						}

						.sow-masonry-grid-item a[data-lightbox-options] {
							display: contents;
						}

						.sow-slider-image a[data-lightbox-options] {
							display: block;
						}
					}';
				}

				if ( $lightbox_settings['disabled_on_mobile'] ) {
					$css .= '
					@media (max-width: ' . $mobile_width . 'px) {
						a[data-lightbox-options] {
							pointer-events: none;
						}

						.sow-masonry-grid-item a[data-lightbox-options] {
							display: contents;
						}

						.sow-slider-image a[data-lightbox-options] {
							display: block;
						}
					}';
				}

				if ( ! empty( $css ) ) {
					siteorigin_widget_add_inline_css( $css );
				}

				// Prevent the above code from running again
				$this->enabled_on_processed = true;
			}
		}
	}

	private function update_image_vars( $template_vars, $instance, $lightbox_settings ) {
		// Account for Images with no local image set but have an external image set
		if ( ! empty( $instance['image'] ) ) {
			$src = wp_get_attachment_image_src( $instance['image'], 'full' );
			$template_vars['url'] = ! empty( $src ) ? $src[0] : '';
		} elseif ( ! empty( $instance['image_fallback'] ) ) {
			$template_vars['url'] = esc_url( $instance['image_fallback'] );
		} else {
			$template_vars['url'] = '';
		}

		$link_atts = empty( $template_vars['link_attributes'] ) ? array() : $template_vars['link_attributes'];

		if ( empty( $instance['lightbox']['image_set_slug'] ) ) {
			if ( ! empty( $instance['_sow_form_id'] ) ) {
				$link_atts['data-lightbox'] = $instance['_sow_form_id'];
			} else {
				$link_atts['data-lightbox'] = $template_vars['url'];
			}
		} else {
			$link_atts['data-lightbox'] = $instance['lightbox']['image_set_slug'];
		}

		$link_atts['data-lightbox-options'] = json_encode( siteorigin_widgets_underscores_to_camel_case( $lightbox_settings ) );

		if ( empty( $lightbox_settings['lightbox']['disable_caption'] ) && empty( $instance['lightbox']['disable_caption'] ) ) {
			if ( ! empty( $instance['title'] ) ) {
				$image_caption = $instance['title'];
			} else {
				$image_caption = wp_get_attachment_caption( $instance['image'] );

				if ( empty( $image_caption ) ) {
					$image_caption = get_the_title( $instance['image'] );
				}
			}
			$link_atts['data-title'] = wp_kses_post( $image_caption );
		}

		$template_vars['link_attributes'] = $link_atts;

		return $template_vars;
	}

	private function update_image_grid_vars( $template_vars, $instance, $lightbox_settings ) {
		foreach ( $template_vars['images'] as &$image ) {
			// Account for Images with no local image set but have an external image set
			if ( ! empty( $image['image'] ) ) {
				$src = wp_get_attachment_image_src( $image['image'], 'full' );
				$image['url'] = ! empty( $src ) ? $src[0] : '';
			} elseif ( ! empty( $image['image_fallback'] ) ) {
				$image['url'] = esc_url( $image['image_fallback'] );
			} else {
				continue;
			}

			$link_atts = empty( $image['link_attributes'] ) ? array() : $image['link_attributes'];

			if ( empty( $instance['lightbox']['image_set_slug'] ) ) {
				if ( ! empty( $instance['_sow_form_id'] ) ) {
					$link_atts['data-lightbox'] = $instance['_sow_form_id'];
				} else {
					$link_atts['data-lightbox'] = $image['url'];
				}
			} else {
				$link_atts['data-lightbox'] = $instance['lightbox']['image_set_slug'];
			}

			$link_atts['data-lightbox-options'] = json_encode( siteorigin_widgets_underscores_to_camel_case( $lightbox_settings ) );

			if ( empty( $lightbox_settings['lightbox']['disable_caption'] ) && empty( $instance['lightbox']['disable_caption'] ) ) {
				if ( ! empty( $image['title'] ) ) {
					$image_caption = $image['title'];
				} else {
					$image_caption = wp_get_attachment_caption( $image['image'] );

					if ( empty( $image_caption ) ) {
						$image_caption = get_the_title( $image['image'] );
					}
				}
				$link_atts['data-title'] = wp_kses_post( $image_caption );
			}

			$image['link_attributes'] = $link_atts;
		}

		return $template_vars;
	}

	private function update_simple_masonry_vars( $template_vars, $instance, $lightbox_settings ) {
		foreach ( $template_vars['items'] as &$item ) {
			if ( ! empty( $item['image'] ) ) {
				$src = wp_get_attachment_image_src( $item['image'], 'full' );
				$item['url'] = ! empty( $src ) ? $src[0] : '';
			} elseif ( ! empty( $item['image_fallback'] ) ) {
				$item['url'] = esc_url( $item['image_fallback'] );
			} else {
				continue;
			}

			$link_atts = empty( $item['link_attributes'] ) ? array() : $item['link_attributes'];

			if ( empty( $instance['lightbox']['image_set_slug'] ) ) {
				if ( ! empty( $instance['_sow_form_id'] ) ) {
					$link_atts['data-lightbox'] = $instance['_sow_form_id'];
				} else {
					$link_atts['data-lightbox'] = $item['url'];
				}
			} else {
				$link_atts['data-lightbox'] = $instance['lightbox']['image_set_slug'];
			}

			$link_atts['data-lightbox-options'] = json_encode( siteorigin_widgets_underscores_to_camel_case( $lightbox_settings ) );

			if ( empty( $lightbox_settings['lightbox']['disable_caption'] ) && empty( $instance['lightbox']['disable_caption'] ) ) {
				if ( ! empty( $item['title'] ) ) {
					$image_caption = $item['title'];
				} else {
					$image_caption = wp_get_attachment_caption( $item['image'] );

					if ( empty( $image_caption ) ) {
						$image_caption = get_the_title( $item['image'] );
					}
				}
				$link_atts['data-title'] = wp_kses_post( $image_caption );
			}

			$item['link_attributes'] = $link_atts;
		}

		return $template_vars;
	}

	private function update_image_slider_vars( $template_vars, $instance, $lightbox_settings ) {
		foreach ( $template_vars['frames'] as &$frame ) {
			$foreground_src = siteorigin_widgets_get_attachment_image_src(
				$frame['foreground_image'],
				'full',
				! empty( $frame['foreground_image_fallback'] ) ? $frame['foreground_image_fallback'] : ''
			);

			if ( ! empty( $foreground_src ) ) {
				$frame['url'] = $foreground_src[0];
			} elseif ( empty( $frame['background_videos'] ) ) {
				$background_src = siteorigin_widgets_get_attachment_image_src(
					$frame['background_image'],
					'full',
					! empty( $frame['background_image_fallback'] ) ? $frame['background_image_fallback'] : ''
				);
				$frame['url'] = ! empty( $background_src ) ? $background_src[0] : '';
			} else {
				$frame['url'] = '';
			}

			$link_atts = empty( $frame['link_attributes'] ) ? array() : $frame['link_attributes'];

			if ( ! empty( $instance['lightbox']['image_set_slug'] ) ) {
				$link_atts['data-lightbox'] = $instance['lightbox']['image_set_slug'];
			} elseif ( ! empty( $instance['_sow_form_id'] ) ) {
				$link_atts['data-lightbox'] = $instance['_sow_form_id'];
			} else {
				$link_atts['data-lightbox'] = $frame['url'];
			}

			if ( empty( $lightbox_settings['lightbox']['disable_caption'] ) && empty( $instance['lightbox']['disable_caption'] ) ) {
				if ( ! empty( $frame['background_image'] ) ) {
					$image_id = $frame['background_image'];
				} elseif ( ! empty( $frame['foreground_image'] ) ) {
					$image_id = $frame['foreground_image'];
				}

				// Check if background or foreground image is set
				if ( isset( $image_id ) ) {
					$link_atts['data-title'] = wp_get_attachment_caption( $image_id );

					// If no caption, use image title
					if ( empty( $link_atts['data-title'] ) ) {
						$link_atts['data-title'] = wp_kses_post( get_the_title( $image_id ) );
					}
				}
			}

			$link_atts['data-lightbox-options'] = json_encode( siteorigin_widgets_underscores_to_camel_case( $lightbox_settings ) );

			$frame['link_attributes'] = $link_atts;
		}

		return $template_vars;
	}

	public function update_slider_wrapper( $wrapper_attributes, $frame, $background ) {
		if ( ! empty( $frame['link_attributes'] ) && ! empty( $frame['link_attributes']['data-lightbox'] ) ) {
			// Prevent slider JS handling clicks when we're using lightbox.
			unset( $wrapper_attributes['data-url'] );
		}

		return $wrapper_attributes;
	}
}
