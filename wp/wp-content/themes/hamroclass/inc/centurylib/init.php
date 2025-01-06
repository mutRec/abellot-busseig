<?php
/**
 * @since Centurylib 1.0.0
 * @param string $file_path, path from the centurylib
 * @return string full path of file inside centurylib
 *
 */
if( !function_exists( 'centurylib_file_directory' ) ){

    function centurylib_file_directory( $file_path ){

        $centurylib_path = 'inc/centurylib/'.$file_path;
        $parent_file_path = trailingslashit( get_template_directory() ) . $centurylib_path;
        $child_file_path = trailingslashit( get_stylesheet_directory() ) . $centurylib_path;
        if( file_exists( wp_normalize_path( $child_file_path ) ) ){
            return wp_normalize_path( $child_file_path );
        }else{
            return wp_normalize_path( $parent_file_path );
        }

    }

}

/**
 * @since Centurylib 1.0.0
 * @param string $file_path, path from the centurylib
 * @return string full path of file inside centurylib
 *
 */
if( !function_exists('centurylib_directory_uri') ){

    function centurylib_directory_uri( $file_url='' ){
    
        $centurylib_file_url = '/inc/centurylib/'.$file_url;

        $theme_file_url = get_template_directory_uri() . $centurylib_file_url;

        return $theme_file_url;
    
    }

}

require_once centurylib_file_directory('core/init.php');

require_once centurylib_file_directory('widgets/init.php');

require_once centurylib_file_directory('customizer/init.php');

require_once centurylib_file_directory('hooks/init.php');

require_once centurylib_file_directory('sections/init.php');

require_once centurylib_file_directory('metabox/init.php');