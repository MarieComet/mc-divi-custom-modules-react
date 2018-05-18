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
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'mdcm-mc-divi-custom-modules-react' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'mdcm-mc-divi-custom-modules-react' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>%1$s</h1>', $this->props['content'] );
	}
}

new MDCM_HelloWorld;
