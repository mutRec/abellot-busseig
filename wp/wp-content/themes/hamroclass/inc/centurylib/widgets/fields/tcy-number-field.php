<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for number field
 */
$field_attribute = isset($widget_field['centurylib_widget_field_attrs']) ? $widget_field['centurylib_widget_field_attrs'] : array();
?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>:
	</label><br/>
	<input class="widefat" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" type="number" id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" value="<?php echo esc_attr( $centurylib_widget_field_value ); ?>" <?php centurylib_the_attr($field_attribute); ?>/>
	<?php if ( isset( $centurylib_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
	<?php } ?>
</p>