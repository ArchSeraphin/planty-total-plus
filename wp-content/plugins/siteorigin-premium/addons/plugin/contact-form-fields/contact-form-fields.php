<?php
/*
Plugin Name: SiteOrigin Contact Form
Description: Enhance SiteOrigin forms with a Layout Builder, Autoresponder, Location/Datetime Picker Fields, and Merge Tags for advanced form customization.
Version: 1.0.0
Author: SiteOrigin
Author URI: https://siteorigin.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Documentation: https://siteorigin.com/premium-documentation/plugin-addons/contact-form-fields/
Tags: Widgets Bundle
Video: 314963239
Requires: so-widgets-bundle/contact
*/

class SiteOrigin_Premium_Plugin_Contact_Form_Fields {
	public $merge_tags = array();

	public function __construct() {
		add_action( 'init', array( $this, 'init_addon' ) );
	}

	public static function single() {
		static $single;

		return empty( $single ) ? $single = new self() : $single;
	}

	public function init_addon() {
		$this->add_filters();
	}

	public function add_filters() {
		if ( class_exists( 'SiteOrigin_Widgets_ContactForm_Widget' ) ) {
			add_filter( 'siteorigin_widgets_form_options_sow-contact-form', array( $this, 'admin_form_options' ), 10, 2 );
			add_filter( 'siteorigin_widgets_contact_form_field_class_paths', array( $this, 'premium_contactform_fields_class_paths' ) );
			add_action( 'siteorigin_widgets_contact_sent', array( $this, 'contact_email_sent_success' ), 9, 2 );
			add_action( 'siteorigin_widgets_enqueue_frontend_scripts_sow-contact-form', array( $this, 'enqueue_front_end_scripts' ), 10, 2 );
			add_filter( 'siteorigin_widgets_instance_sow-contact-form', array( $this, 'modify_instance' ) );
			add_filter( 'siteorigin_widgets_form_instance_sow-contact-form', array( $this, 'modify_instance' ) );
			add_filter( 'siteorigin_widgets_less_variables_sow-contact-form', array( $this, 'add_location_less_variables' ), 20, 2 );
			add_filter( 'siteorigin_widgets_less_vars_sow-contact-form', array( $this, 'add_location_less' ), 20, 3 );

			add_filter( 'siteorigin_widgets_contact_post_var_field', array( $this, 'store_merge_tag' ), 10, 2 );
			add_filter( 'siteorigin_widgets_contact_email_fields', array( $this, 'inject_merge_tags' ) );
			add_filter( 'siteorigin_widgets_contact_success_message', array( $this, 'inject_merge_tags' ) );
			add_filter( 'siteorigin_premium_contact_auto_responder_subject', array( $this, 'inject_merge_tags' ) );
			add_filter( 'siteorigin_premium_contact_auto_responder_message', array( $this, 'inject_merge_tags' ) );
		}
		add_action( 'siteorigin_premium_version_update', array( $this, 'update_settings_migration' ), 20, 3 );
	}

	/**
	 * Tell the autoloader where to look for premium contact form field classes.
	 *
	 * @return array
	 */
	public function premium_contactform_fields_class_paths( $class_paths ) {
		$class_paths[] = plugin_dir_path( __FILE__ ) . 'fields/';

		return $class_paths;
	}

	public function get_settings_form() {
		$years = range(
			apply_filters( 'siteorigin_premium_datepicker_max_year', date( 'Y' ) - 1 ),
			apply_filters( 'siteorigin_premium_datepicker_min_year', date( 'Y' ) - 110 )
		);

		// Set array indexes to year to account for new years automatically.
		$years = array_combine(
			$years,
			$years
		);

		$max_years = array(
			'current' => __( 'Current year', 'siteorigin-premium' ),
			'next' => __( 'Next year', 'siteorigin-premium' ),
		) + $years;

		return new SiteOrigin_Premium_Form(
			'so-addon-contact-form-fields-settings',
			array(
				'year_range_min' => array(
					'type' => 'select',
					'label' => __( 'Datepicker min year', 'siteorigin-premium' ),
					'options' => array_reverse( $years, true ),
				),
				'year_range_max' => array(
					'type' => 'select',
					'label' => __( 'Datepicker max year', 'siteorigin-premium' ),
					'options' => $max_years,
					'default' => 'current',
				),
				'use_date_format' => array(
					'type' => 'checkbox',
					'label' => __( 'Use WordPress date format', 'siteorigin-premium' ),
				),
			)
		);
	}

