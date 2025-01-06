<?php
/**
 * The template for top header
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?>
<div class="hmc-top-header-wrap">
	<div class="hmc-container">
		<?php $hamroclass_date_option = get_theme_mod( 'hamroclass_top_date_option', 'show' ); ?>
		<div class="hmc-top-left-section-wrapper">
			<?php do_action('hamroclass_topheader_toggleicon' ); ?>
			<?php
			if ( $hamroclass_date_option == 'show' ) {
				echo '<div class="date-section">' . esc_html( date_i18n( 'l, F d, Y' ) ) . '</div>';
			}
			?>

			<?php if ( has_nav_menu( 'hamroclass_top_menu' ) ) { ?>
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php 
					$nav_menu_args = array(
						'depth'          => 1,
						'menu_id'        => 'top-menu',
						'theme_location' => 'hamroclass_top_menu',
						'fallback_cb' => 'hamroclass_custom_fallback_menu'
					);
					wp_nav_menu( $nav_menu_args );
					?>
				</nav><!-- #site-navigation -->
			<?php } ?>
		</div><!-- .hmc-top-left-section-wrapper -->
		<div class="hmc-top-right-section-wrapper">
			<?php
			$hamroclass_top_social_option = get_theme_mod( 'hamroclass_top_social_option', 'show' );
			if ( $hamroclass_top_social_option == 'show' ) {
				hamroclass_social_media();
			}
			?>
		</div><!-- .hmc-top-right-section-wrapper -->
	</div>
</div>

<?php
do_action( 'hamroclass_topheader_widgetarea' );
