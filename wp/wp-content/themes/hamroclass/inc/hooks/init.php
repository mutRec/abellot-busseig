<?php
/**
 * hamroclass setup hooks
 */
require_once hamroclass_file_directory('inc/hooks/setup.php');

/**
 * hamroclass setup hooks
 */
require_once hamroclass_file_directory('inc/hooks/jetpack.php');

/**
 * Ajax Related code goes here
 */
require_once hamroclass_file_directory('inc/hooks/ajax.php');

/**
 * Dynamic styles from customizer and settings
 */
require_once hamroclass_file_directory('inc/hooks/styles.php');

/**
 * Single related hooks
 */
require_once hamroclass_file_directory('inc/hooks/single.php');

if(is_admin()):
	/**
	 * TGMPA Installation Plugin
	 */
	require_once hamroclass_file_directory('inc/hooks/tgmpa.php');
	
endif;

/**
 * plugins related hooks
 */
require_once hamroclass_file_directory('inc/hooks/plugins/init.php');