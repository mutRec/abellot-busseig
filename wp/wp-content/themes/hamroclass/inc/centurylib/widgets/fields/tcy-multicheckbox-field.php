<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for multiple checkbox field
 */
$centurylib_widget_field_value = (array)$centurylib_widget_field_value;
?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<?php echo esc_html( $centurylib_widget_field_title ); ?>
	<?php foreach ( $centurylib_widget_field_options as $athm_option_name => $athm_option_title ) { ?>
		<label class="block-field widefat" for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ).esc_attr($athm_option_name); ?>">
			<input id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ).esc_attr($athm_option_name); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>[]" type="checkbox" value="<?php echo esc_attr($athm_option_name); ?>" <?php checked(1, in_array($athm_option_name, $centurylib_widget_field_value) ); ?>/>
			<?php echo esc_html( $athm_option_title ); ?>
		</label>
	<?php } ?>
	<?php if ( isset( $centurylib_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo wp_kses_post( $centurylib_widget_field_description ); ?></small>
	<?php } ?>
</p>