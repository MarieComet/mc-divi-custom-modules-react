<?php
/**
 * Child module / module item (module which appears inside parent module) with FULL builder support
 * This module appears on Visual Builder and requires react component to be provided
 * Due to full builder support, all advanced options (except button options) are added by default
 *
 * @since 1.0.0
 */
class MC_FlipBox_Child extends ET_Builder_Module {
	// Module slug (also used as shortcode tag)
	public $slug                     = 'mc_et_pb_flipbox_child';

	// Module item has to use `child` as its type property
	public $type                     = 'child';

	// Module item's attribute that will be used for module item label on modal
	public $child_title_var          = 'title';

	// If the attribute defined on $this->child_title_var is empty, this attribute will be used instead
	//public $child_title_fallback_var = 'subtitle';

	// Full Visual Builder support
	public $vb_support = 'on';

	/**
	 * Module properties initialization
	 *
	 * @since 1.0.0
	 *
	 * @todo Remove $this->advanced_options['background'] once https://github.com/elegantthemes/Divi/issues/6913 has been addressed
	 */
	function init() {

		// Module name
		$this->name             = esc_html__( 'Facette de la flip box', 'mc_divi_custom_modules' );

		$this->main_css_element = '%%order_class%%.mc_et_pb_flipbox_child';

		// Module item's modal title
		$this->settings_text = esc_html__( 'Paramètres de la facette', 'mc_divi_custom_modules' );

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Texte', 'mc_divi_custom_modules' ),
					'image'        => esc_html__( 'Image & Icône', 'mc_divi_custom_modules' ),
					'button'       => esc_html__( 'Bouton', 'mc_divi_custom_modules' ),
				),
			),
		);

		//error_log(print_r($this, true));
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		return array(
			'title' => array(
				'label'           => esc_html__( 'Titre', 'mc_divi_custom_modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Le texte saisi ici s\'affichera comme titre de la facette.', 'mc_divi_custom_modules' ),
				'toggle_slug'     => 'main_content',
			),
			'content' => array(
				'label'           => esc_html__( 'Contenu', 'mc_divi_custom_modules' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Le texte saisi ici s\'affichera comme contenu de la facette', 'mc_divi_custom_modules' ),
				'toggle_slug'     => 'main_content',
			),
			'button_text' => array(
				'label'           => esc_html__( 'Texte du bouton', 'mc_divi_custom_modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Le texte du bouton.', 'mc_divi_custom_modules' ),
				'toggle_slug'     => 'button',
			),
			'button_url' => array(
				'label'           => esc_html__( 'Button URL', 'mc_divi_custom_modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'L\'URL du bouton.', 'mc_divi_custom_modules' ),
				'toggle_slug'     => 'button',
			),
			'button_url_new_window' => array(
				'default'         => 'off',
				'default_on_front'=> true,
				'label'           => esc_html__( 'Ouverture du lien', 'mc_divi_custom_modules' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'Dans la même fenêtre', 'mc_divi_custom_modules' ),
					'on'  => esc_html__( 'Dans un nouvel onglet', 'mc_divi_custom_modules' ),
				),
				'toggle_slug'     => 'button',
				'description'     => esc_html__( 'Choisissez si le lien s\'ouvre dans une nouvelle fenêtre ou non.', 'mc_divi_custom_modules' ),
			),
			'use_icon' => array(
				'label'           => esc_html__( 'Utiliser une îcône', 'mc_divi_custom_modules' ),
				'type'            => 'yes_no_button',
				'option_category' => 'basic_option',
				'options'         => array(
					'off' => esc_html__( 'Non', 'mc_divi_custom_modules' ),
					'on'  => esc_html__( 'Oui', 'mc_divi_custom_modules' ),
				),
				'toggle_slug'     => 'image',
				'affects'         => array(
					'font_icon',
					'image',
				),
				'description' => esc_html__( 'Choisissez si vous souhaitez afficher une icône à afficher en entête.', 'mc_divi_custom_modules' ),
				'default_on_front'=> 'off',
			),
			'font_icon' => array(
				'label'               => esc_html__( 'Icône', 'mc_divi_custom_modules' ),
				'type'                => 'select_icon',
				'option_category'     => 'basic_option',
				'class'               => array( 'et-pb-font-icon' ),
				'toggle_slug'         => 'image',
				'description'         => esc_html__( 'Choisissez une icône.', 'mc_divi_custom_modules' ),
				'depends_show_if'     => 'on',
			),
			'image' => array(
				'label'              => esc_html__( 'Image', 'mc_divi_custom_modules' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'mc_divi_custom_modules' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'mc_divi_custom_modules' ),
				'update_text'        => esc_attr__( 'Set As Image', 'mc_divi_custom_modules' ),
				'depends_show_if'    => 'off',
				'description'        => esc_html__( 'Téléversez une image à afficher en entête.', 'mc_divi_custom_modules' ),
				'toggle_slug'        => 'image',
			),
		);
	}

	/**
	 * Module's advanced fields configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_advanced_fields_config() {
		return array(
			'fonts'                 => array(
				'title' => array(
					'label'    => esc_html__( 'Titre', 'mc_divi_custom_modules' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .flipbox-title",
						'font' => "{$this->main_css_element} .flipbox-title",
						'color' => "{$this->main_css_element} .flipbox-title",
						'plugin_main' => "{$this->main_css_element} .flipbox-title, {$this->main_css_element} .flipbox-title",
						'important' => 'all',
					),
					'header_level' => array(
						'default' => 'h2',
					),
				),
				'content'   => array(
					'label'    => esc_html__( 'Contenu', 'mc_divi_custom_modules' ),
					'css'      => array(
						'main'        => "{$this->main_css_element} .flipbox-content p",
						'color'       => "{$this->main_css_element}, {$this->main_css_element} .flipbox-content *",
						'line_height' => "{$this->main_css_element} .flipbox-content p",
						'plugin_main' => "{$this->main_css_element}, %%order_class%%.flipbox-content p",
					),
				),
			),
			'text' => false,
			'use_background_layout' => false,
			'filters'			=> false,
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

		$image = $this->props['image'];
		$use_icon = $this->props['use_icon'];
		$font_icon = $this->props['font_icon'];
		$header_level          = $this->props['header_level'];

		if ( 'off' === $use_icon ) {
			$image = ( '' !== trim( $image ) ) ? sprintf(
				'<img src="%1$s" />',
				esc_attr( $image )
			) : '';
		} else {

			$image = ( '' !== $font_icon ) ? sprintf(
				'<span class="et-pb-icon">%1$s</span>',
				esc_attr( et_pb_process_font_icon( $font_icon ) )
			) : '';
		}
		// Module specific props added on $this->get_fields()
		$title                 = $this->props['title'];
		$button_text           = $this->props['button_text'];
		$button_url            = $this->props['button_url'];
		$button_url_new_window = $this->props['button_url_new_window'];

		// Design related props are added via $this->advanced_options['button']['button']
		$button_custom         = $this->props['custom_button'];
		$button_rel            = $this->props['button_rel'];
		$button_use_icon       = $this->props['button_use_icon'];

		// Render button
		$button = $this->render_button( array(
			'button_text'      => $button_text,
			'button_url'       => $button_url,
			'url_new_window'   => $button_url_new_window,
			'button_custom'    => $button_custom,
			'button_rel'       => $button_rel,
			'custom_icon'      => $button_use_icon,
		) );

		/*if ( '' !== $this->props['module_text_align'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .flipbox-content',
				'declaration' => sprintf(
					'text-align: %1$s;',
					esc_html( $this->props['module_text_align'] )
				),
			) );
		}

		if ( '' !== $this->props['text_orientation'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .flipbox-title',
				'declaration' => sprintf(
					'text-align: %1$s;',
					esc_html( $this->props['text_orientation'] )
				),
			) );
		}

		if ( '' !== $this->props['title_color'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .flipbox-title',
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $this->props['title_color'] )
				),
			) );
		}*/

		if ( '' !== $title ) {
			$title = sprintf( '<%1$s class="flipbox-title et_pb_module_header">%2$s</%1$s>', et_pb_process_header_level( $header_level, 'h2' ), $title );
		}

		// Render module content
		$output = sprintf(
			'<div class="flipbox-header">%1$s</div>
			%2$s
			<div class="flipbox-content"><p>%3$s</p></div>
			%4$s',
			$image,
			$title,
			et_sanitized_previously( $this->content ),
			et_sanitized_previously( $button )
		);

		return $output;
		// Render wrapper
		// 3rd party module with no full VB support has to wrap its render output with $this->_render_module_wrapper().
		// This method will automatically add module attributes and proper structure for parallax image/video background
		//return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new MC_FlipBox_Child;
