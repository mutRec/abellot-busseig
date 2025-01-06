<?php
/*
 * Site Identity
 */

$title_tagline = $wp_customize->get_section('title_tagline');
$title_tagline->priority = 10;
$title_tagline->panel = 'site_header_panel';