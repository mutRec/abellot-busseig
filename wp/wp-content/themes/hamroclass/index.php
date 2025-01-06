<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			$hamroclass_blog_layout = get_theme_mod( 'hamroclass_blog_layout', 'list' );
			?>
			<div class="hamroclass-list-items-wrapper hmc-list-<?php echo esc_attr($hamroclass_blog_layout); ?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/listing/content',  $hamroclass_blog_layout );
				endwhile;
				$navigation_type = apply_filters( 'hamroclass_index_navigation_layout', 'navigation' );
				if($navigation_type=='navigation' ){
					the_posts_navigation();	
				}else{
					do_action('hamroclass_navigation_template', $navigation_type );
				}
				?>
			</div>
			<?php 
		else :
			get_template_part( 'template-parts/single/content', 'none' );
		endif; 
		?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();

get_footer();
