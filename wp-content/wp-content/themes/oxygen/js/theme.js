( function( $ ){

	/* Remove a class from the body tag if JavaScript is enabled */
	$( 'body' ).removeClass( 'no-js' );

	/* Masonry */

	/* Since wp_localize_script passes the data as text, convert it to boolean for later use */
	if ( masonry_setting.isRTL == 'true' ) {
		masonry_setting.isRTL = true;
	} else {
		masonry_setting.isRTL = false;
	}

	var $container = $( '.hfeed-more');
	var width = $container.width();
	$container.imagesLoaded( function() {
		$container.masonry( {
			itemSelector: '.hentry',
			columnWidth: width * 0.4787234042553191,
			gutterWidth: width * 0.0425531914893617,
			isResizable: true,
			isRTL: masonry_setting.isRTL
		} );
	} );

	/* Cycle */
	$( '#featured-content' ).cycle( {
		slideExpr: '.featured-post',
		fx: 'fade',
		speed: 500,
		timeout: 6000,
		cleartypeNoBg: true,
		pager: '#slide-thumbs',
		slideResize: true,
		containerResize: false,
		width: '100%',
		fit: 1,
		prev: '#slider-prev',
		next: '#slider-next',
		pagerAnchorBuilder: function( idx, slide ) {
			// return selector string for existing anchor
			return '#slide-thumbs li:eq(' + idx + ') a';
    	}
	} );
} )( jQuery );