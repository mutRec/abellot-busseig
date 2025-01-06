<?php
/**
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Dynamic style about template
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'hamroclass_dynamic_styles' ) ):
	
	function hamroclass_dynamic_styles() {

		$hamroclass_theme_color      = get_theme_mod( 'hamroclass_theme_color', '#294a70' );

		$header_textcolor  = get_theme_mod( 'header_textcolor', '#294a70' );
		$theme_color = get_theme_mod( 'hamroclass_theme_color', false );

		$output_css = '';

		$output_css .= ".hmc-notice-wrapper{background:$theme_color;}\n";

		if ( $header_textcolor == 'blank' ) {
			$output_css .= ".site-title, .site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}\n";
		} else {
			$output_css .= ".site-title a{
				color:" . esc_attr( $header_textcolor ) . ";
			}\n";
			$output_css .= ".header-info-wrapper .header-info-item i{
				background-color:" . esc_attr( $header_textcolor ) . ";
			}\n";
		}
		if($theme_color){
			$output_css.= "
			.hmc-header-menu-wrapper,
			#site-navigation ul.sub-menu,
			.hmc-related-title, 
			.page-header .page-title, 
			.widget-title, 
			.edit-link .post-edit-link,
			.navigation .nav-links a,
			.bottom-footer{
				background:".esc_attr($theme_color).";
			}\n";
			$output_css.="
			#site-navigation ul li.current-menu-ancestor > a, 
			#site-navigation ul li.current-menu-item > a,
			#site-navigation ul li a:hover{
				background:".esc_attr($theme_color).";
				background-color:rgba(0,0,0,0.1);
			}\n";
			$output_css.=".hamroclass_default_tabbed_widget ul.widget-tabs li{
				background-color:".esc_attr($theme_color).";
			}\n";
			$output_css.="
			#site-navigation ul#primary-menu > li:hover > a::after,
			.navigation .nav-links a{
				border-color:".esc_attr($theme_color).";
			}\n";
		}

		$categories = get_categories( array( 'hide_empty' => 0 ) );
		foreach ( $categories as $category_details ) {
			$category_slug = $category_details->slug;
			$category_colorcode = get_theme_mod( 'centurylib_category_color_'.$category_slug, '#0f233a' );
			$output_css .= ".post-cats-list .category-button.hmc-cat-{$category_slug}{
				color:#fff;
				background:".esc_attr($category_colorcode).";
			}\n";
			$output_css .= ".post-cats-list .category-button.hmc-cat-{$category_slug}:after{
				border-left-color:".esc_attr($category_colorcode).";
				border-bottom-color:".esc_attr($category_colorcode).";
			}\n";

		}

		$refine_output_css = hamroclass_css_strip_whitespace( $output_css );

		wp_add_inline_style( 'hamroclass-main', $refine_output_css );

	}

endif;

add_action( 'wp_enqueue_scripts', 'hamroclass_dynamic_styles', 30 );