<?php
/*
Plugin Name: SiteOrigin Logo Booster
Description: Customize logos on a per-page or language basis, seamlessly adapting your branding to enhance appeal and relevance in diverse visitor contexts.
Version: 1.0.0
Author: SiteOrigin
Author URI: https://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Documentation: https://siteorigin.com/premium-documentation/theme-addons/logo-booster/
Tags: Theme, Widgets Bundle
Requires: so-widgets-bundle
*/

class SiteOrigin_Premium_Theme_Logo_booster {
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	public function init() {
		if ( function_exists( 'siteorigin_setting' ) ) {
			add_filter( 'theme_mod_custom_logo', array( $this, 'override_wp_logo_setting' ) );
			add_filter( 'get_custom_logo', array( $this, 'add_logo_wp' ), 1 );

			add_filter( 'siteorigin_north_logo_url', array( $this, 'get_base_logo_id' ) );
			add_filter( 'siteorigin_north_logo_attributes', array( $this, 'setup_scroll_logo_theme' ), 20 );

			add_filter( 'siteorigin_unwind_logo_url', array( $this, 'get_base_logo_id' ) );
			add_filter( 'siteorigin_unwind_logo_attributes', array( $this, 'setup_scroll_logo_theme' ), 20 );

			add_filter( 'vantage_logo_image_id', array( $this, 'add_vantage_logo' ) );
			add_filter( 'vantage_logo_image_attributes', array( $this, 'setup_scroll_logo_theme' ), 20 );

			add_filter( 'siteorigin_premium_metabox_form_options', array( $this, 'metabox_options' ) );
			add_filter( 'siteorigin_premium_metabox_meta', array( $this, 'metabox_migrate' ), 9, 2 );

			add_action( 'customize_dynamic_partial_args', array( $this, 'customizer_prevent_double_edit' ), 10, 2 );
		}
	}

	public function get_settings_form() {
		$form_options = array(
			'scroll_logo' => array(
				'type' => 'media',
				'label' => __( 'Global Sticky Logo', 'siteorigin-premium' ),
				'description' => __( 'Requires an existing page or theme logo. The Global Sticky Logo replaces this initial logo.', 'siteorigin-premium' ),
				'library' => 'image',
			),
		);

		if ( function_exists( 'icl_get_languages' ) ) {
			$languages = icl_get_languages();
			$default_language = apply_filters( 'wpml_default_language', null );
			// Update standard sticky logo to reference default language.
			$form_options['scroll_logo']['label'] = $languages[ $default_language ]['native_name'] . ' ' . $form_options['scroll_logo']['label'];
			unset( $languages[ $default_language ] );

			foreach ( $languages as $cc => $language ) {
				$form_options[ $cc . '_base_logo' ] = array(
					'type' => 'media',
					'label' => sprintf( __( '%s Base Logo', 'siteorigin-premium' ), $language['native_name'] ),
					'library' => 'image',
				);
				$form_options[ $cc . '_scroll_logo' ] = array(
					'type' => 'media',
					'label' => sprintf( __( '%s Global Sticky Logo', 'siteorigin-premium' ), $language['native_name'] ),
					'library' => 'image',
				);
			}
		}

		return new SiteOrigin_Premium_Form(
			'so-addon-logo-booster-settings',
			$form_options
		);
	}

	private function get_global_settings() {
		$settings = SiteOrigin_Premium_Options::single()->get_settings( 'theme/logo-booster', false );

		if ( function_exists( 'icl_get_languages' ) ) {
			$current_language = apply_filters( 'wpml_current_language', null );

			if ( ! empty( $settings[ $current_language . '_base_logo' ] ) ) {
				$settings['base_logo'] = $settings[ $current_language . '_base_logo' ];
			}

			if ( ! empty( $settings[ $current_language . '_scroll_logo' ] ) ) {
				$settings['scroll_logo'] = $settings[ $current_language . '_scroll_logo' ];
			}
		}

		return $settings;
	}

	private static function get_meta( $premium_meta = array(), $is_admin = false ) {
		$post_id = function_exists( 'is_shop' ) && is_shop() ? wc_get_page_id( 'shop' ) : get_the_id();

		if ( empty( $premium_meta ) ) {
			$premium_meta = get_post_meta( $post_id, 'siteorigin_premium_meta', true );
		}

		if ( ! is_array( $premium_meta ) ) {
			$premium_meta = array();
		}

		if (
			empty( $premium_meta['logo_booster'] ) &&
			apply_filters( 'siteorigin_premium_logo_booster_meta_migrate_check', true )
		) {
			$existing_meta = get_post_meta( $post_id, 'siteorigin_premium_logo_booster', true );

			if (
				! empty( $existing_meta ) &&
				(
					! empty( $existing_meta['base'] ) ||
					! empty( $existing_meta['sticky'] )
				)
			) {
				$premium_meta['logo_booster'] = $existing_meta;

				update_post_meta( $post_id, 'siteorigin_premium_meta', $premium_meta );
				delete_post_meta( $post_id, 'siteorigin_premium_logo_booster' );
			}
		}

		if ( $is_admin ) {
			return $premium_meta;
		} else {
			return ! empty( $premium_meta['logo_booster'] ) ? $premium_meta['logo_booster'] : array();
		}
	}

