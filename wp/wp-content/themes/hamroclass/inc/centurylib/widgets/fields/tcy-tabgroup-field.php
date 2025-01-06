<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for tab group field
 */
$current_widget_slug = $centurywidget->id_base.'_'.$centurywidget->number.'_';
?>
<div class="tcy-widget-field-tab-wraper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<h5 class="tcy-widget-tab-list nav-tab-wrapper">
		<?php 
		foreach($centurylib_widget_field_options as $tab_key=>$tab_details){
			$current_tab_id = $current_widget_slug.$tab_key;
			?>
			<label for="field_<?php echo esc_attr($current_tab_id); ?>" data-id="#content_<?php echo esc_attr($current_tab_id); ?>" class="nav-tab <?php echo ($tab_key == $centurylib_widget_field_value) ? 'nav-tab-active' : ''; ?>"><?php echo esc_html($tab_details['centurylib_widget_field_title']); ?><input id="field_<?php echo esc_attr($current_tab_id); ?>" type="radio" name="<?php echo esc_attr($centurywidget->get_field_name($centurylib_widget_field_name) ); ?>" value="<?php echo esc_attr($tab_key); ?>" <?php checked($centurylib_widget_field_value, $tab_key); ?> class="tcy-hidden"/></label>
		<?php } ?>
	</h5>
	<div class="tcy-tab-content-wraper">
		<?php
		foreach($centurylib_widget_field_options as $tab_key=>$tab_details){ 
			$current_tab_id = $current_widget_slug.$tab_key;
			?>
			<div id="content_<?php echo esc_attr($current_tab_id); ?>" class="centurylib-tab-contents <?php echo ($centurylib_widget_field_value==$tab_key
			) ? 'centurylib-tab-active' : ''; ?>" >
				<?php
					$all_values = get_option('widget_' . $centurywidget->id_base);
					$this_widget_instance = isset($all_values[$centurywidget->number]) ? $all_values[$centurywidget->number] : array();
					$widget_fields = isset($tab_details['centurylib_widget_field_options']) ? $tab_details['centurylib_widget_field_options'] : array();
					// Loop through fields
					if(count($widget_fields)):
			            foreach ( $widget_fields as $widget_field ) {
			                // Make array elements available as variables
			                extract( $widget_field );
			                $centurylib_widget_field_default = isset($widget_field['centurylib_widget_field_default']) ? $widget_field['centurylib_widget_field_default'] : '';
			                $centurylib_widgets_field_value = isset( $this_widget_instance[ $centurylib_widget_field_name ] ) ? $this_widget_instance[ $centurylib_widget_field_name ] : $centurylib_widget_field_default;
			                centurylib_widgets_show_widget_field( $centurywidget, $widget_field, $centurylib_widgets_field_value );
			            }
			        else:
			        	?><p><?php echo esc_html__('No fields are added on ', 'hamroclass').esc_attr($tab_details['centurylib_widget_field_name']).esc_html__(' tab', 'hamroclass'); ?></p><?php
			        endif;
				?>
			</div>
		<?php } ?>
	</div>
</div>