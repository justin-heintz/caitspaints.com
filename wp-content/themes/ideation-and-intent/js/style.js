jQuery( document ).ready( function( $ ) {
	var $menu = $( '.main-navigation' ),
		timeout = false;

	function toggleClass( $obj, left ) {
		var classname = 'main-navigation-lone';
		if ( 0 == left )
			$obj.addClass( classname );
		else
			$obj.removeClass( classname );
	}

	if ( 0 != $menu.length ) {
		toggleClass( $menu, $menu.position().left );

		$( window ).resize( function() {
			if ( false !== timeout )
				clearTimeout( timeout );

			timeout = setTimeout( function() {
				toggleClass( $menu, $menu.position().left );
			}, 200 );
		} );
	}
} );
