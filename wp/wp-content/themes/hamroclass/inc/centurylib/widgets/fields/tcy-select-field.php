<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description Select field for widget
 */
 ?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>:
	</label>
	<select name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" class="widefat <?php echo esc_attr($centurylib_widget_relation_class); ?>" data-relations="<?php echo esc_attr($centurylib_widget_relation_json) ?>">
		<?php foreach ( $centurylib_widget_field_options as $athm_option_name => $athm_option_title ) { ?>
			<option value="<?php echo esc_attr( $athm_option_name ); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $centurylib_widget_field_value ); ?>>
				<?php echo esc_html( $athm_option_title ); ?>
			</option>
		<?php } ?>
	</select>
	<?php if ( isset( $centurylib_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
	<?php } ?>
</p>