<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description TEXTAREA field for widget
 */
?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>:
	</label>
	<textarea class="widefat <?php echo esc_attr($centurylib_widget_relation_class); ?>" rows="<?php echo intval( $centurylib_widgets_row ); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" data-relations="<?php echo esc_attr($centurylib_widget_relation_json) ?>" ><?php echo esc_html( $centurylib_widget_field_value ); ?></textarea>
</p>