<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for radio field
 */
?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>:
	</label>
	<div class="radio-wrapper">
		<?php
			foreach ( $centurylib_widget_field_options as $athm_option_name => $athm_option_title ){
		?>
			<input id="<?php echo esc_attr( $centurywidget->get_field_id( $athm_option_name ) ); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" type="radio" value="<?php echo esc_attr( $athm_option_name ); ?>" <?php checked( $athm_option_name, $centurylib_widget_field_value ); ?> />
				<label for="<?php echo esc_attr( $centurywidget->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?>:</label>
		<?php } ?>
	</div>
	<?php if ( isset( $centurylib_widget_field_description ) ) { ?>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
	<?php } ?>
</p>