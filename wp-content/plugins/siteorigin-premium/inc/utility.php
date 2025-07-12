<?php

/**
 * Class SiteOrigin_Premium_Utility
 *
 * This file contains utility functions that are used throughout the plugin.
 */
class SiteOrigin_Premium_Utility {
	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	/**
	 * Get a post type array.
	 *
	 * @see https://github.com/siteorigin/siteorigin-panels/blob/2.20.4/inc/settings.php#L742
	 *
	 * @return array
	 */
	public function get_post_types() {
		$types = get_transient( 'siteorigin_premium_post_types' );

		if ( empty( $types ) ) {
			$post_types = get_post_types( array( '_builtin' => false ) );

			$types = array(
				'page' => 'page',
				'post' => 'post',
			);

			// We don't use `array_merge` here as it will break things if a post type has a numeric slug.
			foreach ( $post_types as $key => $value ) {
				$types[ $key ] = $value;
			}

			unset( $types['ml-slider'] );
			unset( $types['shop_coupon'] );
			unset( $types['shop_order'] );
			unset( $types['so_mirror_widget'] );
			unset( $types['so_custom_post_type'] );

			foreach ( $types as $type_id => $type ) {
				$type_object = get_post_type_object( $type_id );

				if ( ! $type_object->show_ui ) {
					unset( $types[ $type_id ] );
					continue;
				}

				$types[ $type_id ] = $type_object->label;
			}

			set_transient( 'siteorigin_premium_post_types', $types, 24 * HOUR_IN_SECONDS );
		}

		return apply_filters( 'siteorigin_premium_post_types', $types );
	}

	/**
	 * Checks if an addon is enabled for a specific post.
	 *
	 * @param array $settings The addon settings.
	 * @param string $setting The specific addon setting to check.
	 * @return bool Returns true if the addon is enabled for the post, false otherwise.
	 */
	public function is_addon_enabled_for_post( $settings, $setting ) {
		$premium_meta = get_post_meta( get_the_id(), 'siteorigin_premium_meta', true );

		// Check if the current post type is enabled.
		if (
			! empty( $settings ) &&
			! empty( $settings['types'] ) &&
			is_array( $settings['types'] ) &&
			in_array( get_post_type(), $settings['types'] )
		) {
			if (
				isset( $premium_meta['general'] ) &&
				isset( $premium_meta['general'][ $setting . '_on'] ) &&
				empty( $premium_meta['general'][ $setting . '_on'] )
			) {
				// Post has been disabled via meta.
				return false;
			}

			return true;
		}

		// Post type is disabled. Check if the current post has been enabled.
		if (
			! isset( $premium_meta['general'] ) ||
			empty( $premium_meta['general'][ $setting . '_off'] )
		) {
			// It hasn't.
			return false;
		}

		return true;
	}

	/**
	 * Ensure the tag is valid before output. If it's not, return the fallback.
	 *
	 * @param string $tag The HTML tag to validate.
	 * @param string|null $fallback The fallback value if the tag is empty or invalid.
	 * @param array $valid_tags An array containing valid HTML tags.
	 * @return string A valid HTML tag for the widget.
	 *
	 * @see https://github.com/siteorigin/so-widgets-bundle/blob/develop/base/base.php#L554-L563
	 */
	public function validate_tag( $tag, $fallback = null, $valid_tags = array() ) {
		if ( empty( $valid_tags ) || ! is_array( $valid_tags ) ) {
			$valid_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' );
		}

		if ( ! in_array( $tag, $valid_tags ) ) {
			return $fallback;
		}

		return $tag;
	}

	/**
	 * Retrieve a variable from the settings array with a default fallback.
	 *
	 * This method checks if a specific variable is set and not empty in the settings array.
	 * If the variable is set and not empty, it returns its value. Otherwise, it returns the default value.
	 *
	 * @param array  $settings The settings array to retrieve the variable from.
	 * @param string $var      The key of the variable to retrieve from the settings array.
	 * @param mixed  $default  The default value to return if the variable is not set or is empty. Default is null.
	 *
	 * @return mixed The value of the variable from the settings array or the default value.
	 */
	public static function less_var( $settings, $var, $default = null ) {
		return ! empty( $settings[ $var ] ) ? $settings[ $var ] : $default;
	}

	/**
	 * Check if the current screen is the Block Editor.
	 *
	 * This method checks if the current screen is the Block Editor (Gutenberg).
	 * It first verifies that the request is in the admin area and that the
	 * `get_current_screen` function exists. Then, it checks if the current screen
	 * is not empty and has the `is_block_editor` method. If the current screen is
	 * the Block Editor, it returns true; otherwise, it returns false.
	 *
	 * @return bool Returns true if the current screen is the Block Editor, false otherwise.
	 */
	public static function is_block_editor() {
		if ( ! is_admin() || ! function_exists( 'get_current_screen' ) ) {
			return false;
		}

		$current_screen = get_current_screen();
		if (
			! empty( $current_screen ) &&
			method_exists( $current_screen, 'is_block_editor' ) &&
			! $current_screen->is_block_editor()
		) {
			// Not the Block Editor, bail.
			return false;
		}

		return true;
	}

	/**
	 * Generate date format options for blog settings.
	 *
	 * This returns an associative array with the date format as the key and a
	 * descriptive string (including the current date example) as the value.
	 *
	 * @return array An array of date formats for by addons that include date formats.
	 */
	public static function date_format_options(): array {
		return array(
			'' => sprintf(
				__( 'Default (%s)', 'siteorigin-premium' ),
				date( get_option( 'date_format' ) )
			),
			'Y-m-d' => sprintf(
				__( 'yyyy-mm-dd (%s)', 'siteorigin-premium' ),
				date( 'Y-m-d' )
			),
			'm/d/Y' => sprintf(
				__( 'mm/dd/yyyy (%s)', 'siteorigin-premium' ),
				date( 'm/d/Y' )
			),
			'd/m/Y' => sprintf(
				__( 'dd/mm/yyyy (%s)', 'siteorigin-premium' ),
				date( 'd/m/Y' )
			),
		);
	}
}