	public function add_logo_wp( $html ) {
		if (
			empty( get_theme_mod( 'custom_logo' ) ) ||
			(
				is_archive() &&
				! (
					function_exists( 'is_shop' ) &&
					is_shop()
				)
			)
		) {
			return $html;
		}

		$logo_booster_meta = self::get_meta();

		if ( ! empty( $logo_booster_meta ) && ! empty( $logo_booster_meta['base'] ) ) {
			$logo_override_id = $logo_booster_meta['base'];
		} else {
			$settings = $this->get_global_settings();

			// These are only applicable if the user has Polylang or WPML installed,
			// and has set a language specific logo.
			if ( ! empty( $settings['base_logo'] ) ) {
				$logo_override_id = $settings['base_logo'];
			}
		}

		$scroll_logo_html = $this->get_scroll_logo_markup( 'return', false );
		if ( empty( $logo_override_id ) ) {
			if ( empty( $scroll_logo_html ) ) {
				return $html;
			}

			// No logo override in place. Use the Site Identity logo
			// to allow for the sticky logo to be added.
			$logo_override_id = get_theme_mod( 'custom_logo' );
			if ( empty( $logo_override_id ) ) {
				return $html;
			}
		}

		$classes = 'custom-logo';
		// If there's a scroll logo, we need to add the alt-logo class to allow for
		// themes to hide the main logo.
		if ( ! empty( $scroll_logo_html ) ) {
			$classes .= ' alt-logo';
		}

		$logo_override = wp_get_attachment_image(
			$logo_override_id,
			'full',
			false,
			array(
				'class' => $classes,
				'loading' => 'false',
				'decoding' => 'async',
				'itemprop' => 'logo',
			)
		);

		$html = '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">' . $logo_override . '</a>';

		if ( ! empty( $scroll_logo_html ) ) {
			$html .= $scroll_logo_html;
			// To help with styling, we add a class to the main logo.
			$html = substr_replace( $html, 'alt-logo ', strpos( $html, 'custom-logo' ), 0 );
		}

		return $html;
	}

	public function add_vantage_logo( $logo ) {
		if ( siteorigin_setting( 'layout_masthead' ) == 'logo-in-menu' ) {
			add_filter( 'vantage_logo_retina_image_id', '__return_false' );
			return $this->get_base_logo_id( $logo );
		}

		return $logo;
	}

	public function setup_scroll_logo_theme( $attrs ) {
		if ( get_stylesheet() == 'vantage' ) {
			if ( siteorigin_setting( 'layout_masthead' ) == 'logo-in-menu' ) {
				$logo = siteorigin_setting( 'logo_image' );

				if ( empty( $logo ) && function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
					$logo = get_theme_mod( 'custom_logo' );
				}
				$logo = apply_filters( 'vantage_logo_image_id', $logo );
			}
		} else {
			$logo = siteorigin_setting( 'branding_logo' ) ? siteorigin_setting( 'branding_logo' ) : get_theme_mod( 'custom_logo' );
		}

		$settings = $this->get_global_settings();

		if ( empty( $settings ) || empty( $this->get_scroll_logo() ) || empty( $logo ) ) {
			return $attrs;
		}

		if ( empty( $attrs['class'] ) ) {
			$attrs['class'] = 'custom-logo alt-logo';
		} else {
			$attrs['class'] .= ' alt-logo';
		}

		// Prevent potential situation where the themes retina logo overrides the sticky logo.
		unset( $attrs['srcset'] );

		add_action( 'siteorigin_unwind_logo_after', array( $this, 'get_scroll_logo_markup' ) );
		add_action( 'siteorigin_north_logo_after', array( $this, 'get_scroll_logo_markup' ) );
		add_action( 'vantage_logo_image', array( $this, 'add_scroll_logo_vantage' ), 5 );

		return $attrs;
	}

	/**
	 * Retrieves the base logo ID from the logo booster meta, or global setting.
	 *
	 * This method attempts to retrieve the base logo ID in the following order:
	 * 1. From post meta.
	 * 2. From global settings. Only applicable if WPML or PolyLang are set.
	 * 3. Uses a fallback ID if provided and no other source has a base logo ID.
	 *
	 * @param mixed $fallback_id The fallback ID to use if no base logo ID is found in either the meta or global settings. Default is false.
	 *
	 * @return mixed Returns the base logo ID if found, otherwise returns the fallback ID.
	 */
	public function get_base_logo_id( $fallback_id = false ) {
		$logo_booster_meta = self::get_meta();
		if ( ! empty( $logo_booster_meta ) && ! empty( $logo_booster_meta['base'] ) ) {
			return $logo_booster_meta['base'];
		}

		if ( ! empty( $logo_id ) ) {
			return $logo_id;
		}

		$settings = $this->get_global_settings();
		if ( ! empty( $settings['base_logo'] ) ) {
			return $settings['base_logo'];
		}

		return $fallback_id;
	}

