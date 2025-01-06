<?php
/**
 * HamroClass Header Notice Section
 */

/**
 * Notice Section
 */
$wp_customize->add_section(
	'hamroclass_notice_section',
	array(
		'title'    => esc_html__( 'Notice Section', 'hamroclass' ),
		'priority' => 20,
		'panel'    => 'site_header_panel'
	)
);

$wp_customize->add_setting(
	'hamroclass_notice_option',
	array(
		'default'           => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_notice_option',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Notice Option', 'hamroclass' ),
			'description' => esc_html__( 'Hide/show notice board section.', 'hamroclass' ),
			'section'     => 'hamroclass_notice_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'hamroclass' ),
				'hide' => esc_html__( 'Hide', 'hamroclass' )
			),
			'priority'    => 10,
		)
	)
);

/**
 * Text field for notice caption
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_notice_caption',
	array(
		'default'           => esc_html__( 'Notices', 'hamroclass' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'hamroclass_notice_caption',
	array(
		'type'     => 'text',
		'label'    => esc_html__( 'Notice Caption', 'hamroclass' ),
		'section'  => 'hamroclass_notice_section',
		'priority' => 20
	)
);
$wp_customize->selective_refresh->add_partial(
	'hamroclass_notice_caption',
	array(
		'selector'        => '.notice-caption',
		'render_callback' => 'hamroclass_customize_partial_notice_caption',
	)
);
