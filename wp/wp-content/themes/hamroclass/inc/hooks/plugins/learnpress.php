<?php
/**
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.2
 */

if(!function_exists( 'hamroclass_learnpress_enqueue_scripts' ) ):

	function hamroclass_learnpress_enqueue_scripts(){

		global $hamroclass_version;

		wp_enqueue_style( 'hamroclass-learnpress', get_template_directory_uri() . '/assets/css/learnpress.min.css', array(), esc_attr( $hamroclass_version ) );

	}
	
endif;
add_action( 'wp_enqueue_scripts', 'hamroclass_learnpress_enqueue_scripts', 1000 );

if(!function_exists('hamroclass_before_left_user_profile')):
	
	function hamroclass_before_left_user_profile($profile){
	
		echo '<div class="hamroclass-left-profile-wraper">';
	
	}

endif;
add_action( 'learn-press/before-user-profile', 'hamroclass_before_left_user_profile', 1, 1 );


if(!function_exists('hamroclass_after_left_user_profile')):
	
	function hamroclass_after_left_user_profile($profile){
	
		echo '</div>';
	
	}

endif;
add_action( 'learn-press/after-profile-nav', 'hamroclass_after_left_user_profile', 10, 1 );

if(!function_exists('harmoclass_learnpress_thumbnail_change')):

	function harmoclass_learnpress_change_placeholder($thumbnail){

		$search_image = plugins_url( 'learnpress/assets/images/placeholder-800x450.jpg');
		$replace_image = get_template_directory_uri().'/assets/img/blank-image.jpg';
		$new_thumbnail = str_replace($search_image, $replace_image, $thumbnail);
		return $new_thumbnail;

	}

endif;
add_filter( 'hamroclass_learnpress_thumbnail', 'harmoclass_learnpress_change_placeholder', 10, 1 );

if(!function_exists('hamroclass_learnpress_template_redirect_callback')):

	function hamroclass_learnpress_template_redirect_callback(){

		remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_buttons', 35 );

	}

endif;

add_action( 'plugins_loaded', 'hamroclass_learnpress_template_redirect_callback', 10 );


if(!function_exists('hamroclass_learnpress_loop_item_before_title')):

	function hamroclass_learnpress_loop_item_before_title(){

		?><div class="hamroclass-course-content"><?php

	}

endif;

add_action( 'learn-press/courses-loop-item-title', 'hamroclass_learnpress_loop_item_before_title', 11 );

if(!function_exists('hamroclass_learnpress_loop_item_after_content')):

	function hamroclass_learnpress_loop_item_after_content(){

		?></div> <!--.hamroclass-course-content-->
		<?php

	}

endif;
add_action( 'learn-press/after-courses-loop-item', 'hamroclass_learnpress_loop_item_after_content', 50 );

if(!function_exists('hamroclass_learnpress_addons_tabs')):

	function hamroclass_learnpress_addons_tabs($tabs){
		if(isset($tabs['more'])){
			unset($tabs['more']);
		}
		if(isset($tabs['themes'])){
			unset($tabs['themes']);
		}
		return $tabs;
	}

endif;

add_action('learn-press/admin/page-addons-tabs', 'hamroclass_learnpress_addons_tabs', 10, 1 );