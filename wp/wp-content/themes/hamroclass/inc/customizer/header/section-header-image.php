<?php
/**
 * section header imgage
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
$header_image = $wp_customize->get_section( 'header_image' );
$header_image->panel = 'site_header_panel';
$header_image->priority = 10;