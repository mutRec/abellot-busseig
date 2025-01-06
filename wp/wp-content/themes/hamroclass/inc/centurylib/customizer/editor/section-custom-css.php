<?php
/*
 * Custom Css
 */
$custom_css = $wp_customize->get_section( 'custom_css' );
$custom_css->priority = 10;
$custom_css->panel = 'site_code_editor';