<?php
/**
 * The template for main navigation
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?>
<div id="hmc-menu-wrap" class="hmc-header-menu-wrapper">
	<div class="hmc-header-menu-block-wrap">
		<div class="hmc-container">
			<?php
			if ( get_theme_mod( 'harmoclass_logo_on_navigation', 'disable' ) == 'enable' ) {
				hamroclass_site_identity_section();
			} ?>
			<div class="hmc-navigation">
				<a href="javascript:void(0)" class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </a>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location' => 'hamroclass_primary_menu',
						'menu_id'        => 'primary-menu',
						'fallback_cb' => 'hamroclass_custom_fallback_menu'
					) );
					?>
				</nav><!-- #site-navigation -->
				<?php
				$hamroclass_search_icon_option = get_theme_mod( 'hamroclass_search_icon_option', 'show' );
				if ( $hamroclass_search_icon_option == 'show' ) {
					?>
					<div class="hmc-header-search-wrapper">
						<a class="search-main" href="JavaScript:Void(0);"><i class="fa fa-search"></i></a>
						<div class="search-form-main hmc-clearfix">
							<?php get_search_form(); ?>
						</div>
					</div><!-- .hmc-header-search-wrapper -->
				<?php } ?>
			</div>
		</div>
	</div>
</div><!-- .hmc-header-menu-wrapper -->
