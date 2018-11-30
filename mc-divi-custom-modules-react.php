<?php
/*
Plugin Name: Mc Divi Custom Modules React
Plugin URI:  
Description: Add some custom modules to Divi Builder
Version:     1.0.1
Author:      Marie Comet
Author URI:  https://mariecomet.fr
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: mdcm-mc-divi-custom-modules-react
Domain Path: /languages

Mc Divi Custom Modules React is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Mc Divi Custom Modules React is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Mc Divi Custom Modules React. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 'mdcm_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function mdcm_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/McDiviCustomModulesReact.php';
}
add_action( 'divi_extensions_init', 'mdcm_initialize_extension' );
endif;
