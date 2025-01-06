<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

$sidebar_list_items = hamroclass_sidebar_name_array();
foreach( $sidebar_list_items as $index=>$sidebar_name ){
	if ( ! is_active_sidebar( $sidebar_name ) ){
		continue;
	}
	$sidebar_class = apply_filters( 'hamroclass_sidebar_class', $sidebar_name );
	?>
	<aside id="secondary" class="sidebar-main-area widget-area <?php echo esc_attr($sidebar_class); ?>" role="complementary">
		<?php dynamic_sidebar( $sidebar_name ); ?>
	</aside><!-- #secondary -->
	<?php

}