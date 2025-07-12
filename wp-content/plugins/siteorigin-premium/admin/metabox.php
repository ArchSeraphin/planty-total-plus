<?php

/**
 * This metabox is the box that appears when users create new custom layouts..
 */
class SiteOrigin_Premium_Metabox extends SiteOrigin_Widget {
	private $ignore_fields = array(
		'tab',
		'type',
		'section',
		'hide',
		'label',
		'options',
		'state_handler',
		'state_emitter',
		'args',
		'callback',
		'default',
		'description',
		'fallback',
	);

	private $special_keys = array(
		'so_field_container_state',
		'_sow_form_timestamp',
		'_sow_form_id'
	);

	public function __construct() {
		parent::__construct(
			'siteorigin-premium',
			__( 'SiteOrigin Premium', 'siteorigin-premium' ),
			array(
				'has_preview' => false,
			),
			array(),
			false,
			plugin_dir_path( __FILE__ )
		);
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'metabox_save' ), 10, 3 );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	public function add_metabox( $post_type ) {
		$excluded_types = apply_filters( 'siteorigin_premium_metabox_excluded_post_types', array(
			'so_mirror_widget',
			'so_custom_post_type',
			'acf-field-group',
			'acf-post-type',
			'acf-taxonomy',
			'acf-field-group',
		) );

		if ( ! in_array( $post_type, $excluded_types ) ) {
			add_meta_box(
				'siteorigin_premium_metabox',
				__( 'SiteOrigin Premium', 'siteorigin-premium' ),
				array( $this, 'render_metabox' ),
				$post_type,
				'advanced',
				'default',
				array(
					'__block_editor_compatible_meta_box' => true,
				)
			);
		}
	}

	public function get_widget_form() {
		$form_options = apply_filters( 'siteorigin_premium_metabox_form_options', array(
			'general' => array(
				'type' => 'section',
				'label' => __( 'General', 'siteorigin-premium' ),
				'tab' => true,
				'hide' => true,
				'fields' => array(),
			),
		) );

		// If there aren't any general fields, remove the tab.
		if ( empty( $form_options['general']['fields'] ) ) {
			unset( $form_options['general'] );
		}

		if ( class_exists( 'SiteOrigin_Widget_Field_Tabs' ) ) {
			// If WB is new enough to support the Tabs field, add it.
			$tabs = array();

			foreach ( $form_options as $id => $field ) {
				if ( isset( $field['tab'] ) ) {
					$tabs[ $id ] = $field['label'];
				}
			}

			if ( ! empty( $tabs ) ) {
				$form_options = array(
					'tabs' => array(
						'type' => 'tabs',
						'tabs' => $tabs,
					),
				) + $form_options;
			}
		}

		return $form_options;
	}

	public function render_metabox( $post ) {
		$meta = get_post_meta( $post->ID, 'siteorigin_premium_meta', true );

		$this->form(
			apply_filters(
				'siteorigin_premium_metabox_meta',
				! empty( $meta ) ? $meta : array(),
				$post
			)
		);
		wp_nonce_field( 'siteorigin_premium_metabox_save', '_siteorigin_premium_metabox_save_nonce' );
	}

	/**
	 * Ensure all fields from form_options are present in instance.
	 *
	 * This function processes the form options array and the values array,
	 * ensuring that all fields are present in the instance array. It does
	 * this by rebuilding the $instance array.
	 *
	 * WB specific values instance variables are maintained.
	 *
	 * @param array $form_options The form options array.
	 * @param array $values The values array.
	 *
	 * @return array The modified instance array.
	*/
	private function ensure_all_fields_present( $form_options, $values ) {
		$instance = array();

		foreach ( $form_options as $id => $field ) {
			if ( in_array( $id, $this->ignore_fields ) ) {
				continue;
			}

			if ( $field['type'] === 'section' ) {
				$instance[ $id ] = $this->ensure_all_fields_present(
					$field['fields'],
					isset( $values[ $id ] ) ? $values[ $id ] : array()
				);
				continue;
			}

			// If there is a value for this field, and it's an array, we need to
			// handle it slightly differently to support multiple select fields.
			if (
				isset( $values[ $id ] ) &&
				is_array( $values[ $id ] )
			) {
				$instance[ $id ] = count( $values[ $id ] ) > 1 ? $values[ $id ] : $values[ $id ][0];
				continue;
			}

			$instance[ $id ] = isset( $values[ $id ] ) ? $values[ $id ] : '';

			// Measurement fields store the unit in a separate field.
			if (
				! empty( $instance[ $id ] ) &&
				$field['type'] === 'measurement'
			) {
				$instance[ $id . '_unit' ] = isset( $values[ $id . '_unit' ] ) ? $values[ $id . '_unit' ] : 'px';
			}
		}

		// Include WB specific values not found in form options.
		foreach ( $values as $id => $value ) {
			if (
				! isset( $id, $instance ) &&
				in_array( $id, $this->special_keys )
			) {
				 $instance[ $id ] = $value;
			}
		}

		return $instance;
	}

	public function metabox_save( $post_id ) {
		if (
			empty( $_POST['_siteorigin_premium_metabox_save_nonce'] ) ||
			! wp_verify_nonce( $_POST['_siteorigin_premium_metabox_save_nonce'], 'siteorigin_premium_metabox_save' ) ||
			! current_user_can( 'edit_post', $post_id )
		) {
			return;
		}

		if (
			! empty( $_POST['widget-siteorigin-premium'] ) &&
			! empty( $_POST['widget-siteorigin-premium'][1] )
		) {
			$values = $_POST['widget-siteorigin-premium'][1];
			$form_options = $this->get_widget_form();
			unset( $form_options['tabs'] );

			$old_instance = get_post_meta( $post_id, 'siteorigin_premium_meta', true );

			// Run regular WB widget update process.
			$instance = parent::update(
				$values,
				! empty( $old_instance ) ? $old_instance : false,
				'metabox'
			);

			$instance = $this->ensure_all_fields_present( $form_options, $instance );

			update_post_meta(
				$post_id,
				'siteorigin_premium_meta',
				$instance
			);
		}

		do_action( 'siteorigin_premium_metabox_save', $post_id );
	}

	public function enqueue_admin_scripts() {
		wp_enqueue_script(
			'siteorigin-premium-metabox',
			plugin_dir_url( __FILE__ ) . 'js/metabox' . SOW_BUNDLE_JS_SUFFIX . '.js',
			array( 'jquery' ),
			SOW_BUNDLE_VERSION
		);
		wp_enqueue_style(
			'siteorigin-premium-metabox',
			plugin_dir_url( __FILE__ ) . 'css/metabox.css',
			SOW_BUNDLE_VERSION
		);
	}
}