	private function get_scroll_logo( $logo_booster_meta = array() ) {
		if ( empty( $logo_booster_meta ) ) {
			$logo_booster_meta = self::get_meta();
		}

		$scroll_logo_id = false;

		if ( ! empty( $logo_booster_meta ) && ! empty( $logo_booster_meta['sticky'] ) ) {
			return $logo_booster_meta['sticky'];
		}

		$settings = $this->get_global_settings();
		if ( ! empty( $settings['scroll_logo'] ) ) {
			return $settings['scroll_logo'];
		}

		return $scroll_logo_id;
	}

	/**
	 * Generates the HTML markup for the scroll logo.
	 *
	 * This method generates the scroll logo HTML if a scroll logo exists.
	 * The scroll logo is then either returned as a string or echoed out, based on the method's parameters.
	 *
	 * @param bool $retoutputurn Determines if the scroll logo HTML should be returned as a string or echoed out. Default is echo.
	 * @param bool $add_styles Whether the `siteorigin_premium_logo_booster_sticky_style` filter is used to apply custom styles to the logo. Default is false.
	 *
	 * @return string|void The scroll logo HTML if `$return` is true, otherwise nothing is returned and the logo is echoed.
	 */
	public function get_scroll_logo_markup( $output = 'echo', $add_styles = true ) {
		$scroll_logo_id = $this->get_scroll_logo();

		if ( empty( $scroll_logo_id ) ) {
			return false;
		}

		$logo_attrs = array(
			'class' => 'alt-logo-scroll',
			'loading' => 'false',
			'decoding' => 'async',
			'itemprop' => 'logo',
		);

		if ( $add_styles ) {
			$logo_attrs['style'] = apply_filters( 'siteorigin_premium_logo_booster_sticky_style', 'max-width: 75px;' );
		}

		$scroll_logo = wp_get_attachment_image(
			$scroll_logo_id,
			'full',
			false,
			$logo_attrs
		);

		if ( empty( $scroll_logo_id ) ) {
			return false;
		}

		// Nest the logo.
		$scroll_logo = '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">' . $scroll_logo . '</a>';

		if ( $output === 'return' ) {
			return $scroll_logo;
		}

		echo $scroll_logo;
	}

	public function add_scroll_logo_vantage( $logo_html ) {
		$logo_html .= $this->get_scroll_logo_markup( 'return', false );

		if ( siteorigin_setting( 'logo_in_menu_constrain' ) ) {
			// If Vantage is set to constrain the logo, we need to need to add
			// some classes to maintain sizing.
			$logo_html = str_replace( 'custom-logo-link', 'custom-logo-link logo', $logo_html );
		}

		return $logo_html;
	}

	// If the user doesn't set a Theme or WP logo, the page defined logos can't show.
	// We need to override the theme setting with a placeholder to allow for them to appear.
	public function override_wp_logo_setting( $value ) {
		// If the user has set a logo, we don't need to do anything here.
		if (
			! empty( $value ) ||
			! empty( siteorigin_setting( 'branding_logo' ) ) ||
			! empty( siteorigin_setting( 'logo_image' ) )
		) {
			return $value;
		}

		$base_logo_id = $this->get_base_logo_id();
		return empty( $base_logo_id ) ? $value : $base_logo_id;
	}

	public function metabox_options( $form_options ) {
		return $form_options + array(
			'logo_booster' => array(
				'type' => 'section',
				'label' => __( 'Logo Booster', 'siteorigin-premium' ),
				'tab' => true,
				'hide' => true,
				'fields' => array(
					'base' => array(
						'type' => 'media',
						'label' => __( 'Logo', 'siteorigin-premium' ),
					),

					'sticky' => array(
						'type' => 'media',
						'label' => __( 'Sticky Logo', 'siteorigin-premium' ),
					),
				),
			),
		);
	}

	public function metabox_migrate( $meta, $post ) {
		return $this->get_meta( $meta, true );
	}

	/**
	 * Modifies the Customizer Custom Logo partial settings to prevent
	 * two edit buttons appearing.
	 *
	 * This method intercepts the customizer settings for elements identified
	 * by their ID. If the ID matches 'custom_logo', we modify the selector
	 * to target only the first instance of the custom logo link.
	 *
	 * @param array $args The original customizer settings for the element.
	 * @param string $id The ID of the element being customized.
	 *
	 * @return array The modified or original customizer settings.
	 */
	public function customizer_prevent_double_edit( $args, $id ) {
		if ( $id !== 'custom_logo' ) {
			return $args;
		}

		$args['selector'] = '.custom-logo-link:first-of-type';

		return $args;
	}
}
