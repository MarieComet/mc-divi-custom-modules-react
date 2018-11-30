<?php
/**
 * Parent module (module which has module item / child module) with FULL builder support
 * This module appears on Visual Builder and requires react component to be provided
 * Due to full builder support, all advanced options (except button options) are added by default
 *
 * @since 1.0.0
 */
class MC_FlipBox_Parent extends ET_Builder_Module {
	// Module slug (also used as shortcode tag)
	public $slug       = 'mc_et_pb_flipbox';

	// Full Visual Builder support
	public $vb_support = 'on';

	// Module item's slug
	public $child_slug = 'mc_et_pb_flipbox_child';

	/**
	 * Module properties initialization
	 *
	 * @since 1.0.0
	 */

	/*function get_main_tabs() {
		$tabs = array(
			'general'    => esc_html__( 'Face', 'et_builder' ),
			'back'  => esc_html__( 'Arrière', 'mdcm-mc-divi-custom-modules-react' ),
			'advanced'   => esc_html__( 'Design', 'et_builder' ),
			'custom_css' => esc_html__( 'Advanced', 'et_builder' ),
		);

		return apply_filters( 'et_builder_main_tabs', $tabs );
	}*/

	function init() {
		// Module name
		$this->name = esc_html__( 'Flip Box', 'mdcm-mc-divi-custom-modules-react' );

		// Module Icon
		// Load customized svg icon and use it on builder as module icon. If you don't have svg icon, you can use
		// $this->icon for using etbuilder font-icon. (See CustomCta / DICM_CTA class)
		$this->icon_path =  plugin_dir_path( __FILE__ ) . 'icon.svg';

		$this->child_item_text	= esc_html__( 'Ajouter une facette (une pour la face, une pour l\'arrière)', 'mdcm-mc-divi-custom-modules-react' );

		//$this->main_tabs = $this->get_main_tabs();
		// Toggle settings
		/*$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Texte avant', 'mdcm-mc-divi-custom-modules-react' ),
				),
			),
		);*/
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	/*function get_fields() {
		return array(
			'title' => array(
				'label'           => esc_html__( 'Title', 'mdcm-mc-divi-custom-modules-react' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Text entered here will appear as title.', 'mdcm-mc-divi-custom-modules-react' ),
				'toggle_slug'     => 'main_content',
				'tab_slug'        => 'general',
			)
		);
	}*/

	/**
	 * Module's advanced fields configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_advanced_fields_config() {
		return array(
			'max_width' => array(
				'use_max_width'        => true, // default
				'use_module_alignment' => true, // default
				'options' => array(
					'max_width' => array(
						'default' => '100%',
						'range_settings'  => array(
							'min'  => '0',
							'max'  => '100',
							'step' => '1',
						),
					),
					'max_width_tablet' => array(
						'default' => '100%',
						'range_settings'  => array(
							'min'  => '0',
							'max'  => '100',
							'step' => '1',
						),
					),
					'max_width_phone' => array(
						'default' => '100%',
						'range_settings'  => array(
							'min'  => '0',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
			),
		);
	}

	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */
	function render( $attrs, $content = null, $render_slug ) {

		// Render module content
		$output = sprintf(
			'%1$s',
			$this->content
		);

		return $output;

		// Render wrapper
		// 3rd party module with no full VB support has to wrap its render output with $this->_render_module_wrapper().
		// This method will automatically add module attributes and proper structure for parallax image/video background
		//return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new MC_FlipBox_Parent;
