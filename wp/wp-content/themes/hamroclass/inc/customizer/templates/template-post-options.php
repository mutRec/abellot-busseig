<?php
/**
 * Post Settings
 *
 * @since 1.0.0
 */

$wp_customize->get_setting( 'centurylib_related_posts_title' )->transport = 'postMessage';
$wp_customize->selective_refresh->add_partial(
	'centurylib_related_posts_title',
	array(
		'selector' => 'h2.hmc-related-title',
		'render_callback' => 'hamroclass_customize_partial_related_title',
	)
);
