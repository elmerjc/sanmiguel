<?php
require get_template_directory() . '/inc/tgm/tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'dentalcare_require_plugins' );

function dentalcare_require_plugins() {
	$plugins_path = get_template_directory() . '/inc/tgm/plugins';
	$plugins      = array(
		array(
			'name'             => esc_html__('TMC Post Type','dentalcare'),
			'slug'             => 'tmc-post-type',
			'source'           => $plugins_path . '/tmc-post-type.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'         => esc_html__('WPBakery Visual Composer','dentalcare'),
			'slug'         => 'vc-composer',
			'source'       => $plugins_path . '/js_composer.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://vc.wpbakery.com','dentalcare'),
		),
		array(
			'name'         => esc_html__('Revolution Slider','dentalcare'),
			'slug'         => 'revslider',
			'source'       => $plugins_path . '/revslider.zip',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
			'external_url' => esc_url('http://www.themepunch.com/revolution/','dentalcare'),
		),
		array(
			'name'     => esc_html__('Breadcrumb NavXT','dentalcare'),
			'slug'     => 'breadcrumb-navxt',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
	
		array(
			'name'     => esc_html__('Contact Form 7','dentalcare'),
			'slug'     => 'contact-form-7',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),
		array(
			'name'     => esc_html__('MailChimp for WordPress Lite','dentalcare'),
			'slug'     => 'mailchimp-for-wp',
			'required'         => true,
			'force_activation'  => false,
			'force_deactivation' => false,
		),		

		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		
	    array(
            'name'               => 'TMC Data options',
            'slug'               => 'tmc-data-options', 
            'source'             => $plugins_path . '/tmc-data-options.zip',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
			'version'            => '1.0.1',
        ),	
		array(
		'name'               => 'Envato Market',
		'slug'               => 'envato-market',
		'source'             => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
		'required'           => true,
		'force_activation'   => false,
		'force_deactivation' => false,
		),
	);

	tgmpa( $plugins, array( 'is_automatic' => true ) );
}