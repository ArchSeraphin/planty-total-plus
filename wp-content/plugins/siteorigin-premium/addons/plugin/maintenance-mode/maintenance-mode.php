<?php
/*
Plugin Name: SiteOrigin Maintenance Mode
Description: Craft your own maintenance page with text or layout tools. Personalize with custom titles and design elements for a seamless user experience.
Version: 1.0.0
Author: SiteOrigin
Author URI: https://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Documentation: https://siteorigin.com/premium-documentation/plugin-addons/maintenance-mode/
Tags: Page Builder, Widgets Bundle
*/

class SiteOrigin_Premium_Plugin_Maintenance_Mode extends SiteOrigin_Premium_Central_Gate {
	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'show_maintenance_mode' ) );

		add_filter( 'siteorigin_premium_addon_section_link-plugin/maintenance-mode', array( $this, 'addon_section_details' ) );

		// Indicator in the admin bar.
		add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_indicator' ), 32 );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_admin_bar_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_bar_assets' ) );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	public function get_settings_form() {
		// Load defaults.
		$form_options = $this->form_options();

		// Add addon specific values.
		$form_options['enabled']['label'] = __( 'Enable Maintenance Mode', 'siteorigin-premium' );
		$form_options['title']['default'] = $this->default_title();
		unset( $form_options['title']['state_handler'] );

		$form_options['content_type']['default'] = 'text';

		// Body design defaults.
		$form_options['design']['fields']['body']['fields']['background_color']['default'] = '#f1f1f1';

		// Content Container design defaults.
		$form_options['design']['fields']['container']['fields']['margin']['default'] = '50px 0px 0px 0px';
		$form_options['design']['fields']['container']['fields']['border_radius']['default'] = '24px 24px 24px 24px';
		$form_options['design']['fields']['container']['fields']['padding']['default'] = '40px 40px 20px 40px';

		// Text Design defaults.
		$form_options['design']['fields']['text']['fields']['size']['default'] = '15px';


		$form_options['content_text']['default'] = __(
			"<h1>Site Under Maintenance</h1>
			<p>We're currently performing some scheduled maintenance on our website. Don't worry, we'll be back online shortly!</p>
			<p><strong>What's happening:</strong></p>
			<ul>
				<li>Scheduled Maintenance: We're making improvements to enhance your experience.</li>
				<li>Temporary Access: This page will automatically redirect once maintenance is complete.</li>
				<li>Questions?: If you need immediate assistance, please contact our support team.</li>
			</ul>
			<p>Thank you for your patience and understanding. We appreciate your support as we work to make our site even better for you.</p>",
			'siteorigin-premium'
		);

		return new SiteOrigin_Premium_Form(
			'so-addon-maintenance-mode-settings',
			$form_options
		);
	}

	public function addon_section_details() {
		return array(
			'show_settings_on_activation' => true,
		);
	}

	public function default_title() {
		return sprintf( __( 'Under Maintenance - %s', 'siteorigin-premium' ), get_bloginfo( 'name' ) );
	}

	/**
	 * Check if maintenance mode is active.
	 *
	 * This method checks the settings to determine if maintenance mode is enabled.
	 * It also sets up the settings if they are not already set.
	 *
	 * @return bool The current maintenance mode status.
	 */
	private function is_maintenance_mode_active() : bool {
		if ( ! isset( $this->settings ) ) {
			$premium_options = SiteOrigin_Premium_Options::single();
			$this->settings = $premium_options->get_settings( 'plugin/maintenance-mode', false );
		}

		return ! empty( $this->settings['enabled'] );
	}

	/**
	 * Determine if the current user can bypass maintenance mode.
	 *
	 * This method checks the following conditions:
	 * - If the user is logged in.
	 * - If the user has the 'edit_posts' capability.
	 * - If the 'siteorigin_premium_maintenance_mode_show' filter returns `true`.
	 *
	 * If all conditions are met, the user can bypass maintenance mode.
	 */
	public function current_user_can_bypass_maintenance_mode() : bool {
		if ( ! is_user_logged_in() ) {
			return false;
		}

		if ( ! current_user_can( 'edit_posts' ) ) {
			return false;
		}


		return apply_filters( 'siteorigin_premium_maintenance_mode_show', true );
	}

	public function show_maintenance_mode() {
		global $pagenow;

		if ( ! $this->is_maintenance_mode_active() ) {
			return;
		}

		// Prevent admins from getting locked out.
		if ( is_admin() || 'wp-login.php' === $pagenow ) {
			return;
		}

		if ( $this->current_user_can_bypass_maintenance_mode() ) {
			return;
		}

		// Prevent caching issues.
		status_header( 503 );
		nocache_headers();

		$this->render();
	}

	/**
	 * Add maintenance mode indicator to the admin bar.
	 *
	 * If maintenance mode isn't active, the indicator has the
	 * class 'so-maintenance-mode-indicator-inactive' set which
	 * will hide the indicator.
	 *
	 * @param WP_Admin_Bar $admin_bar The WP_Admin_Bar instance.
	 */
	public function add_admin_bar_indicator( $admin_bar ) : void {
		if ( ! $this->current_user_can_bypass_maintenance_mode() ) {
			return;
		}

		$indicator = array(
			'id' => 'so-maintenance-mode',
			'title' => '<span aria-hidden="true" class="ab-icon dashicons dashicons-bell"></span> ' .
			'<span class="ab-label">' . __( 'Maintenance Mode Active', 'siteorigin-premium' ) . '</span>',
			'href' => admin_url( 'admin.php?page=siteorigin-premium-addons&addon=plugin/maintenance-mode' ),
			'meta' => array(
				'class' => 'so-maintenance-mode-indicator',
				'title' => __( 'Maintenance Mode is currently active', 'siteorigin-premium' ),
				'html' => '<style>#wp-admin-bar-so-maintenance-mode > .ab-item { display: flex !important; align-items: center; }</style>',
			),
		);

		if ( ! $this->is_maintenance_mode_active() ) {
			$indicator['meta']['html'] = '<style>#wp-admin-bar-so-maintenance-mode{display:none;}</style>';
		}

		$admin_bar->add_node( $indicator );
	}

	public function add_admin_bar_assets() : void {
		if ( ! $this->current_user_can_bypass_maintenance_mode() ) {
			return;
		}

		wp_enqueue_style(
			'so-maintenance-mode-indicator',
			plugin_dir_url( __FILE__ ) . 'css/indicator' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.css',
			array(),
			SITEORIGIN_PREMIUM_VERSION
		);

		wp_enqueue_script(
			'so-maintenance-mode-indicator',
			plugin_dir_url( __FILE__ ) . 'js/indicator' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
			array( 'jquery' ),
			SITEORIGIN_PREMIUM_VERSION,
			true
		);
	}
}
