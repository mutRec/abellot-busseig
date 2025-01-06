<?php
/**
 * sanitize functions to allow styling of the templates
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if(!function_exists('sanitize_hamroclass_show_hide')){
	
	function sanitize_hamroclass_show_hide($value){

		$sanitize_value = 'show';
		switch($value){
			case 'show':
			case 'hide':
				$sanitize_value = $value;
				break;
			default:
				$sanitize_value = 'show';
				break;
		}
		return $sanitize_value;

	}

}

if(!function_exists('sanitize_hamroclass_enable_disable')){
	
	function sanitize_hamroclass_enable_disable($value){

		$sanitize_value = 'enable';
		switch($value){
			case 'enable':
			case 'disable':
				$sanitize_value = $value;
				break;
			default:
				$sanitize_value = 'enable';
				break;
		}
		return $sanitize_value;

	}

}


if(!function_exists('sanitize_hamroclass_posttype_values')){
	
	function sanitize_hamroclass_posttype_values($value){

		$sanitize_value = 'page';
		$post_types = centurylib_posttypes();
		if(isset($post_types[$value])){
			$sanitize_value = $value;
		}
		return $sanitize_value;

	}

}

if(!function_exists('sanitize_hamroclass_transition_effect')){
	
	function sanitize_hamroclass_transition_effect($value){

		$sanitize_value = 'fade';
		$transition_effects = array(
			'fade'       => esc_html__( 'Fade', 'hamroclass' ),
			'slide'    => esc_html__( 'Slide', 'hamroclass' ),
		);
		if(isset($transition_effects[$value])){
			$sanitize_value = $value;
		}
		return $sanitize_value;

	}

}

if(!function_exists('sanitize_hamroclass_thumbnail_size')){
	
	function sanitize_hamroclass_thumbnail_size($value){

		$sanitize_value = 'full';
		$thumbnail_list = centurylib_get_image_sizes();
		if(isset($thumbnail_list[$value])){
			$sanitize_value = $value;
		}
		return $sanitize_value;

	}

}

if(!function_exists('sanitize_hamroclass_site_layout')){
	
	function sanitize_hamroclass_site_layout($value){

		$sanitize_value = 'hmc_fullwidth_layout';
		switch($value){
			case 'hmc_fullwidth_layout':
			case 'hmc_boxed_width_layout':
				$sanitize_value = $value;
				break;
			default:
				$sanitize_value = 'hmc_fullwidth_layout';
				break;
		}
		return $sanitize_value;

	}

}


if(!function_exists('sanitize_hamroclass_widget_layout')){
	
	function sanitize_hamroclass_widget_layout($value){

		$sanitize_value = 'layout2';
		switch($value){
			case 'layout1':
			case 'layout2':
				$sanitize_value = $value;
				break;
			default:
				$sanitize_value = 'layout2';
				break;
		}
		return $sanitize_value;

	}

}