<?php
/**
 * Theme Options related to slider.
 *
 * @package HamroClass
 */

// Slider Type Section.
$wp_customize->add_section(
	'hamroclass_banner_slider',
	array(
		'title'      => esc_html__( 'Banner Slider', 'hamroclass' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'hamroclass_homepage_panel',
	)
);

// Setting banner_slider_type.
$wp_customize->add_setting( 
	'banner_slider_post_type',
	array(
		'default'           => 'page',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hamroclass_posttype_values',
	)
);

$wp_customize->add_control( 
	'banner_slider_post_type',
	array(
		'label'           => esc_html__( 'Select Slider Type', 'hamroclass' ),
		'section'         => 'hamroclass_banner_slider',
		'type'            => 'select',
		'priority'        => 10,
		'choices'         => centurylib_posttypes(),
		//'choices'         => array( 'page'=> esc_html__('Page', 'hamroclass') ),
		'description'	  => esc_html__( 'After changing slider type value may slider could not appear on frontend. So please publish it once and refresh(customizer) it. After that you can manage banner slider items and publish it.', 'hamroclass' ),
	)
);

/**
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'banner_slider_items', 
	array(
		'sanitize_callback' => 'centurylib_sanitize_repeater_data',
		'default' => json_encode(
			array(
				array(
					'post_type_item' => '',
					'description_alignment' => 'center',
					'primary_button_label'	=> esc_html__('Primary Button', 'hamroclass' ),
					'primary_button_url'	=> '#',
					'primary_button_target'	=> '_self',
					'secondary_button_label'	=> esc_html__('Secondary Button', 'hamroclass' ),
					'secondary_button_url'	=> '#',
					'secondary_button_target'	=> '_self',
				)
			)
		)
	)
);

$wp_customize->add_control(
	new Centurylib_Customizer_Repeater_Control(
		$wp_customize, 
		'banner_slider_items', 
		array(
			'label' => esc_html__('Banner Slider Items', 'hamroclass'),
			'section' => 'hamroclass_banner_slider',
			'settings' => 'banner_slider_items',
			'priority' => 20,
			'add_row_label' => esc_html__('Add Slide', 'hamroclass'),
			'wraper_item_label' => esc_html__('Banner Slide Item', 'hamroclass'),
		), 
		array(
			'post_type_item' => array(
				'type' => 'select',
				'label' => esc_html__( 'Choose Post type item', 'hamroclass'),
				'description' => esc_html__('Choose slider post type item.', 'hamroclass'),
				'options' => hamroclass_get_post(
					array(
						'post_type' => get_theme_mod( 'banner_slider_post_type', 'page' )
					)
				),
			),
			'description_alignment' => array(
				'type' => 'select',
				'label' => esc_html__('Description Alignment', 'hamroclass'),
				'description' => esc_html__('Choose banner description alignment.', 'hamroclass'),
				'options' => array(
					'left'   => esc_html__( 'Left', 'hamroclass' ),
					'center' => esc_html__( 'Center', 'hamroclass' ),
					'right'  => esc_html__( 'Right', 'hamroclass' ),
				),
			),
			'primary_button_label' => array(
				'type' => 'text',
				'label' => esc_html__('Primary Button Label', 'hamroclass'),
				'description' => esc_html__('Please enter primary button label.', 'hamroclass'),
			),
			'primary_button_url' => array(
				'type' => 'text',
				'label' => esc_html__('Primary Button URL', 'hamroclass'),
				'description' => esc_html__('Please enter primary button url.', 'hamroclass'),
			),
			'primary_button_target' => array(
				'type' => 'select',
				'label' => esc_html__('Primary Button Target', 'hamroclass'),
				'description' => esc_html__('Please choose primary button target.', 'hamroclass'),
				'options' => array(
					''  => esc_html__( 'Disabled', 'hamroclass' ),
					'_self'   => esc_html__( 'Open with same tab', 'hamroclass' ),
					'_blank' => esc_html__( 'Open with New Tab', 'hamroclass' ),
				),
			),
			'secondary_button_label' => array(
				'type' => 'text',
				'label' => esc_html__('Secondary Button Label', 'hamroclass'),
				'description' => esc_html__('Please enter secondary button label.', 'hamroclass'),
			),
			'secondary_button_url' => array(
				'type' => 'text',
				'label' => esc_html__('Secondary Button URL', 'hamroclass'),
				'description' => esc_html__('Please enter secondary button url.', 'hamroclass'),
			),
			'secondary_button_target' => array(
				'type' => 'select',
				'label' => esc_html__('Secondary Button Target', 'hamroclass'),
				'description' => esc_html__('Please choose secondary button target.', 'hamroclass'),
				'options' => array(
					''  => esc_html__( 'Disabled', 'hamroclass' ),
					'_self'   => esc_html__( 'Open with same tab', 'hamroclass' ),
					'_blank' => esc_html__( 'Open with New Tab', 'hamroclass' ),
				),
			),
		)
	)
);

// Setting banner_slider_read_more_text.
$wp_customize->add_setting( 
	'banner_slider_readmore_text',
	array(
		'default'           => esc_html__( 'Read More...', 'hamroclass' ),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 
	'banner_slider_readmore_text',
	array(
		'label'           => esc_html__( 'Read More Text', 'hamroclass' ),
		'section'         => 'hamroclass_banner_slider',
		'type'            => 'text',
		'priority'        => 30,
	)
);


// Setting banner_slider_transition_effect.
$wp_customize->add_setting( 
	'banner_slider_transition_effect',
	array(
		'default'           => 'fade',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hamroclass_transition_effect',
	)
);
$wp_customize->add_control( 
	'banner_slider_transition_effect',
	array(
		'label'    => esc_html__( 'Transition Effect', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'select',
		'priority' => 40,
		'choices'  => array(
			'fade'       => esc_html__( 'Fade', 'hamroclass' ),
			'slide'    => esc_html__( 'Slide', 'hamroclass' ),
		),
	)
);

// Setting banner_slider_transition_delay.
$wp_customize->add_setting( 
	'banner_slider_transition_delay',
	array(
		'default'           => 5,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 
	'banner_slider_transition_delay',
	array(
		'label'       => esc_html__( 'Transition Delay', 'hamroclass' ),
		'description' => esc_html__( 'in seconds (default = 5)', 'hamroclass' ),
		'section'     => 'hamroclass_banner_slider',
		'type'        => 'number',
		'priority'    => 50,
		'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
	)
);
// Setting banner_slider_transition_duration.
$wp_customize->add_setting( 
	'banner_slider_transition_duration',
	array(
		'default'           => 2,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 
	'banner_slider_transition_duration',
	array(
		'label'       => esc_html__( 'Transition Duration', 'hamroclass' ),
		'description' => esc_html__( 'in seconds (default = 2)', 'hamroclass' ),
		'section'     => 'hamroclass_banner_slider',
		'type'        => 'number',
		'priority'    => 60,
		'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
	)
);
// Setting banner_slider_enable_description.
$wp_customize->add_setting( 
	'banner_slider_enable_description',
	array(
		'default'           => 1,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 
	'banner_slider_enable_description',
	array(
		'label'    => esc_html__( 'Enable Description', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'checkbox',
		'priority' => 70,
	)
);

// Setting banner_slider_arrow_layout.
$wp_customize->add_setting( 
	'banner_slider_arrow_layout',
	array(
		'default'           => 'disable',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 
	'banner_slider_arrow_layout',
	array(
		'label'    => esc_html__( 'Arrow layout', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'select',
		'priority' => 80,
		'choices'	=> array(
			'disable' => esc_html__( 'Disable', 'hamroclass' ),
			'default' => esc_html__( 'Default', 'hamroclass' ),
		),
	)
);

// Setting banner_slider_enable_autoplay.
$wp_customize->add_setting( 
	'banner_slider_enable_autoplay',
	array(
		'default'           => 1,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 
	'banner_slider_enable_autoplay',
	array(
		'label'    => esc_html__( 'Enable Autoplay', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'checkbox',
		'priority' => 90,
	)
);

// Setting banner_slider_enable_overlay.
$wp_customize->add_setting( 
	'banner_slider_enable_overlay',
	array(
		'default'           => 1,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 
	'banner_slider_enable_overlay',
	array(
		'label'    => esc_html__( 'Enable Overlay', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting banner_slider_thumbnail_size.
$wp_customize->add_setting( 
	'banner_slider_thumbnail_size',
	array(
		'default'           => 'full',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hamroclass_thumbnail_size',
	)
);
$wp_customize->add_control( 
	'banner_slider_thumbnail_size',
	array(
		'label'    => esc_html__( 'Thumbnail Size', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'select',
		'priority' => 110,
		'choices'  => centurylib_get_image_sizes(), 
	)
);

// Setting banner_slider_description_length.
$wp_customize->add_setting( 
	'banner_slider_description_length',
	array(
		'default'           => '150',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 
	'banner_slider_description_length',
	array(
		'label'    => esc_html__( 'Description Length', 'hamroclass' ),
		'section'  => 'hamroclass_banner_slider',
		'type'     => 'number',
		'priority' => 120,
	)
);


