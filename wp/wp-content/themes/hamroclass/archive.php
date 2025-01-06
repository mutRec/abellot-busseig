<?php
/**
 * The template for displaying archive pages
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
		if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					$hamroclass_archive_layout = get_theme_mod( 'hamroclass_archive_layout', 'list' );
				?>
			</header><!-- .page-header -->
			<div class="hamroclass-list-items-wrapper hmc-list-<?php echo esc_attr($hamroclass_archive_layout); ?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/listing/content',  $hamroclass_archive_layout );
				endwhile;

				$navigation_type = apply_filters( 'hamroclass_archive_navigation_layout', 'navigation' );
				if($navigation_type=='navigation' ){
					the_posts_navigation();	
				}else{
					do_action('hamroclass_navigation_template', $navigation_type );
				}
				?>
			</div>
		<?php else :
			get_template_part( 'template-parts/single/content', 'none' );
		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();