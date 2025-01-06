<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

$not_found_title = get_theme_mod( 'centurylib_notfound_page_title', esc_html__( 'Oops! That page can&rsquo;t be found.', 'hamroclass' ) );
$not_found_description = get_theme_mod( 'centurylib_notfound_page_description', esc_html__( 'It looks like nothing was found at this location.', 'hamroclass' ) );
?>
	<div id="primary" class="content-area main-content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html($not_found_title); ?></h1>
				</header><!-- .page-header -->
				<div class="error-num"> <?php esc_html_e( '404', 'hamroclass' ); ?> <span><?php esc_html_e( 'error', 'hamroclass' );?></span> </div>
				<div class="page-content">
					<p><?php echo esc_html($not_found_description); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();