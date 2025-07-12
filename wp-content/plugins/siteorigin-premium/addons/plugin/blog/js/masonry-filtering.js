/* globals jQuery, sowb */

var sowb = window.sowb || {};

jQuery( function ( $ ) {

	sowb.setupBlogMasonryFiltering = function () {
		$( '.sow-masonry-filtering' ).each( function () {
			const $$ = $( this );
			const $buttons = $$.find( '.sow-masonry-filter-terms button' );
			const $container = $$.find( '.sow-blog-posts' );

			$container.isotope( {
				itemSelector: '.sow-masonry-filtering-item',
				filter: '*',
				layoutMode: 'fitRows',
				resizable: true,
			} );

			$buttons.on( 'click', function() {
				const $this = $( this );
				const selector = $this.attr( 'data-filter' );

				$container.isotope( {
					filter: selector,
				} );

				$buttons.removeClass( 'active' );
				$this.addClass( 'active' );
				return false;
			} );
		} );
	};

	sowb.setupBlogMasonryFiltering();

	$( sowb ).on( 'setup_widgets', sowb.setupBlogMasonryFiltering );
} );

window.sowb = sowb;
