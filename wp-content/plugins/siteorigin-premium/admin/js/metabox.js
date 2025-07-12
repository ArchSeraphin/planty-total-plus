jQuery( function( $ ) {
	const $metabox = $( '#siteorigin_premium_metabox' );
	if ( ! $metabox.length ) {
		return;
	}

	// If the metabox is moved to the sidebar we want to collapse the tabs.
	const maybeShowTabs = () => {
		const $tabs = $metabox.find( '.siteorigin-widget-field-type-tabs' );
		if ( ! $tabs ) {
			return;
		}

		// If the tabs are too small (by being placed in the sidebar for example),
		// we want to show the standard sections instead of tabs.
		if ( $tabs.parent().width()>= 500 ) {
			// Tabs are able to be displayed. Hide the sections in favour of tabs.
			$metabox.find( '.sow-tabs-smaller-show' ).removeClass( 'sow-tabs-smaller-show' );
			$tabs.show();
			return;
		}

		if ( $tabs.parent().width() == 0 ) {
			// The parent hasn't rendered completely yet. Try again later.
			setTimeout( maybeShowTabs, 100 );
		} else {
			$tabs.find( 'li' ).each( function( i ) {
				var $item = $( '.siteorigin-widget-field-' + $( this ).data( 'id' ) ).find( '> .siteorigin-widget-field-label' );
				$item.addClass( 'sow-tabs-smaller-show' );

				if ( i == 0 ) {
					$item.addClass( 'siteorigin-widget-section-visible' );
				}
			} );

			$tabs.hide();
		}
	}

	$( '#side-sortables, #normal-sortables, #advanced-sortables' ).on( 'sortstop', maybeShowTabs );
	maybeShowTabs();

	$( '.block-editor-page #siteorigin_premium_metabox > .postbox-header' ).css( 'height', '44px' );
} );
