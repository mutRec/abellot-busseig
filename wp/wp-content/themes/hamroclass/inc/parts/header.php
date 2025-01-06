<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/**
 * Site Branding Section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_site_identity_section' ) ):

	function hamroclass_site_identity_section() {
		?>
		<div class="site-branding">
			<?php if ( has_custom_logo() ){ ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-logo -->
			<?php }
			$header_textcolor = get_theme_mod('header_textcolor');
			if($header_textcolor!='blank'){
				if( is_front_page() ){ ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php }else{ ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				}
				$description = get_bloginfo( 'description', 'display' );
				if( $description || is_customize_preview() ){ ?>
					<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */?></p>
					<?php 
				}
			}
			?>
		</div><!-- .site-branding -->
		<?php
	
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Website Preloader Section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_preloader_image_section' ) ) :

	function hamroclass_preloader_image_section(){
		
		/**
	     * Website Preloader
	     *
	     * @since 1.0.0
	     */
		get_template_part( 'template-parts/parts/site', 'preloader' );

	}

endif;

add_action( 'hamroclass_preloader_section', 'hamroclass_preloader_image_section', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_image_onheader_section' ) ):

	function hamroclass_image_onheader_section() {
	
		get_template_part( 'template-parts/header/header', 'image' );

	}

endif;

add_action( 'hamroclass_header_image_section', 'hamroclass_image_onheader_section', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Website header notice Section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_notice_header_section' ) ) :

	function hamroclass_notice_header_section(){
		
		/**
	     * Website header notice
	     *
	     * @since 1.0.0
	     */
		get_template_part( 'template-parts/header/header', 'notice' );

	}

endif;

add_action( 'hamroclass_header_notice_section', 'hamroclass_notice_header_section', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Section Top Header
 *
 * @since 1.0.0
 */
if( !function_exists( 'hamroclass_header_top_section' ) ):

	function hamroclass_header_top_section(){

		get_template_part( 'template-parts/header/top', 'header' );

	}

endif;
add_action( 'hamroclass_top_header_section', 'hamroclass_header_top_section', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Section Site Branding
 *
 * @since 1.0.0
 */
if( !function_exists( 'hamroclass_header_site_branding_section' ) ):

	function hamroclass_header_site_branding_section(){

		get_template_part( 'template-parts/header/site', 'branding' );

	}

endif;
add_action( 'hamroclass_site_branding_header', 'hamroclass_header_site_branding_section', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Section Header Navigation
 *
 * @since 1.0.0
 */
if( !function_exists( 'hamroclass_header_main_navigation_section' ) ):

	function hamroclass_header_main_navigation_section(){

		get_template_part( 'template-parts/header/main', 'navigation' );

	}

endif;
add_action( 'hamroclass_main_navigation_header', 'hamroclass_header_main_navigation_section', 10 );


if( !function_exists( 'hamroclass_preloader_before_page' ) ):

	function hamroclass_preloader_before_page(){

		/*
		 * hamroclass_preloader_section - hook
		 *
		 * @hooked - hamroclass_preloader_image_section - 10
		 * @since 1.0.0
		 */
		do_action( 'hamroclass_preloader_section' );

	}

endif;
add_action( 'hamroclass_before_page', 'hamroclass_preloader_before_page', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Section Main Header
 *
 * @since 1.0.0
 */
if( !function_exists( 'hamroclass_header_main_section' ) ):

	function hamroclass_header_main_section(){

		$harmoclass_branding_alignment = get_theme_mod( 'harmoclass_branding_alignment', 'left' );
		$harmoclass_logo_on_navigation = get_theme_mod( 'harmoclass_logo_on_navigation', 'disable' );
		$site_header_class = $harmoclass_branding_alignment;
		if($harmoclass_logo_on_navigation=='enable'){
			$site_header_class.= ' default';
		}
		?>
		<header id="masthead" class="site-header <?php echo esc_attr( $site_header_class ); ?>">
			<?php

			/**
			 * hamroclass_header_image_section - hook
			 *
			 * @hooked - hamroclass_image_onheader_section - 10
			 * @since 1.0.0
			 */
			do_action( 'hamroclass_header_image_section' );

			$enable_notice = get_theme_mod( 'hamroclass_notice_option', 'show' );
			
			if ( $enable_notice == 'show' && is_front_page() ) {

				/**
				 * hamroclass_header_notice_section - hook
				 *
				 * @hooked - hamroclass_notice_header_section - 10
				 * @since 1.0.0
				 */
				do_action( 'hamroclass_header_notice_section' );

			}
			$enable_top_header = get_theme_mod( 'hamroclass_top_header_option', 'show' );
			if ( $enable_top_header == 'show' ) {

				/**
				 * hamroclass_top_header_section - hook
				 *
				 * @hooked - hamroclass_header_top_section - 10
				 * @since 1.0.0
				 */
				do_action( 'hamroclass_top_header_section' );

			}
			if(get_theme_mod( 'hamroclass_show_branding_header', 'enable' ) == 'enable' ){
				/**
				 * hamroclass_site_branding_header - hook
				 *
				 * @hooked - hamroclass_header_site_branding_section - 10
				 * @since 1.0.0
				 */
				do_action( 'hamroclass_site_branding_header' );
			}

			/**
			 * hamroclass_main_navigation_header - hook
			 *
			 * @hooked - hamroclass_header_main_navigation_section - 10
			 * @since 1.0.0
			 */
			do_action( 'hamroclass_main_navigation_header' );
			?>
		</header>
		<?php

	}

endif;
add_action( 'hamroclass_main_header_section', 'hamroclass_header_main_section', 10 );
