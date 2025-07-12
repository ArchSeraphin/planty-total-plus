jQuery( function( $ ) {
	const $indicator = $( '.so-maintenance-mode-indicator' );

	jQuery( 'body' ).on( 'siteorigin_addon_settings_saved', function( e, data ) {

		const $form = $( '#siteorigin-premium-settings-dialog form' );
		const maintenanceModeStatus = $form.find( '.siteorigin-widget-field-enabled input' ).is( ':checked' );

		if ( maintenanceModeStatus ) {
			$indicator.show();
		} else {
			$indicator.hide();
		}
	} );
} );
