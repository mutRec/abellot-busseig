<?php
/**
 * Global Colors
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$centurylib_colors = $wp_customize->get_section( 'colors' );
$centurylib_colors->priority 	= 10;
$centurylib_colors->panel 		= 'site_color_options';
$centurylib_colors->title 		= esc_html__( 'Global Colors', 'hamroclass' );