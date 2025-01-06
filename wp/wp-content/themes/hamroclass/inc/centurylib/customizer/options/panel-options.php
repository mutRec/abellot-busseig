<?php
/**
 * Panel: Theme Options
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_panel(
	'site_setting_options',
	array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Theme Options', 'hamroclass'),
		'description'    => esc_html__('Remaining all setting options goes here.', 'hamroclass'),
	)
);

require_once centurylib_file_directory( 'customizer/options/section-background-image.php' );