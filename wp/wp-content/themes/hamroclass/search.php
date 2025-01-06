<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
<section id="primary" class="content-area main-content-area">
	<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'hamroclass' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->
			<?php $hamroclass_search_layout = get_theme_mod( 'hamroclass_search_layout', 'list' ); ?>
			<div class="hamroclass-list-items-wrapper  hmc-list-<?php echo esc_attr($hamroclass_search_layout); ?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/listing/content',  $hamroclass_search_layout );
				endwhile;
				$navigation_type = apply_filters( 'hamroclass_search_navigation_layout', 'navigation' );
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
</section><!-- #primary -->
<?php
get_sidebar();
get_footer();