<?php
/**
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.2
 */

if(!function_exists( 'hamroclass_sikshya_enqueue_scripts' ) ):

	function hamroclass_sikshya_enqueue_scripts(){

		global $hamroclass_version;

		wp_enqueue_style( 'hamroclass-sikshya', get_template_directory_uri() . '/assets/css/sikshya.min.css', array(), esc_attr( $hamroclass_version ) );

	}
	
endif;
add_action( 'wp_enqueue_scripts', 'hamroclass_sikshya_enqueue_scripts', 1000 );