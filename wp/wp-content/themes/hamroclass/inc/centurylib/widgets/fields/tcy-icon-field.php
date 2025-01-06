<?php
/**
 * @package themecentury
 * @subpackage centurylib
 * @since centurylib 1.0.0
 * @version 1.0.0
 * @description this file for icon field
 */
?>
<div class="tcy-widget-field-wrapper centurylib-icons-wrapper <?php echo esc_attr($centurylib_widget_field_wraper); ?>">
    <div class="centurylib-icon-preview">
        <?php if( !empty( $centurylib_widget_field_value ) ) { echo '<i class="fa '. esc_attr( $centurylib_widget_field_value ).'"></i>'; } ?>
    </div>
    <div class="icon-toggle">
        <?php echo ( empty( $centurylib_widget_field_value )? esc_html__('Add Icon','hamroclass'): esc_html__('Edit Icon','hamroclass') ); ?>
        <span class="dashicons dashicons-arrow-down"></span>
    </div>
    <div class="icons-list-wrapper hidden">
        <input class="icon-search widefat" type="text" placeholder="<?php esc_attr_e('Search Icon','hamroclass')?>">
        <?php
        $centurylib_icons_list = centurylib_fa_iconslist();
        foreach ( $centurylib_icons_list as $single_icon ) {
            if( $centurylib_widget_field_value == $single_icon ) {
                echo '<span class="single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
            } else {
                echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
            }
        }
        ?>
    </div>
    <input class="widefat tcy-icon-value <?php echo esc_attr($centurylib_widget_relation_class); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $centurylib_widget_field_name ) ); ?>" type="hidden" name="<?php echo esc_attr( $centurywidget->get_field_name( $centurylib_widget_field_name ) ); ?>" value="<?php echo esc_attr( $centurylib_widget_field_value ); ?>" placeholder="fa-desktop"  data-relations="<?php echo esc_attr($centurylib_widget_relation_json) ?>"/>
</div>