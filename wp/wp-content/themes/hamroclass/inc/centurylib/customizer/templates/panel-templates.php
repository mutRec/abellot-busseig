<?php
/**
 * Template Post
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_panel(
	'site_template_options',
	array(
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Template Options', 'hamroclass'),
		'description'    => esc_html__('Templates related settings and sections goes here. You can manage different templates like page, post, 404page etc from this panel.', 'hamroclass'),
	)
);

require_once centurylib_file_directory( 'customizer/templates/templates-homepage.php' );
require_once centurylib_file_directory( 'customizer/templates/templates-post-single.php' );
require_once centurylib_file_directory( 'customizer/templates/templates-page-details.php' );
require_once centurylib_file_directory( 'customizer/templates/templates-archive-page.php' );
require_once centurylib_file_directory( 'customizer/templates/templates-blog-page.php' );
require_once centurylib_file_directory( 'customizer/templates/templates-search-page.php' );
require_once centurylib_file_directory( 'customizer/templates/templates-404-page.php' );
