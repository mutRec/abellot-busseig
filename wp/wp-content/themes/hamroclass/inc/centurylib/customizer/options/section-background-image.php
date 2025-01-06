<?php
/**
 * Background Image
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$background_image = $wp_customize->get_section( 'background_image' );
$background_image->priority 	= 10;
$background_image->panel 		= 'site_setting_options';