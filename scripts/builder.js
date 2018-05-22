// This script is loaded both on the frontend page and in the Visual Builder.

jQuery(function($) {
	var flip_box_module = $('div[data-module_type="dicm_cta_parent"]');
	console.log(flip_box_module);
	if ( $( flip_box_module ).length ) {
		console.log('exist');
	}
});
