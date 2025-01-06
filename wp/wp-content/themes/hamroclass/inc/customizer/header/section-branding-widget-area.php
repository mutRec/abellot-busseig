<?php
/**
 * HamroClass Header Settings panel at Theme Customizer
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.8
 */

$branding_widget_area = $wp_customize->get_section( 'sidebar-widgets-hamroclass_header_branding_area' );
if($branding_widget_area){
	$branding_widget_area->panel = 'site_header_panel';
	$branding_widget_area->priority = 60;
}
