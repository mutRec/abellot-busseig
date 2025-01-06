<?php
/**
 * Widget Area Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
	'hamroclass_main_footer_section',
	array(
		'title'		=> esc_html__( 'Footer Main', 'hamroclass' ),
		'panel'     => 'site_footer_options',
		'priority'  => 20,
	)
);

/**
 * Switch option for Top Header
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_footer_widget_option',
	array(
		'default' => 'show',
		'sanitize_callback' => 'sanitize_hamroclass_show_hide',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Switch_Control(
		$wp_customize,
		'hamroclass_footer_widget_option',
		array(
			'type'      => 'switch',
			'label'     => esc_html__( 'Footer Widget Section', 'hamroclass' ),
			'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'hamroclass' ),
			'section'   => 'hamroclass_main_footer_section',
			'choices'   => array(
				'show'  => esc_html__( 'Show', 'hamroclass' ),
				'hide'  => esc_html__( 'Hide', 'hamroclass' )
			),
			'priority'  => 10,
		)
	)
);

/**
 * Parallax footer
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_parallax_footer',
	array(
		'default'    => '',
		'sanitize_callback' => 'esc_url'
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'hamroclass_parallax_footer',
		array(
			'label'      => esc_html__('Upload Parallax image', 'hamroclass' ),
			'section'    => 'hamroclass_main_footer_section',
			'settings'   => 'hamroclass_parallax_footer',
			'priority'  => 20,
		)
	)   
);

/**
 * Field for Image Radio
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'footer_widget_layout',
	array(
		'default'           => 'column_three',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Imageoptions_Control(
		$wp_customize,
		'footer_widget_layout',
		array(
			'label'    => esc_html__( 'Footer Widget Layout', 'hamroclass' ),
			'description' => esc_html__( 'Choose layout from available layouts', 'hamroclass' ),
			'section'  => 'hamroclass_main_footer_section',
			'choices'  => array(
				'column_four' => array(
					'label' => esc_html__( 'Columns Four', 'hamroclass' ),
					'url'   => '%s/inc/centurylib/assets/img/grid/four-column.png'
				),
				'column_three' => array(
					'label' => esc_html__( 'Columns Three', 'hamroclass' ),
					'url'   => '%s/inc/centurylib/assets/img/grid/three-column.png'
				),
				'column_two' => array(
					'label' => esc_html__( 'Columns Two', 'hamroclass' ),
					'url'   => '%s/inc/centurylib/assets/img/grid/two-column.png'
				),
				'column_one' => array(
					'label' => esc_html__( 'Column One', 'hamroclass' ),
					'url'   => '%s/inc/centurylib/assets/img/grid/one-column.png'
				)
			),
			'priority' => 30
		)
	)
);

