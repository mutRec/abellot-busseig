<?php
/*
 * Static Front Page
 */
$wp_customize->add_setting(
	'hamroclass_static_homepage_layout',
	array(
		'default'      => 'widgetize',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_static_homepage_layout',
		array(
			'type'      => 'switch',
			'label'     => esc_html__( 'Homepage template options', 'hamroclass' ),
			'description'   => esc_html__( 'Choose option for Static Home Page Template.', 'hamroclass' ),
			'section'   => 'static_front_page',
			'choices'   => array(
				'widgetize'  => esc_html__( 'Widgetize', 'hamroclass' ),
				'default'  => esc_html__( 'Default', 'hamroclass' )
			),
			'priority'  => 20,
		)
	)
);
