<?php
/**
 * Category Colors
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
	'centurylib_categories_color_options',
	array(
		'priority'      => 20,
		'title'         => esc_html__( 'Category Colors', 'hamroclass' ),
		'panel'         => 'site_color_options',
	)
);

$priority = 10;

$categories = get_categories( array( 'hide_empty' => 0 ) );

foreach ( $categories as $category_list ) {

	$wp_customize->add_setting( 
		'centurylib_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
		array(
			'default'              => '#0f233a',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize, 
			'centurylib_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
			array(
				/* translators: %s: Category Name */
				'label'    => sprintf( esc_html__( ' %s Button Background', 'hamroclass' ), esc_attr( $category_list->name ) ),
				'section'  => 'centurylib_categories_color_options',
				'priority' => $priority
			)
		)
	);

	$priority+=10;

}