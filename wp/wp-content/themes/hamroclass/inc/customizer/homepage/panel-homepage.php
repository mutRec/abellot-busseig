<?php
/*
 * Panel Home Page
 */
$wp_customize->add_panel(
	'hamroclass_homepage_panel',
	array(
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__('Homepage Sections', 'hamroclass'),
		'description'    => esc_html__('Homepage all sections goes here.', 'hamroclass')
	)
);

require_once hamroclass_file_directory( 'inc/customizer/homepage/section-banner-slider.php' );
require_once hamroclass_file_directory( 'inc/customizer/homepage/section-main-services.php' );
require_once hamroclass_file_directory( 'inc/customizer/homepage/section-homepage-widgets.php' );
