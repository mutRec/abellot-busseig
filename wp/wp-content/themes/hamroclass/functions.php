<?php
/**
 * ThemeCentury functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ThemeCentury
 * @subpackage ThemeCentury
 */
/**
 *
 * @since HamroClass 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('hamroclass_file_directory') ){

    function hamroclass_file_directory( $file_path ){

    	$parent_file_path = trailingslashit( get_stylesheet_directory() ) . $file_path;
        $child_file_path = trailingslashit( get_template_directory() ) . $file_path;
        if( file_exists( wp_normalize_path( $parent_file_path ) ) ){
            return wp_normalize_path( $parent_file_path );
        }else{
            return wp_normalize_path( $child_file_path );
        }

    }

}

/**
 * Initialized hamroclass themes
 */
require_once hamroclass_file_directory( 'inc/init.php' );
