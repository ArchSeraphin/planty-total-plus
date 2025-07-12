/* global jQuery, soWidgets */

jQuery( function( $ ) {
	window.SiteOriginPremium = window.SiteOriginPremium || {};

	SiteOriginPremium.CrossDomainCopyPasteAddon = function() {
		return {
			action: function( data ) {
				// Does navigator exist? If not, return false.
				if ( typeof navigator == 'undefined' ) {
					return false;
				}

				navigator.clipboard.writeText( JSON.stringify( data.data ) );
			},
			// Required by PB.
			copy: function ( data ) {
				this.action( { method: 'set', data: data } );
			},

			paste: function() {
				pasteData = this.action( { method: 'get' } );
			}
		}
	};

	// The Copy Paste Addon requires a secure connection.
	$( 'body' ).on( 'siteorigin_addon_status_changed', function( e, addon ) {
		if (
			addon.id == 'plugin/cross-domain-copy-paste' &&
			addon.status == 1 &&
			window.location.protocol == 'http:'
		) {
			alert( soPremiumCrossDomainCopyPaste.https );
			$( '.so-addon[data-id="plugin/cross-domain-copy-paste"] .so-addon-deactivate' ).trigger( 'click' );
		}

	} );

	// Handling adding pasted data.
	$( document ).on( 'paste', '.siteorigin-widget-field-copy_paste_data textarea', function() {
		const field = $( this ).parents( '.siteorigin-widget-field-copy_paste_data' );
		// Delay processing the paste due to there sometimes being a delay after larger pastes.
		setTimeout( function() {
			const data = field.find( 'textarea' ).val();
			let message = soPremiumCrossDomainCopyPaste.fail;
			if ( data != '' ) {
				try {
					const jsonData = JSON.parse( data );
					if (
						typeof jsonData.class != 'undefined' || // Widget.
						typeof jsonData.thingType != 'undefined' // Row.
					) {
						localStorage.setItem( 'panels_clipboard_' + userSettings.uid, data );
						message = soPremiumCrossDomainCopyPaste.success;
					} else {
						return false;
					}
				} catch ( e ) {
					// Outputting the issue should help with debugging.
					console.log( e );
					message = soPremiumCrossDomainCopyPaste.fail;
				}
			}
			field.find( '.siteorigin-widget-field-label' ).text( message );
			field.find( 'textarea' ).val( '' );
		}, 150 );
	} );
} );
