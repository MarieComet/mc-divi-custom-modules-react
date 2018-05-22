<?php

class MDCM_HelloWorld extends ET_Builder_Module {

	public $slug       = 'mdcm_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Marie Comet',
		'author_uri' => 'https://mariecomet.fr',
	);

	public function init() {
		$this->name = esc_html__( 'Hello World', 'mdcm-mc-divi-custom-modules-react' );

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
			'face_text' => array(
				'label'           => esc_html__( 'Texte face', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'	  => 'face',
				'description'     => esc_html__( 'Texte face', 'et_builder' ),
			),
			'back_text' => array(
				'label'           => esc_html__( 'Texte derrière', 'et_builder' ),
				'type'            => 'text',
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

	public function render( $attrs, $content = null, $render_slug ) {

		error_log(print_r($this->props, true));
		$module_id            = $this->props['module_id'];
		$module_class         = $this->props['module_class'];
		$face_text				= $this->props['face_text'];
		$back_text				= $this->props['back_text'];
		$link				= $this->props['link'];
		$show_button		= $this->props['show_button'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $render_slug );

		//$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		$class = " et_pb_module";

		$output = sprintf(
			'<div%4$s class="et_pb_flipbox%3$s%5$s">
				<div class="box">
					<a href="%6$s">
						<div class="face front">
							<p>%1$s</p>
						</div>
						<div class="face back">
							<p class="%7$s">%2$s</p>						
						</div>			
					</a>
				</div>		
			</div><!-- .et_pb_flipbox -->',
			esc_html( $face_text ),
			esc_html( $back_text ),
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			esc_attr( $link ),
			( 'on' === $show_button ? sprintf( ' %1$s', esc_attr( 'et_pb_button' ) ) : '' )
		);

		return $output;
	}
}

new MDCM_HelloWorld;
