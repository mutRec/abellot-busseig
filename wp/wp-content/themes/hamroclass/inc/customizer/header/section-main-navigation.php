<?php
/**
 * section header main navigation
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
$wp_customize->add_section(
	'hamroclass_header_main_navigation',
	array(
		'title'    => esc_html__( 'Main Navigation', 'hamroclass' ),
		'priority' => 80,
		'panel'    => 'site_header_panel'
	)
);


/**
 * Switch option for Home Icon
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_menu_sticky_option',
	array(
		'default'           => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_menu_sticky_option',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Sticky Menu', 'hamroclass' ),
			'description' => esc_html__( 'Enable/Disable option for sticky menu.', 'hamroclass' ),
			'section'     => 'hamroclass_header_main_navigation',
			'choices'     => array(
				'show' => esc_html__( 'Enable', 'hamroclass' ),
				'hide' => esc_html__( 'Disable', 'hamroclass' )
			),
			'priority'    => 10,
		)
	)
);

/**
 * Switch option for Search Icon
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_search_icon_option',
	array(
		'default'           => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_search_icon_option',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Search Icon', 'hamroclass' ),
			'description' => esc_html__( 'Show/Hide option for search icon at primary menu.', 'hamroclass' ),
			'section'     => 'hamroclass_header_main_navigation',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'hamroclass' ),
				'hide' => esc_html__( 'Hide', 'hamroclass' )
			),
			'priority'    => 20,
		)
	)
);

/**
 * Enable round navigation
 *
 * @since 1.0.0
 */
/*$wp_customize->add_setting(
	'harmoclass_logo_on_navigation',
	array(
		'default'           => 'disable',
		'sanitize_callback' => 'sanitize_hamroclass_enable_disable',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'harmoclass_logo_on_navigation',
		array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Logo on navigation?', 'hamroclass' ),
			'description' => esc_html__( 'Show/Hide option for search icon at primary menu.', 'hamroclass' ),
			'section'     => 'hamroclass_header_main_navigation',
			'choices'     => array(
				'enable' => esc_html__( 'Enable', 'hamroclass' ),
				'disable' => esc_html__( 'Disable', 'hamroclass' )
			),
			'priority'    => 30,
		)
	)
);*/
