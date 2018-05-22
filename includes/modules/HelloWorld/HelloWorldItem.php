<?php

class MDCM_HelloWorld_Item extends ET_Builder_Module {

	public $slug       = 'mdcm_hello_world_item';
	public $vb_support = 'on';


	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Marie Comet',
		'author_uri' => 'https://mariecomet.fr',
	);

	public function init() {
		$this->name = esc_html__( 'Hello World', 'mdcm-mc-divi-custom-modules-react' );
		$this->type = 'child';
		$this->child_slug  = 'mdcm_hello_world_item';
		$this->no_render = true;
		$this->main_css_element = '%%order_class%%.et_pb_flipbox_item';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'face' => esc_html__( 'Face', 'et_builder' ),
					'back' => esc_html__( 'Arrière', 'et_builder' ),
					'link'         => esc_html__( 'Link', 'et_builder' )
				),
			)
		);
	}

	public function get_fields() {
		return array(
			'title' => array(
				'label'           => esc_html__( 'Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'The title will appear above the content and when the toggle is closed.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'content' => array(
				'label'           => esc_html__( 'Texte face', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'	  => 'face',
				'description'     => esc_html__( 'Texte face', 'et_builder' ),
			),
			'back_text' => array(
				'label'           => esc_html__( 'Texte derrière', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'toggle_slug'	  => 'back',
				'description'     => esc_html__( 'Texte qui apparait au survol', 'et_builder' ),
			),
			'link' => array(
				'label'           => esc_html__( 'URL cible', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'link',
				'description'     => esc_html__( 'URL ouverte au click', 'et_builder' ),
			),
			'show_button' => array(
				'label'             => esc_html__( 'Afficher l\'arrière comme un bouton', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'basic_option',
				'options'           => array(
					'on'  => esc_html__( 'Oui', 'et_builder' ),
					'off' => esc_html__( 'Non', 'et_builder' ),
				),
				'toggle_slug'     => 'link',
				'description'        => esc_html__( 'Si oui affichera l\'arrière comme un bouton', 'et_builder' ),
			),
		);
	}
}

new MDCM_HelloWorld;
