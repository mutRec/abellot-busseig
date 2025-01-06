<?php
/**
 * Register the recommended plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function hamroclass_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(
		
		array(
			'name'     => esc_html__('Century ToolKit', 'hamroclass'),
			'slug'     => 'century-toolkit',
			'required' => false,
		),
		array(
			'name'		=> esc_html__('The Event Calendar', 'hamroclass'),
			'slug'		=> 'the-events-calendar',
			'required'	=> false,
		),
		array(
			'name'		=> esc_html__('Learn Press', 'hamroclass'),
			'slug'		=> 'learnpress',
			'required'	=> false,
		),
		array(
			'name'     => esc_html__( 'Contact Form 7', 'hamroclass' ),
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		
	);

	tgmpa( $plugins );
}


/**
 * This file contains the recommended plugin lists to this theme
 */

add_action( 'tgmpa_register', 'hamroclass_register_required_plugins' );