	public function admin_form_options( $form_options, $widget ) {
		if ( empty( $form_options ) ) {
			return $form_options;
		}

		$position = array_key_exists( 'spam', $form_options ) ? 'spam' : count( $form_options );

		$current_user = wp_get_current_user();

		siteorigin_widgets_array_insert( $form_options, $position, array(
			'use_auto_responder' => array(
				'type' => 'checkbox',
				'label' => __( 'Use autoresponder.', 'siteorigin-premium' ),
				'default' => false,
				'state_emitter' => array(
					'callback' => 'conditional',
					'args' => array(
						'use_auto_responder[show]: val',
						'use_auto_responder[hide]: ! val',
					),
				),
			),
			'auto_responder' => array(
				'type' => 'section',
				'label' => __( 'Autoresponder', 'siteorigin-premium' ),
				'hide' => true,
				'fields' => array(
					'from_name' => array(
						'type' => 'text',
						'label' => __( 'From name', 'siteorigin-premium' ),
						'default' => $current_user->display_name,
						'description' => __( 'The name of the person the automatic response email will come from.', 'siteorigin-premium' ),
					),
					'from_email' => array(
						'type' => 'text',
						'label' => __( 'From email', 'siteorigin-premium' ),
						'description' => __( 'The email address the automatic response email will come from.', 'siteorigin-premium' ),
					),
					'subject' => array(
						'type' => 'text',
						'label' => __( 'Response email subject', 'siteorigin-premium' ),
						'default' => __( 'Message received!', 'siteorigin-premium' ),
					),
					'message' => array(
						'type' => 'tinymce',
						'label' => __( 'Response email message', 'siteorigin-premium' ),
						'default' => __( 'Thanks for contacting us. We\'ll get back to you shortly.', 'siteorigin-premium' ),
					),
				),
				'state_handler' => array(
					'use_auto_responder[show]' => array( 'slideDown' ),
					'use_auto_responder[hide]' => array( 'slideUp' ),
				),
			),
		) );

		$fields = $form_options['fields']['fields'];
		$field_types = $fields['type']['options'];
		siteorigin_widgets_array_insert( $fields, 'required', array(
			'merge_tag' => array(
				'type'    => 'text',
				'label'   => __( 'Merge Tag', 'siteorigin-premium' ),
				'description'   => __( 'Merge tags can added to the Subject, Success, and Auto Responder messages. Insert your tag name in the field above and output the tag by wrapping it in square brackets, for [example].', 'siteorigin-premium' ),
			),
		) );

		$field_types = array_merge( $field_types, array(
			'datepicker' => __( 'Datetime Picker', 'siteorigin-premium' ),
			'location' => __( 'Location', 'siteorigin-premium' ),
			'builder' => __( 'Layout Builder', 'siteorigin-premium' ),
		) );

		$fields = array_merge( $fields, array(
			// For location fields.
			// These are only required when location is selected.
			'location_options' => array(
				'type' => 'section',
				'label' => __( 'Location Options', 'siteorigin-premium' ),
				'fields' => array(
					'show_map' => array(
						'type' => 'checkbox',
						'label' => __( 'Show Google Map', 'siteorigin-premium' ),
						'default' => true,
						'description' => __( 'Clicking on the map will guess the closest address and the map will try to display the address entered into the text input', 'siteorigin-premium' ),
					),
					'map_id' => array(
						'type' => 'text',
						'label' => __( 'Map ID', 'siteorigin-premium' ),
						'description' => sprintf(
							__( 'A Map ID allows you to manage your map styles using the %sGoogle Cloud Console%s. This is only used if Map Styles are not set.', 'siteorigin-premium' ),
							'<a href="https://console.cloud.google.com/google/maps-apis/studio/maps" target="_blank" rel="noopener noreferrer">',
							'</a>'
						),
					),
					'default_location' => array(
						'type' => 'location',
						'label' => __( 'Default location', 'siteorigin-premium' ),
					),
					'center_user_location' => array(
						'type' => 'checkbox',
						'label' => __( "Center on user's location", 'siteorigin-premium' ),
						'default' => false,
						'description' => __( 'The user will be prompted to accept before centering. The Map Default location will be used as a fallback. Requires HTTPS.', 'siteorigin-premium' ),
					),
				),

				'state_handler' => array(
					'field_type_{$repeater}[location]' => array( 'show' ),
					'_else[field_type_{$repeater}]' => array( 'hide' ),
				),
			),

			// For datetime picker fields.
			'datetime_options' => array(
				'type' => 'section',
				'label' => __( 'Datetime Options', 'siteorigin-premium' ),
				'fields' => array(
					'show_datepicker' => array(
						'type' => 'checkbox',
						'label' => __( 'Show Date Picker', 'siteorigin-premium' ),
						'default' => true,
					),
					'calendar_always_visible' => array(
						'type' => 'checkbox',
						'label' => __( 'Calendar Always Visible', 'siteorigin-premium' ),
						'default' => false,
					),
					'datepicker_label' => array(
						'type' => 'text',
						'label' => __( 'Date Picker Label', 'siteorigin-premium' ),
						'default' => __( 'Date', 'siteorigin-premium' ),
					),
					'first_day' => array(
						'type' => 'radio',
						'label' => __( 'First Day of the Week', 'siteorigin-premium' ),
						'default' => 'sunday',
						'options' => array(
							'sunday' => __( 'Sunday', 'siteorigin-premium' ),
							'monday' => __( 'Monday', 'siteorigin-premium' ),
						),
					),
					'disable_days' => array(
						'type' => 'radio',
						'label' => __( 'Disable', 'siteorigin-premium' ),
						'default' => 'none',
						'options' => array(
							'none' => __( 'None', 'siteorigin-premium' ),
							'weekends' => __( 'Weekends', 'siteorigin-premium' ),
							'weekdays' => __( 'Weekdays', 'siteorigin-premium' ),
						),
					),
					'datepicker_prefill' => array(
						'type' => 'checkbox',
						'label' => __( 'Prefill Date Picker With Current Date', 'siteorigin-premium' ),
						'default' => false,
					),
					'disabled_dates' => array(
						'type' => 'text',
						'label' => __( 'Disable Dates', 'siteorigin-premium' ),
						'description' => __( 'Specify specific dates, date ranges or weekdays to disable. Dates should be of the format YYYYMMDD e.g. 20160806 and date ranges should be separated by a hyphen e.g. 20160902-20160918. Week days should be the first three letters of the day e.g. Mon,Wed,Fri. Multiple dates, ranges and days should separated by a comma e.g. 20160825,20160902-20160918,Sun,Fri.', 'siteorigin-premium' ),
					),
					'show_timepicker' => array(
						'type' => 'checkbox',
						'label' => __( 'Show Time Picker', 'siteorigin-premium' ),
						'default' => false,
					),
					'timepicker_label' => array(
						'type' => 'text',
						'label' => __( 'Time Picker Label', 'siteorigin-premium' ),
						'default' => __( 'Time', 'siteorigin-premium' ),
					),
					'timepicker_custom_format' => array(
						'type' => 'checkbox',
						'label' => __( 'Use 24h format.', 'siteorigin-premium' ),
						'default' => false,
					),
					'timepicker_prefill' => array(
						'type' => 'checkbox',
						'label' => __( 'Prefill Time Picker With Current Time', 'siteorigin-premium' ),
						'default' => true,
					),
					'disabled_times' => array(
						'type' => 'text',
						'label' => __( 'Disabled Times', 'siteorigin-premium' ),
						'description' => __( 'Specify disabled times. Ranges should be specified with a dash and multiple ranges should be separated with a comma. E.g. 5:00pm-8:00am,1pm-14:30', 'siteorigin-premium' ),
					),
					'hide_disabled_times' => array(
						'type' => 'checkbox',
						'label' => __( 'Hide Disabled Times', 'siteorigin-premium' ),
						'default' => false,
					),
				),

				'state_handler' => array(
					'field_type_{$repeater}[datepicker]' => array( 'show' ),
					'_else[field_type_{$repeater}]' => array( 'hide' ),
				),
			),

			// For Builder Field.
			'builder_options' => array(
				'type' => 'builder',
				'label' => __( 'Builder Field', 'siteorigin-premium' ),
				'state_handler' => array(
					'field_type_{$repeater}[builder]' => array( 'show' ),
					'_else[field_type_{$repeater}]' => array( 'hide' ),
				),
			),
		) );

		$fields['type']['options'] = $field_types;
		$form_options['fields']['fields'] = $fields;

		return $form_options;
	}

