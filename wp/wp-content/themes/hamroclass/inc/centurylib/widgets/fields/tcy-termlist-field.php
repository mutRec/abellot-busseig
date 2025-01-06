<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for term list field
 */
?>
<p class="tcy-widget-field-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>">
		<?php echo esc_html( $centurylib_widget_field_title ); ?>: 
	</label>
	<?php
	/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
	if( taxonomy_exists( $centurylib_widget_taxonomy_type ) ){
		$args = array(
			'show_option_all'	=> esc_html__('Show All', 'hamroclass'),
			'show_option_none'   => false,
			'orderby'            => 'name',
			'order'              => 'asc',
			'show_count'         => 1,
			'hide_empty'         => 0,
			'echo'               => 1,
			'selected'           => $centurylib_widget_field_value,
			'hierarchical'       => 1,
			'name'               => esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ),
			'id'                 => esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ),
			'class'              => 'widefat',
			'taxonomy'           => $centurylib_widget_taxonomy_type,
			'hide_if_empty'      => false,
		);
		wp_dropdown_categories( $args );	
	}else{
		?><select id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" class="widefat">
			<option value=""><?php esc_html_e( 'No terms found in this taxonomy', 'hamroclass' ); ?></option>
		</select><?php
	}	

	if ( isset( $centurylib_widget_field_description ) ) { 
		?>
		<br/>
		<small><?php echo esc_html( $centurylib_widget_field_description ); ?></small>
		<?php 
	} 
	?>

</p>