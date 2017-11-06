( function( $ ) {
	$( document ).on( 'ready post-load', function() {
		var $container = $( '#content' );
		
		$container.imagesLoaded( function() {
			$container.masonry( {
				itemSelector: '.hentry',
				columnWidth: 397
			} );
		} );
	} );
} ) ( jQuery )