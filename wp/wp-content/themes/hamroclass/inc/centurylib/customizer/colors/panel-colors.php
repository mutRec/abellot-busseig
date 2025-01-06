<?php
/**
 * Panel: Colors
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_panel(
	'site_color_options',
	array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Color Options', 'hamroclass'),
		'description'    => esc_html__('Colors related settings and sections goes here. You can manage color from this panel.', 'hamroclass'),
	)
);
require_once centurylib_file_directory( 'customizer/colors/section-global-colors.php' );
require_once centurylib_file_directory( 'customizer/colors/section-category-colors.php' );