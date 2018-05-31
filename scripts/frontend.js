// This script is loaded both on the frontend page and in the Visual Builder.

jQuery(function($) {

	$( document ).ready( resizeFlipBox );

	$( window ).resize( resizeFlipBox );

	function resizeFlipBox() {

		console.log('resize');
		// Get an array of all element heights
		var elementHeights = null;
		$( '.et_pb_row' ).each( function() {

			var flixboxModulesChilds = $( this ).find( '.mc_et_pb_flipbox_child > div:first-child' );

			var elementHeights = $( flixboxModulesChilds ).map( function() {
				return $( this ).outerHeight();
			}).get();

			var flixboxModules = $( this ).find( '.mc_et_pb_flipbox_child, .mc_et_pb_flipbox' );

			// Math.max takes a variable number of arguments
			// `apply` is equivalent to passing each height as an argument
			var maxHeight = Math.max.apply( null, elementHeights );
			// Set each height to the max height
			$( flixboxModules ).height( maxHeight );
		});
	}

	$('.mc_et_pb_flipbox').hover( function() {

		count_child = $( this ).find('.mc_et_pb_flipbox_child').length;
		if ( count_child > 1 ) {
		    $( '.mc_et_pb_flipbox_child' ).removeClass('hidden');
		    $( '.mc_et_pb_flipbox_child' ).removeClass('visible');

	    	main = $( this ).find( '.mc_et_pb_flipbox_child:first-child' );
	        next = $( main ).next( '.mc_et_pb_flipbox_child' );

	        $( next ).toggleClass('visible');
	        $( main ).toggleClass( 'hidden' );
	    }

	}, function() {
		if ( count_child > 1 ) {
			$( next ).toggleClass('visible');
			$( main ).toggleClass( 'hidden' );
		}
	});

	/*$('.mc_et_pb_flipbox').click( function(e) {
		e.preventDefault();
		console.log('clicked');
		var main_parent = $( this ).parents( '.mc_et_pb_flipbox_child' );
		var parent = $( this ).parents( '.mc_et_pb_flipbox_child > div:first-child' );
		console.log(main_parent);
		//$( parent ).addClass( 'hidden' );
		$( '.mc_et_pb_flipbox_child' ).removeClass('hidden');
		$( '.mc_et_pb_flipbox_child' ).removeClass('visible');		
		//$('.rotate_button').not( this ).parents( '.mc_et_pb_flipbox_child > div:first-child' ).removeClass('visible');
		var next = $( main_parent ).next( '.mc_et_pb_flipbox_child' );
		console.log(next);
		$( next ).toggleClass('visible');
		$( main_parent ).toggleClass( 'hidden' );
		
		//$( next ).find( '> div:first-child' ).addClass('visible');
		//$( next ).find( '.et_pb_module_inner' ).addClass('visible');
		
		//$('.rotate_button').not( this ).parents( '.mc_et_pb_flipbox_child' ).addClass('hidden');
	});*/

});

