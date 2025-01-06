<?php
/**
 * The template for Header Branding
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?>
<div class="hmc-logo-section-wrapper">
	<div class="hmc-container">
		<?php
		$harmoclass_logo_on_navigation = get_theme_mod( 'harmoclass_logo_on_navigation', 'disable' );
		if($harmoclass_logo_on_navigation=='disable'){
			hamroclass_site_identity_section(); 
		}
		?>
		<div class="hmc-header-banner-area">
			<?php
			$branding_options = get_theme_mod( 'hamroclass_branding_option', 'officeinfo' );
			if($branding_options=='officeinfo'){
				get_template_part( 'template-parts/parts/header', 'info' );	
			}else{
				if ( is_active_sidebar( 'hamroclass_header_branding_area' ) ) {
					dynamic_sidebar( 'hamroclass_header_branding_area' );
				}
			}
			?>
		</div><!-- .hmc-header-banner-area -->
	</div>
</div>
