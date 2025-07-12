<?php
/*
Plugin Name: SiteOrigin Cross Domain Copy Paste
Description: Streamline your site development by effortlessly copying and pasting rows, columns, and widgets across domains, saving time and enhancing creative continuity.
Version: 1.0.0
Author: SiteOrigin
Author URI: https://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Documentation: https://siteorigin.com/premium-documentation/plugin-addons/cross-domain-copy-paste
Tags: Page Builder
Requires: siteorigin-panels
*/

class SiteOrigin_Premium_Plugin_cross_domain_copy_paste {
	public function __construct() {
		add_action( 'siteorigin_panel_enqueue_admin_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_action( 'siteorigin_premium_addons_page_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_filter( 'siteorigin_premium_metabox_form_options', array( $this, 'metabox_options' ), 20 );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	// Add global addon settings.
	public function get_settings_form() {
		return new SiteOrigin_Premium_Form(
			'so-addon-cross-domain-copy-paste-settings',
			array(
				'intro' => array(
					'type' => 'html',
					'markup' => include plugin_dir_path( __FILE__ ) . 'tpl/modal.php',
				),
			)
		);
	}

	public function enqueue_admin_assets( $hook_suffix = '' ) {
		static $assetsOutput = false;

		if ( $assetsOutput ) {
			return;
		}

		$assetsOutput = true;

		$settings = SiteOrigin_Premium_Options::single()->get_settings( 'plugin/cross-domain-copy-paste' );


		if (
			! empty( $hook_suffix ) &&
			$hook_suffix === 'widgets.php'
		) {
			add_action( 'admin_footer-widgets.php', array( $this, 'widgets_page_markup' ) );
		}

		wp_enqueue_script(
			'siteorigin-premium-cross-domain-copy-paste-addon',
			plugin_dir_url( __FILE__ ) . 'js/addon' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
			array( 'jquery' ),
			SITEORIGIN_PREMIUM_VERSION
		);

		wp_localize_script(
				'siteorigin-premium-cross-domain-copy-paste-addon',
				'soPremiumCrossDomainCopyPaste',
				array(
					'loc' => esc_html__( 'Cross Domain Paste', 'siteorigin-premium' ),
					'success' => esc_html__( 'Success. You can now right-click and paste in Page Builder.', 'siteorigin-premium' ),
					'fail' => esc_html__( 'Something went wrong. Please try copying the data again.', 'siteorigin-premium' ),
					'https' => esc_html__( 'Your website must use HTTPS for the SiteOrigin Premium Cross Domain Copy Paste Addon to function.', 'siteorigin-premium' ),
				)
			);

		wp_enqueue_style(
			'siteorigin-premium-cross-domain-copy-paste-addon',
			plugin_dir_url( __FILE__ ) . 'css/addon.css',
			array(),
			SITEORIGIN_PREMIUM_VERSION
		);
	}

	private function get_field_html(): string {
		ob_start();
		?>
		<div class="siteorigin-widget-field siteorigin-widget-field-type-textarea siteorigin-widget-field-copy_paste_data">
			<label for="widget-siteorigin-premium-1-copy_paste-copy_paste_data-1" class="siteorigin-widget-field-label"></label>
			<textarea type="text" name="widget-siteorigin-premium[1][copy_paste][copy_paste_data]" id="widget-siteorigin-premium-1-copy_paste-copy_paste_data-1" rows="4" class="widefat siteorigin-widget-input"></textarea>
		</div>

		<div class="siteorigin-widget-field siteorigin-widget-field-type-html siteorigin-widget-field-note">
			<div class="siteorigin-widget-html-field">
				<?php
				echo sprintf(
					esc_html( __( 'Paste your row or widget data into the above field, then right-click and paste in Page Builder. %sGetting Started%s', 'siteorigin-premium' ) ),
					'<a href="https://siteorigin.com/premium-documentation/plugin-addons/cross-domain-copy-paste/" target="_blank" rel="noopener noreferrer">',
					'</a>'
				);
				?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	public function widgets_page_markup() {
		?>
		<div class="siteorigin-premium-copy-page-widgets" style="display: none;">
			<div class="siteorigin-premium-copy-page-widgets-fields">
				<?php echo $this->get_field_html(); ?>
			</div>
		</div>
		<?php
	}

	public function metabox_options( $form_options ) {
		$settings = SiteOrigin_Premium_Options::single()->get_settings( 'plugin/cross-domain-copy-paste' );

		return $form_options + array(
			'copy_paste' => array(
				'type' => 'section',
				'label' => __( 'Cross Domain Copy Paste' , 'siteorigin-premium' ),
				'tab' => true,
				'hide' => true,
				'fields' => array(
					'copy_paste_data' => array(
						'type' => 'textarea'
					),
					'note' => array(
						'type' => 'html',
						'markup' => sprintf(
							__( 'Paste your row or widget data into the above field, then right-click and paste in Page Builder. %sGetting Started%s' , 'siteorigin-premium' ),
							'<a href="https://siteorigin.com/premium-documentation/plugin-addons/cross-domain-copy-paste/" target="_blank" rel="noopener noreferrer">',
							'</a>'
						),
					),
				),
			),
		);
	}
}
