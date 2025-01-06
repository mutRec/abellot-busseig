<?php
/**
 * Theme Century Functions
 */
require_once hamroclass_file_directory('inc/functions/init.php');

/*
 * Include Theme Century library 
 */
require_once hamroclass_file_directory( 'inc/centurylib/init.php' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
require_once hamroclass_file_directory( 'inc/widgets/init.php' );

if(is_admin()){

	//TGMPA plugin activation
	require_once hamroclass_file_directory( 'inc/library/tgm-plugin-activation/class-tgm-plugin-activation.php' );

	//Hamroclass Admin
	require_once hamroclass_file_directory( 'inc/library/class-hamroclass-admin.php' );

}

/**
 * require Theme Century hooks files.
 */
require_once hamroclass_file_directory( 'inc/hooks/init.php' );

/**
 * Theme Century Customizer
 */
require_once hamroclass_file_directory( 'inc/customizer/init.php' );

/**
 * Theme Century Parts Hooks
 */
require_once hamroclass_file_directory( 'inc/parts/init.php' );
