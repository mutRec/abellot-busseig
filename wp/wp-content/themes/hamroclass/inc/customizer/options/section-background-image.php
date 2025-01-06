<?php
/**
 * Section Background Image
 *
 * @since 1.0.0
 */

$background_image = $wp_customize->get_section('background_image');
$background_image->panel = 'site_setting_options';
$background_image->priority = 20;