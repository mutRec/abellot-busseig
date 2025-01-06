<?php
/**
 * Implementation of slider feature.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @version 1.0.0
 */
if( ! function_exists( 'hamroclass_default_banner_slider_details' ) ){

	function hamroclass_default_banner_slider_details( $banner_details =array() ){

		$other_details = array();

		$other_details[ 'post_type' ] = get_theme_mod( 'banner_slider_post_type', 'page' );
		$other_details[ 'readmore_text' ] = get_theme_mod( 'banner_slider_readmore_text', esc_html__( 'Read More...', 'hamroclass' ) );
		$other_details[ 'transition_effect' ] = get_theme_mod( 'banner_slider_transition_effect', 'fade' );
		$other_details[ 'transition_effect' ] = get_theme_mod( 'banner_slider_transition_effect', 'fade' );
		$other_details[ 'transition_delay' ] = get_theme_mod( 'banner_slider_transition_delay', 1 );
		$other_details[ 'transition_duration' ] = get_theme_mod( 'banner_slider_transition_duration', 1 );
		$other_details[ 'enable_description' ] = get_theme_mod( 'banner_slider_enable_description', true );
		$other_details[ 'arrow_layout' ] = get_theme_mod( 'banner_slider_arrow_layout', 'default' );
		$other_details[ 'enable_autoplay' ] = get_theme_mod( 'banner_slider_enable_autoplay', true );
		$other_details[ 'enable_overlay' ] = get_theme_mod( 'banner_slider_enable_overlay', true );
		$other_details[ 'thumbnail_size' ] = get_theme_mod( 'banner_slider_thumbnail_size', 'full' );
		$other_details[ 'description_length' ] = get_theme_mod( 'banner_slider_description_length', '150' );

		$banner_slider_items = get_theme_mod( 'banner_slider_items' );
		$banner_details['slides'] = ($banner_slider_items) ? json_decode($banner_slider_items, true) : array();
		$banner_details['other_details'] = $other_details;
		return $banner_details;

	}

}

if( ! function_exists( 'hamroclass_default_main_services' ) ){

	function hamroclass_default_main_services( $services_details =array() ){

		$other_options = array();
		$other_options[ 'noof_columns' ] = get_theme_mod( 'main_service_noof_columns', 4 );
		$other_options[ 'enable_overlap' ] = get_theme_mod( 'main_service_overlap_toppart', 1 );

		$services_list = get_theme_mod( 'hamroclass_services_list' );

		$services_details['other_options'] = $other_options;
		$services_details['services_list'] = ($services_list) ? json_decode($services_list, true) : array();
		return $services_details;

	}
}


add_filter( 'hamroclass_default_banner_slider_details', 'hamroclass_default_banner_slider_details', 10, 1 );
add_filter( 'hamroclass_default_main_services', 'hamroclass_default_main_services', 10, 1 );