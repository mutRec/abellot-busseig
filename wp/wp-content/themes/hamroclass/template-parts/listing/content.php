<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hmc-content-list' ); ?>>
	<div class="hmc-article-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
		</a>
	</div><!-- .hmc-article-thumb -->
	<div class="hmc-post-content-wrapper">
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			$show_date = 'show';
			$show_author = 'show';
			$excerpt_length = 400;
			$readmore_text = esc_html__( 'Read More...', 'hamroclass' );
			if(is_archive()){
				$show_date = get_theme_mod( 'centurylib_enable_date_archive', $show_date );
				$show_author = get_theme_mod( 'centurylib_enable_authorname_archive', $show_author );
				$excerpt_length = get_theme_mod( 'centurylib_excerpt_length_archive', $excerpt_length );
				$readmore_text = get_theme_mod( 'centurylib_readmore_text_archive', $readmore_text );
			}
			if(is_home()){
				$show_date = get_theme_mod( 'centurylib_enable_date_index', $show_date );
				$show_author = get_theme_mod( 'centurylib_enable_authorname_index', $show_author );
				$excerpt_length = get_theme_mod( 'centurylib_excerpt_length_index', $excerpt_length );
				$readmore_text = get_theme_mod( 'centurylib_readmore_text_index', $readmore_text );
			}
			if(is_search()){
				$show_date = get_theme_mod( 'centurylib_enable_date_search', $show_date );
				$show_author = get_theme_mod( 'centurylib_enable_authorname_search', $show_author );
				$excerpt_length = get_theme_mod( 'centurylib_excerpt_length_search', $excerpt_length );
				$readmore_text = get_theme_mod( 'centurylib_readmore_text_search', $readmore_text );
			}
			$args1 = ($show_date == 'show') ? true : false;
			$args2 = ($show_author == 'show') ? true : false;
			if ( 'post' === get_post_type() ):
				?>
				<div class="entry-meta">
					<?php hamroclass_inner_posted_on($args1, $args2); ?>
				</div><!-- .entry-meta -->
				<?php
			endif;
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			$show_readmore = ($readmore_text) ? true : false;
			centurylib_the_excerpt( absint($excerpt_length), $show_readmore, $readmore_text);
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php hamroclass_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .hmc-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->