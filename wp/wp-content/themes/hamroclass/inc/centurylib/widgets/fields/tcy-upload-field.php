<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description UPLOAD field for widget
 */
?>
<p class="tcy-widget-field-wrapper sub-option widget-upload <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>"><?php echo esc_html( $centurylib_widget_field_title ); ?></label>
	<span class="img-preview-wrap" <?php echo empty( $centurylib_widget_field_value ) ? 'style="display:none;"' : ''; ?>>
		<img class="widefat" src="<?php echo esc_url( $centurylib_widget_field_value ); ?>" alt="<?php esc_attr_e( 'Image preview', 'hamroclass' ); ?>"  />
	</span>
	<!-- .img-preview-wrap -->
	<input type="text" class="widefat <?php echo esc_attr($centurylib_widget_relation_class); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" placeholder="<?php esc_attr_e('Choose file', 'hamroclass'); ?>" value="<?php echo esc_url( $centurylib_widget_field_value ); ?>" data-relations="<?php echo esc_attr($centurylib_widget_relation_json) ?>" />
	<input type="button" value="<?php esc_attr_e( 'Upload', 'hamroclass' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Image','hamroclass'); ?>" data-button="<?php esc_attr_e( 'Select Image','hamroclass'); ?>"/>
	<input type="button" value="<?php esc_attr_e( 'Remove', 'hamroclass' ); ?>" class="button media-image-remove" />
</p>