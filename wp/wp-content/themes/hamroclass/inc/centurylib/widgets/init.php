<?php
/*
 * Widget Initialized
 */

// Require Widget related Fields 
require_once centurylib_file_directory('widgets/fields/init.php');
/*
 * Widget Register
 */
if(!function_exists('centurylib_widget_initialize')):

    function centurylib_widget_initialize(){

        require_once centurylib_file_directory('widgets/function-tcy-widget-dependencies.php');
        require_once centurylib_file_directory('widgets/class-tcy-social-icons-widget.php');
        require_once centurylib_file_directory('widgets/class-tcy-author-info-widget.php');
        
        register_widget( 'Centurylib_Social_Icons_Widget' );
        register_widget( 'Centurylib_Author_Info_Widget' );

    }

endif;
add_action('widgets_init', 'centurylib_widget_initialize');