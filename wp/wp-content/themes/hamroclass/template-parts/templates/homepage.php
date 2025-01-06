<?php
/**
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/**
 * Home Top Section Area
 *
 * @since 1.0.0
 */

get_template_part( 'template-parts/parts/banner', 'slider' );

get_template_part( 'template-parts/parts/main', 'services' );

if ( is_active_sidebar( 'hamroclass_home_content_area' ) ) {
	?>
	<div class="hmc-home-content-section hmc-clearfix">
		<div class="hmc-container-fluid">
			<?php dynamic_sidebar( 'hamroclass_home_content_area' ); ?>
		</div>
	</div><!-- .hmc-home-top-section -->
	<?php
}

/**
 * Home Middle Section Area
 *
 * @since 1.0.0
 */
if ( is_active_sidebar( 'hamroclass_home_middle_section_area' ) ) {
	?>
	<div class="hmc-home-middle-section  hmc-clearfix">
		<div class="hmc-container">
			<div class="middle-primary widget-area hamroclass-sticky-wraper">
				<?php dynamic_sidebar( 'hamroclass_home_middle_section_area' ); ?>
			</div><!-- .middle-primary -->
			<div class="middle-aside sidebar-main-area widget-area hamroclass-sticky-wraper">
				<?php dynamic_sidebar( 'hamroclass_home_middle_aside_area' ); ?>
			</div><!-- .middle-aside -->
		</div>
	</div><!-- .hmc-home-middle-section -->
	<?php
}

/**
 * Home Bottom Section Area
 *
 * @since 1.0.0
 */
if ( is_active_sidebar( 'hamroclass_home_bottom_section_area' ) ) {
	?>
	<div class="hmc-home-bottom-section">
		<div class="hmc-container-fluid">
			<?php dynamic_sidebar( 'hamroclass_home_bottom_section_area' ); ?>
		</div>
	</div><!-- .hmc-home-bottom-section -->

	<?php

}
