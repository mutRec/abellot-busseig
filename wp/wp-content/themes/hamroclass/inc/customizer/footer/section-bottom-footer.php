<?php


$wp_customize->get_setting( 'footer_copyright_text' )->transport = 'postMessage';
$wp_customize->selective_refresh->add_partial( 
	'footer_copyright_text',
	array(
		'selector' => 'span.hmc-copyright-text',
		'render_callback' => 'hamroclass_customize_partial_copyright',
	)
);

