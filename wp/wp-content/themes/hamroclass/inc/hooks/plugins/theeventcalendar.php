<?php
/**
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.2
 */

if(!function_exists('hamroclass_eventlist_before_widget')):

	function hamroclass_eventlist_before_widget(){

		?><div class="hmc-container"><?php

	}

endif;
add_action( 'tribe_events_before_list_widget', 'hamroclass_eventlist_before_widget', 10 );

if(!function_exists('hamroclass_eventlist_after_widget')):

	function hamroclass_eventlist_after_widget(){

		?></div><?php
		
	}

endif;
add_action( 'tribe_events_after_list_widget', 'hamroclass_eventlist_after_widget', 10 );


if(!function_exists( 'hamroclass_theeventcalendar_enqueue_scripts' ) ):

	function hamroclass_theeventcalendar_enqueue_scripts(){

		global $hamroclass_version;

		wp_enqueue_style( 'hamroclass-theeventcalendar', get_template_directory_uri() . '/assets/css/theeventcalendar.min.css', array(), esc_attr( $hamroclass_version ) );

	}
	
endif;
add_action( 'wp_enqueue_scripts', 'hamroclass_theeventcalendar_enqueue_scripts', 20 );

if(!function_exists( 'hamroclass_event_list_form_fields' ) ):

	function hamroclass_event_list_form_fields($widget, $return, $instance ){
		if($widget->id_base != 'tribe-events-list-widget' ){
			return $return;
		}
		$event_layout = (isset($instance['event_layout'])) ? esc_attr($instance['event_layout']) : 'layout1';
		$layout_options = array(
			'layout1' => esc_html__( 'Layout One', 'hamroclass' ),
			'layout2' => esc_html__( 'Layout Two', 'hamroclass' ),
			'layout3' => esc_html__( 'Layout Three', 'hamroclass' ),
		);
		?>
		<p>
			<label for="<?php echo esc_attr( $widget->get_field_id( 'event_layout' ) ); ?>"><?php esc_html_e( 'Event Layout:', 'hamroclass' ); ?></label>
			<select id="<?php echo esc_attr( $widget->get_field_id( 'event_layout' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'event_layout' ) ); ?>" class="widefat">
				<?php foreach($layout_options as $layout_key => $layout_label ){ ?>
				<option value="<?php echo esc_attr($layout_key); ?>" <?php selected($layout_key, $event_layout) ?>><?php echo esc_html($layout_label); ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
		return null;


	}

endif;
add_action( 'in_widget_form', 'hamroclass_event_list_form_fields', 10,  3 );

if(!function_exists('hamroclass_widget_update_callback')):
	
	function hamroclass_widget_update_callback($instance, $new_instance, $old_instance){

		$instance['event_layout'] = isset($new_instance['event_layout']) ? esc_attr($new_instance['event_layout']) : 'layout1';
		
		return $instance;

	}

endif;
add_action( 'widget_update_callback', 'hamroclass_widget_update_callback', 10, 3 );

