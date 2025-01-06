<?php
/**
 * Widget Settings
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'hamroclass_widget_settings',
    array(
        'title'         => esc_html__( 'Widget Settings', 'hamroclass' ),
        'description'   => esc_html__( 'Manage settings of widget from here.', 'hamroclass' ),
        'priority'      => 50,
        'panel'         => 'site_setting_options',
    )
);


$wp_customize->add_setting(
	'homepage_widget_layout',
	array(
		'default'           => 'layout2',
		'sanitize_callback' => 'sanitize_hamroclass_widget_layout',
	)
);
$wp_customize->add_control(
	'homepage_widget_layout',
	array(
		'type' => 'radio',
		'priority'    => 10,
		'label' => esc_html__( 'Widget title layout.', 'hamroclass' ),
		'section' => 'hamroclass_widget_settings',
		'choices' => array(
			'layout1'   => esc_html__( 'Layout One', 'hamroclass' ),
			'layout2' => esc_html__( 'Layout Two', 'hamroclass' )
		),
	)
);
