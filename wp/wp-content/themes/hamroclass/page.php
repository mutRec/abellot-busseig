<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

get_header(); 

$hamroclass_static_homepage_layout = get_theme_mod( 'hamroclass_static_homepage_layout', 'widgetize' );

if($hamroclass_static_homepage_layout == 'widgetize' && is_front_page() ){

	get_template_part( 'template-parts/templates/homepage' );

}else{
	
	/*
	 * centurylib_breadcrumbs_section_template - hook
	 *
	 * @hooked - centurylib_breadcrumbs_section_callback - 10
	 *
	 * @since 1.0.0
	 */
	do_action( 'centurylib_breadcrumbs_section_template' );
	?>
	<div id="primary" class="content-area main-content-area">

		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/single/content', 'page' );

				/**
			     * hamroclass_after_editor_content hook
			     *
			     * @hooked -  - 10
			     *
			     * @since 1.0.0
		     	 */
				do_action('hamroclass_after_editor_content');

				// If comments are open or we have at least one comment, load up the comment template.
				if( comments_open() || get_comments_number() ){
					comments_template();
				}
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	get_sidebar();

}
get_footer();