	public function contact_email_sent_success( $instance, $email_fields ) {
		if ( ! empty( $instance['use_auto_responder'] ) ) {
			$this->send_auto_response( $email_fields, $instance );
		}
	}

	public function send_auto_response( $email_fields, $instance ) {
		if ( empty( $instance['auto_responder'] ) ) {
			return;
		}

		$auto_responder = $instance['auto_responder'];

		// Need to have an email address to which to send the auto response.
		if ( empty( $email_fields[ 'email' ] ) ) {
			return;
		}

		$response_email_address = sanitize_email( $email_fields[ 'email' ] );

		$subject = apply_filters(
			'siteorigin_premium_contact_auto_responder_subject',
			empty( $auto_responder['subject'] ) ?
				esc_html__( 'Message received!', 'siteorigin-premium' ) :
				$auto_responder['subject']
		);

		$message = apply_filters(
			'siteorigin_premium_contact_auto_responder_message',
			empty( $auto_responder['message'] ) ?
				esc_html__( 'Thanks for contacting us. We\'ll get back to you shortly.', 'siteorigin-premium' ) :
				wpautop( wp_kses_post( $auto_responder['message'] ) )
		);

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . SiteOrigin_Widgets_ContactForm_Widget::sanitize_header( $auto_responder['from_name'] ) . ' <' . sanitize_email( $auto_responder['from_email'] ) . '>',
			'Reply-To: ' . SiteOrigin_Widgets_ContactForm_Widget::sanitize_header( $auto_responder['from_name'] ) . ' <' . sanitize_email( $auto_responder['from_email'] ) . '>',
		);

