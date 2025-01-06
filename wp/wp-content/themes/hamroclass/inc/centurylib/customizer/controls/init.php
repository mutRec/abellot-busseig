<?php
/*
 * Custom Controls for customizers
 */
if(!function_exists('centurylib_customize_control_register')){

	function centurylib_customize_control_register($wp_customize){

		require_once centurylib_file_directory('customizer/controls/tcy-theme-information-control.php');	
		require_once centurylib_file_directory('customizer/controls/tcy-customizer-icons-control.php');	
		require_once centurylib_file_directory('customizer/controls/tcy-customizer-message-control.php');		
		require_once centurylib_file_directory('customizer/controls/tcy-customizer-repeater-control.php');
		require_once centurylib_file_directory('customizer/controls/tcy-customizer-imageoptions-control.php');
		require_once centurylib_file_directory('customizer/controls/tcy-customizer-termslist-control.php');
		require_once centurylib_file_directory('customizer/controls/tcy-customizer-switch-control.php');

		$wp_customize->register_control_type('Centurylib_Customize_Imageoptions_Control');
		
	}

}

add_action('customize_register', 'centurylib_customize_control_register');