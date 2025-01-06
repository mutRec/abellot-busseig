<?php
/**
 * HamroClass Theme Customizer
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hamroclass_customize_register( $wp_customize ) {

	require_once hamroclass_file_directory( 'inc/customizer/upsell/hamroclass-upsell-section.php' );
	require_once hamroclass_file_directory( 'inc/customizer/header/panel-header.php' );
	require_once hamroclass_file_directory( 'inc/customizer/templates/panel-templates.php' );
	require_once hamroclass_file_directory( 'inc/customizer/footer/panel-footer.php' );
	require_once hamroclass_file_directory( 'inc/customizer/colors/panel-colors.php' );
	require_once hamroclass_file_directory( '/inc/customizer/homepage/panel-homepage.php' );
	require_once hamroclass_file_directory( 'inc/customizer/options/panel-options.php' );

}

add_action( 'customize_register', 'hamroclass_customize_register' );


function hamroclass_customize_preview_init() {
	wp_enqueue_script( 'hamroclass_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'hamroclass_customize_preview_init' );
