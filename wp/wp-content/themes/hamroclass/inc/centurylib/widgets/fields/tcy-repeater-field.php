<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description Repeater field for widget
 */
$tcy_repeater_row_title = isset($widget_field['tcy_repeater_row_title']) ? $widget_field['tcy_repeater_row_title'] : esc_html__('Row', 'hamroclass');
$tcy_repeater_addnew_label = isset($widget_field['tcy_repeater_addnew_label']) ? $widget_field['tcy_repeater_addnew_label'] : esc_html__('Add row', 'hamroclass');
$centurylib_widget_field_options = isset($widget_field['centurylib_widget_field_options']) ? $widget_field['centurylib_widget_field_options'] : array();
$coder_repeater_depth = 'coderRepeaterDepth_'.'0';
$tcy_repeater_main_key = $centurylib_widget_field_name;
?>
<div class="tcy-widget-field-wrapper tcy-widget-repeater-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label class="tcy-widget-repeater-heading" for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>"><?php echo esc_html( $centurylib_widget_field_title ); ?>:</label>
	<div class="centurylib-main-repeater">
		<?php
		$repeater_count = 0;
		if( is_array( $centurylib_widget_field_value ) && count( $centurylib_widget_field_value ) > 0 ){
			foreach ($centurylib_widget_field_value as $repeater_key=>$repeater_details){
				?>
				<div class="tcy-widget-repeater-table">
					<div class="centurylib-repeater-top">
						<div class="centurylib-repeater-title-action">
							<button type="button" class="centurylib-repeater-action">
								<span class="te-toggle-indicator" aria-hidden="true"></span>
							</button>
						</div>
						<div class="centurylib-repeater-title">
							<h3><?php echo esc_html($tcy_repeater_row_title); ?><span class="centurylib-main-repeater-inner-title"></span></h3>
						</div>
					</div>
					<div class='centurylib-inside-repeater hidden'>
						<?php
						foreach($centurylib_widget_field_options as $repeater_slug => $repeater_data){
							
							$tcy_repeater_child_field_name = (isset($repeater_data['centurylib_widget_field_name'] ) ) ? esc_attr($repeater_data['centurylib_widget_field_name']) : '';
							$repeater_field_id  = esc_attr($centurywidget->get_field_id( $centurylib_widget_field_name).$tcy_repeater_child_field_name);
							$centurylib_widget_field_name = esc_attr($tcy_repeater_main_key.'['.$repeater_count.']['.$tcy_repeater_child_field_name.']');
							$repeater_data['centurylib_widget_field_name'] = $centurylib_widget_field_name;
							$centurylib_widget_field_default = (isset($repeater_data['centurylib_widget_field_default']) ) ? $repeater_data['centurylib_widget_field_default'] : '';
							$centurylib_widget_field_value = ( isset($repeater_details[$tcy_repeater_child_field_name] ) ) ? $repeater_details[$tcy_repeater_child_field_name] : $centurylib_widget_field_default;
							centurylib_widgets_show_widget_field( $centurywidget, $repeater_data, $centurylib_widget_field_value );
						}
						?>
						<div class="centurylib-main-repeater-control-actions">
							<button type="button" class="button-link button-link-delete centurylib-main-repeater-remove"><?php esc_html_e('Remove','hamroclass');?></button> |
							<button type="button" class="button-link centurylib-main-repeater-close"><?php esc_html_e('Close','hamroclass');?></button>
						</div>
					</div>
				</div>
				<?php
				$repeater_count++;
			}
		}

		?>
		<script type="text/html" class="tcy-code-for-repeater">
			<div class="tcy-widget-repeater-table">
				<div class="centurylib-repeater-top">
					<div class="centurylib-repeater-title-action">
						<button type="button" class="centurylib-repeater-action">
							<span class="te-toggle-indicator" aria-hidden="true"></span>
						</button>
					</div>
					<div class="centurylib-repeater-title">
						<h3><?php echo esc_html($tcy_repeater_row_title); ?><span class="centurylib-main-repeater-inner-title"></span></h3>
					</div>
				</div>
				<div class='centurylib-inside-repeater hidden'>
					<?php
					
					foreach($centurylib_widget_field_options as $repeater_slug => $repeater_data){
						/**/
						$tcy_repeater_child_field_name = (isset($repeater_data['centurylib_widget_field_name'] ) ) ? esc_attr($repeater_data['centurylib_widget_field_name']) : '';
						$repeater_field_id  = esc_attr($centurywidget->get_field_id( $centurylib_widget_field_name).$tcy_repeater_child_field_name);
						$centurylib_widget_field_name = esc_attr($tcy_repeater_main_key.'['.$coder_repeater_depth.']['.$tcy_repeater_child_field_name.']');
						$repeater_data['centurylib_widget_field_name'] = $centurylib_widget_field_name;
						$centurylib_widget_field_default = isset($repeater_data['centurylib_widget_field_default']) ? $repeater_data['centurylib_widget_field_default'] : '';
						centurylib_widgets_show_widget_field( $centurywidget, $repeater_data, $centurylib_widget_field_default );
					}
					?>
					<div class="centurylib-main-repeater-control-actions">
						<button type="button" class="button-link button-link-delete centurylib-main-repeater-remove"><?php esc_html_e('Remove','hamroclass');?></button> |
						<button type="button" class="button-link centurylib-main-repeater-close"><?php esc_html_e('Close','hamroclass');?></button>
					</div>
				</div>
			</div>
		</script>

		<input class="tcy-total-repeater-counter" type="hidden" value="<?php echo esc_attr( $repeater_count ) ?>">
		<span class="button tcy-add-repeater" id="<?php echo esc_attr( $coder_repeater_depth ); ?>"><?php echo esc_html($tcy_repeater_addnew_label); ?></span><br/>

	</div>
	<?php if ( isset( $centurylib_widget_field_description ) ) { ?>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
	<?php } ?>
</div>