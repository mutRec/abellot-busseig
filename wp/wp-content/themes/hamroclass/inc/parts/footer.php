<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package themecentury
 * @subpackage HamroClass
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_footer_start' ) ) :
	function hamroclass_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
		
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_footer_widget_section' ) ) :
	function hamroclass_footer_widget_section() {
		/**
 		* parallax footer
 		*
 		* @since 1.0.0
 		*/
 		$parallax_footer = get_theme_mod('hamroclass_parallax_footer');
 		if($parallax_footer) { ?>
 			<div class="parallax" style='background-image: url("<?php echo esc_url($parallax_footer); ?>"); '>
 				<div class="parallax-content">
 				<?php } ?>
 				<?php
 				get_template_part( 'template-parts/footer/footer', 'main' );
 				$parallax_footer = get_theme_mod('hamroclass_parallax_footer');
 				?>
 				<?php if($parallax_footer) {  ?>
 				</div> 
 			</div> 
 			<?php
 		}
 	}
 endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_bottom_footer_start' ) ) :
	function hamroclass_bottom_footer_start() {
		echo '<div class="bottom-footer hmc-clearfix">';
		echo '<div class="hmc-container">';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer side info
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_footer_site_info_section' ) ) :
	function hamroclass_footer_site_info_section() {
?>
		<div class="site-info">
			<span class="hmc-copyright-text">
				<?php
					$footer_copyright_text = get_theme_mod( 'footer_copyright_text', esc_html__( 'Copyright 2019 All rights reserved.', 'hamroclass' ) );
					echo esc_html( $footer_copyright_text );
				?>
			</span>
			<?php $remove_footer_link = apply_filters( 'hamroclass_remove_footer_link', false ); ?>
			<?php if(!$remove_footer_link): ?>
				<span class="sep"> | </span>
				<?php
				$hamroclass_author_url = 'https://themecentury.com/';
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'hamroclass' ), 'HamroClass', '<a href="'. esc_url( $hamroclass_author_url ).'"  target="_blank">Themecentury</a>' );
				?>
			<?php endif; ?>
		</div><!-- .site-info -->
<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer menu
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_footer_menu_section' ) ) :
	function hamroclass_footer_menu_section() {
		?>
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 
				'depth' => 1, 
				'theme_location' => 'hamroclass_footer_menu', 
				'menu_id' => 'footer-menu',
				'fallback_cb' => 'hamroclass_custom_fallback_menu',
			) );
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_bottom_footer_end' ) ) :
	function hamroclass_bottom_footer_end() {
		echo '</div><!-- .hmc-container -->';
		echo '</div> <!-- bottom-footer -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_footer_end' ) ) :
	function hamroclass_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Go to Top Icon
 *
 * @since 1.0.0
 */

if( ! function_exists( 'hamroclass_go_top' ) ) :
	function hamroclass_go_top() {
		echo '<div id="hmc-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed functions for footer hook
 *
 * @since 1.0.0
 */
add_action( 'hamroclass_footer', 'hamroclass_footer_start', 10 );
add_action( 'hamroclass_footer', 'hamroclass_footer_widget_section', 30 );
add_action( 'hamroclass_footer', 'hamroclass_bottom_footer_start', 40 );
add_action( 'hamroclass_footer', 'hamroclass_footer_site_info_section', 50 );
add_action( 'hamroclass_footer', 'hamroclass_footer_menu_section', 60 );
add_action( 'hamroclass_footer', 'hamroclass_bottom_footer_end', 70 );
add_action( 'hamroclass_footer', 'hamroclass_footer_end', 90 );
add_action( 'hamroclass_footer', 'hamroclass_go_top', 100 );
