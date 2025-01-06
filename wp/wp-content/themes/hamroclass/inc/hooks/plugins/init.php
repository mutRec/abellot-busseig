<?php
/**
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.2
 */

/**
 * learnpress related hooks
 */
require_once hamroclass_file_directory('inc/hooks/plugins/learnpress.php');

if(defined('SIKSHYA_VERSION')){
	
	/**
	 * sikshya related hooks
	 */
	require_once hamroclass_file_directory('inc/hooks/plugins/sikshya.php');	
}
	

/**
 * The Event Calendar Hooks
 */
require_once hamroclass_file_directory('inc/hooks/plugins/theeventcalendar.php');
