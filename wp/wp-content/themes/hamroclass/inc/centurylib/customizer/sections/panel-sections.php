<?php
/*
 * Panel Section
 */
$wp_customize->add_panel(
	'site_additional_sections',
	array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__('Additional Sections', 'hamroclass'),
		'description'    => esc_html__('Overall section settings goes here.', 'hamroclass')
	)
);

require_once centurylib_file_directory( 'customizer/sections/section-social-icons.php' );
require_once centurylib_file_directory( 'customizer/sections/section-breadcrumbs.php' );

