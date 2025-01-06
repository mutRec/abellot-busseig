<?php
/**
 * @package themecentury
 * @package HamroClass
 * @since 1.0.2
 */

// Slider Type Section.
$wp_customize->add_section(
	'hamroclass_office_details',
	array(
		'title'      => esc_html__( 'Office Details', 'hamroclass' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'site_header_panel',
	)
);

// Call support text
$wp_customize->add_setting(
	'hamroclass_call_support',
	array(
		'default'           => esc_html__('Call Support: ', 'hamroclass'),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	'hamroclass_call_support',
	array(
		'label'           => esc_html__( 'Call Support Label:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'text',
		'priority'        => 10,
	)
);

// Call support text
$wp_customize->add_setting(
	'hamroclass_phone_number',
	array(
		'default'           => '00619800000000',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	'hamroclass_phone_number',
	array(
		'label'           => esc_html__( 'Phone Number:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'text',
		'priority'        => 20,
	)
);


// email support text
$wp_customize->add_setting(
	'hamroclass_email_support',
	array(
		'default'           => esc_html__('Email Support: ', 'hamroclass'),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	'hamroclass_email_support',
	array(
		'label'           => esc_html__( 'Email Support Label:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'text',
		'priority'        => 30,
	)
);

// official email
$wp_customize->add_setting(
	'hamroclass_official_email',
	array(
		'default'           => 'info@example.com',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_email',
	)
);

$wp_customize->add_control( 
	'hamroclass_official_email',
	array(
		'label'           => esc_html__( 'Official Email:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'email',
		'priority'        => 40,
	)
);

// location support text
$wp_customize->add_setting(
	'hamroclass_location_support',
	array(
		'default'           => esc_html__('Location: ', 'hamroclass'),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	'hamroclass_location_support',
	array(
		'label'           => esc_html__( 'Location Label:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'text',
		'priority'        => 50,
	)
);

// official email
$wp_customize->add_setting(
	'hamroclass_location_text',
	array(
		'default'           => esc_html__('Sydney New South Wales', 'hamroclass' ),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	'hamroclass_location_text',
	array(
		'label'           => esc_html__( 'Official Location:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'email',
		'priority'        => 60,
	)
);

// official email
$wp_customize->add_setting(
	'hamroclass_map_location_link',
	array(
		'default'           => 'https://www.google.com/maps',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control( 
	'hamroclass_map_location_link',
	array(
		'label'           => esc_html__( 'Map Location Url:', 'hamroclass' ),
		'section'         => 'hamroclass_office_details',
		'type'            => 'url',
		'priority'        => 70,
	)
);