		$mail_success = wp_mail( $response_email_address, $subject, $message, $headers );

		return $mail_success;
	}

	public function enqueue_front_end_scripts( $instance, $widget ) {
		$fields = empty( $instance['fields'] ) ? array() : $instance['fields'];
		$has_datepicker = false;
		$has_timepicker = false;

		foreach ( $fields as $field ) {
			if ( $field['type'] == 'datepicker' ) {
				$datetime_options = $field['datetime_options'];
				$has_datepicker = $has_datepicker || $datetime_options['show_datepicker'];
				$has_timepicker = $has_timepicker || $datetime_options['show_timepicker'];
			} elseif ( $field['type'] == 'location' && ! empty( $field['location_options']['center_user_location'] ) ) {
				wp_enqueue_script( 'siteorigin-premium-map-user-location' );
			}
		}

		$datepicker_deps = array( 'jquery' );

		if ( $has_datepicker || is_admin() ) {
			wp_enqueue_script(
				'moment-js',
				plugin_dir_url( __FILE__ ) . 'fields/js/moment' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
				array( 'jquery' ),
				false
			);
			wp_enqueue_style( 'sowb-pikaday' );
			wp_enqueue_script( 'sowb-pikaday-jquery' );
			array_push( $datepicker_deps, 'moment-js', 'sowb-pikaday' );
		}

		if ( $has_timepicker || is_admin() ) {
			wp_enqueue_style(
				'jquery-timepicker',
				plugin_dir_url( __FILE__ ) . 'fields/css/jquery.timepicker.css'
			);
			wp_enqueue_script(
				'jquery-timepicker',
				plugin_dir_url( __FILE__ ) . 'fields/js/jquery.timepicker' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
				array( 'jquery' ),
				SITEORIGIN_PREMIUM_VERSION
			);
			array_push( $datepicker_deps, 'jquery-timepicker' );
		}

		wp_enqueue_style(
			'so-contactform-datepicker',
			plugin_dir_url( __FILE__ ) . 'fields/css/so-contactform-datepicker.css'
		);
		wp_enqueue_script(
			'so-contactform-datepicker',
			plugin_dir_url( __FILE__ ) . 'fields/js/so-contactform-datepicker' . SITEORIGIN_PREMIUM_JS_SUFFIX . '.js',
			$datepicker_deps,
			SITEORIGIN_PREMIUM_VERSION
		);
	}

	public function modify_instance( $instance ) {
		// The API key form field has been removed.
		if ( ! empty( $instance['location_options'] ) && ! empty( $instance['location_options']['gmaps_api_key'] ) ) {
			$maps_widget = new SiteOrigin_Widget_GoogleMap_Widget();
			$global_settings = $maps_widget->get_global_settings();

			if ( ! empty( $global_settings['api_key'] ) ) {
				unset( $instance['location_options']['gmaps_api_key'] );
			}
		}

		return $instance;
	}

	public function add_location_less_variables( $less_variables, $instance ) {
		$fields = empty( $instance['fields'] ) ? array() : $instance['fields'];

		foreach ( $fields as $field ) {
			if ( $field['type'] == 'location' ) {
				$maps_widget = new SiteOrigin_Widget_GoogleMap_Widget();
				$global_settings = $maps_widget->get_global_settings();

				$less_variables['height'] = '200px';
				$less_variables['map_consent'] = ! empty( $global_settings['map_consent'] );

				if ( $less_variables['map_consent'] && ! empty( $global_settings['map_consent_design'] ) ) {
					$map_content_settings = array(
						'text',
						'button',
						'background',
					);

					foreach ( $map_content_settings as $setting ) {
						if ( ! empty( $global_settings['map_consent_design'][ $setting ] ) && is_array( $global_settings['map_consent_design'][ $setting ] ) ) {
							foreach ( $global_settings['map_consent_design'][ $setting ] as $style => $value ) {
								if ( ! empty( $value ) ) {
									$less_variables[ 'map_consent_notice_' . $setting . '_' . $style ] = $value;
								}
							}
						}
					}
				}

				break;
			}
		}

		return $less_variables;
	}

	public function add_location_less( $less, $vars, $instance ) {
		$fields = empty( $instance['fields'] ) ? array() : $instance['fields'];

		foreach ( $fields as $field ) {
			if ( $field['type'] !== 'location' ) {
				continue;
			}

			$less_file = siteorigin_widget_get_plugin_dir_path( 'google-map' ) . 'styles/default.less';

			if ( substr( $less_file, -5 ) == '.less' && file_exists( $less_file ) ) {
				$maps_less = file_get_contents( $less_file );

				// Prevent error due to importing mixins twice.
				$less .= str_replace( '@import "../../../base/less/mixins";', '', $maps_less );
			}

			break;
		}

		if ( ! empty( $instance['design']['fields']['multi_margin'] ) ) {
			$field_margin = $this->sanitize_field_margin( $instance['design']['fields']['multi_margin'] );

			$less .= '.sow-google-map-canvas {
				margin: ' . $field_margin . ';
			}';
		}

		return $less;
	}

	/**
	 * Sanitize field margin string.
	 *
	 * Takes a space-separated margin string (e.g. "23px 24% 0px 1px")
	 * and ensures each value has a valid number and unit. Invalid
	 * values are defaulted to "0px".
	 *
	 * @param string $field_margin Space-separated margin values with units
	 *
	 * @return string Sanitized margin string with validated values
	 */
	private function sanitize_field_margin( $field_margin ) {
		$parts = explode( ' ', $field_margin );
		$allowed_units = array( 'px', '%' );
		$sanitized = array();

		foreach ( $parts as $part ) {
			preg_match( '/^(\d+)(.*)$/', $part, $matches );

			// Is this part correctly structured?
			if ( ! empty( $matches[1] ) &&
				in_array( $matches[2], $allowed_units )
			) {
				$sanitized[] = $matches[1] . $matches[2];
			} else {
				$sanitized[] = '0px';
			}
		}

		return implode( ' ', $sanitized );
	}

	public function update_settings_migration( $new_version, $old_version ) {
		$premium_options = SiteOrigin_Premium_Options::single();
		$contact_form_fields_settings = $premium_options->get_settings( 'plugin/contact-form-fields' );

		// If upgrading from a version of SO Premium prior to 1.28.4, check if we need to migrate from 2021 to Current Year.
		if (
			version_compare( $old_version, '1.28.4', '<=' ) &&
			! empty( $contact_form_fields_settings ) &&
			! empty( $contact_form_fields_settings['year_range_max'] ) &&
			$contact_form_fields_settings['year_range_max'] == 2021
		) {
			$contact_form_fields_settings['year_range_max'] = 'current';

			$premium_options->save_settings( 'plugin/contact-form-fields', $contact_form_fields_settings );
		}
	}

	/**
	 * Searches for merge tags and replaces them.
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public function apply_merge_tag( &$value ) {
		preg_match_all( '/\[(.*?)\]/', $value, $matches, PREG_SET_ORDER );

		foreach ( $matches as $match ) {
			if ( ! empty( $match[1] ) && ! empty( $this->merge_tags[ $match[1] ] ) ) {
				$value = str_replace( $match[0], $this->merge_tags[ $match[1] ], $value );
			}
		}
		return $value;
	}

	public function inject_merge_tags( $value ) {
		if ( current_filter() == 'siteorigin_widgets_contact_email_fields' ) {
			$this->apply_merge_tag( $value['subject'] );
		} else {
			$this->apply_merge_tag( $value );
		}

		return $value;
	}

	public function store_merge_tag( $value, $field ) {
		if ( ! empty( $field['merge_tag'] ) ) {
			$this->merge_tags[ $field['merge_tag'] ] = $value;
		}
	}

}
