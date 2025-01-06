<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for color field
 */
?>
<p class="tcy-widget-field-wrapper tcy-color-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>:
	</label>
	<input class="widefat tcy-color-picker <?php echo esc_attr($centurylib_widget_relation_class); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" type="text" value="<?php echo esc_attr( $centurylib_widget_field_value ); ?>"  data-relations="<?php echo esc_attr($centurylib_widget_relation_json) ?>"/>
	<?php if ( isset( $centurylib_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
	<?php } ?>
</p>