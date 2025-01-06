<?php
/*
 * Section widgets homepage
 */


/*
 * section top homepage content area
 */
$homepage_top_widgetarea = $wp_customize->get_section('sidebar-widgets-hamroclass_home_content_area');
if($homepage_top_widgetarea){
	$homepage_top_widgetarea->panel = 'hamroclass_homepage_panel';
	$homepage_top_widgetarea->priority = 30;
}

/*
 * section top homepage content area
 */

$homepage_left_widgetarea = $wp_customize->get_section('sidebar-widgets-hamroclass_home_middle_section_area');
if($homepage_left_widgetarea){
	$homepage_left_widgetarea->panel = 'hamroclass_homepage_panel';
	$homepage_left_widgetarea->priority = 40;
}

/*
 * section top homepage content area
 */
$homepage_right_widgetarea = $wp_customize->get_section('sidebar-widgets-hamroclass_home_middle_aside_area');
if($homepage_left_widgetarea){
	$homepage_right_widgetarea->panel = 'hamroclass_homepage_panel';
	$homepage_right_widgetarea->priority = 50;
}

/*
 * section top homepage content area
 */
$homepage_bottom_widgearea = $wp_customize->get_section('sidebar-widgets-hamroclass_home_bottom_section_area');
if($homepage_left_widgetarea){
	$homepage_bottom_widgearea->panel = 'hamroclass_homepage_panel';
	$homepage_bottom_widgearea->priority = 60;
}