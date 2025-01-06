<?php
/**
 * HamroClass Top Header Section
 */

/**
 * Top Header Section
 */
$wp_customize->add_section(
	'hamroclass_top_header_section',
	array(
		'title'    => esc_html__( 'Top Header', 'hamroclass' ),
		'priority' => 30,
		'panel'    => 'site_header_panel'
	)
);

/**
 * Switch option for Top Header
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_top_header_option',
	array(
		'default'           => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_top_header_option',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Top Header Section', 'hamroclass' ),
			'description' => esc_html__( 'Show/Hide option for top header section.', 'hamroclass' ),
			'section'     => 'hamroclass_top_header_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'hamroclass' ),
				'hide' => esc_html__( 'Hide', 'hamroclass' )
			),
			'priority'    => 10,
		)
	)
);

/**
 * Switch option for Current Date
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_top_date_option',
	array(
		'default'           => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_top_date_option',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Current Date', 'hamroclass' ),
			'description' => esc_html__( 'Show/Hide option for current date at top header section.', 'hamroclass' ),
			'section'     => 'hamroclass_top_header_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'hamroclass' ),
				'hide' => esc_html__( 'Hide', 'hamroclass' )
			),
			'priority'    => 20,
		)
	)
);

/**
 * Switch option for Social Icon
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_top_social_option',
	array(
		'default'           => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_top_social_option',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Social Icons', 'hamroclass' ),
			'description' => esc_html__( 'Show/Hide option for social media icons at top header section.', 'hamroclass' ),
			'section'     => 'hamroclass_top_header_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'hamroclass' ),
				'hide' => esc_html__( 'Hide', 'hamroclass' )
			),
			'priority'    => 30,
		)
	)
);
