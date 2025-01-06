<?php
/*
 * Global theme related settings
 */

if(!function_exists('centurylib_after_setup_theme')):

	function centurylib_after_setup_theme(){

		add_image_size( 'centurylib-thumb-400x300', 400, 300, true );

	}

endif;
add_action( 'after_setup_theme', 'centurylib_after_setup_theme' );

/*
 * Enqueue Scripts and Styles
 */

if(!function_exists('centurylib_admin_enqueue_scripts') ):

	function centurylib_admin_enqueue_scripts(){

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');

		wp_enqueue_style( 'tcy-admin-styles', centurylib_assets_url('css/tcy-admin-styles.min.css'), array(), '1.0.0');
		wp_enqueue_style( 'font-awesome', centurylib_assets_url('library/font-awesome/css/font-awesome.min.css'), array(), '1.0.0');

		wp_enqueue_script('tcy-admin-script', centurylib_assets_url('js/tcy-admin-script.min.js'), array('jquery'), '1.0.0', true);

	}

endif;

add_action('admin_enqueue_scripts', 'centurylib_admin_enqueue_scripts');

if(!function_exists('centurylib_front_enqueue_scripts') ):

	function centurylib_front_enqueue_scripts(){

		wp_enqueue_style( 'font-awesome', centurylib_assets_url('library/font-awesome/css/font-awesome.min.css'), array(), '1.0.0');
		wp_enqueue_style( 'tcy-front-style', centurylib_assets_url('css/tcy-front-style.min.css'), array(), '1.0.0' );

		wp_enqueue_script('tcy-front-script', centurylib_assets_url('js/tcy-front-script.min.js'), array('jquery'), '1.0.0', true);
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

endif;
add_action('wp_enqueue_scripts', 'centurylib_front_enqueue_scripts');


$filter_name = 'upload_mimes';
/**
 * custom mimes upload
 */
if(!function_exists('hamroclass_custom_upload_mimes')):

	function hamroclass_custom_upload_mimes($mimes = array()) {

    // Add a key and value for the CSV file type
		$mimes['csv'] = "text/csv";
		return $mimes;
	}

endif;

add_filter( $filter_name, 'hamroclass_custom_upload_mimes');
