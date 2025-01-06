<?php
/**
 * Theme Options related to Services
 *
 * @package HamroClass
 */

//$default = hamroclass_get_default_theme_options();

// Service Type Section.
$wp_customize->add_section( 
	'hamroclass_main_services',
	array(
		'title'      => esc_html__( 'Main Services', 'hamroclass' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
		'panel'      => 'hamroclass_homepage_panel',
	)
);


$wp_customize->add_setting(
    'main_service_noof_columns', 
    array(
        'default' 			=> 4,
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
	'main_service_noof_columns', 
	array(
		'type'		=> 'select',
		'label'		=> esc_html__('Number of Column', 'hamroclass'),
		'section'	=> 'hamroclass_main_services',
		'settings'	=> 'main_service_noof_columns',
		'priority'	=> 10,
		'choices'	=> array(
			'1'		=> esc_html__( 'One Column ( Full Width )', 'hamroclass' ),
			'2'		=> esc_html__( 'Two Column ( Full Width )', 'hamroclass' ),
			'3'		=> esc_html__( 'Three Column ( Full Width )', 'hamroclass' ),
			'4'		=> esc_html__( 'Four Column ( Full Width )', 'hamroclass' ),
		),
	)
);

$wp_customize->add_setting(
    'main_service_overlap_toppart', 
    array(
        'default' 			=> 1,
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
	'main_service_overlap_toppart', 
	array(
		'type'		=> 'checkbox',
		'label'		=> esc_html__('Overlap Top Part', 'hamroclass'),
		'section'	=> 'hamroclass_main_services',
		'settings'	=> 'main_service_overlap_toppart',
		'priority'	=> 20,
	)
);

/**
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_services_list', 
	array(
		'sanitize_callback' => 'centurylib_sanitize_repeater_data',
		'default' => json_encode(
			array(
				array(
					'post_type_item'		=> '',
					'font_color'		=> '#fff',
					'background_color'		=> '#1e73be',
					'service_fa_icon'		=> 'fa-star',

				)
			)
		)
	)
);
$wp_customize->add_control(
	new Centurylib_Customizer_Repeater_Control(
		$wp_customize, 
		'hamroclass_services_list', 
		array(
			'label' => esc_html__('Service Items', 'hamroclass'),
			'section' => 'hamroclass_main_services',
			'settings' => 'hamroclass_services_list',
			'priority' => 30,
			'add_row_label' => esc_html__('Add Service', 'hamroclass'),
			'wraper_item_label' => esc_html__('Service Item', 'hamroclass'),
		), 
		array(
			'post_type_item' => array(
				'type' => 'select',
				'label' => esc_html__( 'Choose Item', 'hamroclass'),
				'description' => esc_html__('Choose post/page to display features services parts.', 'hamroclass'),
				'options' => hamroclass_get_post(),
			),
			'font_color' => array(
				'type' => 'color',
				'label' => esc_html__('Font Color', 'hamroclass'),
				'description' => esc_html__('Choose service font color for service block.', 'hamroclass'),
			),
			'background_color' => array(
				'type' => 'color',
				'label' => esc_html__('Background Color', 'hamroclass'),
				'description' => esc_html__('Choose background color for service block.', 'hamroclass'),
			),
			'service_fa_icon' => array(
				'type' => 'icons',
				'label' => esc_html__('Service Icon', 'hamroclass'),
				'description' => esc_html__('Please choose service icon.', 'hamroclass'),
			),
		)
	)
);
