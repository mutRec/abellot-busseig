<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for page list field
 */
?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>: 
	</label>
	<?php
	/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
	$args = array(
		'selected'              => $centurylib_widget_field_value,
		'name'                  => esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ),
		'id'                    => esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ),
		'class'                 => 'widefat',
		'show_option_none'      => esc_html__('Select Page','hamroclass'),
		'option_none_value'     => 0 // string
	);
	wp_dropdown_pages( $args );

	if ( isset( $centurylib_widget_field_description ) ) { 
		?>
		<br/>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
		<?php 
	} 
	?>
</p>
