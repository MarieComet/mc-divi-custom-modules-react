// This script is loaded both on the frontend page and in the Visual Builder.

jQuery(function($) {

	$( document ).ready( resizeFlipBox );

	$( window ).resize( resizeFlipBox );

	function resizeFlipBox() {
		// Get an array of all element heights
		var elementHeights = $( '.dicm_et_pb_flipbox_child .et_pb_module_inner' ).map( function() {
			return $( this ).outerHeight();
		}).get();

		// Math.max takes a variable number of arguments
		// `apply` is equivalent to passing each height as an argument
		var maxHeight = Math.max.apply( null, elementHeights );

		// Set each height to the max height
		$( '.dicm_et_pb_flipbox_child, .dicm_et_pb_flipbox' ).height( maxHeight );
	}
});
