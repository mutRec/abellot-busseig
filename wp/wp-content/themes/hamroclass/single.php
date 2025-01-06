<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

get_header(); 

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

			get_template_part( 'template-parts/single/content', 'single' );

			/**
		     * hamroclass_author_info_section hook
		     *
		     * @hooked - hamroclass_author_box_callback - 10
		     *
		     * @since 1.0.0
		     */
			if( is_singular( 'post' )){

				do_action( 'hamroclass_author_info_section' );

			}

			//centurylib show prev and next post
			$show_before_after = get_theme_mod( 'centurylib_prev_next_button_post', 'show' );
			if($show_before_after=='show' && is_singular( 'post' ) ){
				the_post_navigation();
			}

			/**
		     * dblib_reaction_section_icons hook
		     *
		     * @hooked -  - 10
		     *
		     * @since 1.0.0
		     */
			if( is_singular( 'post' )){

				do_action('hamroclass_after_editor_content');

			}

			/**
		     * hamroclass_related_posts hook
		     *
		     * @hooked - hamroclass_related_posts_section - 10
		     *
		     * @since 1.0.0
		     */
			if( is_singular( 'post' )){
		    
		    	do_action( 'hamroclass_related_posts' );
		    
		    }


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :

				comments_template();
			
			endif;

		endwhile; // End of the loop.
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_sidebar();

get_footer();
