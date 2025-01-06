<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>><?php
	
	do_action( 'wp_body_open' );
	
	?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hamroclass' ); ?></a>
	<?php
	/**
	 * hamroclass_before_page hook
	 *
	 * @hooked - hamroclass_preloader_section - 10
	 * @since 1.0.0
	 */
	do_action( 'hamroclass_before_page' );
	?>
	<div id="page" class="site">
		<?php
		/**
		 * hamroclass_header_main_section hook
		 *
		 * @hooked - hamroclass_header_main_section - 10
		 *
		 * @since 1.0.0
		 */
		do_action( 'hamroclass_main_header_section' );
		?>
		<div id="content" class="site-content">
			<?php
			$header_main_wrapper = 'hamroclass-main-wrapper';
			$widget_template = get_theme_mod( 'hamroclass_static_homepage_layout', 'widgetize' );
			if( ! ( $widget_template=='widgetize' && is_front_page() && !is_home() ) ){
				$header_main_wrapper = 'hmc-container';
			}
			?>
			<div class="<?php echo esc_attr($header_main_wrapper); ?>">
